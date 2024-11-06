'use strict';
import _ from './../../../masterlog/js/service/index.js';
export default class BudgetMaterialService extends _ {
    #page = "budget";
    async newbudgetmaterials(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "newbudgetmaterials", fd);
        return req;
    }
    async autocompleatematerials(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "autocompleatematerials", fd);
        return req;
    }
    async budgetmaterialsbyproject(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "budgetmaterialsbyproject", fd);
        return req;
    }
    async budgetmaterialsbybmid(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "budgetmaterialsbybmid", fd);
        return req;
    }
    async updatebudgetmaterials(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "updatebudgetmaterials", fd);
        return req;
    }

    async bgmtypes(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "materialtype", fd);
        return req;
    }


    colsdef(s, c, a) {
        let xc = [];
        if (a.newbutton) {
            xc.push({
                headerName: "",
                cellRenderer: (p) => c(`
            <button type="button" 
            class = "ism-new-page-header-button normalbtn" 
            ng-click = "editinfo('${p.data.bmid}')"
            >
            Edit
            </button>
            `)(s)[0],
                width: 80
            })
        }
        xc.push({
            headerName: "Types",
            field: 'bmtype',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 520,            
            wrapText: true,
            autoHeight: true,      
        })
        xc.push({
            headerName: "Qty",
            field: 'bmqty',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 150
        })
        if (a.priceview) {
            xc.push({
                headerName: "Estimated Price",
                field: 'bmeprice',
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 150
            })

            xc.push({
                headerName: "Estimated Amount",
                field: 'bmeval',
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 150
            })
            xc.push({
                headerName: "Discounted Price",
                field: 'bmdiscountprice',
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 150
            })
            xc.push({
                headerName: "Discounted Amount",
                field: 'bmdiscountval',
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 150
            })
            xc.push({
                headerName: "Budget No",
                field: 'budgetNo',
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 150
            })
            xc.push({
                headerName: "Budget Type",
                field: 'budgettypetxt',
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 150
            })
        }
        return xc;
    }
}