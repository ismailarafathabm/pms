import GoServices from './index.js'
export default class GlassSupplierServices extends GoServices{    
    async getAllGlassSuppliers(fd = this.FormData()) {
        const res = await this.servicecall(this._page, "allglasssuppliers", fd);
        return res;
    }
    async newsupplier(fd = this.FormData()) {
        const res = await this.servicecall(this._page, "newsupplier", fd);
        return res;
    }
    
    async infosupplier(fd = this.FormData()) {
        const res = await this.servicecall(this._page, "getinfo", fd);
        return res;
    }

    async updatesupplier(fd = this.FormData()) {
        const res = await this.servicecall(this._page, "updatesupplier", fd);
        return res;
    }

    suppliercols(s, c, a) {
        let xc = [];
        if (a.edit) {
            xc.push({
                headerName: "Edit",
                width: 80,
                fitler: false,
                sortingOrder: false,
                cellRenderer: (p) => c(`
                    <button
                        type= "button" 
                        class = "ism-new-page-header-button normalbtn" 
                        ng-click = "editsupplierinfo('${p.data.glasssupplierid}')">                    
                        Edit
                    </button>
                `)(s)[0]
            })
        }

        xc.push({
            headerName: "Name",
            field: 'glasssuppliername',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180,
            flex: 1,
            wrapText: true,
            autoHeight: true,
        })
        xc.push({
            headerName: "Contact Persion",
            field: 'suppliercontact',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Contact No",
            field: 'supplierphone',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "E-Mail",
            field: 'supplieremail',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Fax",
            field: 'supplierfax',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Address",
            field: 'supplieraddress',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            flex: 1,
            wrapText: true,
            autoHeight: true,
        })

        xc.push({
            headerName: "Location",
            field: 'glasssuppliercountry',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })       

        return xc;
    }
}