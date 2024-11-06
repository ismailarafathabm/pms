import _ from './../../../masterlog/js/service/index.js';
export default class PurchaseGlassServices extends _{
    #page = "budget";
    async gobudgettotalarea(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "gobudgettotalarea", fd);
        return req;
    }
    async sumgobudgetotalarea(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "sumgobudgetotalarea", fd);
        return req;
    }

    async gosave(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "newbudgetgoorder", fd);
        return req;
    }

    async projectgos(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "projectpurcahsego", fd);
        return req;
    }

    async printgo(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "printgo", fd);
        return req;
    }

    cols(s, c, a) {
        let xc = [];
        xc.push({
            headerName: "Print",
            cellRenderer: (p) => c(`<button
            type = "button" 
            class = "ism-new-page-header-button normalbtn" 
            ng-click = "print_data('${p.data.bgoid}')" 
            >
            <i class = "fa fa-print"></i>
            </button>`)(s)[0],
            width : 75,
        })
        xc.push({
            headerName: "Ref NO",
            field: 'refno',
            cellRenderer : (p) => p.data.refno,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Date",
            field: 'bgodate',
            cellRenderer : (p) => p.data.bgodate_d,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Type",
            field: 'bgotype',          
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Ref#No",
            field: 'bgogorefno',
            cellRenderer : (p) => p.data.bgogorefno,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Supplier",
            field: 'bgotype',          
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Area (m2)",
            field: 'bgogoqty',          
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "P/m2",
            field: 'bgoppsqm',          
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Total Cost",
            field: 'bgoval',          
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        
        return xc;
    }
}