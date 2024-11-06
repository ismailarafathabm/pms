import Maintanceworkservices from "./service.js";
import MaintanceWorkControllers from "./controller.js";

app.controller("maintanaceworkctrl", maintanaceworkctrl);
function maintanaceworkctrl($scope) {
    const mc = new MaintanceWorkControllers();
    const ms = new Maintanceworkservices();
}



app.controller('maintanaceworknewctrl', maintanaceworknewctrl)

function maintanaceworknewctrl($scope) {
    const mc = new MaintanceWorkControllers();
    const ms = new Maintanceworkservices();
}