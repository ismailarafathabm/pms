import mac from './../../../masterlog/js/service/index.js';

export default class Technicalservices extends mac {
    #page = "technical";
    /*-------------------------Systems Approvals---------------*/
    async projectsystems(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "projectsystems", fd);
        return res;
    }
    async newsystem(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "newsystem", fd);
        return res;
    }
    async updatesystem(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "updatesystem", fd);
        return res;
    }
    async removesystem(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "removesystem", fd);
        return res;
    }
    /*-------------------------Systems Approvals End---------------*/

    /*-------------------------Color Approvals---------------*/
    //get all project approved colors api 👀
    async colorapprovals(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "colorapprovals", fd);
        return res;
    }
    //Remove Selected Color Approvals From Projects 🎗
    async colorremove(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "colorremove", fd);
        return res;
    }
    //Add New Color Approvals For Project
    async colornew(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "colornew", fd);
        return res;
    }
    //Update Selected Color Approvals From Projects
    async colorupdate(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "colorupdate", fd);
        return res;
    }
    /*-------------------------Color Approvals END---------------*/



    /*-------------------------hardware Approvals---------------*/
    //Add new Hardware Approvals
    async hardwarenew(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "hardwarenew", fd);
        return res;
    }
    //Update Selected Hardware Approvals
    async hardwareupdate(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "hardwareupdate", fd);
        return res;
    }
    //get hardware approvals for selected Project
    async hardwareall(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "hardwareall", fd);
        return res;
    }
    //Remove Selected Hardware approval form selected Project
    async hardwareremove(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "hardwareremove", fd);
        return res;
    }
    /*-------------------------hardware Approvals END---------------*/


    /*-------------------------Technical Approvals---------------*/
     //@ Api Calling Actions
    async apicall(fd = this.FormData(),pagename = "") {
        const res = await this.servicecall(this.#page, pagename , fd);
        return res;
    }  
    /*-------------------------Technical Approvals END---------------*/


}