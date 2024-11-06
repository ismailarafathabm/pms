app.controller('manpowerrpt', manpowerrpt);

function manpowerrpt($scope, $http) {
    console.log("working");
    const FetchData = async (url, postdata) => {
        const req = await fetch(url, postdata);
        try {
            const res = await req.json();
            return res;
        } catch (e) {
            console.log(e);
            return {};
        }

    }

    const GetRentData = async (date) => {
        const fd = new FormData();
        fd.append("session_username", userinfo.user_name);
        fd.append("session_token", userinfo.user_token);
        fd.append("mdate", date);
        const postData = {
            body: fd,
            method: 'post',
            headers: {
                'Accept': 'application/json'
            }
        };
        const res = await FetchData(`${api_pms}api/manpowerxa/e.php`, postData);
        console.log(res);
        if (res.msg === '1') {
            return res.data;
        } else {
            return [];
        }
    }

    const GetContractData = async (date) => {
        const fd = new FormData();
        fd.append("session_username", userinfo.user_name);
        fd.append("session_token", userinfo.user_token);
        fd.append("mdate", date);
        const postData = {
            body: fd,
            method: 'post',
            headers: {
                'Accept': 'application/json'
            }
        };
        const res = await FetchData(`${api_pms}api/manpowerxa/f.php`, postData);
        console.log(res);
        if (res.msg === '1') {
            return res.data;
        } else {
            return [];
        }
    }

    const GetData = async (date) => {
        const fd = new FormData();
        fd.append("session_username", userinfo.user_name);
        fd.append("session_token", userinfo.user_token);
        fd.append("mdate", date);
        const postData = {
            body: fd,
            method: 'post',
            headers: {
                'Accept': 'application/json'
            }
        };
        const res = await FetchData(`${api_pms}api/manpowerxa/c.php`, postData);
        console.log(res);
        if (res.msg === '1') {

            return res.data;
        } else {
            return [];
        }

    }

    const ReportGen = async (date) => {
        const data = await GetData(date);
        let _projectnames = [];
        data.map(i => {
            let isPname = _projectnames.includes(i.projectname);
            if (!isPname) {
                _projectnames.push(i.projectname);
            }
        });

        // $scope.$apply();
        let projectinfos = [];
        let absent = [];
        let present = []
        _projectnames.map(i => {
            let result = data.find(x => x.projectname === i);
            let abesents = [];
            let presents = [];
            data.map(x => {
                if (x.filenostatus.toString() === "1" && x.projectname.toLowerCase() === i.toLowerCase()) {
                    presents.push(x);
                }
                if (x.filenostatus.toString() !== "1" && x.projectname.toLowerCase() === i.toLowerCase()) {
                    abesents.push(x);
                }
            })
            present.push({
                project: i,
                presents: presents
            });
            absent.push({
                project: i,
                abesents: abesents
            })
            projectinfos.push(result);

        });

        let finalData = [];

        _projectnames.map(i => {
            let datainfo = {};
            projectinfos.map(j => {
                if (i.toLowerCase() === j.projectname.toLowerCase()) {
                    datainfo = {
                        ...datainfo,
                        mdate: j.mdate,
                        mdate_n: j.mdate_n,
                        mdate_d: j.mdate_d,
                        mdate_p: j.mdate_p,
                        projectno: j.projectno,
                        projectname: j.projectname,
                        formanname: j.formanname,
                        projectregion: j.projectregion,
                        mangername: j.mangername,
                        pmhfnoname: j.pmhfnoname,
                        totrent: 0,
                        subcont: 0

                    }
                }
            })
            let pr = 0;
            present.map(j => {
                if (i.toLowerCase() === j.project.toLowerCase()) {
                    datainfo = {
                        ...datainfo,
                        pres: j.presents.length
                    }
                    pr = (j.presents.length);
                }
            })
            let ab = 0;
            absent.map(j => {
                if (i.toLowerCase() === j.project.toLowerCase()) {
                    let ab = (+j.abesents.length);
                    let tot = pr + ab;
                    datainfo = {
                        ...datainfo,
                        abse: j.abesents.length,
                        totalemp: tot

                    };
                }
            })
            finalData.push(datainfo);
        })
        //console.log(finalData);
        const rentdata = await GetRentData(date);
        let rentProjects = [];
        rentdata.map(i => {
            let isRendProjects = rentProjects.includes(i.rprojectname.toLowerCase());
            if (!isRendProjects) {
                rentProjects.push(i.rprojectname.toLowerCase());
            }
        })

        rentdata.map(i => {
            finalData.map(j => {
                // j.totrent = 0
                if (i.rprojectname.toLowerCase() === j.projectname.toLowerCase()) {
                    j.totrent = i.rtota
                }
            })
        });


        const contdata = await GetContractData(date);

        let contProjects = [];
        contdata.map(i => {
            let isRendProjects = contProjects.includes(i.rprojectname.toLowerCase());
            if (!isRendProjects) {
                contProjects.push(i.rprojectname.toLowerCase());
            }


        })

        contdata.map(i => {
            finalData.map(j => {
                // j.subcont = 0
                if (i.rprojectname.toLowerCase() === j.projectname.toLowerCase()) {
                    console.log(i.rtota);
                    j.subcont = i.rtota
                }
            })
        });
        // console.table(rentProjects);
        // console.table(contProjects);

        let notIncludeContProject = contProjects.filter(i => !_projectnames.includes(i.toLowerCase()));
        let notIncludeRendProject = rentProjects.filter(i => !_projectnames.includes(i.toLowerCase()));
        // console.table(notIncludeRendProject);
        // console.table(notIncludeContProject);
        let dtOfNoIncludeContProject = [];
        console.log("contract", contdata);
        notIncludeContProject.map(i => {
            const _edata = contdata.find(x => x.rprojectname.toLowerCase() === i.toLowerCase())
            dtOfNoIncludeContProject.push(_edata);

        })
        console.log("finters contract data", dtOfNoIncludeContProject);
        let dtOfNotIncludeRentProject = [];
        notIncludeRendProject.map(i => {
            const _edata = rentdata.find(x => x.rprojectname.toLowerCase() === i.toLowerCase())
            dtOfNotIncludeRentProject.push(_edata)
        });
        console.log("finters contract data", dtOfNotIncludeRentProject);

        //console.log(dtOfNoIncludeContProject);
        dtOfNoIncludeContProject.map(j => {
            console.log(j);
            finalData.push({
                mdate: j.mdate,
                mdate_n: j.rdate,
                mdate_d: j.rdate_d,
                mdate_p: j.rdate_p,
                projectno: j.rproject,
                projectname: j.rprojectname,
                formanname: j.foremanname,
                pmhfnoname: "-",
                pres: 0,
                abse: 0,
                totalemp: 0,
                projectregion: j.rregion,
                mangername: j.mangername,
                totrent: 0,
                subcont: j.rtota
            })
        })

        dtOfNotIncludeRentProject.map(j => {

            finalData.push({
                mdate: j.mdate,
                mdate_n: j.rdate,
                mdate_d: j.rdate_d,
                mdate_p: j.rdate_p,
                projectno: j.rproject,
                projectname: j.rprojectname,
                formanname: "-",
                pmhfnoname: j.pmhfnoname,
                pres: 0,
                abse: 0,
                totalemp: 0,
                projectregion: j.rregion,
                mangername: "-",
                totrent: j.rtota,
                subcont: 0
            })
        })



        return finalData;
    }


    //_gettest();

    const d = new Date();
    const xdatex = `${d.getDate()}-${d.getMonth() + 1}-${d.getFullYear()}`;
    $scope.newrent = {
        ...$scope.newrent,
        renddate: xdatex
    }
    async function _gettest() {
        const apiurl = `${api_pms}/manpowerx/cb.php?srcdate=2023-08-27`;

        const pd = {
            method: 'POST',
            headers: {
                'accept': 'application/json',
                "Token": `${session_username} ${session_token}`
            }
        }
        const res = await fetch(apiurl, pd);
        console.log(res);
    }

    var _todays = "";
    $scope._ispageloading = true;
    $scope.gregorianDatepickerConfig = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };
    moment.locale('en');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    var filterParams = {
        comparator: function (filterLocalDateAtMidnight, cellValue) {
            var dateAsString = cellValue;
            var dateParts = dateAsString.split('-');
            var cellDate = new Date(
                Number(dateParts[0]),
                Number(dateParts[1]) - 1,
                Number(dateParts[2])
            );

            if (filterLocalDateAtMidnight.getTime() === cellDate.getTime()) {
                return 0;
            }

            if (cellDate < filterLocalDateAtMidnight) {
                return -1;
            }

            if (cellDate > filterLocalDateAtMidnight) {
                return 1;
            }
        },
    };

    var columndef = [{
        headerName: 'Project No',
        field: 'projectno',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 100,
    },
    {
        headerName: 'Name',
        field: 'projectname',
        cellRenderer: function (d) {
            // return `
            // // <button type="button" class="ism-btn ism-btn-danger" onclick="getinfos('${d.data.projectno}','${d.data.mdate}')" style="padding: 3px 2px;">
            // //     ${d.data.projectname}
            // // </button>
            // `
            return `${d.data.projectname}`

        },
        filter: 'agMultiColumnFilter',

        sortingOrder: ['asc', 'desc'],
        width: 495,
        sort: 'asc',
        sortIndex: 2,
    },
    {
        headerName: 'Region',
        field: 'projectregion',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        sort: 'asc',
        sortIndex: 0,
    },
    {
        headerName: 'Project Head',
        field: 'pmhfnoname',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        sort: 'asc',
        sortIndex: 1,
        cellRenderer: function (p) {
            return p.data.pmhfnoname === 'NAN' || p.data.pmhfnoname === 'false' || p.data.pmhfnoname === false ? '-' : p.data.pmhfnoname;
        }
    },
    {
        headerName: 'Project Manager',
        field: 'mangername',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        sort: 'asc',
        sortIndex: 1,
        cellRenderer: function (p) {
            return p.data.mangername === 'NAN' ? 'NONE' : p.data.mangername;
        }
    },
    {
        headerName: 'Foreman',
        field: 'formanname',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        sort: 'asc',
        sortIndex: 1,
        cellRenderer: function (p) {
            return p.data.formanname === 'NAN' ? 'NONE' : p.data.formanname;
        }
    },
    {
        headerName: 'Total',
        field: 'totalemp',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellRenderer: function (d) {
            return (+d.data.totalemp) === 0 ? "-" : d.data.totalemp
        },
        width: 70,
    },
    {
        headerName: 'Absent',
        field: 'abse',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellRenderer: function (d) {
            return (+d.data.abse) === 0 ? "-" : d.data.abse
        },
        width: 70,
    },
    {
        headerName: 'Present',
        field: 'pres',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellRenderer: function (d) {
            return (+d.data.pres) === 0 ? "-" : d.data.pres
        },
        width: 70,
    },

    {
        headerName: 'Rent',
        field: 'totrent',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 70,
    },
    {
        headerName: 'Sub.Con',
        field: 'subcont',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 70,
    },

    ];
     
    
    let gridOptions = {
            columnDefs: columndef,
            enableCellChangeFlash: true,
            defaultColDef: {

                sortable: true,
                filter: true,
                floatingFilter: true,
                wrapText: true,
                resizable: true,
            },
            suppressMenuHide: true,
            excelStyles: [{
                id: 'dateType',
                dataType: "dateTime",
                numberFormat: {
                    format: "dd-MMM-yyyy;;;"
                }
            },
            {
                id: 'dateTypes',
                dataType: "dateTime",
                numberFormat: {
                    format: "dd-MMM-yyyy;;;"
                }
            },
            {
                id: 'dateType_green',
                dataType: "dateTime",
                numberFormat: {
                    format: "dd-MMM-yyyy;;;"
                }
            }
            ],
            statusBar: {
                statusPanels: [{

                    statusPanel: 'agFilteredRowCountComponent',
                    align: 'left'
                },
                {
                    statusPanel: 'agTotalAndFilteredRowCountComponent',
                    align: 'left'
                },
                ],
            },
            rowHeight: 50,
        };

       
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    
    

    $scope.print_projecthead_rpt = () => {
        //check previous 
        let _x = new Date('2023-02-07');
        let _n = document.getElementsByName("startdate")[0];
        if (_n.value.trim() === "") {
            alert("Please Load Report");
            return;
        }
        let x = _n.value.split('-');
        let _y = x[2];
        let _m = x[1];
        let _d = x[0];
        let _fd = `${_y}-${_m}-${_d}`;

        let _fdd = new Date(_fd);;
        if (_x > _fdd) {
            alert("This Report Only Work After 07-02-2023");
            return;
        }
        let printdata = []
        gridOptions.api.forEachNodeAfterFilterAndSort(i => {
            printdata.push(i.data)
        });
        if (printdata.length === 0) {
            alert("No Data Found");
            return;
        }
        console.log(printdata);
        localStorage.removeItem("print_ems_manpower_daily_new_datas");
        localStorage.removeItem("print_ems_manpower_daily_new_title");
        localStorage.setItem("print_ems_manpower_daily_new_datas", JSON.stringify(printdata));
        let printpagetitle = `Daily Manpower Report For  ${_todays}`;
        localStorage.setItem("print_ems_manpower_daily_new_title", printpagetitle)
        window.open('../../print/manpower/indexnew.html', '_blank', "width = '1300px', height = '700px'");
    }

    $scope.filterdata_submit = async () => {
        $scope.is_start_update = true;
        var date = document.getElementsByName("startdate")[0].value;
        _date = date;
        dateinfos(date);
        const finaldata = await ReportGen(date);
        //console.table(finaldata);
        gridOptions.api.setRowData(finaldata);
        document.getElementById('rpt_src_dialog').style.display = "none";

        $scope.is_start_update = false;
        $scope.$apply();
    }

    function dateinfos(date) {
        var post_data = {
            url: `${api_pms}api/manpowerxa/ex.php?datex=${date}`,
            method: 'post'
        };
        var rdaa = [];
        $http(post_data).then(res => {
            $scope._filtertitle = `- ${res.data.datefull}  -  ${res.data.datefr}`;
            _todays = `- ${res.data.datefull}  -  ${res.data.datefr}`;

            document.title = `${res.data.datefull}  -  ${res.data.datefr} MANPOWER REPORT [NAFCO - EMS]`;

        });
    }
    
    
    $scope.prints = () => {
                //check previous 
                let _x = new Date('2023-02-07');
                let _n = document.getElementsByName("startdate")[0];
                if (_n.value.trim() === "") {
                    alert("Please Load Report");
                    return;
                }
                let x = _n.value.split('-');
                let _y = x[2];
                let _m = x[1];
                let _d = x[0];
                let _fd = `${_y}-${_m}-${_d}`;

                let _fdd = new Date(_fd);;
                if (_x > _fdd) {
                    alert("This Report Only Work After 07-02-2023");
                    return;
                }
                let printdata = []
                gridOptions.api.forEachNodeAfterFilterAndSort(i => {
                    printdata.push(i.data)
                });
                if (printdata.length === 0) {
                    alert("No Data Found");
                    return;
                }
                console.log(printdata);
                localStorage.removeItem("print_ems_manpower_daily_new_datas");
                localStorage.removeItem("print_ems_manpower_daily_new_title");
                localStorage.setItem("print_ems_manpower_daily_new_datas", JSON.stringify(printdata));
                let printpagetitle = `Daily Manpower Report For  ${_todays}`;
                localStorage.setItem("print_ems_manpower_daily_new_title", printpagetitle)
                window.open('https://ems.alunafco.net//print/manpower/indexnew.html', '_blank', "width = '1300px', height = '700px'");
            }

}





