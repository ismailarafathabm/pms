import GoServices from './index.js'
export default class GBudget extends GoServices {
    async savebudget(fd = this.FormData()) {
        const req = await this.servicecall(this._page, 'savebudget', fd);
        return req;
    }
    async loaddata(fd = this.FormData()) {
        const req = await this.servicecall(this._page, "loadbudget", fd);
        return req;
    }
    async getbudgetinfo(fd = this.FormData()) {
        const req = await this.servicecall(this._page, 'budgetinfo', fd);
        return req;        
    }

    async updatebudget(fd = this.FormData()) {
        const req = await this.servicecall(this._page, 'updatebudget', fd);
        return req;
    }
    async savebudgetgo(fd = this.FormData()) {
        const req = await this.servicecall(this._page, 'savebudgetgo', fd);
        return req;
    }

    async bugetglassorderhistory(fd = this.FormData()) {
        const req = await this.servicecall(this._page, 'bugetglassorderhistory', fd);
        return req;
    }


    columnsbudget(s, c, a) {
        let xc = [];
        xc.push({
            headerName: "Edit",
            width: 80,
            fitler: false,
            sortingOrder: false,
            cellRenderer: (p) => c(`
                <button
                    type= "button" 
                    class = "ism-new-page-header-button normalbtn" 
                    ng-click = "editbudgetinfo('${p.data.gbudgetid}')">                    
                    Edit
                </button>
            `)(s)[0],
            filter:false
        })

        xc.push(
            {
                headerName: "New",               
                cellRenderer: (p) => {
                    return c(`
                        <button 
                            type = 'button'
                            class = 'mis-new-page-header-button normalbtn'
                            ng-click = "addnewglassorder('${p.data.gbudgetid}')">
                            <i class="fa fa-plus"></i>
                            New
                            </button>
                    `)(s)[0]
                },
                sortingOrder: ['asc', 'desc'],
                filter:false,
                width: 180
            }
        )

        xc.push(
            {
                headerName: "History",               
                cellRenderer: (p) => {
                    let rcarea = `${p.data.rcarea === null || p.data.rcarea === 'null' ? '0' : p.data.rcarea}`
                    return (+rcarea) !== 0 ? c(`<button 
                    type='button'
                    class="ism-new-page-header-button normalbtn"
                    ng-click="gethistoryglassorder('${p.data.gbudgetid}')">
                    <i class="fa fa-eye"></i>
                    View</button>`)(s)[0] : '-';
                },
                sortingOrder: ['asc', 'desc'],
                filter: false,
                width: 180
            }
        )
        
        xc.push({
            headerName: "Project",
            field: 'gbprojectname',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Order Type",
            field: 'gbudgettype',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Supplier",
            field: 'gbsupplier',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Supplier",
            field: 'gbsupplier',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Glass Type",
            field: 'gbudgetglasstype',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Glass Spc",
            field: 'gbudgetspc',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 280,

        })
        xc.push({
            headerName: "Glass Tickness",
            field: 'gbudgtickness',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Area",
            field: 'gbudgetarea',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180,
            headerClass : 'budget-area',
            cellClass : 'budget-area'
        })
        xc.push({
            headerName: "Price",
            field: 'gbudgetbprice',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180,
            headerClass : 'budget-price',
            cellClass : 'budget-price'
        })
        xc.push({
            headerName: "Total Amount",
            field: 'gbudgetbtotal',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180,
            headerClass : 'budget-amount',
            cellClass : 'budget-amount'
        })

        xc.push(
            {
                headerName: "Total Received  Qty",
                field: 'rcqty',
                cellRenderer: (p) => {
                    return c(`
                        <button 
                            type = 'button'
                            class = 'ism-new-page-header-button normalbtn'
                            ng-click = "addnewglassorder('${p.data.gbudgetid}')">
                            ${p.data.rcqty === null || p.data.rcqty === 'null' ? '0' : p.data.rcqty}
                            </button>
                    `)(s)[0]
                },
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 180,
                headerClass : 'budget-re-qty',
                cellClass : 'budget-re-qty'
            }
        )

        xc.push(
            {
                headerName: "Total Received Area",
                field: 'rcarea',
                cellRenderer: (p) => {
                    let rcarea = `${p.data.rcarea === null || p.data.rcarea === 'null' ? '0' : p.data.rcarea}`
                    return (+rcarea) !== 0 ? c(`<button 
                    type='button'
                    class="ism-new-page-header-button normalbtn"
                    ng-click="gethistoryglassorder('${p.data.gbudgetid}')">
                    ${rcarea}</button>`)(s)[0] : '-';
                },
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 180,
                headerClass : 'budget-re-area',
                cellClass : 'budget-re-area'
            }
        )

        xc.push(
            {
                headerName: "Total Received Value",
                field: 'totrcamount',
                cellRenderer: (p) => {
                    return `${p.data.totrcamount === null || p.data.totrcamount === 'null' ? '-' : p.data.totrcamount}`
                },
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 180,
                headerClass : 'budget-re-val',
                cellClass : 'budget-re-val'
            }
        )

        xc.push(
            {
                headerName: "Pending Area",
                
                cellRenderer: (p) => {
                    let rcarea = p.data.rcarea === null || p.data.rcarea === 'null' ? '-' : p.data.rcarea;
                    let budgetarea = p.data.gbudgetarea;
                    let balance = (+budgetarea) - (+rcarea);
                    return Math.round(balance);
                },
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 180,
                headerClass : 'budget-pen-val',
                cellClass : 'budget-pen-val'
            }
        )

        xc.push(
            {
                headerName: "Amount",
                
                cellRenderer: (p) => {
                    let rcarea = p.data.totrcamount === null || p.data.totrcamount === 'null' ? '0' : p.data.totrcamount;
                    let budgetarea = p.data.gbudgetbtotal;
                    let balance = (+budgetarea) - (+rcarea);
                    return Math.round(balance);
                },
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 180,
                headerClass : 'budget-pen-amunt',
                cellClass : 'budget-pen-amunt'
            }
        )
        return xc;
    }
}