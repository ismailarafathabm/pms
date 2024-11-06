export default class MAC {
    _init_url = `${api_url}index.php?page=`;
    fd() {
        const fd = new FormData();
        fd.append("user_name", userinfo.user_name);
        fd.append("user_token", userinfo.user_token);
        return fd;
    }

    postdata(fd) {
        const pd = {
            method: "POST",
            body : fd,
            headers: {
                'Accept': 'application/json',                
            }
        }

        return pd;
    }

    FetchAction(url, pd) {
        return new Promise((resolve, reject) => {
            fetch(url, pd)
                .then(r => {
                    if (!r.ok) {
                        reject(r.statusText);
                    }
                    return r.json()
                }).then((res) => {
                    if (res.msg === "1") {
                        resolve(res.data);
                    } else if (res.msg === "404") {
                        reject("Authentication Error, Please Re-Login");
                    } else {
                        reject(res.data);
                    }
                }).catch((e) => {
                    reject(e);
                })
        });
    }
}