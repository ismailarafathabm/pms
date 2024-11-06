import _ from './../service/index.js';
export default class GEN extends _{
    #page = "mattobeload";
    async getAllUnits(fd = this.FormData()) {
        const res = await this.servicecall(
            this.#page,
            "loadallunits",
            fd
        );

        if (res.msg !== 1) {
            alert(res.data);
            return [];
        }

        return res.data;
    }
    async getAllProjects(fd = this.FormData()) {
        const res = await this.servicecall(
            this.#page,
            "loadprojects",
            fd
        );
        if (res.msg !== 1) {
            alert(res.data);
            return [];
        }
        return res.data;
    }

    async getProjectInfo(fd = this.FormData()) {
        const res = await this.servicecall(
            this.#page,
            "getinfoproject",
            fd
        );
        if (res?.msg !== 1) {
            alert(res.data);
            return {};
        }
        return res.data;
    }

    async getAllitems(fd = this.FormData()) {
        const res = await this.servicecall(
            this.#page,
            "items",
            fd
        );
        return res;
    }


    async getdates(fd = this.FormData()) {
        const res = await this.servicecall(
            this.#page,
            "loadthisweek",
            fd
        );
        return res;
    }
    
}
