import _ from './../service/index.js';

export default class SystemControllers extends _{    
    #page = "masterlog";
    
    #finaldata(data) {
        let fn = [];
        return fn;
    }
    async getData(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "systemsall", fd);
        if (res.msg !== 1) {
            console.log(res.data);
            alert(res.data);
            return [];
        } 

        return res.data;
    }
    

    formvalidate(_ = {}) {
        const systemname = document.getElementById("systemname");
        const systemprocurement = document.getElementById("systemprocurement");
        const systemesimation = document.getElementById("systemesimation");

        if (systemname.value.trim() === "") {
            alert("Enter System Name");
            systemname.focus();
            return false;
        }

        
        if (systemprocurement.value.trim() === "") {
            alert("Enter Procurement Durations Days");
            systemprocurement.focus();
            return false;
        }

        if (systemesimation.value.trim() === "") {
            alert("Enter Esitmation Durations Days");
            systemesimation.focus();
            return false;
        }

        return true;
    }

    async Fmsave(fd, _,grid,msg) {
        _.newsystem = {           
            ..._.newsystem,           
            data: {
                ..._.newsystem.data,
            },
            isloading:true,
        };
        const res = await this.servicecall(this.#page, "systemsave", fd);
        if (res?.msg !== 1) {
            //alert(res.data);
            _.newsystem = {
                ..._.newsystem,
                data: {
                    ..._.newsystem.data,
                },
                isloading: false,
            };
            msg(true, 'e', res.data);
            _.$apply();
            return;
        } 
        _.newsystem = {
            isloading: false,
            title: "NEW SYSTEM",
            mode: "N",
            data: {
                systemname: "",
                systemprocurement: "",
                systemesimation: "",
            }
        };
        _.gridData = res.data;
        msg(true, 's', "Saved");
        grid.api.setRowData(res.data);
        _.$apply();
        document.getElementById("systemname").focus();
       
        return;
        
    }

    async FmUpdate(fd,_,grid,msg) {
        _.newsystem = {
            ..._.newsystem,   
            data: {
                ..._.newsystem.data,
            },   
            isloading : true,
        };
        const res = await this.servicecall(this.#page, "systemsedit", fd);
        if (res?.msg !== 1) {
            _.newsystem = {
                ..._.newsystem,
                data: {
                    ..._.newsystem.data,
                },
                isloading: false, 
            };
            msg(true, 'e', res.data);
            _.$apply();
            return;
        }

        _.newsystem = {
            isloading: false,
            title: "NEW SYSTEM",
            mode: "N",
            data: {
                systemname: "",
                systemprocurement: "",
                systemesimation: "",
            }
        };
        msg(true, 's', "Data has Updated");
        grid.api.setRowData(res.data);
        _.$apply();
        return;

    }

    async systemgetinfo(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, "systeminfoget", fd);        
        if (res?.msg !== 1) {
            alert(res.data);
            return {};            
        }
        return res.data;
    }
    
}

