class WhServices {
    api_ip = "172.0.100.17:8090";
    api_url = `http://${this.api_ip}/api/`;
    pd(method = "GET", fd = {}) {
        const pdata = {
            method: method,
            headers: {
                'Accept': 'Application/json',
            },
            body: JSON.stringify(fd)
        };
        return pdata;
    }
    async postRequest(page, fd) {
        const pd = {
            method: "POST",
            headers: {
                'content-type': "application/json; charset=utf-8"
            },
            body: JSON.stringify(fd)
        }
        try {
            const req = await fetch(`${this.api_url}${page}`, pd);
            return req.json();
        } catch (e) {
            return e;
        }
    }
    async getRequest(page) {
        try {
            const req = await fetch(`${this.api_url}${page}`, {
                method: 'get',
            });
            return req.json();
        } catch (e) {
            return e;
        }
    }
    async servicecall(page, fd) {
        const postdata = this.pd(fd);
        try {
            const res = await this.FetchAction(`${this.api_url}${page}`, postdata);
            return { msg: 1, data: res };
        } catch (e) {
            return { msg: 0, data: e };
        }
    }
    async FetchAction(url, pd) {
        // const req =await fetch(url, pd);
        // const res = req.json();
        // return res;
        return new Promise((r, e) => {
            const req = fetch(url, pd);
            const res = req.then(rx => {
                // console.log(rx);
                if (!rx.ok) {
                    e("Api Location Not Found");
                }
                return rx.json();
            });

            res.then(nr => {
                return nr;
            }).catch(ne => { e(ne); })
        })
    }
}

export default WhServices;