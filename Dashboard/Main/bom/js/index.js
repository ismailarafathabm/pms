import bomadd from "./controllers/index.js";

app.controller('bomaddctrl', bomadd);
app.directive('whItems', () => {
    return {
        restrict: "E",
        templateUrl : 'bom/js/controllers/dia.html'
    }
})