import _ from './../../../masterlog/js/service/index.js';

export default class TechnicalSubmitalSerices extends _{
    #page = "submitals";

    async savets(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "savets", fd);
        return res;
    }

    async updatets(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "updatets", fd);
        return res;
    }
    
    async saveds(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "saveds", fd);
        return res;
    }
    async apicall(fun, fd = this.FormData()) {
        const res = await this.servicecall(this.#page, fun, fd);
        return res;
    }
}