import _ from './../../../masterlog/js/service/index.js';
export default class BudgetGlassService extends _ {
    #page = "budget";
    async allglassbudgetbyproject(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "allglassbudgetbyproject", fd);
        return req;
    }
    async addglassbudgetbyproject(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "addglassbudgetbyproject", fd);
        return req;
    }
    async glassautocompleate(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "glassautocompleate", fd);
        return req;
    }
    async bsp(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, 'bsp', fd);
        return req;
    }

    async bipo(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, 'bipo', fd);
        return req;
    }

    
    async bmbt(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, 'bmbt', fd);
        return req;
    }

    async getglass(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, 'getglass', fd);
        return req;
    }

    async updateglassbudget(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "updateglassbudget", fd);
        return req;
    }
    colsdef(s, c, a) {
        let xc = [];        
        if (a.editbutton) {
            xc.push({
                headerName: "EDIT",
                cellRenderer: (p) =>
                    c(`
                    <button type="button"
                            class="ism-new-page-header-button normalbtn"
                            ng-click="editglassbudget('${p.data.bgid}')">
                            <i class="fa fa-pencil"></i>
                    </button>
                `)(s)[0],
                width: 95,
                filter: false,
            })
        }
        xc.push({
            headerName: "",
            field: 'gbudgetglassno',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120,
            wrapText: true,
            autoHeight: true,
        })
        xc.push({
            headerName: "Glass Specs",
            field: 'bgglass',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 530,
            wrapText: true,
            autoHeight: true,            
        })
        xc.push({
            headerName: "Area M2",
            field: 'bgarea',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120
        })
        if (a.printbutton) {
            xc.push({
                headerName: "Cost /M2",
                field: 'bgcost',
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 120
            })
            xc.push({
                headerName: "Total Cost (S.R)",
                field: 'bgtotalcost',
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 120
            })
        }
        xc.push({
            headerName: "Shaped Area (M2)",
            field: 'bgshapedarea',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120
        })
        if (a.printbutton) {
            xc.push({
                headerName: "Cost (M2)",
                field: 'bgshapedcost',
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 120
            })
            xc.push({
                headerName: "Shaped Total Cost(S.R)",
                field: 'bgshapedtotalcost',
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 120
            })
            xc.push({
                headerName: "Type",
                field: 'bgtypetxt',
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 120
            })
            xc.push({
                headerName: "Code",
                field: 'bgcode',
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 120
            })
        }

        return xc;
    }

   

    colsbudgetsummary(s, c, a) {
        const r = {
            'bg-red-budget': function(params) {
                return (+params.data.poval) < 0
            },
        };
        
        let xc = [];
        xc.push({
            headerName: "Type",
            field: 'bmmaterialtype',
            cellRenderer: (p) => {
                return `${p.data.bmmaterialtype}`;
               
            },
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 520,            
            wrapText: true,
            autoHeight: true, 
            cellClassRules : r
            // wrapText: true,
            // autoHeight: true,           
            // flex : 3,
        })

        xc.push({
            headerName: "Buget Value",
            field: 'budgetval',
            cellRenderer: (p) => {
                return c(`
                <button type="button" class="ism-new-page-header-button normalbtn" ng-click="getmaterialbudget('${p.data.bmmaterialtype.toLocaleString()
                }')">
                ${((+p.data.budgetval).toFixed(2)).toLocaleString()}
                </button>
                `)(s)[0]
            },
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120,
            cellClassRules : r
        })

        xc.push({
            headerName: "Previous PO",
            field: 'poval',
            cellRenderer: (p) => {
                if ((+p.data.poval) !== 0) {
                    return c(`
                    <button type="button" class="ism-new-page-header-button normalbtn" ng-click="getpurchase('${p.data.bmmaterialtype}')">
                    ${p.data.poval}
                    </button>
                    `)(s)[0]
                } else {
                    return `-`;
                }
            },
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120,
            cellClassRules : r
        })
        xc.push({
            headerName: "Balance Of Budget",
            field: 'balance',
            cellRenderer(p) {
                if ((+p.data.balance >= 0)) {
                    return `
                    <div style="display:flex;gap:4px;align-item:center">
                    <div style="flex:1">${p.data.balance}</div>
                    <div><img height='15px' src="${print_location}/assets/okarrow.png"></div>
                    </div>
                    `
                } else {
                    return `
                    <div style="display:flex;gap:4px;align-item:center" ng-click="getpurchase('${p.data.type}')">
                    <div style="flex:1; font-weight: bold;
                    color: #f00;">${p.data.balance}</div>
                    <div><img height='15px' src="${print_location}/assets/errorup.png"></div>
                    </div>
                    `
                }
            },
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 160,
            cellClassRules : r

        })
        return xc;
    }
}