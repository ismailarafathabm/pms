import mac from './../../../masterlog/js/service/index.js';

export default class MRservices extends mac{
    #page = "mr"
    async apicall(fd = this.FormData(), page = "") {
        const res = await this.servicecall(this.#page, page, fd);
        return res;
    }

    // async getItemOldPgm() {
    //     const req = await fetch('https://localhost:7006/api/Items');
    //     const res = req.json();
    //     return res;
    // }
}
