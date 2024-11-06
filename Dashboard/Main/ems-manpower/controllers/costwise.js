import API_Services from "../services/apiServices.js";

export default function costWisemanpower($scope, $compile) {
    $scope.gregorianDatepickerConfig = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian',
        minDate: moment().subtract(10, 'years'),
        allowFuture: false,
    };
    moment.locale('en');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };

    const rpt_src_dialog2 = document.getElementById("rpt_src_dialog2");
    rpt_src_dialog2.style.display = "flex";
    const cols = _cols($scope, $compile);

    const apis = new API_Services();
    const gridOptions = apis._gridOptions(cols);
    $scope.isLoading = false;
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);
    $scope.clearFilters = () => {
        filterClear();
    }

    function filterClear() {
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        });
        gridOptions.api.setFilterModel(null);
    }
    $scope.exportExcel = () => {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            let da = document.getElementsByName('startdate')[0].value;
            var mname = `Man Power Daily Report For ${da}`
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }


    $scope.filterdata_submit = async () => await LoadReport();

    const funUniqeProjects = async (datas) => {
        let projectlist = [];
        datas.map(i => {
            if (!projectlist.includes(i.projectname)) {
                projectlist.push(i.projectname);
            }
        })
        return projectlist;
    }
    const funprojectEmployees = (projects, data) => {
        let projectemp = [];
        projects.map(i => {
            let projectname = i;
            let projectdata = data.filter(x => x.projectname === i);
            projectemp.push({ projectname: projectname, projectdata: projectdata });
        })
        return projectemp;
    }
    const funPresentCount = (filterdata) => {
        const present = filterdata.filter(x => x.filenostatus === "1");
        return present.length;
    }
    const sumofproject = (data) => {
        //console.log(data);
        let tos = 0
        data.map(i => {
            if (i.filenostatus === "1") {

                tos += (+i.perday);
            }
        })
        return tos;
    }
    const funProjectSummary = (projectdata) => {
        let summary = [];
        projectdata.map(i => {
            let pjname = i.projectname;
            let total = i.projectdata.length;
            let present = funPresentCount(i.projectdata);
            let absent = (+total) - (+present);
            let totval = sumofproject(i.projectdata);
            let projectinfo = i.projectdata.find(x => x.projectname === i.projectname);
            summary.push({
                pjname: pjname,
                total: total,
                present: present,
                absent: absent,
                datas: i.projectdata,
                totval: (+totval).toFixed(2),
                projectinfo: projectinfo
            })
        })
        return summary;
    }
    const funreportSummary = (summaryData) => {
        let rpt = [];
        summaryData.map(i => {
            rpt.push(
                {
                    projectno: i.projectinfo.projectno,
                    projectname: i.projectinfo.projectname,
                    projectregion: i.projectinfo.projectregion,
                    mangername: i.projectinfo.mangername,
                    engname: i.projectinfo.engname,
                    formanname: i.projectinfo.formanname,
                    formatsubname: i.projectinfo.formatsubname,
                    pres: i.present,
                    abse: i.absent,
                    totalemp: i.total,
                    coustamount: i.totval,
                    datas: i.datas
                }
            )
        })
        return rpt;
    }


    const TableWork = async (data, emp) => {
        const projectlist = await funUniqeProjects(data);
        const projectData = await funprojectEmployees(projectlist, data);
        const summaryData = await funProjectSummary(projectData);
        const finaldata = await funreportSummary(summaryData);
        return finaldata;
    }
    let _startdate = document.getElementsByName("startdate")[0];
    let _enddate = document.getElementsByName("enddate")[0];
    async function LoadReport() {
        if ($scope.isLoading) return;
        gridOptions.api.setRowData([]);
        _startdate = document.getElementsByName("startdate")[0];
        _enddate = document.getElementsByName("enddate")[0];
        if (_startdate.value.trim() === "") {
            alert("Enter Start Date");
            _startdate.focus();
            return;
        }
        if (_enddate.value.trim() === "") {
            alert("Enter End Date");
            _enddate.focus();
            return;
        }
        $scope.isLoading = true;
        const res = await apis.GET(`pms-manpower/monthly.php?stdate=${_startdate.value}&enddate=${_enddate.value}`);
        if (!res.isSuccess) {
            alert(res.msg);
            $scope.isLoading = false;
            $scope.$apply();
            return;
        }
        if (!res.data) {
            alert("No Data found");
            rpt_src_dialog2.style.display = "none";
            $scope.isLoading = false;
            $scope.$apply();
            return;
        }
        const summary = await TableWork(res.data, []);
        $scope.workerlist = summary;
        gridOptions.api.setRowData(summary);
        rpt_src_dialog2.style.display = "none";
        $scope.isLoading = false;
        $scope.$apply();
        return;
    }

    $scope.getinfos = async (pid, pname) => await LoadProjectSummary(pid, pname)
    const getCurrentProjectinfo = (datas, current) => {
        const data = datas.filter(i => i.projectname === current);
        return data;

    }
    const funWorkerFnoList = (datas) => {
        let fnos = [];
        datas.map(i => {
            if (!fnos.includes(i.efile)) {
                fnos.push(i.efile);
            }
        })
        return fnos;
    }

    const funSummary = (fnolist, datas) => {
        let summary = [];
        fnolist.map(i => {
            let fno = i;
            let empinfo = datas.filter(j => j.efile === i);
            console.log(empinfo);

            let totpresdate = datas.filter(j => j.efile === i && j.filenostatus === "1");
            let present = totpresdate.length;
            let totabsent = datas.filter(j => j.efile === i && j.filenostatus !== "1");
            let absent = totabsent.length;
            let totdays = (+present) + (+absent);
            let totamount = (+empinfo[0].perday) * (+present)
            summary.push({
                fileno: fno,
                ename: empinfo[0].ename,
                enationality: empinfo[0].enationality,
                eposition: empinfo[0].ecategory,
                present: present,
                pres: present,
                amount: (+totamount).toFixed(2),
                abse: absent,
                totalemp: totdays
            })

        });
        return summary;
    }
    const countrylist = (datas) => {
        let clist = [];
        datas.map(i => {
            if (!clist.includes(i.enationality)) {
                clist.push(i.enationality)
            }
        })
        return clist;
    }
    const positionlist = (datas) => {
        let clist = [];
        datas.map(i => {
            if (!clist.includes(i.eposition)) {
                clist.push(i.eposition)
            }
        })
        return clist;
    }

    async function LoadProjectSummary(project, pjname) {
        var dia = document.getElementById("rpt_emp_dialog");
        $scope._empinfomanpower = `Date Form : ${_startdate} to ${_enddate}`;
        dia.style.display = "block";
        $scope._empinfomanpowerdet = {
            'stardate': _startdate,
            'endate': _enddate,
            'project': pjname,
            // 'employsees': employsees,
            // 'positions': src_designation,
            // 'countrys': src_nationality,
            'pjname': pjname

        };
        // console.log(scope.workerlist);
        const currentProject = getCurrentProjectinfo($scope.workerlist, pjname);
        // console.log(currentProject);
        // console.log(currentProject[0].datas);
        const filenoList = funWorkerFnoList(currentProject[0].datas);
        //console.log(filenoList);
        const summary = funSummary(filenoList, currentProject[0].datas);
        ///console.log(summary);
        $scope._empinfomanpowerdet.employsees = summary;
        $scope._empinfomanpowerdet.positions = positionlist(summary);
        $scope._empinfomanpowerdet.countrys = countrylist(summary);
        //$scope.$apply();
    }


    //for print actions
    let _todays = "";
    $scope.print_rpt = () => {
        var regions = [];
        var print_data = [];
        var tot_emp = 0;
        var totamount = 0;
        var cdate = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(i => {
            cdate.push(i.data);
            tot_emp += (+i.data.totalemp);
            totamount += (+i.data.coustamount);
            var av = regions.includes(i.data.projectregion);
            if (!av) {
                regions.push(i.data.projectregion)
            }
        })

        regions.map(i => {
            var regnam = i;
            var list = [];
            var total = 0;
            var totempamount = 0;
            cdate.map(j => {
                if (i === j.projectregion) {
                    total += (+j.totalemp);
                    totempamount += (+j.coustamount);
                    list.push(j)
                }
            })
            print_data.push({
                regnam,
                list,
                total,
                totempamount
            });

        })


        var prdata = "";
        prdata += ` <div class="row monthinfos">
                     <div class="monthinfoss">Project Wise Summary With Cost ${_todays}</div>
                     </div>                                
                        `;
        print_data.map(i => {
            if (i.list.length !== 0) {
                prdata += `<div class="row summarytable" style="background:#f6ea98">
                            <div>Region : ${angular.uppercase(i.regnam)} <span style="color:red"> Total Employees :${i.total}</span> </div>
                            <div class='title_tos'>Total Amount : ${(+i.totempamount).toLocaleString(undefined,{maximumFractionDigits:2})} </div>
                        </div>
                `;
                prdata += `<div class="variationfino">
                            <table>
                                <thead>                                                                                       
                                    <tr>
                                        <th class="fiexdheader" style="width:25px">S.No</th> 
                                        <th class="fiexdheader" style="width:100px">Project No</th>           
                                        <th class="fiexdheader" style="width:300px">Project Name</th>                                                           
                                        <th class="fiexdheader" style="width:100px">Present</th>  
                                        <th class="fiexdheader" style="width:100px">Absent</th>  
                                        <th class="fiexdheader" style="width:100px">Total</th>                                                                                      
                                        <th class="fiexdheader" style="width:100px">Amount</th>    
                                    </tr>
                                </thead>
                                <tbody>`;
                var sno = 0;
                var totalprj = 0;
                var totabs = 0;
                var totpres = 0;
                var tttcnt = 0;
                var tttamount = 0;
                i.list.map(j => {
                    sno += 1;
                    totalprj = sno;
                    totabs += (+j.abse);
                    totpres += (+j.pres);
                    tttcnt += (+j.totalemp);
                    tttamount += (+j.coustamount)
                    prdata += `
                                    <tr>
                                        <td class="fullinfo" style="width:25px">${sno}</td>
                                        <td class="fullinfo" style="width:100px">${j.projectno}</td>
                                        <td class="fullinfo" style="width:300px">${j.projectname.toUpperCase()}</td>
                                        <td class="fullinfo" style="width:100px;text-align:center;">${j.pres}</td>
                                        <td class="fullinfo" style="width:100px;color:red;text-align:center;">${j.abse}</td>
                                        <td class="fullinfo" style="width:100px;font-weight:bold;text-align:center;">${j.totalemp}</td>                                                
                                        <td class="fullinfo" style="width:100px;font-weight:bold;text-align:center;">${(+j.coustamount).toLocaleString(2)}</td>                                                
                                    </tr>
                                    `;
                });

                prdata += `
                                    <tr>
                                        <td colspan="3" style="font-size: 14px;background-color: #b3ffb5;font-weight: 600;">Total Project ${totalprj}</td>                                                
                                        <td style="font-size: 14px;background-color: #b3ffb5;font-weight: 600;text-align:center;">${totpres}</td>
                                        <td style="font-size: 14px;background-color: #b3ffb5;font-weight: 600;text-align:center;">${totabs}</td>
                                        <td style="font-size: 14px;background-color: #b3ffb5;font-weight: 600;text-align:center;">${tttcnt}</td>                                                
                                        <td style="font-size: 14px;background-color: #b3ffb5;font-weight: 600;text-align:center;">${(+tttamount).toLocaleString(undefined,{maximumFractionDigits:2})}</td>  
                                    </tr> </tbody></table>
                `;

            }
        })

        prdata += `<div class="row summarytable bottomtotal" style="background:#ffea5d">
                            <div>
                                Total Employees  ${tot_emp} 
                            </div>
                            <div class='title_tos'>
                               Total Amount : ${(+totamount).toLocaleString(undefined,{maximumFractionDigits:2})}
                            </div>
                        </div>
            `;

        localStorage.removeItem("printdisplayhead");
        localStorage.removeItem('print_data');
        localStorage.setItem('print_data', prdata);

        window.open(`${api_pms}/print/manpower/index.html`, '_blank', "width = '1300px', height = '700px'");
    }

    $scope.print_myinfos = () => {
        var category = [];
        var workerslist = [];
        $scope.flist.map(i => {
            var av = category.includes(i.eposition);
            if (!av) {
                category.push(i.eposition)
            }
            workerslist.push(i)
        });
        var gtotemp = 0;
        var gtotal = 0;
        var prdata = [];
        category.map(i => {
            var cate = i;
            var emplis = [];
            var totab = 0;
            var totpr = 0;
            var totda = 0
            var totsal = 0;
            workerslist.map(j => {
                if (j.eposition === i) {
                    totab += (+j.abse);
                    totpr += (+j.pres);
                    totda += (+j.totalemp)
                    totsal += (+j.amount);
                    gtotal += (+j.amount);
                    emplis.push(j);
                }
            })

            prdata.push({
                cate,
                emplis,
                totab,
                totpr,
                totda,
                totsal,
            })
        });
        let pjname = $scope._empinfomanpowerdet.pjname;
        var prdatap = "";
        prdatap += ` 
        <div class="row monthinfos">
                     <div class="monthinfoss">Man Power Summary Cost Report </div>
                     </div>
        <div class="row monthinfos">
                     <div class="monthinfoss">Project Name : ${pjname}</div>
                     </div> 
        <div class="row monthinfos">
                     <div class="monthinfoss">  ${_todays}</div>
                     </div>
                                                    
                        `;
        prdata.map(i => {
            prdatap += `<div class="row summarytable" style="background:#f6ea98">
                            <div>Designation : ${angular.uppercase(i.cate)}</div>
                            <div class='title_tos'>Total Salary : ${(+i.totsal).toLocaleString(2)} </div>
                        </div>
                `;
            prdatap += `<div class="variationfino">
                        <table>
                            <thead>                                                                                       
                                <tr>
                                    <th class="fiexdheader" style="width:25px">S.No</th> 
                                    <th class="fiexdheader" style="width:100px">File No</th>           
                                    <th class="fiexdheader" style="width:300px">Name</th>                                                           
                                    <th class="fiexdheader" style="width:100px">Nationality</th>  
                                    <th class="fiexdheader" style="width:100px">Present</th>  
                                    <th class="fiexdheader" style="width:100px">Absent</th>                                                                                      
                                    <th class="fiexdheader" style="width:100px">Total Days</th>                                                                                      
                                    <th class="fiexdheader" style="width:100px">Salary</th>                                                                                      
                                </tr>
                            </thead>
                            <tbody>`;
            var sno = 0;
            var totemp = i.emplis.length;
            gtotemp += i.emplis.length;
            i.emplis.map(j => {
                sno += 1;
                prdatap += `
                                    <tr>
                                        <td class="fullinfo" style="width:25px">${sno}</td>
                                        <td class="fullinfo" style="width:100px">${j.fileno}</td>
                                        <td class="fullinfo" style="width:300px">${j.ename}</td>
                                        <td class="fullinfo" style="width:100px">${j.enationality}</td>
                                        <td class="fullinfo" style="width:100px;color:red">${j.pres}</td>
                                        <td class="fullinfo" style="width:100px;color:red">${j.abse}</td>
                                        <td class="fullinfo" style="width:100px;color:red">${j.totalemp}</td>
                                        <td class="fullinfo" style="width:100px;font-weight:bold">${(+j.amount).toLocaleString(2)}</td>                                                
                                    </tr>
                                    `;
            })
            prdatap += `
                                    <tr>
                                        <td colspan="4">Total Employees ${totemp}</td>                                                
                                        <td style="font-weight:bold">${i.totpr}</td>
                                        <td style="font-weight:bold;color:red">${i.totab}</td>
                                        <td style="font-weight:bold">${i.totda}</td>                                                
                                        <td style="font-weight:bold">${(+i.totsal).toLocaleString(2)}</td>                                                
                                    </tr> </tbody></table>
                `;
        });
        prdatap += `<div class="row summarytable bottomtotal" style="background:#ffea5d">
                            <div>
                                Total Employees ${gtotemp}
                            </div>
                            <div class='title_tos'>
                                Total Amount : ${gtotal.toFixed(2)} 
                            </div>
                        </div>
            `;
        localStorage.removeItem("printdisplayhead");
        localStorage.removeItem('print_data');
        localStorage.setItem('print_data', prdatap);

        window.open(`${api_pms}/print/manpower/index.html`, '_blank', "width = '1300px', height = '700px'");
    }
}




function _cols(s, c) {
    const columndef = [{
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
            return c(`
            <button type="button" class="grid-button" ng-click="getinfos('${d.data.projectno}','${d.data.projectname}')">
                ${d.data.projectname.toUpperCase()}
            </button>
            `)(s)[0];
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 495,

    },
    {
        headerName: 'Region',
        field: 'projectregion',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        sort: 'asc'
    },
    {
        headerName: 'Present',
        field: 'pres',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 70,
    },
    {
        headerName: 'Absent',
        field: 'abse',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 70,
    },
    {
        headerName: 'Total',
        field: 'totalemp',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 70,
    },
    {
        headerName: 'Amount',
        field: 'coustamount',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 70,
    },

    ];

    return columndef;
}