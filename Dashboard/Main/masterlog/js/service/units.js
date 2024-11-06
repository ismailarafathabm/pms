import MAC from './index.js';

export default class UnitsServices extends MAC{
    #apiurl = this._init_url + "masterlog&f=";
    async getAllUnits(fd = this.fd,f) {
        const pd = this.pd(fd);
        try {
            const res = await this.FetchAction(`${this.#apiurl}${f}`, pd);
            return { msg: 1, data: res };
        } catch (e) {
            return { msg: 0, data: e };
        }
    }

    
}