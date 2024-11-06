import _ from './../service/index.js';
export default class UnitControllers extends _ {
    #page = "masterlog";
    setCalbytype() {
        const _ = [
            { type: '1', desc: 'by Qty' },
            { type: '2', desc: 'by Area/LM/TON' },
        ]
        return _;
    }

    async loadAllUnits(scope, grid) {
        scope.unitdata = this.setUnitData(true);
        const res = await this.servicecall(this.#page, "unitsall");
        if (res?.msg !== 1) {
            scope.unitdata = this.setUnitData(true);
            scope.$apply();
            alert(res?.data);
            return;
        }
        const fdata = this.finaldata(res.data ?? []);
        scope.unitdata = this.setUnitData(false, fdata);
        grid.api.setRowData(fdata);
        scope.$apply();
    }

    setUnitData(loading, data = []) {
        const _ = { isloading: loading, data: data };
        return _;
    }
    setUnitView(isloading, mode, btntitle = "Save", subtitle = "New Unit", data = {}) {
        const _ = {
            isloading: isloading,
            mode: mode,
            btntitle: btntitle,
            subtitle: subtitle,
            data: data
        }
        return _;
    }
    #typetxt(t) {
        switch (t) {
            default: return "by Qty";
            case '1': return 'by Qty';
            case '2': return 'by Area/LM/TON'
        };
    }

    finaldata(data) {
        console.log(data);
        let ifinal = [];
        data.map(x => {
            var _ = {
                unitid: x.unitid,
                unitdesc: x.unitdesc,
                calcby: x.calcby,
                unitdisplay: x.unitdisplay,
                calcbydisp: this.#typetxt(x.calcby),
            }
            ifinal.push(_);
        })
        return ifinal;
    }

    async unitinfoget(scope, desc, dia) {
        if (scope.unitview.isloading) {
            console.log("Already process is running");
            return;
        }
        const fd = this.FormData();
        fd.append("unitdesc", desc);
        scope.unitview = {
            ...scope.unitview,
            data: { ...scope.unitview.data },
            isloading: true,
        };
        const res = await this.servicecall(this.#page, "unitinfoget", fd);
        if (res?.msg !== 1) {
            alert(res.data);
            scope.unitview = {
                ...scope.unitview,
                data: { ...scope.unitview.data },
                isloading: false,
            };
            scope.$apply();
            return;
        }
        scope.unitview = {
            ...scope.unitview,
            mode: "E",
            btntitle: "Update",
            subtitle: `Edit '${res.data.unitdesc}' Informations`,
            data: {
                ...scope.unitview.data,
                unitid: res.data.unitid,
                unitdesc: res.data.unitdesc,
                calcby: res.data.calcby,
                unitdisplay: res.data.unitdisplay,
                calcbydisp: this.#typetxt(res.data.calcby),
            },
            isloading: false,
        };
        dia.style.display = "flex";
        scope.$apply();
        return;
    }


    unitformvalidate() {
        const unitdesc = document.getElementById("unitdesc");
        const calcby = document.getElementById("calcby");

        if (unitdesc.value.trim() === "") {
            alert("Enter Unit Description");
            unitdesc.focus();
            return 0;
        }

        if (calcby.value.trim() === "") {
            alert("Select Unit Calculation By");
            calcby.focus();
            return 0;
        }

        return 1;
    }

    async saveunit(scope, grid) {
        const unitdesc = document.getElementById("unitdesc");
        const calcby = document.getElementById("calcby");
        const fd = this.FormData()
        fd.append("unitdesc", unitdesc.value.trim());
        fd.append("calcby", calcby.value.trim());
        scope.unitview = {
            ...scope.unitview,
            data: { ...scope.unitview.data },
            isloading: true,
        }
        //scope.$apply();
        const res = await this.servicecall(this.#page, 'unitsave', fd);
        if (res?.msg !== 1) {
            alert(res.data);
            scope.unitview = {
                ...scope.unitview,
                data: { ...scope.unitview.data },
                isloading: false,
            }
            scope.$apply();
            return;
        }
        alert("Data Has Saved");
        scope.unitview = {
            ...scope.unitview,
            data: { ...scope.unitview.data },
            isloading: false,
        }
        const fdata = this.finaldata(res.data);
        scope.unitdata = this.setUnitData(false, fdata);
        grid.api.setRowData(fdata);
        scope.$apply();
        return;
    }

    async updateunit(scope, grid) {
        const unitdesc = document.getElementById("unitdesc");
        const calcby = document.getElementById("calcby");
        const unitid = scope.unitview?.data?.unitid ?? 0;

        const fd = this.FormData()
        fd.append("unitdesc", unitdesc.value.trim());
        fd.append("calcby", calcby.value.trim());
        fd.append("unitid", unitid);
        scope.unitview = {
            ...scope.unitview,
            data: { ...scope.unitview.data },
            isloading: true,
        }
        const res = await this.servicecall(this.#page, 'unitupdate', fd);
        if (res?.msg !== 1) {
            scope.unitview = {
                ...scope.unitview,
                data: { ...scope.unitview.data },
                isloading: false,
            };
            scope.$apply();
            return;
        }
        const fdata = this.finaldata(res.data);
        scope.unitdata = this.setUnitData(false, fdata);
        grid.api.setRowData(fdata);
        scope.unitview = {
            ...scope.unitview,
            data: { ...scope.unitview.data },
            isloading: false,
        }
        scope.$apply();
        return;
    }

    unitcolumns($compile,$scope) {
        let columnDefs = [];
        columnDefs.push({
            headerName: "",
            cellRenderer: (p) => {
                return $compile(`<button type="button" class="ism-new-page-header-button normalbtn" ng-click="editunit('${p.data.unitdesc}')">Edit</button>`)($scope)[0]
            },
            sort: false,
            filter: false,
            width: 65
        });
        // columnDefs.push({
        //     valueGetter: "node.rowIndex + 1",
        //     sort: false,
        //     filter: false,
        //     width:50
        // })
        columnDefs.push({
            headerName: "Unit Description",
            field: 'unitdisplay',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 140

        });

        columnDefs.push({
            headerName: "Calculation Based",
            field: 'calcbydisp',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 160
        });
        return columnDefs;
    }
}