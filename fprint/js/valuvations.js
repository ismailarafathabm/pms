let _isdisplay = false;
const title = localStorage.getItem("ams_valuvation_rpt_title");
const data = JSON.parse(localStorage.getItem("ams_valuvation_rpt_data"));
document.getElementById("printtitle").innerText = title;
const printcontainer = document.getElementById("printcontainer");
groupbynone();
function groupbynone() {
    let p = "";
    p += "<table class='mainprint-table'>";
    p += ` <thead>
            <tr>
            <th style="width:30px;">S.No</th>
            <th style="width:280px;">Project</th>
            <th style="width:80px;">Contract Value</th>
            <th style="width:80px;">Executed Work</th>
            <th style="width:30px;">%</th>
            <th style="width:80px;">Paid</th>
            <th style="width:30px;">%</th>
            <th style="width:80px;">Status</th>
            <th style="width:30px;">Invoice No.</th>
            <th style="width:80px;">Invoice Date.</th>
            <th style="width:80px;">Not Approved</th>
            <th style="width:80px;">Approved</th>
            <th style="width:80px;">Collected</th>
            <th style="width:80px;">Balance</th>
            <th style="width:30px;">%</th>
        </tr>
    </thead>
    <tbody>
    `;
    let pjcvalue = 0;
    let previewvalue = 0;
    let previousetotpaid = 0;
    let unapprovedtotal = 0;
    let approvedtotal = 0;
    let approvedinvoicetotalpaid = 0;
    let approvedinvoiceBalance = 0;
    data.sort((a, b) => a.workdonepres - b.workdonepres).map((i, index) => {
        pjcvalue += (+i.pjcvalue);
        previewvalue += (+i.previewvalue);
        previousetotpaid += (+i.previousetotpaid);
        unapprovedtotal += (+i.unapprovedtotal);
        approvedtotal += (+i.approvedtotal);
        approvedinvoicetotalpaid += (+i.approvedinvoicetotalpaid);
        approvedinvoiceBalance += (+i.approvedinvoiceBalance);
        p += `<tr key="${index}" data-row-id="${index}">
            <td>${index + 1}</td>
            <td style="background:#fff;color:#003bc5;font-weight:bold">${i.pjname.toUpperCase()}</td>
            <td class="numeric-cells" style="${(+i.pjcvalue) !== 0 ? 'background:#f6ffff;color:#079172;font-weight:bold' : ''}">${(+i.pjcvalue) === 0 ? "-" : (+i.pjcvalue.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="${(+i.previewvalue) !== 0 ? 'background:#fff;color:#d40058;font-weight:500' : ''}">${(+i.previewvalue) === 0 ? "-" : (+i.previewvalue.toFixed(2)).toLocaleString()}</td>
            <td style="text-align:center">${i.workdonepres}</td>
            <td class="numeric-cells" style="${(+i.previousetotpaid) !== 0 ? 'background:#fff;color:#0f6700;font-weight:600' : ''}">${(+i.previousetotpaid) === 0 ? "-" : (+i.previousetotpaid.toFixed(2)).toLocaleString()}</td>
            <td style="text-align:center">${i.paidpres}</td>
            <td style="text-align:center">${i.pstatus}</td>
            <td style="text-align:center">${i.currentinvoice_code}</td>
            <td>${i.currentinvoice_date_d}</td>
            <td class="numeric-cells" style="${(+i.unapprovedtotal) !== 0 ? 'background:#fff;color:#d05e00;font-weight:600' : ''}">${(+i.unapprovedtotal) === 0 ? "-" : (+i.unapprovedtotal.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="${(+i.approvedtotal) !== 0 ? 'background:#fff;color:#43008c;font-weight:600' : ''}">${(+i.approvedtotal) === 0 ? "-" : (+i.approvedtotal.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="${(+i.approvedinvoicetotalpaid) !== 0 ? 'background:#e4f7ff;color:#006d9b;font-weight:600' : ''}">${(+i.approvedinvoicetotalpaid) === 0 ? "-" : (+i.approvedinvoicetotalpaid.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="${(+i.approvedinvoiceBalance) !== 0 ? 'background:#fde4e4;color:#9f0000;font-weight:600' : ''}">${(+i.approvedinvoiceBalance) === 0 ? "-" : (+i.approvedinvoiceBalance.toFixed(2)).toLocaleString()}</td>
            <td style="text-align:center">${i.approvedpres}</td>
        </tr>`
    })
    p += `<tr key="grandtotal" data-row-id="grandtotal">
            <td colspan="2" style="text-align:right">Total</td>            
            <td class="numeric-cells" style="${(+pjcvalue) !== 0 ? 'background:#f6ffff;color:#079172;font-weight:bold' : ''}">${(+pjcvalue) === 0 ? "-" : (+pjcvalue.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="${(+previewvalue) !== 0 ? 'background:#fff;color:#d40058;font-weight:500' : ''}">${(+previewvalue) === 0 ? "-" : (+previewvalue.toFixed(2)).toLocaleString()}</td>
            <td style="text-align:center"></td>
            <td class="numeric-cells" style="${(+previousetotpaid) !== 0 ? 'background:#fff;color:#0f6700;font-weight:600' : ''}">${(+previousetotpaid) === 0 ? "-" : (+previousetotpaid.toFixed(2)).toLocaleString()}</td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td></td>
            <td class="numeric-cells" style="${(+unapprovedtotal) !== 0 ? 'background:#fff;color:#d05e00;font-weight:600' : ''}">${(+unapprovedtotal) === 0 ? "-" : (+unapprovedtotal.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="${(+approvedtotal) !== 0 ? 'background:#fff;color:#43008c;font-weight:600' : ''}">${(+approvedtotal) === 0 ? "-" : (+approvedtotal.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="${(+approvedinvoicetotalpaid) !== 0 ? 'background:#e4f7ff;color:#006d9b;font-weight:600' : ''}">${(+approvedinvoicetotalpaid) === 0 ? "-" : (+approvedinvoicetotalpaid.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="${(+approvedinvoiceBalance) !== 0 ? 'background:#fde4e4;color:#9f0000;font-weight:600' : ''}">${(+approvedinvoiceBalance) === 0 ? "-" : (+approvedinvoiceBalance.toFixed(2)).toLocaleString()}</td>
            <td style="text-align:center"></td>
        </tr>`
    p += `</tbody></table>`
    printcontainer.innerHTML = p;
}

function gropuby(x) {
    let group_item = [];
    //console.log(data);
    data.map(i => {
        //console.log(i[x]);
        if (!group_item.includes(i[x].toLowerCase())) {
            group_item.push(i[x].toLowerCase())
        }
    });
    console.log(group_item);
    let finaldata = [];
    group_item.map(y => {
        finaldata.push({ cols: y, datas: data.filter(i => i[x].toLowerCase() === y) });
    })
    console.log(finaldata);
    let pjcvalue = 0;
    let previewvalue = 0;
    let previousetotpaid = 0;
    let unapprovedtotal = 0;
    let approvedtotal = 0;
    let approvedinvoicetotalpaid = 0;
    let approvedinvoiceBalance = 0;
    let p = "";
    p += "<table class='mainprint-table'>";
    p += ` <thead>
    <tr>
    <th style="width:30px;">S.No</th>
    <th style="width:280px;">Project</th>
    <th style="width:80px;">Contract Value</th>
    <th style="width:80px;">Executed Work</th>
    <th style="width:30px;">%</th>
    <th style="width:80px;">Paid</th>
    <th style="width:30px;">%</th>
    <th style="width:80px;">Status</th>
    <th style="width:30px;">Invoice No.</th>
    <th style="width:80px;">Invoice Date.</th>
    <th style="width:80px;">Not Approved</th>
    <th style="width:80px;">Approved</th>
    <th style="width:80px;">Collected</th>
    <th style="width:80px;">Balance</th>
    <th style="width:30px;">%</th>
</tr>
</thead>
<tbody>
`;
    finaldata.map((y) => {
        let _pjcvalue = 0;
        let _previewvalue = 0;
        let _previousetotpaid = 0;
        let _unapprovedtotal = 0;
        let _approvedtotal = 0;
        let _approvedinvoicetotalpaid = 0;
        let _approvedinvoiceBalance = 0;
        p += `<thead><tr>
            <td style="background: #fffeed;font-weight: 600;line-height: 2.5em;font-size: 0.7em;text-align:center" colspan="15">${y.cols.toUpperCase()}</td>
        </tr></thead>`
        y.datas.map((i, index) => {
            pjcvalue += (+i.pjcvalue);
            previewvalue += (+i.previewvalue);
            previousetotpaid += (+i.previousetotpaid);
            unapprovedtotal += (+i.unapprovedtotal);
            approvedtotal += (+i.approvedtotal);
            approvedinvoicetotalpaid += (+i.approvedinvoicetotalpaid);
            approvedinvoiceBalance += (+i.approvedinvoiceBalance);

            _pjcvalue += (+i.pjcvalue);
            _previewvalue += (+i.previewvalue);
            _previousetotpaid += (+i.previousetotpaid);
            _unapprovedtotal += (+i.unapprovedtotal);
            _approvedtotal += (+i.approvedtotal);
            _approvedinvoicetotalpaid += (+i.approvedinvoicetotalpaid);
            _approvedinvoiceBalance += (+i.approvedinvoiceBalance);

            p += `<tr key="${index}" data-row-id="${index}">
                <td>${index + 1}</td>
                <td style="background:#fff;color:#003bc5;font-weight:bold">${i.pjname.toUpperCase()}</td>
                <td class="numeric-cells" style="${(+i.pjcvalue) !== 0 ? 'background:#f6ffff;color:#079172;font-weight:bold' : ''}">${(+i.pjcvalue) === 0 ? "-" : (+i.pjcvalue.toFixed(2)).toLocaleString()}</td>
                <td class="numeric-cells" style="${(+i.previewvalue) !== 0 ? 'background:#fff;color:#d40058;font-weight:500' : ''}">${(+i.previewvalue) === 0 ? "-" : (+i.previewvalue.toFixed(2)).toLocaleString()}</td>
                <td style="text-align:center">${i.workdonepres}</td>
                <td class="numeric-cells" style="${(+i.previousetotpaid) !== 0 ? 'background:#fff;color:#0f6700;font-weight:600' : ''}">${(+i.previousetotpaid) === 0 ? "-" : (+i.previousetotpaid.toFixed(2)).toLocaleString()}</td>
                <td style="text-align:center">${i.paidpres}</td>
                <td style="text-align:center">${i.pstatus}</td>
                <td style="text-align:center">${i.currentinvoice_code}</td>
                <td>${i.currentinvoice_date_d}</td>
                <td class="numeric-cells" style="${(+i.unapprovedtotal) !== 0 ? 'background:#fff;color:#d05e00;font-weight:600' : ''}">${(+i.unapprovedtotal) === 0 ? "-" : (+i.unapprovedtotal.toFixed(2)).toLocaleString()}</td>
                <td class="numeric-cells" style="${(+i.approvedtotal) !== 0 ? 'background:#fff;color:#43008c;font-weight:600' : ''}">${(+i.approvedtotal) === 0 ? "-" : (+i.approvedtotal.toFixed(2)).toLocaleString()}</td>
                <td class="numeric-cells" style="${(+i.approvedinvoicetotalpaid) !== 0 ? 'background:#e4f7ff;color:#006d9b;font-weight:600' : ''}">${(+i.approvedinvoicetotalpaid) === 0 ? "-" : (+i.approvedinvoicetotalpaid.toFixed(2)).toLocaleString()}</td>
                <td class="numeric-cells" style="${(+i.approvedinvoiceBalance) !== 0 ? 'background:#fde4e4;color:#9f0000;font-weight:600' : ''}">${(+i.approvedinvoiceBalance) === 0 ? "-" : (+i.approvedinvoiceBalance.toFixed(2)).toLocaleString()}</td>
                <td style="text-align:center">${i.approvedpres}</td>
            </tr>`
        });
        p += `<tr>
            <td colspan="2" style="background: #ffedf5;font-weight: 600;text-align:right">Sub Total</td>            
            <td class="numeric-cells" style="background: #ffedf5;font-weight: 600;">${(+_pjcvalue) === 0 ? "-" : (+_pjcvalue.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="background: #ffedf5;font-weight: 600;">${(+_previewvalue) === 0 ? "-" : (+_previewvalue.toFixed(2)).toLocaleString()}</td>
            <td style="background: #ffedf5;font-weight: 600;"></td>
            <td class="numeric-cells" style="background: #ffedf5;font-weight: 600;">${(+_previousetotpaid) === 0 ? "-" : (+_previousetotpaid.toFixed(2)).toLocaleString()}</td>
            <td style="background: #ffedf5;font-weight: 600;"></td>
            <td style="background: #ffedf5;font-weight: 600;"></td>
            <td style="background: #ffedf5;font-weight: 600;"></td>
            <td style="background: #ffedf5;font-weight: 600;"></td>
            <td class="numeric-cells" style="background: #ffedf5;font-weight: 600;">${(+_unapprovedtotal) === 0 ? "-" : (+_unapprovedtotal.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="background: #ffedf5;font-weight: 600;">${(+_approvedtotal) === 0 ? "-" : (+_approvedtotal.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="background: #ffedf5;font-weight: 600;">${(+_approvedinvoicetotalpaid) === 0 ? "-" : (+_approvedinvoicetotalpaid.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="background: #ffedf5;font-weight: 600;">${(+_approvedinvoiceBalance) === 0 ? "-" : (+_approvedinvoiceBalance.toFixed(2)).toLocaleString()}</td>
            <td style="background: #ffedf5;font-weight: 600;"></td>
        </tr>`
    })
    p += `<tr key="grandtotal" data-row-id="grandtotal">
            <td colspan="2" style="text-align:right">Total</td>
            
            <td class="numeric-cells" style="${(+pjcvalue) !== 0 ? 'background:#f6ffff;color:#079172;font-weight:bold' : ''}">${(+pjcvalue) === 0 ? "-" : (+pjcvalue.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="${(+previewvalue) !== 0 ? 'background:#fff;color:#d40058;font-weight:500' : ''}">${(+previewvalue) === 0 ? "-" : (+previewvalue.toFixed(2)).toLocaleString()}</td>
            <td style="text-align:center"></td>
            <td class="numeric-cells" style="${(+previousetotpaid) !== 0 ? 'background:#fff;color:#0f6700;font-weight:600' : ''}">${(+previousetotpaid) === 0 ? "-" : (+previousetotpaid.toFixed(2)).toLocaleString()}</td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td></td>
            <td class="numeric-cells" style="${(+unapprovedtotal) !== 0 ? 'background:#fff;color:#d05e00;font-weight:600' : ''}">${(+unapprovedtotal) === 0 ? "-" : (+unapprovedtotal.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="${(+approvedtotal) !== 0 ? 'background:#fff;color:#43008c;font-weight:600' : ''}">${(+approvedtotal) === 0 ? "-" : (+approvedtotal.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="${(+approvedinvoicetotalpaid) !== 0 ? 'background:#e4f7ff;color:#006d9b;font-weight:600' : ''}">${(+approvedinvoicetotalpaid) === 0 ? "-" : (+approvedinvoicetotalpaid.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="${(+approvedinvoiceBalance) !== 0 ? 'background:#fde4e4;color:#9f0000;font-weight:600' : ''}">${(+approvedinvoiceBalance) === 0 ? "-" : (+approvedinvoiceBalance.toFixed(2)).toLocaleString()}</td>
            <td style="text-align:center"></td>
        </tr>`
    p += `</tbody></table>`
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

function savePDF() {
    window.jsPDF = window.jspdf.jsPDF;
    var docPDF = new jsPDF();
    printa(docPDF);
}

function printa(docPDF) {
    var elementHTML = document.querySelector("#printpart");
    docPDF.html(elementHTML, {
        callback: function (docPDF) {
            docPDF.save('Valuvation.pdf');
        },
        x: 5,
        y: 5,
        // // width: 170,
        width: 170,
        // //windowWidth: 650
         windowWidth: 1050
    });
}