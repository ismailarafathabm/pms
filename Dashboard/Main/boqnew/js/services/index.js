import mac from '../../../masterlog/js/service/index.js'
export default class AuthorizationServices extends mac{
    #page = "autorize";

    async apicall(page = "",fd = this.FormData()) {
        const res = await this.servicecall(this.#page, page, fd);
        return res;
    }
}