class WhServices {
    private api_ip :string = "172.0.100.17:8090";
    private api_url :string = `http://${this.api_ip}/api/`;
    private pd(method:string = "GET",fd : any = {}) {
        const pdata : any = {
            method: method,
            headers: {
                'Accept': 'Application/json',
            },
            body: JSON.stringify(fd)
        };

        return pdata;
    }
    public async getRequest(page:any){
        try {
            const req = await fetch(`${this.api_url}${page}`, {
                method: 'get',
            });
            return req.json();
        } catch (e) {
            return e;
        }
    }
    public async servicecall(page:string,fd:any) {
        const postdata = this.pd(fd);
        try {
            const res = await this.FetchAction(`${this.api_url}${page}`, postdata);
            return { msg: 1, data: res };
        } catch (e) {
            return { msg: 0, data: e };
        }
    }
    public async FetchAction(url: string, pd: any) {
        const req =await fetch(url, pd);
        const res = req.json();
        return res;
        // return new Promise((r, e) => {
        //     const req = fetch(url, pd);
        //     const res = req.then(rx => {
        //         // console.log(rx);
        //         if (!rx.ok) {
        //             e("Api Location Not Found");
        //         }
        //         return rx.json();
        //     });

        //     res.then(nr => {
        //         return nr;
        //     }).catch(ne => { e(ne); })
        // })
    }
}

export default WhServices;