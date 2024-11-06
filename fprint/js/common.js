function printaction() {
    window.print();
}

let _isdisplay = false;
function showhiddenlist() {
    if (!_isdisplay) {
        document.getElementById("dropdownlist").style.display = "flex";
        _isdisplay = true;
    } else {
        document.getElementById("dropdownlist").style.display = "none";
        _isdisplay = false;
    }
}