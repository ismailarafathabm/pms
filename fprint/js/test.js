// function showdata() {
//     const res = fetch("http://172.0.0.1:8082/AMSN/api/index");
//     postMessage(res);
// }

// showdata();



var res = {};
function timedCount() {    
    const req = fetch("http://172.0.100.17:8082/PMS/api/DrawingApprovals/speedcode/wk.php");
    req.then(r => r.json()).then(rs => res = rs);

    postMessage(res);  
}

timedCount();