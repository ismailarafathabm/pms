let _isdisplay = false;
let printmode = "N";
const cols = JSON.parse(localStorage.getItem("ams_balanceofwork_cols"));
const data = JSON.parse(localStorage.getItem("ams_balanceofwork_data"));

function render(finaldata) {
    const printcontainer = document.getElementById("printcontainer");
    if (printmode === "N") {
        printcontainer.innerHTML = _printUngroup(finaldata);
    } else {
        printcontainer.innerHTML = _printGroup(finaldata);
    }
}
function _printUngroup(x) {
    let p = '';
    let pjcval = 0;
    let motot = 0;
    let valuvations = 0;
    let totbeinvoiced = 0;
    let totbeexecuted = 0;
    let totbecontracted = 0;
    p += ` <table class="mainprint-table">`;
    p += ` <thead>
            <tr>
            <th style="width:50px">S.No</th>
            <th style="width:303px">Project Name </th>
            <th style="width:120px">Manager	</th>
            <th style="width:90px">Total Value</th>
            <th style="width:90px">MO Value</th>
            <th style="width:90px">Valuvation Value</th>
            <th style="width:90px">Balance of MO</th>
            <th style="width:90px">To Be Executed</th>
            <th style="width:90px">Balance Of Contract</th>
        </tr>
    </thead>
    <tbody>
    `;
    x.map((y, index) => {
        pjcval += (+y.pjval);
        motot += (+y.motot);
        valuvations += (+y.valuvation);
        totbeinvoiced += (+y.tobeinvoiced);
        totbeexecuted += (+y.tobeexecuted);
        totbecontracted += (+y.tobecontract);
        p += `<tr>`;
        p += `<td>${index + 1}</td>`;
        p += `<td style="color:#000" >${(y.asm_projects_pjname).toUpperCase()}</td>`;
        p += `<td>${(y.asm_projects_projectmgr).toUpperCase()}</td>`;
        p += `<td class="numeric-cells">${(+y.pjval) === 0 ? "-" : (+y.pjval.toFixed(2)).toLocaleString(2)}</td>`;
        p += `<td class="numeric-cells">${(+y.motot) === 0 ? "-" : (+y.motot.toFixed(2)).toLocaleString(2)}</td>`;
        p += `<td class="numeric-cells">${(+y.valuvation) === 0 ? "-" : (+y.valuvation.toFixed(2)).toLocaleString(2)}</td>`;

        p += `<td class="numeric-cells">${(+y.tobeinvoiced) === 0 ? "-" : (+y.tobeinvoiced.toFixed(2)).toLocaleString(2)}</td>`;
        p += `<td class="numeric-cells">${(+y.tobeexecuted) === 0 ? "-" : (+y.tobeexecuted.toFixed(2)).toLocaleString(2)}</td>`;
        p += `<td class="numeric-cells">${(+y.tobecontract) === 0 ? "-" : (+y.tobecontract.toFixed(2)).toLocaleString(2)}</td>`;
        p += `<tr>`;
    });
    p += "<tr>";
    p += `<td colspan="3" class="numeric-cells gtotalrow titlerow" style='width:473px;'>Grand Total</td>`;
    p += `<td class="numeric-cells gtotalrow">${(+pjcval) === 0 ? "-" : (+pjcval.toFixed(2)).toLocaleString(2)}</td>`;
    p += `<td class="numeric-cells gtotalrow">${(+motot) === 0 ? "-" : (+motot.toFixed(2)).toLocaleString(2)}</td>`;
    p += `<td class="numeric-cells gtotalrow">${(+valuvations) === 0 ? "-" : (+valuvations.toFixed(2)).toLocaleString(2)}</td>`;
    p += `<td class="numeric-cells gtotalrow">${(+totbeinvoiced) === 0 ? "-" : (+totbeinvoiced.toFixed(2)).toLocaleString(2)}</td>`;
    p += `<td class="numeric-cells gtotalrow">${(+totbeexecuted) === 0 ? "-" : (+totbeexecuted.toFixed(2)).toLocaleString(2)}</td>`;
    p += `<td class="numeric-cells gtotalrow">${(+totbecontracted) === 0 ? "-" : (+totbecontracted.toFixed(2)).toLocaleString(2)}</td>`;
    p += "</tr>";
    p += `</tbody> </table>`;
    return p;
}
function _printGroup(x) {
    let pjcval = 0;
    let motot = 0;
    let valuvations = 0;
    let totbeinvoiced = 0;
    let totbeexecuted = 0;
    let totbecontracted = 0;

    let p = '';
    p += ` <table class="mainprint-table">`;
    p += ` <thead>
            <tr>
            <th style="width:50px">S.No</th>
            <th style="width:303px">Project Name </th>
            <th style="width:120px">Manager	</th>
            <th style="width:90px">Total Value</th>
            <th style="width:90px">MO Value</th>
            <th style="width:90px">Valuvation Value</th>
            <th style="width:90px">Balance of MO</th>
            <th style="width:90px">To Be Executed</th>
            <th style="width:90px">Balance Of Contract</th>
        </tr>
    </thead>
    <tbody>
    `;
    x.map(i => {
        p += `<tr>`;
        p += `<td colspan='9'  class='grouptitle' style='width:100%;'>${(i.colname).toUpperCase()}</td>`;
        p += `</tr>`;
        let _pjcval = 0;
        let _motot = 0;
        let _valuvations = 0;
        let _totbeinvoiced = 0;
        let _totbeexecuted = 0;
        let _totbecontracted = 0;
        i.gdata.map((y, index) => {

            pjcval += (+y.pjval);
            motot += (+y.motot);
            valuvations += (+y.valuvation);
            totbeinvoiced += (+y.tobeinvoiced);
            totbeexecuted += (+y.tobeexecuted);
            totbecontracted += (+y.tobecontract);

            _pjcval += (+y.pjval);
            _motot += (+y.motot);
            _valuvations += (+y.valuvation);
            _totbeinvoiced += (+y.tobeinvoiced);
            _totbeexecuted += (+y.tobeexecuted);
            _totbecontracted += (+y.tobecontract);
            p += `<tr>`;
            p += `<td>${index + 1}</td>`;
            p += `<td style="color:#000" >${(y.asm_projects_pjname).toUpperCase()}</td>`;
            p += `<td>${(y.asm_projects_projectmgr).toUpperCase()}</td>`;
            p += `<td class="numeric-cells">${(+y.pjval) === 0 ? "-" : (+y.pjval.toFixed(2)).toLocaleString(2)}</td>`;
            p += `<td class="numeric-cells">${(+y.motot) === 0 ? "-" : (+y.motot.toFixed(2)).toLocaleString(2)}</td>`;
            p += `<td class="numeric-cells">${(+y.valuvation) === 0 ? "-" : (+y.valuvation.toFixed(2)).toLocaleString(2)}</td>`;

            p += `<td class="numeric-cells">${(+y.tobeinvoiced) === 0 ? "-" : (+y.tobeinvoiced.toFixed(2)).toLocaleString(2)}</td>`;
            p += `<td class="numeric-cells">${(+y.tobeexecuted) === 0 ? "-" : (+y.tobeexecuted.toFixed(2)).toLocaleString(2)}</td>`;
            p += `<td class="numeric-cells">${(+y.tobecontract) === 0 ? "-" : (+y.tobecontract.toFixed(2)).toLocaleString(2)}</td>`;
            p += `<tr>`;

        })
        p += "<tr>";
        p += `<td colspan="3" class='numeric-cells subtotalrow title-cell' style='width:473px;'>Sub Total</td>`;
        p += `<td class="numeric-cells subtotalrow">${(+_pjcval) === 0 ? "-" : (+_pjcval.toFixed(2)).toLocaleString(2)}</td>`;
        p += `<td class="numeric-cells subtotalrow">${(+_motot) === 0 ? "-" : (+_motot.toFixed(2)).toLocaleString(2)}</td>`;
        p += `<td class="numeric-cells subtotalrow">${(+_valuvations) === 0 ? "-" : (+_valuvations.toFixed(2)).toLocaleString(2)}</td>`;
        p += `<td class="numeric-cells subtotalrow">${(+_totbeinvoiced) === 0 ? "-" : (+_totbeinvoiced.toFixed(2)).toLocaleString(2)}</td>`;
        p += `<td class="numeric-cells subtotalrow">${(+_totbeexecuted) === 0 ? "-" : (+_totbeexecuted.toFixed(2)).toLocaleString(2)}</td>`;
        p += `<td class="numeric-cells subtotalrow">${(+_totbecontracted) === 0 ? "-" : (+_totbecontracted.toFixed(2)).toLocaleString(2)}</td>`;
        p += "</tr>";
    })
    p += "<tr>";
    p += `<td colspan="3" class="numeric-cells gtotalrow titlerow" style='width:473px;'>Grand Total</td>`;
    p += `<td class="numeric-cells gtotalrow">${(+pjcval) === 0 ? "-" : (+pjcval.toFixed(2)).toLocaleString(2)}</td>`;
    p += `<td class="numeric-cells gtotalrow">${(+motot) === 0 ? "-" : (+motot.toFixed(2)).toLocaleString(2)}</td>`;
    p += `<td class="numeric-cells gtotalrow">${(+valuvations) === 0 ? "-" : (+valuvations.toFixed(2)).toLocaleString(2)}</td>`;
    p += `<td class="numeric-cells gtotalrow">${(+totbeinvoiced) === 0 ? "-" : (+totbeinvoiced.toFixed(2)).toLocaleString(2)}</td>`;
    p += `<td class="numeric-cells gtotalrow">${(+totbeexecuted) === 0 ? "-" : (+totbeexecuted.toFixed(2)).toLocaleString(2)}</td>`;
    p += `<td class="numeric-cells gtotalrow">${(+totbecontracted) === 0 ? "-" : (+totbecontracted.toFixed(2)).toLocaleString(2)}</td>`;
    p += "</tr>";
    p += `</tbody> </table>`;
    return p;
}
function gropuby(a) {
    console.log(data);
    let _g = [];
    data.map(i => {
        if (!_g.includes(i[a].toLowerCase())) {
            _g.push(i[a].toLowerCase());
        }
    });
    let fdata = [];
    _g.map(i => {
        let colname = i;
        let gdata = [];
        data.map(j => {
            if (i.toLowerCase() === j[a].toLowerCase()) {
                gdata.push(j);
            }
        });
        fdata.push({ colname, gdata });
    })
    console.log(fdata);
    printmode = "G";
    _isdisplay = false;
    document.getElementById("dropdownlist").style.display = "none";
    render(fdata);
}
groupbynone();
function groupbynone() {
    _isdisplay = false;
    document.getElementById("dropdownlist").style.display = "none";
    render(data);
}

function readcols() {

}

function readdatas() {

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

function printaction() {
    window.print();
}

