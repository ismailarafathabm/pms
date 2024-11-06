let _printmode = "N";
let _pby = "N";
const app = () => {
    const root = document.getElementById("root");
    const rdata = localStorage.getItem("metrotechapprovals");
   // console.log(rdata);
    if (rdata === null || rdata === "null") {
        alert("No data found");
        return;
    }
    const pdata = JSON.parse(rdata);
    
    let print = "|";
    root.innerHTML = print; 
    
}

function headercreator() {
    
}

app();