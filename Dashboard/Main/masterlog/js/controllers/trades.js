import _ from './../service/index.js';

export default class TradesController extends _{
    #page = "masterlog";
    async getAllTradeGroup(scope, msg) {
        const fd = this.FormData();
        scope.newtradegroup = {    
            ...scope.newtradegroup,
            list: [...scope.newtradegroup.list],
            isloading: true
        };
        const res = await this.servicecall(this.#page, "tradegroupsall", fd);
        if (res?.msg !== 1) {
            scope.newtradegroup = {      
                ...scope.newtradegroup,
                list: [...scope.newtradegroup.list],
                isloading: false
            };
            msg(true, "n", res.data);
            scope.$apply();
            return;
        }

        scope.newtradegroup = {
            data: { ...scope.newtradegroup, },
            list: res?.data ?? [],
            isloading: false
        };
        scope.$apply();
        return;
    }

}