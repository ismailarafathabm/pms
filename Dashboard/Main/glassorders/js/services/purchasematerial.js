import _ from './../../../masterlog/js/service/index.js';
export default class PurchaseMaterialService extends _ {
    #page = "budget";
    async bmos(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "bmos", fd);
        return req;
    }

    async bmo(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "bmo", fd);
        return req;
    }

    async savebmo(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "savebmo", fd);
        return req;
    }

    async updatebmo(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "updatebmo", fd);
        return req;
    }

    async autoitems(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "autocompleatematerials", fd);
        return req;
    }

    async bmoprint(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "bmoprint", fd);
        return req;
    }

    cols(s, c, a) {
        let xc = [];
        xc.push({
            headerName: "Print",
            cellRenderer: (p) => c(`<button
            type = "button" 
            class = "ism-new-page-header-button normalbtn" 
            ng-click = "print_data('${p.data.bmoid}')" 
            >
            <i class = "fa fa-print"></i>
            </button>`)(s)[0],
            width : 75,
        })
        xc.push({
            headerName: "Ref NO",
            field: 'bmorefno',
            cellRenderer : (p) => p.data.bmorefno,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Date",
            field: 'bmodate',
            cellRenderer : (p) => p.data.bmodate_d,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Order Type",
            field: 'bmotype',          
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Ref#No",
            field: 'bmoorefno',          
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Material Type",
            field: 'bmomtype',          
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180,
            flex: 1,
            wrapText: true,
            autoHeight: true, 
        })
        
        xc.push({
            headerName: "Supplier",
            field: 'bmospplier',          
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Qty",
            field: 'bmoqty',          
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 110
        })
        xc.push({
            headerName: "Unit",
            field: 'bmounit',          
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 110
        })
        xc.push({
            headerName: "Price Per Sqm",
            field: 'bmoppunit',          
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 110
        })
        xc.push({
            headerName: "Total Cost",
            field: 'bmoval',          
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 110
        })
        return xc;
    }


}