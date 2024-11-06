import _ from './../service/index.js';

export default class MtblServices extends _ {
    #page = "mattobeload";

    formvalidate(msg) {
        const loadproject = document.getElementById("loadproject");
        const location = document.getElementById("location");
        const loaddate = document.getElementById("loaddate");
        const loadingdate = document.getElementById("loadingdate");
        const ascurrentdate = document.getElementById("ascurrentdate");
        const driver = document.getElementById("driver");
        const status = document.getElementById("status");
        const remark = document.getElementById("remark");

        if (loadproject.value.trim() === "") {
            msg(true, "n", "Enter Project Name");
            loadproject.focus();
            return 0;
        }

        if (location.value.trim() === "") {
            msg(true, "n", "Enter Project Location");
            location.focus();
            return 0;
        }
        if (loaddate.value.trim() === "") {
            msg(true, "n", "Enter Run Date");
            loaddate.focus();
            return 0;
        }

        if (loadingdate.value.trim() === "") {
            msg(true, "n", "Enter Loading Date");
            loadingdate.focus();
            return 0;
        }

        if (ascurrentdate.value.trim() === "") {
            msg(true, "n", "Enter At Site Date");
            ascurrentdate.focus();
            return 0;
        }
        if (driver.value.trim() === "") {
            msg(true, "n", "Enter Driver Name");
            driver.focus();
            return 0;
        }

        if (status.value.trim() === "") {
            msg(true, "n", "Select Status");
            status.focus();
            return 0;
        }

        if (remark.value.trim() === "") {
            msg(true, "n", "Enter Remark");
            remark.focus();
            return 0;
        }

        let estimatedate = "";
        let estimatetositedate = "";

        if (status.value === "Delivered") {
            estimatedate = document.getElementById("estimatedate");
            estimatetositedate = document.getElementById("estimatetositedate");
            if (estimatedate.value.trim() === "") {
                msg(true, "n", "Enter Actual Loaded Date");
                estimatedate.focus();
                return 0;
            }

            if (estimatetositedate.value.trim() === "") {
                msg(true, "n", "Enter Actual At Site Date");
                estimatetositedate.focus();
                return 0;
            }
        }
        const fd = this.FormData();
        fd.append("loadproject", loadproject.value);
        fd.append("location", location.value);
        fd.append("loaddate", loaddate.value);
        fd.append("loadingdate", loadingdate.value);
        fd.append("ascurrentdate", ascurrentdate.value);
        fd.append("driver", driver.value);
        fd.append("status", status.value);
        fd.append("loadproject", loadproject.value);
        fd.append("remark", remark.value);
        if (status.value === "Delivered") {
            fd.append("estimatedate", estimatedate.value);
            fd.append("estimatetositedate", estimatetositedate.value);
        }
        return fd;
    }
    #driverlist(_data) {
        let driverlist = [];
        _data.map(i => {
            let driver = i.driver;
            if (!driverlist.includes(driver.toLowerCase())) {
                driverlist = [...driverlist, i.driver.toLowerCase()]
            }
        })

        return driverlist;
    }
    async getallrpt(fd = this.FormData(), scope, grid) {
        scope.mtblrpt = {
            ...scope.mtblrpt,
            data: {
                ...scope.mtblrpt.data
            },
            isloading: true
        };
        const res = await this.servicecall(
            this.#page,
            "loadrpt",
            fd
        );

        if (res.msg !== 1) {
            scope.mtblrpt = {
                ...scope.mtblrpt,
                data: {
                    ...scope.mtblrpt.data
                },
                isloading: false
            };
            scope.$apply();
            return;
        }

        scope.mtblrpt = {
            ...scope.mtblrpt,
            data: {
                ...scope.mtblrpt.data
            },
            isloading: false
        };
        scope.driverlist = this.#driverlist(res.data);
        console.log(scope.driverlist)
        grid.api.setRowData(res.data);
        document.getElementById("dia_load_rpt").style.display = "none";
        scope.$apply();
        return;
    }
    async Save(fd = this.FormData(), msg, scope, grid,ep) {
        scope.mtbl = {
            ...scope.mtbl,
            data: { ...scope.mtbl.data },
            mtbllist: [...scope.mtbl.mtbllist],
            listadd: { ...scope.mtbl.listadd, data: { ...scope.mtbl.listadd.data } },
            isloading: true,
        }
        const res = await this.servicecall(this.#page, 'save', fd);
        if (res.msg !== 1) {
            msg(true, "n", res.data);
            scope.mtbl = {
                ...scope.mtbl,
                data: { ...scope.mtbl.data },
                mtbllist: [...scope.mtbl.mtbllist],
                listadd: { ...scope.mtbl.listadd, data: { ...scope.mtbl.listadd.data } },
                isloading: false,
            }
            scope.$apply();
            return;
        }
        msg(true, "t", "Saved");
        scope.mtbl = ep();
        grid.api.setRowData(res.data);
        scope.$apply();
    }
    #projectsummarycalc(data) {
        let fdata = [];
        let desc = [];
        data.map(i => {
            const _des = i.description.toLowerCase();
            if (!desc.includes(_des)) {
                desc.push(_des);
            }
        });
        console.log(desc);
        let disc_info = [];
        desc.map(i => {
            let dname = i;
            let dunit = "";
            let dtotal = 0;
            let ddele = 0;
            let dpend = 0;
            let pres = 0;
            data.map(j => {
                if (i === j.description.toLowerCase()) {
                    dunit = j.unit;
                }
                if (i === j.description.toLowerCase()) {
                    dtotal += (+j.qty);
                    if (j.status === "Delivered") {
                        ddele += (+j.qty);
                    } else {
                        dpend += (+j.qty);
                    }
                }
            })

            pres = Math.round(ddele / dtotal * 100);
            disc_info.push(
                {
                    dname,
                    dunit,
                    dtotal,
                    ddele,
                    dpend,
                    pres
                }
            );
        })
        console.log(disc_info)
        fdata = disc_info;
        return fdata;
    }
    async rptbyproject(fd = this.FormData(), scope) {
        scope.projectmat = {
            ...scope.projectmat,
            data: [],
            isloading: true
        };
        const res = await this.servicecall(
            this.#page,
            "loadrptbyproject",
            fd
        );

        if (res?.msg !== 1) {
            alert(res.data);
            scope.projectmat = {
                ...scope.projectmat,
                data: [],
                isloading: false
            };
            scope.$apply();
            return;
        }
        scope.projectmat = {
            ...scope.projectmat,
            data: res.data,
            isloading: false
        };
        scope.materialssummarydata = [];
        scope.materialssummarydata = this.#projectsummarycalc(res.data ?? []);
        scope.$apply();
        return;

    }

    async getinfotoken(fd = this.FormData(),scope,msg) {
        scope.mtbl = {
            ...scope.mtbl,
            data: { ...scope.mtbl.data },
            mtbllist: [...scope.mtbl.mtbllist],
            listadd: { ...scope.mtbl.listadd, data: { ...scope.mtbl.listadd.data } },
            title: "Edit",
            btntitle: "Update",
            mode: "E",
            isloading: true,
        }

        const res = await this.servicecall(
            this.#page,
            "getinfotoken",
            fd
        );

        if (res?.msg !== 1) {
            msg(true, "n", res.data);
            scope.mtbl = {
                ...scope.mtbl,
                data: { ...scope.mtbl.data },
                mtbllist: [...scope.mtbl.mtbllist],
                listadd: { ...scope.mtbl.listadd, data: { ...scope.mtbl.listadd.data } },
                isloading: false,
            };
            scope.$apply();
            return;
        }
        const infos = res.data[0];
        let list = [];
        res.data.map(i => {
            list.push({
                id: i.loadid,
                description: i.description,
                area: i.area,
                qty: i.qty,
                units: i.unit,
                _check: true
            });
        })
        scope.mtbl = {
            ...scope.mtbl,
            data: { 
                pjcnoenc: infos.pjcnoenc,
                loadid: infos.loadid,
                loaddate : infos.loaddate_n,
                loadproject : infos.loadproject,
                location : infos.location,
                estimatedate : infos.estimatedate_n,
                loadingdate : infos.loadingdate_n,
                estimatetositedate: infos.estimatetositedate_n,
                ascurrentdate : infos.ascurrentdate_n,
                driver: infos.driver,
                status : infos.status,
                remark : infos.remark,
                pjcno: infos.pjcno,
                invno : infos.invno
            },
            listadd: {
                ...scope.mtbl.listadd                
            },
            mtbllist: list,
            isloading: false,
        }
        scope.$apply();
        document.getElementById("location").setAttribute('readonly', true)
        return;
    }

    async getinfo(id, scope, msg) {
        scope.mtblinfo = {
            ...scope.mtblinfo,
            data: { ...scope.mtbl.mtblinfo },
            isloading: true
        };
        const fd = this.FormData();
        fd.append('loadid', id);
        const res = await this.servicecall(
            this.#page,
            "getinfo",
            fd
        );
        if (res?.msg !== 1) {
            scope.mtblinfo = {
                ...scope.mtblinfo,
                data: { ...scope.mtblinfo.data },
                isloading: false
            };

            msg(true, "n", res.data);
            scope.$apply();
            return;
        }

        scope.mtblinfo = {
            ...scope.mtbl,
            title: `Edit -${res.data.loadproject} Material to Be Load Informations`,
            btntitle: "Update",
            mode: "E",
            data: {
                ...scope.mtblinfo.data,
                pjcnoenc: res.data.pjcnoenc,
                loadid: res.data.loadid,
                loadproject: res.data.loadproject,
                location: res.data.location,
                loaddate: res.data.loaddate_n,
                description: res.data.description,
                qty: res.data.qty,
                unit: res.data.unit,
                loadingdate: res.data.loadingdate_n,
                ascurrentdate: res.data.ascurrentdate_n,
                driver: res.data.driver,
                status: res.data.status,
                remark: res.data.remark,
                pjcno: res.data.pjcno,
                area: res.data.area,
                estimatedate: res.data.estimatedate_n,
                estimatetositedate: res.data.estimatetositedate_n,
                cuttinglistno: res.data.cuttinglistno,
                mattype : res.data.mattype,
                
            },
            isloading: false
        };
        scope.$apply();
        
        document.getElementById("location").setAttribute('readonly', true)
        return;
    }


    async updateAll(fd = this.FormData(), scope, msg, grid,ep) {
        scope.mtbl = {
            ...scope.mtbl,
            data: { ...scope.mtbl.data },
            mtbllist: [...scope.mtbl.mtbllist],
            listadd: { ...scope.mtbl.listadd, data: { ...scope.mtbl.listadd.data } },
            isloading: true,
        }
        const res = await this.servicecall(this.#page, 'updateall', fd);
        if (res?.msg !== 1) {
            msg(true, "n", res.data);
            scope.mtbl = {
                ...scope.mtbl,
                data: { ...scope.mtbl.data },
                mtbllist: [...scope.mtbl.mtbllist],
                listadd: { ...scope.mtbl.listadd, data: { ...scope.mtbl.listadd.data } },
                isloading: false,
            }
            scope.$apply();
            return;
        }
        msg(true, "t", "Update");
        scope.mtbl = ep();
        grid.api.setRowData(res.data);
        scope.$apply();
    }

    checksingleupdatefrmdata() {
        const single_loadproject = document.getElementById("single_loadproject");
        const single_location = document.getElementById("single_location");
        const single_loaddate = document.getElementById("single_loaddate");
        const single_loadingdate = document.getElementById("single_loadingdate");
        const single_ascurrentdate = document.getElementById("single_ascurrentdate");
        const single_driver = document.getElementById("single_driver");
        const single_status = document.getElementById("single_status");
        const single_description = document.getElementById("single_description");
        const single_qty = document.getElementById("single_qty");
        const single_area = document.getElementById("single_area");
        const single_unit = document.getElementById("single_unit");
        const single_mattype = document.getElementById("single_mattype");
        const single_cuttinglistno = document.getElementById("single_cuttinglistno");
        

        if (single_loadproject.value.trim() === "") {
            msg(true, "n", "Enter Project Name");
            single_loadproject.focus();
            return 0;
        }

        if (single_location.value.trim() === "") {
            msg(true, "n", "Enter Project Location");
            single_location.focus();
            return 0;
        }
        if (single_loaddate.value.trim() === "") {
            msg(true, "n", "Enter Run Date");
            single_loaddate.focus();
            return 0;
        }

        if (single_loadingdate.value.trim() === "") {
            msg(true, "n", "Enter Loading Date");
            single_loadingdate.focus();
            return 0;
        }

        if (single_ascurrentdate.value.trim() === "") {
            msg(true, "n", "Enter At Site Date");
            single_ascurrentdate.focus();
            return 0;
        }
        if (single_driver.value.trim() === "") {
            msg(true, "n", "Enter Driver Name");
            single_driver.focus();
            return 0;
        }

        if (single_status.value.trim() === "") {
            msg(true, "n", "Select Status");
            single_status.focus();
            return 0;
        }

        if (single_remark.value.trim() === "") {
            msg(true, "n", "Enter Remark");
            single_remark.focus();
            return 0;
        }

        if (single_description.value.trim() === "") {
            msg(true, "n", "Enter Description");
            single_description.focus();
            return 0;
        }


        if (single_qty.value.trim() === "") {
            msg(true, "n", "Enter Qty");
            single_qty.focus();
            return 0;
        }


        if (single_area.value.trim() === "") {
            msg(true, "n", "Enter Area");
            single_area.focus();
            return 0;
        }

        if (single_unit.value.trim() === "") {
            msg(true, "n", "Select Unit");
            single_unit.focus();
            return 0;
        }

        let estimatedate = "";
        let estimatetositedate = "";

        if (single_status.value === "Delivered") {
            estimatedate = document.getElementById("single_estimatedate");
            estimatetositedate = document.getElementById("single_estimatetositedate");
            if (single_estimatedate.value.trim() === "") {
                msg(true, "n", "Enter Actual Loaded Date");
                single_estimatedate.focus();
                return 0;
            }

            if (single_estimatetositedate.value.trim() === "") {
                msg(true, "n", "Enter Actual At Site Date");
                single_estimatetositedate.focus();
                return 0;
            }
        }
        const fd = this.FormData();
        fd.append("loadproject", single_loadproject.value);
        fd.append("location", single_location.value);
        fd.append("loaddate", single_loaddate.value);
        fd.append("loadingdate", single_loadingdate.value);
        fd.append("ascurrentdate", single_ascurrentdate.value);
        fd.append("driver", single_driver.value);
        fd.append("status", single_status.value);
        fd.append("loadproject", single_loadproject.value);
        fd.append("remark", single_remark.value);
        fd.append("description", single_description.value);
        fd.append("qty", single_qty.value);
        fd.append("area", single_area.value);
        fd.append("unit", single_unit.value);
        fd.append("mattype", single_mattype.value);
        fd.append("cuttinglistno", single_cuttinglistno.value);
        
        if (single_status.value === "Delivered") {
            fd.append("estimatedate", estimatedate.value);
            fd.append("estimatetositedate", estimatetositedate.value);
        }
        return fd;
    }

    async update(fd = this.FormData(), scope, msg, grid) {
        scope.mtblinfo = {
            ...scope.mtblinfo,
            data: { ...scope.mtblinfo.data },
            isloading: true
        };
        const res = await this.servicecall(
            this.#page,
            "update",
            fd
        );

        if (res?.msg !== 1) {
            msg(true, "n", res.data);
            scope.mtblinfo = {
                ...scope.mtblinfo,
                data: { ...scope.mtblinfo.data },
                isloading: false
            };
            scope.$apply();
            return;
        }

        scope.mtblinfo = {
            ...scope.mtblinfo,
            data: { ...scope.mtblinfo.data },
            isloading: false
        };
        msg(true, "s", "Data Has Updated");
        grid.api.setRowData(res.data);
        scope.$apply();
        return;
    }

    async getlog(fd = this.FormData(), scope) {
        scope.logs = {
            isloading: true,
            data: []
        };
        const res = await this.servicecall(
            this.#page,
            "logs",
            fd
        );

        if (res.msg !== 1) {
            alert(res.data);
            scope.logs = {
                isloading: false,
                data: []
            };
            scope.$apply()
            return;
        }
        scope.logs = {
            isloading: false,
            data: res.data
        };

        scope.$apply()
        return;
    }

    async Remove(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "remove", fd);
        return res;
    }
    async BackLog(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "backlog", fd);
        return res;
    }

    columns(s, c,m) {
        let columnDefs = [];
        let username = userinfo.user_name;
        
       
        if (m === "A") {
            if (username === 'demo' || username === "ikramullah") {
                columnDefs.push({
                    headerName: "EDIT",
                    cellRenderer: (p) => c(`
                    <button 
                        type="button" 
                        class="ism-new-page-header-button normalbtn"
                        ng-click="getinfowithtoken('${p.data.invno}')"
                    >
                        <i class="fa fa-pencil"></i>
                        Edit
                    </button>
                `)(s)[0],
                    width: 80
                })
            }
            columnDefs.push({
                headerName: "Contract No",
                field: 'pjcno',
                cellRenderer: (p) => c(`
                    <button class="ism-new-page-header-button normalbtn" type="button" ng-click="getprojectsinfos('${p.data.loadproject}','${p.data.pjcno}')">${p.data.pjcno}</button>
                `)(s)[0],
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 120
            });
            columnDefs.push({
                headerName: "Project",
                field: 'loadproject',
                cellRenderer: (p) => `<span style="color:#4010ff;font-weight:600">${p.data.loadproject}</span>`,
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 250
            });
        } else {
            columnDefs.push({
                headerName: "Contract No",
                field: 'pjcno',                
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 120
            });
            columnDefs.push({
                headerName: "Project",
                field: 'loadproject',               
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 250
            });
        }
        columnDefs.push({
            headerName: "Location",
            field: 'location',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120
        });
        // columnDefs.push({
        //     headerName: "Running Date",
        //     field: 'loadingdate',
        //     cellRenderer: (p) => `${p.data.loadingdate_d}`,
        //     sortingOrder: ['asc', 'desc'],
        //     filter: 'agMultiColumnFilter',
        //     width: 120
        // });
        columnDefs.push({
            headerName: "Week No",
            field: 'currentweek',
            cellRenderer : (p) => `Week No. : ${p.data.currentweek}`,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120
        });
        
        // columnDefs.push({
        //     headerName: "Item",
        //     field: 'mattype',              
        //     sortingOrder: ['asc', 'desc'],
        //     filter: 'agMultiColumnFilter',
        //     width: 250
        // });
        if (m === "A") {
            if (username === 'demo' || username === "ikramullah") {
                columnDefs.push({
                    headerName: "Descriiption",
                    field: 'description',
                    cellRenderer: (p) => c(`
                <button class="ism-new-page-header-button normalbtn" type="text" ng-click="edititeminfos('${p.data.loadid}')">
                    ${p.data.description}
                </button>
                `)(s)[0],
                    sortingOrder: ['asc', 'desc'],
                    filter: 'agMultiColumnFilter',
                    width: 350
                });
            } else {
                columnDefs.push({
                    headerName: "Descriiption",
                    field: 'description',
                    sortingOrder: ['asc', 'desc'],
                    filter: 'agMultiColumnFilter',
                    width: 350
                });
            }
        }
        else {
            columnDefs.push({
                headerName: "Descriiption",
                field: 'description',
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 350
            });
        }
        
        columnDefs.push({
            headerName: "Qty",
            field: 'qty',
            cellRenderer: (p) => `<strong>${p.data.qty}</strong>`,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120
        });
        columnDefs.push({
            headerName: "Area",
            field: 'area',
            cellRenderer: (p) => `<strong>${p.data.area}</strong>`,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120
        });
        
        columnDefs.push({
            headerName: "Unit",
            field: 'unit',

            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 80
        });
        columnDefs.push({
            headerName: "Cutting List No",
            field: 'cuttinglistno',              
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 130
        });
        columnDefs.push({
            headerName: "Loading Date",
            field: 'loadingdate',
            cellRenderer: (p) => p.data.loadingdate_d,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120
        });
        columnDefs.push({
            headerName: "At Site",
            field: 'ascurrentdate',
            cellRenderer: (p) => p.data.ascurrentdate_d,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120
        });
        columnDefs.push({
            headerName: "Driver",
            field: 'driver',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120
        });
        columnDefs.push({
            headerName: "Status",
            field: 'status',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120
        });
        columnDefs.push({
            headerName: "Remark",
            field: 'remark',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 200
        });
        if (m === "A") {
            columnDefs.push({
                headerName: "Delay",
                field: 'delay',
                cellRenderer: (p) => c(`
                <button 
                    type="button" 
                    ng-click="loadprevious('${p.data.loadid}')"
                    class="ism-new-page-header-button normalbtn">
                    ${p.data.delay}
                </button>
            `)(s)[0],
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 80
            });
        } else {
            columnDefs.push({
                headerName: "Delay",
                field: 'delay',               
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 80
            });
        }
        columnDefs.push({
            headerName: "loading",
            field: 'load_diff',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 80
        });
        columnDefs.push({
            headerName: "At Site",
            field: 'atsite_diff',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 80
        });


        if (username === "demo" && (m === "A")) {
        // if (username === "demo" || username === "ikramullah") {
            columnDefs.push({
                headerName: "Remove",
                cellRenderer: (p) => c(
                    `
                    <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="removemtblitems('${p.data.loadid}')">
                        <i class="fa fa-trash"></i>
                        Remove
                    </button>
                    `
                )(s)[0],
                width: 120
            });
        }

        return columnDefs;
    }
}