export default function homepage($scope, $rootScope) {
    console.log("working");

    setPagetitle()
    let _date = new Date();
    $scope.currentdate = `${_date.getDate()}-${_date.getMonth() + 1}-${_date.getFullYear()}`;
    async function setPagetitle() {
        console.log("function Called");
        const title = await localStorage.getItem("pagetitle");
        document.title = title;
        console.log(title);
        $rootScope.printtitle = title;
        console.log($rootScope.printtitle);
        console.log("function End");
        $scope.$apply();
    }

    $scope.ungroupdisp = true;
    // $rootScope.printtitle = "Materials to be Loaded";
    $rootScope.printfilters = true;
    $scope.colspancnt = 11;
    const groupitems = [
        {
            disp_name: "Project",
            field_name: "loadproject",
        },
        {
            disp_name: "Sales Rep",
            field_name: "Sales_Representative",
        },
        {
            disp_name: "Description",
            field_name: "mattype",
        },
        {
            disp_name: "Driver",
            field_name: "driver",
        },

        {
            disp_name: "Location",
            field_name: "location",
        },
        {
            disp_name: "Region",
            field_name: "projectRegion"
        },
        {
            disp_name: "Status",
            field_name: "status"
        },
        {
            disp_name: "Week No",
            field_name: "currentweek"
        }
    ];

    function calspanchange(groupColumn) {

        switch (groupColumn) {
            default: return 14;
            case 'loadproject': return 14;
            case 'mattype': return 14;
            case 'driver': return 14;
            case 'location': return 14;
            case 'locastatustion': return 14;
        }
    }

    $rootScope.groupingitems = groupitems;
    $scope.ungroup = [];
    //grop
    const data = JSON.parse(localStorage.getItem("pms_ism_new_print"));
    $scope.ungroup = data;
    $rootScope.groupbynone = () => {
        $scope.ungroup = data;
        showhiddenlist()
        $scope.ungroupdisp = true;
    }
    ungroupdisplay();
    function ungroupdisplay() {
        let printdata = ``;
        let page_break = 1;
        let total_area = 0;
        let total_area_del = 0;
        let total_area_pen = 0;
        data.map((x, index) => {
            page_break += 1;
            let classn = "";
            if (page_break === 21) {
                page_break = 1;
                classn = "break-page";
            }
            if (x.unit.toLowerCase() === 'sqm' || x.unit.toLowerCase() === 'sqm') {
                total_area += (+x.area)
                if (x.status === "Delivered") {
                    total_area_del += (+x.area)
                } else {
                    total_area_pen += (+x.area)
                }
            }
            printdata += `<tr>
            <td>${index + 1}</td>
            <td style="color :#7521ad;font-weight: bold">${x.loadproject}</td>
            <!-- <td style="color :#7521ad;font-weight: bold;white-space: pre-wrap;">{{x.loadproject}} - [{{x.pjcno}}]</td> -->
            <td style="white-space: normal;">${x.location}</td>
            <td style="color :#2207ff;font-weight: bold;">${x.description}</td>
            <td style="text-align: right;font-weight: bold;;text-align:center">${x.qty}</td>
            <td style="text-align: right;font-weight: bold;;text-align:center">${x.area}</td>
            <td>${x.unit}</td>
            <td>${x.cuttinglistno}</td>
            <td>${x.driver}</td>
            <td>${x.loadingdate_p}</td>
            <td>${x.ascurrentdate_p}</td>
            <td class="${x.status === 'Delivered' ? 'okgg' : 'dang'}">${x.status}</td>
            <td>${x.remark}</td>
        </tr>`
        })
        printdata += `
        <tr>
            <td colspan="5" style="text-align: right;
            background: #e0e0ff;
            font-size: 13px;
            font-weight: 600;
            ">Total Area</td>
            <td style="text-align: right;
            background: #e0e0ff;
            font-size: 14px;
            font-weight: 600;
            ">${total_area}</td>
            <td style="
            background: #e0e0ff;
            font-size: 13px;
            font-weight: 600;
            " colspan="7">sqm</td>
        </tr>
        `;
        printdata += `
        <tr>
            <td colspan="5" style="text-align: right;
    background: #e0fff1;
    font-size: 13px;
    font-weight: 600;">Total Delivered Area</td>
            <td style="text-align: right;
            background: #e0fff1;
            font-size: 14px;
            font-weight: 600;">${total_area_del}</td>
            <td style="
            background: #e0fff1;
            font-size: 13px;
            font-weight: 600;" colspan="7">sqm</td>
        </tr>
        `
        printdata += `
        <tr>
            <td colspan="5" style="text-align: right;
    background: #ffe0e0;
    font-size: 13px;
    font-weight: 600;">Total Pending Area</td>
            <td  style="text-align: right;
            background: #ffe0e0;
            font-size: 14px;
            font-weight: 600;">${total_area_pen}</td>
            <td   style="
            background: #ffe0e0;
            font-size: 13px;
            font-weight: 600;" colspan="7">sqm</td>
        </tr>
        `
        document.getElementById("ungroupdata_disp").innerHTML = printdata;
    }

    //ungorup
    $scope.groupdata = [];
    $scope.groupColumn = "";
    $scope.newpageadd = false;
    $scope.groupdataTitle = "";
    $rootScope.gropuby = (z, y) => {
        $scope.colspancnt = calspanchange(z)
        console.log($scope.colspancnt);
        $scope.groupColumn = z;
        $scope.groupdata = [];
        $scope.groupdataTitle = y;
        let group_item = [];
        data.map(i => {
            const y = i[z].toLowerCase();
            if (!group_item.includes(y)) {
                group_item.push(y);
            }
        });
        console.log(group_item);
        let abc = [];
        group_item.sort((a, b) => a - b).map(n => {
            console.log("working");
            let cols = n;
            let xdata = data.filter(ab => ab[z].toLowerCase() === n);
            abc.push({ cols, xdata })
        })
        console.log(abc);
        $scope.groupdata = abc;
        groupDataDisplay(abc)
        $scope.ungroupdisp = false;

        showhiddenlist();
    }

    function groupDataDisplay(data) {
        console.log(data)
        let printdata = "";
        let groupColumn = $scope.groupColumn;
        let colspancnt = $scope.colspancnt;
        let groupdataTitle = $scope.groupdataTitle;
        console.log(colspancnt, groupdataTitle);
        let totarea = 0;
        let totarea_del = 0;
        let totarea_pen = 0;
        data.map((z, index) => {
            printdata += `
            <tr>
                <td colspan="${colspancnt}" class='grouptitle' style="
                    font-size: 15px !important;
                    line-height: 28px !important;
                ">
                    ${groupdataTitle} : ${z.cols.toUpperCase()}
                </td>
            </tr>
            `;
            let g_totalarea = 0;
            let g_totalarea_del = 0;
            let g_totalarea_pen = 0;
            z.xdata.map((x, index) => {
               
                if (x.unit.toLowerCase() === 'sqm' || x.unit.toLowerCase() === 'sqm') {
                    totarea += (+x.area);
                    g_totalarea += (+x.area);
                    if (x.status === "Delivered") {
                        totarea_del += (+x.area)
                        g_totalarea_del += (+x.area)
                    } else {
                        totarea_pen += (+x.area)
                        g_totalarea_pen += (+x.area)
                    }

                }
                printdata += `
                <tr>
                <td>${index + 1}</td>`;
                if (groupColumn !== "loadproject") {
                    printdata += `
                <td style="color :#7521ad;font-weight: bold;white-space: pre-wrap;" >${x.loadproject}</td>
                `
                }
                if (groupColumn !== "location") {
                    printdata += `<td style="white-space: normal;">${x.location}</td>`;
                }
                if (groupColumn !== "description") {
                    printdata += `
                <td style="color :#2207ff;font-weight: bold;white-space: pre-wrap;">${x.description}</td>`;
                }

                printdata += `
                <td style="text-align: right;font-weight: bold;text-align:center">${x.qty}</td>
                <td style="text-align: right;font-weight: bold;text-align:center">${x.area}</td>
                <td>${x.unit}</td>
                <td>${x.cuttinglistno}</td>`;
                if (groupColumn !== "driver"){
                    printdata += `
                <td ng-hide="groupColumn === 'driver'">${x.driver}</td>`;
            }
                printdata += `
                <td>${x.loadingdate_p}</td>
                <td>${x.ascurrentdate_p}</td>`
                if (groupColumn !== "status") {
                    printdata += `
                <td class="${x.status === 'Delivered' ? 'okgg' : 'dang'}"  ng-hide="groupColumn === 'status'">${x.status}</td>`
                }
                printdata += `
                <td style="white-space: normal;">${x.remark}</td>
                </tr>
                `
            })
            printdata += `
            <tr style="display:none">
            <td colspan="4" style="text-align:right;font-weight:bold;font-size:14px;color: #0043ff;">Sub Total</td>
            <td style="font-weight:bold;font-size:14px;color: #0043ff;">${g_totalarea}</td>
            <td colspan="8">sqm</td>
            </tr>
            <tr style="display:none">
            <td colspan="4" style="text-align:right;font-weight:bold;font-size:14px;    color: #007e04;">Delivered - Sub Total </td>
            <td style="font-weight:bold;font-size:14px;    color: #007e04;">${g_totalarea_del}</td>
            <td colspan="8">sqm</td>
            </tr>
            <tr style="display:none">
            <td colspan="4" style="text-align:right;font-weight:bold;font-size:14px;color: #fb0000;border-bottom:5px double  #000">Pending - Sub Total </td>
            <td style="font-weight:bold;font-size:14px;color: #fb0000;border-bottom:5px double  #000">${g_totalarea_pen}</td>
            <td colspan="8" style="border-bottom:5px double  #000">sqm</td>
            </tr>
            `;

        })
        printdata += `
        <tr>
        <td colspan="13" 
            style = "
            background: #fffae8;
            font-size: 15px;
            text-align: center;
            line-height: 28px;
            font-weight: 600;
            text-decoration: underline;
        "
        >Grand Total</td>
        </tr>
        <tr>
        <td colspan="4" style="text-align:right;font-weight:bold;font-size:14px;background: #d2f5ff;">Total Area</td>
        <td style="font-weight:bold;font-size:14px;background: #d2f5ff;">${totarea}</td>
        <td colspan="8" style="background: #d2f5ff;">sqm</td>
        </tr>
        <tr>
        <td colspan="4" style="text-align:right;font-weight:bold;font-size:14px;    background: #afffe5;">Total Delivered </td>
        <td style="font-weight:bold;font-size:14px;    background: #afffe5;">${totarea_del}</td>
        <td colspan="8" style="    background: #afffe5;">sqm</td>
        </tr>
        <tr>
        <td colspan="4" style="text-align:right;font-weight:bold;font-size:14px;background: #ffd6d6;">Total Pending </td>
        <td style="font-weight:bold;font-size:14px;background: #ffd6d6;">${totarea_pen}</td>
        <td colspan="8" style="background: #ffd6d6;">sqm</td>
        </tr>
        `;
        document.getElementById("groupdatadisp").innerHTML = printdata;
    }
}