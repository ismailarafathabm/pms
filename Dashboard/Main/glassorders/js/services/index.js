import _ from './../../../masterlog/js/service/index.js';
export default class GoServices extends _{
    _page = "go";
    async glasstypes() {
        const req = await this.servicecall(this._page, "glasstypes", this.FormData());
        return req;
    }
    
    async addglass(fd = this.FormData()) {
        const req = await this.servicecall(this._page, "addglasstype", fd);
        return req;
    }

    async allglassdescriptoins(fd = this.FormData()) {
        const req = await this.servicecall(this._page, "glassdescriptionsall", fd);
        return req;
    }

    async savenewdescription(fd = this.FormData()) {
        const res = await this.servicecall(this._page, "addglassdescription", fd);
        return res;
    }

    async getglassdescriptioninfo(fd = this.FormData()) {
        const res = await this.servicecall(this._page, "getinfoglassdescription", fd);
        return res;
    }

    async updateglassdescription(fd = this.FormData()) {
        const res = await this.servicecall(this._page, "updateglassdescription", fd);
        return res;
    }

    async getAllProjects(fd = this.FormData()) {
        const req = await this.servicecall(this._page, "projectlist", fd);
        return req;
    }
    descriptioncols(s, c, b) {
        let col = [];
        if (b) {
            col.push({
                headerName: "Edit",
                cellRenderer: (p) => c(`
                <button 
                    type = "button" 
                    class = "ism-new-page-header-button normalbtn" 
                    ng-click = "getinfo('${p.data.glassdescriptoinsid}')">
                    Edit
                    </button>
                `)(s)[0],
                width: 80,              
            })
        }
        col.push({
            headerName: "Type",
            field: 'glassdescriptoinstype',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180,
            
        })
        col.push({
            headerName: "Specification",
            field: 'glassdescriptoinsspec',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            flex:1,
            autoHeight: true,
            wrapText: true,
            rowHeight : 200
            
            
            
        })
        col.push({
            headerName: "Thickness",
            field: 'gdesriptionsortfrm',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 280
        })
        return col;
    }
}