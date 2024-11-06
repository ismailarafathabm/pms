class Maintanceworkservices{
    #postdata(fd){
        let postdata = {
            method: "POST",
            body: fd,
            headers: {
                'Accept':'application/json',
            }
        }
        return postdata;
    }

    fd() {
        const fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        return fd;
    }

    async #FetchActions(url, pd) {
        return new Promise((resolve, reject) => {
            const req = fetch(url, pd);
            const res = req.then((r) => {
                if (!r.ok) {
                    reject("API URL NOT FOUND")
                }
                return r.json();
            });

            res.then(r => {
                if (r?.msg === "1") {
                    resolve(res.data);
                } else if (r?.msg === "404") {
                    reject("Authentication Error");
                } else if (r?.msg === "0") {
                    reject(r.data);
                } else {
                    console.log(r);
                    reject("API ERROR;Check in console");
                }
            }).catch(e => {
                reject(e);
            })
        });
    }

    //get data
    //save data
    //edit data
    //satus update

}
export default Maintanceworkservices;