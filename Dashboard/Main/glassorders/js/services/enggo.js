import GoServices from './index.js'
export default class EngGoServices extends GoServices{
    async getgo(fd = this.FormData()) {
        const req = await this.servicecall(this._page, "projectgo", fd);
        return req;
    }

    async getinfo(fd = this.FormData()) {
        const req = await this.servicecall(this._page, "projectgoinfo", fd);
        return req;
    }

    async newgo(fd = this.FormData()) {
        const req = await this.servicecall(this._page, "projectgonew", fd);
        return req;
    }

    
    async updatego(fd = this.FormData()) {
        const req = await this.servicecall(this._page, "projectgoupdate", fd);
        return req;
    } 

    colsdef(s,c,a) {
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
                    ng-click = "editgo('${p.data.goid}')">                    
                    Edit
                </button>
            `)(s)[0]
        })
        xc.push({
            headerName: "Project",
            field: 'project_name',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Glass Order No",
            field: 'gono',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Done By",
            field: 'godoneby',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Relesed to Purhcase",
            field: 'goreldate',
            cellRenderer : (p) => p.data.goreldate_d,  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Status",
            field: 'gostatus',
            cellRenderer: (p) => p.data.gostatus.toUpperCase(),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Received Form Purhcase",
            field: 'goreldate',
            cellRenderer: function(p) {
                return p.data.gostatus === 'ordered' ? '' : p.data.goreldate_d;
            },  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Supplier",
            field: 'gosupplier',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Glass Type",
            field: 'goglasstype',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Glass Thickness",
            field: 'goglassthickness',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Glass Specification",
            field: 'goglassspc',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            
            width: 230
        })

        xc.push({
            headerName: "Marking Location",
            field: 'gomarkinglocation',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 190,
            
        })

        xc.push({
            headerName: "Supplier",
            field: 'gosupplier',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Qty",
            field: 'goglassqty',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Remark",
            field: 'goremark',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        return xc;
    }
}