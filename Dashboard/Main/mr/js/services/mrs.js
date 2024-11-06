import mac from './../../../masterlog/js/service/index.js'
export default class Mrservices extends mac{
    #url = api_url;
    #username = userinfo.user_name;
    #user_token = userinfo.user_token;
    async GET(page) {
        const apiurl = this.#url + page;
        console.log(apiurl);
        const headers = {
            'Token': this.#username + " " + this.#user_token
        }
        const pd = {
            method: "GET",
            headers: headers
        }
        return await this.fetchactions(apiurl, pd)
    }

    async POST(page, fd) {
        const apiurl = this.#url + page;
        const headers = {
            'Token': this.#username + " " + this.#user_token
        }
        const pd = {
            method: "POST",
            body: fd,
            headers: headers
        }
        return await this.fetchactions(apiurl, pd)
    }

    async fetchactions(api_url, pd) {
        const req = await fetch(api_url, pd);
        //console.log(req);
        if (req.ok) {
            try {
                const res = await req.json();
                if (res?.msg === "1") {
                    return { msg: 1, data: res.data };
                } else {
                    return { msg: 0, data: res.data };
                }
            } catch (e) {
                return { msg: 0, data: e };
            }
        } else {            
            switch (req.status) {
                case 400:
                case 401:
                case 402:
                    try {
                        const res = await req.json();
                        return { msg: 0, data: res.data }
                    } catch (e) {
                        return { msg: 0, data: "something Error in Api - 4xx" }
                    }
                case 500:
                case 501:
                    try {
                        const res = await req.json();
                        return { msg: 0, data: res.data }
                        
                    } catch (e) {
                        return { msg: 0, data: "Somthing wrong API - 5xx" };
                    }
                default: return { msg: 0, data: "Api Calling Error - Unknown" };
            }
        }
    }

}