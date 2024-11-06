import MAC from './index.js';

export default class MetroServices extends MAC{
    #_url = this._init_url + "metro&f=";
    #_approvals = this._init_url + "approvalstype&f=";
    async getAllmetroprojects() {
        const fd = this.fd();
        const pd = this.postdata(fd);
        try {
            const res = await this.FetchAction(`${this.#_url}metroprojects`,pd);
            return { msg: 1, data: res };
        } catch (e) {
            return { msg: 0, data: e };
        }
    }
    async getAllDrawingApprovals() {
        const fd = this.fd();
        const pd = this.postdata(fd);
        try {
            const res = await this.FetchAction(`${this.#_url}drawingapprovals`,pd);
            return { msg: 1, data: res };
        } catch (e) {
            return { msg: 0, data: e };
        }
    }
    async getAllMetroApprovals() {
        const fd = this.fd();
        const pd = this.postdata(fd);
        try {
            const res = await this.FetchAction(`${this.#_url}techapprovals`, pd);
            return { msg: 1, data: res };
         } catch (e) {
            return { msg: 0, data: e };
        }
    }

    async getallapprovalstype() {
        const fd = this.fd();
        const pd = this.postdata(fd);
        try {
            const res = await this.FetchAction(`${this.#_approvals}getall`, pd);
            return { msg: 1, data: res };
         } catch (e) {
            return { msg: 0, data: e };
        }
    }

    async newapprovaltype(fd) {        
        const pd = this.postdata(fd);
        try {
            const res = await this.FetchAction(`${this.#_approvals}new`, pd);
            return { msg: 1, data: res };
         } catch (e) {
            return { msg: 0, data: e };
        }
    }


    
}