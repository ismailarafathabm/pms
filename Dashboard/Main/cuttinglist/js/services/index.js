import mac from './../../../masterlog/js/service/index.js'
export default class cuttinglistservices extends mac {
    #url = api_url;
    #username = userinfo.user_name;
    #user_token = userinfo.user_token;
    async apicall(page, pd = {}) {
        const headers = {
            'token': this.#username + " " + this.#user_token
        }
        pd['headers'] = headers;
        console.log(pd);
        const xurl = this.#url + page;
        return this.#getfetch(xurl, pd);
    }


    async #getfetch(url, pd) {
        const req = await fetch(this.#url + "/cuttinglists/" + url, pd);
        if (req.status === 200) {
            const res = await req.json();
            console.log(req.statusText);
            return { msg: 1, data: res.data };
        }
        const res = await req.json();
        return { msg: 0, data: res?.data ?? req.statusText };
    }

    async GET(page) {
        const apiurl = this.#url + page;
       // console.log(apiurl);
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
            } catch (exp) {
                console.log(exp);
                return { msg: 0, data: "ERROR ON API REQUES" }
            }

        } else {
            switch (req.status) {

                case 401:
                    try {
                        console.log(e);
                        window.location.href = `${print_location}logout.php`;
                    } catch (e) {
                        console.log(e);
                        window.location.href = `${print_location}logout.php`;
                        return { msg: 0, data: "something Error in Api - 4xx" }
                    }
                case 400:
                case 402:
                case 403:
                    try {
                        const res = await req.json();
                        return { msg: 0, data: res.data }
                    } catch (e) {
                        return { msg: 0, data: "something Error in Api - 4xx" }
                    }
                case 409:
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
