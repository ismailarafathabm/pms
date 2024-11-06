const data = JSON.parse(localStorage.getItem("ams_summaryofinvoice_data"));
const title = localStorage.getItem("ams_summaryofinvoice_title");
const printtitle = document.getElementById("printtitle");
printtitle.innerText = title;
const printcontainer = document.getElementById("printcontainer");
let _isdisplay = false;
groupbynone();
function groupbynone() {
    let p = "";
    console.log(data);
    p += "<table class='mainprint-table'>";
    p += ` <thead>
            <tr>
            <th style="width:30px;">S.No</th>
            <th style="width:290px;">Project</th>
            <th style="width:100px;">Manager</th>
            <th style="width:90px;">Sales Rep</th>
            <th style="width:80px;">Value</th>
            <th style="width:80px;">Executed Work</th>
            <th style="width:40px;">%</th>
            <th style="width:80px;">Previous Value</th>
            <th style="width:30px;">%</th>
            <th style="width:60px;">Status</th>
            <th style="width:50px;">Invoice No.</th>
            <th style="width:70px;">Invoice Date.</th>
            <th style="width:80px;">Not Approved</th>
            <th style="width:80px;">Approved</th>
            <th style="width:80px;">Paid</th>
            <th style="width:80px;">Balance</th>
            <th style="width:40px;">%</th>
        </tr>
    </thead>
    <tbody>
    `;
    let pjcvalue = 0;
    let invoicenewtot = 0;
    let pinvoicetot = 0;
    let approved = 0;
    let unapproved = 0;
    let totpaid = 0;
    let invoicebalance = 0;

    data.map((i, index) => {
        pjcvalue += (+i.pjcvalue);
        invoicenewtot += (+i.invoicenewtot);
        pinvoicetot += (+i.pinvoicetot);
        approved += (+i.approved)
        unapproved +=  (+i.unapproved)       
        totpaid += (+i.totpaid);
        invoicebalance += (+i.invoicebalance);

        p += `
            <tr key="${index}" data-row-id="${index}">
                <td>${index + 1}</td>
                <td title="${i.pjname.toUpperCase()}" style="background:#fff;color:#003bc5;font-weight:bold">${i.pjname.toUpperCase()}</td>
                <td title="${i.projectmgr.toUpperCase()}">${i.projectmgr.toUpperCase()}</td>
                <td>${i.pjsalesrep.toUpperCase()}</td>
                <td class="numeric-cells" ${(+i.pjcvalue) !== 0 ? 'style="background:#f8feff;color:#027f52;font-weight:bold"' : ""}>${(+i.pjcvalue) === 0 ? '-' : (+i.pjcvalue.toFixed(2)).toLocaleString()}</td>
                <td class="numeric-cells">${(+i.invoicenewtot) === 0 ? '-' :(+i.invoicenewtot.toFixed(2)).toLocaleString()}</td>
                <td>${i.x} %</td>
                <td class="numeric-cells">${(+i.pinvoicetot) === 0 ? '-' :(+i.pinvoicetot.toFixed(2)).toLocaleString()}</td>
                <td>${i.y} %</td>
                <td>${i.pstatus}</td>
                <td>${i.valuvationNo}</td>
                <td>${i.dates_d}</td>
                
                <td class="numeric-cells" ${(+i.unapproved) !== 0 ? 'style="background:#ffd7d7;color:#751e0e;font-weight:bold"' : ""}>${(+i.unapproved) === 0 ? '-' :(+i.unapproved.toFixed(2)).toLocaleString()}</td>
                <td class="numeric-cells" ${(+i.approved) !== 0 ? 'style="background:#e7fcff;color:#027f52;font-weight:bold"' : ""}>${(+i.approved) === 0 ? '-' : (+i.approved.toFixed(2)).toLocaleString()}</td>
                
                <td class="numeric-cells" ${(+i.totpaid) !== 0 ? 'style="background:#fff;color:#9aa300;font-weight:bold"' : ""}>${(+i.totpaid) === 0 ? '-' :(+i.totpaid.toFixed(2)).toLocaleString()}</td>
                <td class="numeric-cells" ${(+i.invoicebalance) !== 0 ? 'style="background:#fff;color:#d40000;font-weight:bold"' : ""}>${(+i.invoicebalance) === 0 ? '-' :(+i.invoicebalance.toFixed(2)).toLocaleString()}</td>
                <td>${i.z} %</td>
            </tr>
        `;
    });
    p += `
    <tr>
        <td class="gtotalrow" colspan="4" style="text-align:right">GRAND TOTAL</td>        
        <td class="numeric-cells gtotalrow">${(+pjcvalue) === 0 ? "-" : (+pjcvalue.toFixed(2)).toLocaleString(2) }</td>
        <td class="numeric-cells gtotalrow">${(+invoicenewtot) === 0 ? "-" : (+invoicenewtot.toFixed(2)).toLocaleString(2) }</td>        
        <td class="gtotalrow"></td>
        <td class="numeric-cells gtotalrow">${(+pinvoicetot) === 0 ? "-" : (+pinvoicetot.toFixed(2)).toLocaleString(2) }</td>
        <td class="gtotalrow" colspan="4"></td>
        <td class="numeric-cells gtotalrow">${(+unapproved) === 0 ? "-" : (+unapproved.toFixed(2)).toLocaleString(2) }</td>
        <td class="numeric-cells gtotalrow">${(+approved) === 0 ? "-" : (+approved.toFixed(2)).toLocaleString(2) }</td>
        <td class="numeric-cells gtotalrow">${(+totpaid) === 0 ? "-" : (+totpaid.toFixed(2)).toLocaleString(2) }</td>
        <td class="numeric-cells gtotalrow">${(+invoicebalance) === 0 ? "-" : (+invoicebalance.toFixed(2)).toLocaleString(2) }</td>
        <td class="gtotalrow"></td>
    </tr>
    </tbody>
    </table>
    `;
    printcontainer.innerHTML = p;
}

function gropuby(x) {
    let groupitems = [];
    data.map(i => {
        const item = i[x].toLowerCase();
        if (!groupitems.includes(item)) {
            groupitems.push(item)
        }
    });

    console.log(groupitems);
    let print_data = [];
    groupitems.map(y => {
        print_data.push({cols: y,datas: data.filter(i => i[x].toLowerCase() === y.toLowerCase())})
    })
    let p = "";
    p += "<table class='mainprint-table'>";
    p += ` <thead>
            <tr>
            <th style="width:30px;">S.No</th>
            <th style="width:290px;">Project</th>
            <th style="width:100px;">Manager</th>
            <th style="width:90px;">Sales Rep</th>
            <th style="width:80px;">Value</th>
            <th style="width:80px;">Executed Work</th>
            <th style="width:40px;">%</th>
            <th style="width:80px;">Previous Value</th>
            <th style="width:30px;">%</th>
            <th style="width:60px;">Status</th>
            <th style="width:50px;">Invoice No.</th>
            <th style="width:70px;">Invoice Date.</th>
            <th style="width:80px;">Not Approved</th>
            <th style="width:80px;">Approved</th>
            <th style="width:80px;">Paid</th>
            <th style="width:80px;">Balance</th>
            <th style="width:40px;">%</th>
        </tr>
    </thead>
    <tbody>
    `;
    let pjcvalue = 0;
    let invoicenewtot = 0;
    let pinvoicetot = 0;
    let approved = 0;
    let unapproved = 0;
    let totpaid = 0;
    let invoicebalance = 0;
    print_data.map((y, index) => {
        let _pjcvalue = 0;
        let _invoicenewtot = 0;
        let _pinvoicetot = 0;
        let _approved = 0;
        let _unapproved = 0;
        let _totpaid = 0;
        let _invoicebalance = 0;
        let breakpage = ""
        if (index !== 0) {
            breakpage = "page-break-before: always;"
        } else {
            breakpage = "";
        }
        p += `<thead>
        <tr key=${index + 1} style="${breakpage}">
            <td style="background: #fffeed;font-weight: 600;line-height: 2.5em;font-size: 0.7em;text-align:center" colspan="17">${y.cols.toUpperCase()}</td>
        </tr></thead>`;
        
        y.datas.map((i, index) => {
            pjcvalue += (+i.pjcvalue);
            invoicenewtot += (+i.invoicenewtot);
            pinvoicetot += (+i.pinvoicetot);
            approved += (+i.approved)
            unapproved +=  (+i.unapproved)       
            totpaid += (+i.totpaid);
            invoicebalance += (+i.invoicebalance);

            _pjcvalue += (+i.pjcvalue);
            _invoicenewtot += (+i.invoicenewtot);
            _pinvoicetot += (+i.pinvoicetot);
            _approved += (+i.approved)
            _unapproved +=  (+i.unapproved)       
            _totpaid += (+i.totpaid);
            _invoicebalance += (+i.invoicebalance);
            p += `
            <tr key="${index}" data-row-id="${index}">
                <td>${index + 1}</td>
                <td title="${i.pjname.toUpperCase()}" style="background:#fff;color:#003bc5;font-weight:bold">${i.pjname.toUpperCase()}</td>
                <td title="${i.projectmgr.toUpperCase()}">${i.projectmgr.toUpperCase()}</td>
                <td>${i.pjsalesrep.toUpperCase()}</td>
                <td class="numeric-cells" ${(+i.pjcvalue) !== 0 ? 'style="background:#f8feff;color:#027f52;font-weight:bold"' : ""}>${(+i.pjcvalue) === 0 ? '-' : (+i.pjcvalue.toFixed(2)).toLocaleString()}</td>
                <td class="numeric-cells">${(+i.invoicenewtot) === 0 ? '-' :(+i.invoicenewtot.toFixed(2)).toLocaleString()}</td>
                <td>${i.x} %</td>
                <td class="numeric-cells">${(+i.pinvoicetot) === 0 ? '-' :(+i.pinvoicetot.toFixed(2)).toLocaleString()}</td>
                <td>${i.y} %</td>
                <td>${i.pstatus}</td>
                <td>${i.valuvationNo}</td>
                <td>${i.dates_d}</td>
                
                <td class="numeric-cells" ${(+i.unapproved) !== 0 ? 'style="background:#ffd7d7;color:#751e0e;font-weight:bold"' : ""}>${(+i.unapproved) === 0 ? '-' :(+i.unapproved.toFixed(2)).toLocaleString()}</td>
                <td class="numeric-cells" ${(+i.approved) !== 0 ? 'style="background:#e7fcff;color:#027f52;font-weight:bold"' : ""}>${(+i.approved) === 0 ? '-' : (+i.approved.toFixed(2)).toLocaleString()}</td>
                
                <td class="numeric-cells" ${(+i.totpaid) !== 0 ? 'style="background:#fff;color:#9aa300;font-weight:bold"' : ""}>${(+i.totpaid) === 0 ? '-' :(+i.totpaid.toFixed(2)).toLocaleString()}</td>
                <td class="numeric-cells" ${(+i.invoicebalance) !== 0 ? 'style="background:#fff;color:#d40000;font-weight:bold"' : ""}>${(+i.invoicebalance) === 0 ? '-' :(+i.invoicebalance.toFixed(2)).toLocaleString()}</td>
                <td>${i.z} %</td>
            </tr>
        `;
        })
        p += `
        <tr>
            <td colspan="4" style="text-align:right;background: #edf9ff;font-weight: 600;">SUB TOTAL</td>        
            <td class="numeric-cells" style="background: #edf9ff;font-weight: 600;" >${(+_pjcvalue) === 0 ? "-" : (+_pjcvalue.toFixed(2)).toLocaleString(2) }</td>
            <td class="numeric-cells" style="background: #edf9ff;font-weight: 600;">${(+_invoicenewtot) === 0 ? "-" : (+_invoicenewtot.toFixed(2)).toLocaleString(2) }</td>        
            <td style="background: #edf9ff;font-weight: 600;"> </td>
            <td class="numeric-cells" style="background: #edf9ff;font-weight: 600;">${(+_pinvoicetot) === 0 ? "-" : (+_pinvoicetot.toFixed(2)).toLocaleString(2) }</td>
            <td colspan="4" style="background: #edf9ff;font-weight: 600;"></td>
            <td class="numeric-cells" style="background: #edf9ff;font-weight: 600;">${(+_unapproved) === 0 ? "-" : (+_unapproved.toFixed(2)).toLocaleString(2) }</td>
            <td class="numeric-cells" style="background: #edf9ff;font-weight: 600;">${(+_approved) === 0 ? "-" : (+_approved.toFixed(2)).toLocaleString(2) }</td>
            <td class="numeric-cells" style="background: #edf9ff;font-weight: 600;">${(+_totpaid) === 0 ? "-" : (+_totpaid.toFixed(2)).toLocaleString(2) }</td>
            <td class="numeric-cells" style="background: #edf9ff;font-weight: 600;">${(+_invoicebalance) === 0 ? "-" : (+_invoicebalance.toFixed(2)).toLocaleString(2) }</td>
            <td style="background: #edf9ff;font-weight: 600;"> </td>
        </tr>`
    })
    p += `
    <tr>
        <td class="gtotalrow" colspan="4" style="text-align:right">GRAND TOTAL</td>        
        <td class="numeric-cells gtotalrow">${(+pjcvalue) === 0 ? "-" : (+pjcvalue.toFixed(2)).toLocaleString(2) }</td>
        <td class="numeric-cells gtotalrow">${(+invoicenewtot) === 0 ? "-" : (+invoicenewtot.toFixed(2)).toLocaleString(2) }</td>        
        <td class="gtotalrow"></td>
        <td class="numeric-cells gtotalrow">${(+pinvoicetot) === 0 ? "-" : (+pinvoicetot.toFixed(2)).toLocaleString(2) }</td>
        <td class="gtotalrow" colspan="4"></td>
        <td class="numeric-cells gtotalrow">${(+unapproved) === 0 ? "-" : (+unapproved.toFixed(2)).toLocaleString(2) }</td>
        <td class="numeric-cells gtotalrow">${(+approved) === 0 ? "-" : (+approved.toFixed(2)).toLocaleString(2) }</td>
        <td class="numeric-cells gtotalrow">${(+totpaid) === 0 ? "-" : (+totpaid.toFixed(2)).toLocaleString(2) }</td>
        <td class="numeric-cells gtotalrow">${(+invoicebalance) === 0 ? "-" : (+invoicebalance.toFixed(2)).toLocaleString(2) }</td>
        <td class="gtotalrow"></td>
    </tr>
    </tbody>
    </table>
    `;
    printcontainer.innerHTML = p;
 
}
function showhiddenlist() {
    if (!_isdisplay) {
        document.getElementById("dropdownlist").style.display = "flex";
        _isdisplay = true;
    } else {
        document.getElementById("dropdownlist").style.display = "none";
        _isdisplay = false;
    }
}

document.addEventListener("click", (e) => {
    if (e.target.className !== "grupby") {
        document.getElementById("dropdownlist").style.display = "none";
        _isdisplay = false;
    }
})
function printaction() {
    window.print();
}
// function testworker() {
//     const w = new Worker('js/test.js');    
//     w.onmessage = function (event) {
//         console.log(event.data);        
//     };    
//     w.terminate();
// }

// async function titlechange() {
//     let res = [];
//     const req = await fetch("http://172.0.100.17:8082/PMS/api/DrawingApprovals/speedcode/wk.php");
//     req.then(r => r.json()).then(rs => res = rs);
//     console.log(res);

// }