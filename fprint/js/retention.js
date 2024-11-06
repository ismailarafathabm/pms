const data = JSON.parse(localStorage.getItem("ams_retention_rpt_data"));
const title = localStorage.getItem("asm_retention_rpt_title");
document.getElementById("printtitle").innerText = title;
const printcontainer = document.getElementById("printcontainer");
_isdisplay = false;
groupbynone();
function groupbynone() {    
    let p = "";
    let unpaid = 0;
    let due_retintion = 0;
    let approvedtot = 0;
    let napprovedtot = 0;
    p += ` <table class="mainprint-table">`;
    p += ` <thead>
            <tr>
            <th style="width:30px">S.No</th>
            <th style="width:80px">Status</th>
            <th style="width:90px">Un Paid	</th>
            <th style="width:100px">Sales Rep.</th>
            <th style="width:330px">Name</th>
            <th style="width:80px">Due Date</th>
            <th style="width:80px">Due Retention</th>
            <th style="width:80px">Approved Valuvation</th>
            <th style="width:80px">Not Approved Valuvation</th>
        </tr>
    </thead>
    <tbody>
    `;
    data.map((i, index) => {
        unpaid += (+i.unpaid);
        due_retintion += (+i.valuvationsrpt.due_retintion);
        approvedtot += (+i.valuvationsrpt.approvedtot);
        napprovedtot += (+i.valuvationsrpt.napprovedtot);
        p += `
        <tr>
            <td>${index + 1}</td>
            <td style="text-align:center">${i.asm_projects_pstatus}</td>            
            <td class="numeric-cells" style="${(+i.valuvationsrpt.due_retintion) !== 0}? 'background: #e6ebff;color: #0800ba;font-weight: 700;' : ''">${(+i.unpaid) === 0 ? "-" : (+i.unpaid.toFixed(2)).toLocaleString()}</td>
            <td style="color: #002cb0;">${i.asm_projects_pjsalesrep.toUpperCase()}</td>
            <td style="color: #00503f;font-weight: 700;">${(i.asm_projects_pjname).toUpperCase()}</td>
            <td>${i.finaldate_d}</td>
            <td class="numeric-cells" style="${(+i.valuvationsrpt.due_retintion) !== 0}? 'background: #ffe6e6;color: #ef0000;font-weight: 700;' : ''">${(+i.valuvationsrpt.due_retintion) === 0 ? "-" : (+i.valuvationsrpt.due_retintion.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="${(+i.valuvationsrpt.approvedtot) !== 0 ? 'background: #edfff8;color: #00718d;font-weight: 700;' : ''}">${(+i.valuvationsrpt.approvedtot) === 0 ? "-" : (+i.valuvationsrpt.approvedtot.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="${(+i.valuvationsrpt.napprovedtot) !== 0 ? 'background: #ffe1fd;color: #d5009d;font-weight: 700;' : ''}">${(+i.valuvationsrpt.napprovedtot) === 0 ? "-" : (+i.valuvationsrpt.napprovedtot.toFixed(2)).toLocaleString()}</td>
        </tr>
        `;


    })
    p += `
    <tr>
        <td></td>
        <td></td>
        <td class="numeric-cells" style="${(+unpaid) !== 0}? 'background: #e6ebff;color: #0800ba;font-weight: 700;' : ''">${(+unpaid) === 0 ? "-" : (+unpaid.toFixed(2)).toLocaleString(2)}</td>
        <td></td>
        <td></td>
        <td></td>
        <td class="numeric-cells" style="${(+due_retintion) !== 0}? 'background: #ffe6e6;color: #ef0000;font-weight: 700;' : ''">${(+due_retintion) === 0 ? "-" : (+due_retintion.toFixed(2)).toLocaleString(2)}</td>
        <td class="numeric-cells" style="${(+approvedtot) !== 0 ? 'background: #edfff8;color: #00718d;font-weight: 700;' : ''}">${(+approvedtot) === 0 ? "-" : (+approvedtot.toFixed(2)).toLocaleString(2)}</td>        
        <td class="numeric-cells" style="${(+napprovedtot) !== 0 ? 'background: #ffe1fd;color: #d5009d;font-weight: 700;' : ''}">${(+napprovedtot) === 0 ? "-" : (+napprovedtot.toFixed(2)).toLocaleString(2)}</td>
    </tr>
    `;
    p += `</tbody> </table>`;
    printcontainer.innerHTML = p;
}

function gropuby(x) {
    let group_data = [];
    data.map(i => {
        if (!group_data.includes(i[x].toLowerCase())) {
            group_data.push(i[x].toLowerCase());
        }
    });
    let finaldata = [];
    group_data.map(a => {
        let cols = a;
        let datas = data.filter(i => i[x].toLowerCase() === a);
        finaldata.push({ cols, datas });
    })
    console.log(finaldata);    
    let p = "";
    let unpaid = 0;
    let due_retintion = 0;
    let approvedtot = 0;
    let napprovedtot = 0;
    p += ` <table class="mainprint-table">`;
    p += ` <thead>
            <tr>
            <th style="width:30px">S.No</th>
            <th style="width:80px">Status</th>
            <th style="width:90px">Un Paid	</th>
            <th style="width:100px">Sales Rep.</th>
            <th style="width:330px">Name</th>
            <th style="width:80px">Due Date</th>
            <th style="width:80px">Due Retention</th>
            <th style="width:80px">Approved Valuvation</th>
            <th style="width:80px">Not Approved Valuvation</th>
        </tr>
    </thead>
    <tbody>
    `;
    finaldata.map(y => {
        let _unpaid = 0;
        let _due_retintion = 0;
        let _approvedtot = 0;
        let _napprovedtot = 0;
        p +=`<tr>
            <td style="background: #fffeed;font-weight: 600;line-height: 2.5em;font-size: 0.6em;" colspan="9">${ y.cols.toUpperCase()}</td>
        </tr>`
        y.datas.map((i, index) => {
            unpaid += (+i.unpaid);
            due_retintion += (+i.valuvationsrpt.due_retintion);
            approvedtot += (+i.valuvationsrpt.approvedtot);
            napprovedtot += (+i.valuvationsrpt.napprovedtot);

            _unpaid += (+i.unpaid);
            _due_retintion += (+i.valuvationsrpt.due_retintion);
            _approvedtot += (+i.valuvationsrpt.approvedtot);
            _napprovedtot += (+i.valuvationsrpt.napprovedtot);

            p += `
            <tr>
                <td>${index + 1}</td>
                <td style="text-align:center">${i.asm_projects_pstatus}</td>            
                <td class="numeric-cells" style="${(+i.valuvationsrpt.due_retintion) !== 0}? 'background: #e6ebff;color: #0800ba;font-weight: 700;' : ''">${(+i.unpaid) === 0 ? "-" : (+i.unpaid.toFixed(2)).toLocaleString()}</td>
                <td style="color: #002cb0;">${i.asm_projects_pjsalesrep.toUpperCase()}</td>
                <td style="color: #00503f;font-weight: 700;">${(i.asm_projects_pjname).toUpperCase()}</td>
                <td>${i.finaldate_d}</td>
                <td class="numeric-cells" style="${(+i.valuvationsrpt.due_retintion) !== 0}? 'background: #ffe6e6;color: #ef0000;font-weight: 700;' : ''">${(+i.valuvationsrpt.due_retintion) === 0 ? "-" : (+i.valuvationsrpt.due_retintion.toFixed(2)).toLocaleString()}</td>
                <td class="numeric-cells" style="${(+i.valuvationsrpt.approvedtot) !== 0 ? 'background: #edfff8;color: #00718d;font-weight: 700;' : ''}">${(+i.valuvationsrpt.approvedtot) === 0 ? "-" : (+i.valuvationsrpt.approvedtot.toFixed(2)).toLocaleString()}</td>
                <td class="numeric-cells" style="${(+i.valuvationsrpt.napprovedtot) !== 0 ? 'background: #ffe1fd;color: #d5009d;font-weight: 700;' : ''}">${(+i.valuvationsrpt.napprovedtot) === 0 ? "-" : (+i.valuvationsrpt.napprovedtot.toFixed(2)).toLocaleString()}</td>
            </tr>
            `;
        })
        p += `
        <tr>
            <td colspan="2" style="background: #ffedf5;font-weight: 600;">Sub Total</td>            
            <td class="numeric-cells" style="background: #ffedf5;font-weight: 600;">${(+_unpaid) === 0 ? "-" : (+_unpaid.toFixed(2)).toLocaleString()}</td>
            <td style="background: #ffedf5;font-weight: 600;"></td>
            <td style="background: #ffedf5;font-weight: 600;"></td>
            <td style="background: #ffedf5;font-weight: 600;"></td>
            <td class="numeric-cells" style="background: #ffedf5;font-weight: 600;">${(+_due_retintion) === 0 ? "-" : (+_due_retintion.toFixed(2)).toLocaleString()}</td>
            <td class="numeric-cells" style="background: #ffedf5;font-weight: 600;">${(+_approvedtot) === 0 ? "-" : (+_approvedtot.toFixed(2)).toLocaleString()}</td>        
            <td class="numeric-cells" style="background: #ffedf5;font-weight: 600;">${(+_napprovedtot) === 0 ? "-" : (+_napprovedtot.toFixed(2)).toLocaleString()}</td>
        </tr>
        `;
    })
    p += `
    <tr>
        <td></td>
        <td></td>
        <td class="numeric-cells" style="${(+unpaid) !== 0}? 'background: #e6ebff;color: #0800ba;font-weight: 700;' : ''">${(+unpaid) === 0 ? "-" : (+unpaid.toFixed(2)).toLocaleString()}</td>
        <td></td>
        <td></td>
        <td></td>
        <td class="numeric-cells" style="${(+due_retintion) !== 0}? 'background: #ffe6e6;color: #ef0000;font-weight: 700;' : ''">${(+due_retintion) === 0 ? "-" : (+due_retintion.toFixed(2)).toLocaleString()}</td>
        <td class="numeric-cells" style="${(+approvedtot) !== 0 ? 'background: #edfff8;color: #00718d;font-weight: 700;' : ''}">${(+approvedtot) === 0 ? "-" : (+approvedtot.toFixed(2)).toLocaleString()}</td>        
        <td class="numeric-cells" style="${(+napprovedtot) !== 0 ? 'background: #ffe1fd;color: #d5009d;font-weight: 700;' : ''}">${(+napprovedtot) === 0 ? "-" : (+napprovedtot.toFixed(2)).toLocaleString()}</td>
    </tr>
    `;
    p += `</tbody> </table>`;
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
