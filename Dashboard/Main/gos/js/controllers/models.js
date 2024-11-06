export const aliprojectgoview = (s, a, c) => {
    const xc = [];
    var filterParams = {
        comparator: function (filterLocalDateAtMidnight, cellValue) {
            var dateAsString = cellValue;
            var dateParts = dateAsString.split('-');
            //console.log(filterLocalDateAtMidnight);

            var cellDate = new Date(
                Number(dateParts[0]),
                Number(dateParts[1]) - 1,
                Number(dateParts[2])
            );
            //console.log(cellDate);
            if (filterLocalDateAtMidnight.getTime() === cellDate.getTime()) {
                return 0;
            }

            if (cellDate <= filterLocalDateAtMidnight) {
                return -1;
            }

            if (cellDate >= filterLocalDateAtMidnight) {
                return 1;
            }
            // return 1;
        },
    };
    const celltheme = {
        'cutting_cell_production': p => (+p.data.gopflag) >= 2,
        'cutting_cell_fok': p => (+p.data.gopflag) === 3,
    }

    xc.push({
        width: 80,
        headerName: "PJ#",
        field: "goid",
        sortingOrder: ['asc', 'desc'],
        sort: 'desc',
        sortIndex: 0,
        hide: true
    });
    xc.push({
        headerName: 'Remove',
        cellRenderer: (p) => {
            if ((+p.data.filestatus) === 1 || (+p.data.gopflag) === 3) {
                return '-';
            } else {
                return c(`<button class="ism-btns btn-delete" style="padding:2px 2px" ng-click="removego('${p.data.goid}')"><i class="fa fa-trash"></i></button>`)(s)[0]
            }
        },
        width: 60,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: 'PDF',
        cellRenderer: (p) => {
            if (p?.data?.filestatus?.toString() === "0") {
                return '-'
            } else {
                return `
                <div style="margin-top: 3px;
                display: flex;
                gap: 8px;
                align-items: center;">
                <a href="${print_location}/assets/cuttinglists/go/${p.data.goid}.pdf" download="${p.data.goprojectname} GO : ${p.data.gonodisp}.pdf" class="link">
                    <img src="${print_location}/assets/pdfdownload.png?v=2.4.1.4" style="width:15px;">
                </a>
                <a href="${print_location}/assets/cuttinglists/go/${p.data.goid}.pdf" target="_blank" class="link">
                    <i class='fa fa-eye'></i>
                </a>
                </div>
                `;
            }
        },
        width: 80,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: 'GO PDF',
        cellRenderer: (p) => {
            return c(`<button class="ism-btns btn-normal" style="padding:2px 2px" ng-click="uploadmox('${p.data.goid}')"><i class="fa fa-file-pdf-o"></i></button>`)(s)[0]
        },
        width: 60,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "options",
        width: 90,
        cellRenderer: (p) => {
            return c(`
            <div style="display:flex;align-item:center;gap:2px" >
                <button class="ism-btns btn-normal" type="button" style="padding:2px 2px" ng-click="goedit('${p.data.goid}')">
                    <i class="fa fa-edit"></i>
                </button>
            </div>
            `)(s)[0];
            // if ((+p.data.procurement_status) === 0) {

              
            // } else {
            //     return '-'
            // }
        },
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Go#",
        field: "gonodisp",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 180,
        cellStyle: {
            "color": "#003934",
            "font-weight": "bold"
        },
        cellClassRules: celltheme,
        pinned: 'left'
    })
    xc.push({
        headerName: "Department",
        field: "godepartment",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        cellStyle: {
            "color": "#003934",
            "font-weight": "bold"
        },
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "To Dep",
        field: "godeparmentdate",
        filter: 'agDateColumnFilter',
        cellRenderer: (p) => {
            return `<div>${p.data.godeparmentdate_d.normal}</div>`
        },
        cellStyle: {
            "color": "#003934",
            "font-weight": "bold"
        },
        width: 120,
        cellClassRules: celltheme,
        filterParams: filterParams,
        sortingOrder: ['asc', 'desc'],
        sort: 'desc',
        sortIndex: 0
    })
    xc.push({
        headerName: "PJ#",
        field: "goproject",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        cellClassRules: celltheme,

    })
    xc.push({
        headerName: "Project",
        field: "goprojectname",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        cellClassRules: celltheme,

    })
    xc.push({
        headerName: "Type",
        field: "goglasstype",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        cellClassRules: celltheme,

    })
    xc.push({
        headerName: "Specification",
        field: "goglassspec",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 220,
        cellClassRules: celltheme,
        autoHeight: true,
        wrapText: true,

    })
    xc.push({
        headerName: "Marking",
        field: "gomarking",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 190,
        cellClassRules: celltheme,
        autoHeight: true,
        wrapText: true,

    })
    xc.push({
        headerName: "Qty",
        field: "goqty",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme,

    })
    xc.push({
        headerName: "Area",
        field: "goarea",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme,

    })
    xc.push({
        headerName: "Engg",
        field: "godoneby",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme,

    })
    xc.push({
        headerName: "Remark",
        field: "remarks",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 190,
        cellClassRules: celltheme,
        autoHeight: true,
        wrapText: true,
    })



    xc.push({
        headerName: "To Cost",
        field: "gocostingrelease",
        cellRenderer: (p) => {
            return (+p.data.gocostingflag) >= 2 ? p.data.gocostingrelease_d.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "From Cost",
        field: "gocosingreturn",
        cellRenderer: (p) => {
            return (+p.data.gocostingflag) === 3 ? p.data.gocosingreturn_d.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "COSTING ST",
        field: "gocostingflag",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        cellRenderer: (p) => {
            const csst = {
                '0': 'nacss',
                '1': 'direct_css',
                '2': 'fw_css',
                '3': 'rt_css'
            };
            const current_css = csst[p.data.gocostingflag.toString()];
            return c(`
                <div class="${current_css}" style="width:55px!important">
                ${p.data.gocostingflag_txt}
                </div>
            `)(s)[0]
        },
        width: 70,
        cellClassRules: celltheme,

    })


    xc.push({
        headerName: "To PRU",
        field: "goprelease",
        cellRenderer: (p) => {
            return (+p.data.gopflag) >= 2 ? p.data.goprelease_d.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "From PRU",
        field: "gopreturn",
        cellRenderer: (p) => {
            return (+p.data.gopflag) === 3 ? p.data.gopreturn_d.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme,

    })
    xc.push({
        headerName: "Procurement",
        field: "gopflag",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        cellRenderer: (p) => {
            const csst = {
                '0': 'danger_css',
                '1': 'danger_css',
                '2': 'danger_css',
                '3': 'rt_css'
            };
            const current_css = csst[p.data.gopflag.toString()];
            return c(`
                 <div class="${current_css}" style="width:55px!important">
                 ${p.data.goflag_txt}
                 </div>
             `)(s)[0]
        },
        cellClassRules: celltheme,
        pinned: 'right'
    })
    return xc;
}


export const aliprojectgoviewusers = (s, a, c) => {
    const xc = [];
    var filterParams = {
        comparator: function (filterLocalDateAtMidnight, cellValue) {
            var dateAsString = cellValue;
            var dateParts = dateAsString.split('-');
            //console.log(filterLocalDateAtMidnight);

            var cellDate = new Date(
                Number(dateParts[0]),
                Number(dateParts[1]) - 1,
                Number(dateParts[2])
            );
            //console.log(cellDate);
            if (filterLocalDateAtMidnight.getTime() === cellDate.getTime()) {
                return 0;
            }

            if (cellDate <= filterLocalDateAtMidnight) {
                return -1;
            }

            if (cellDate >= filterLocalDateAtMidnight) {
                return 1;
            }
            // return 1;
        },
    };
    const celltheme = {
        'cutting_cell_production': p => (+p.data.gopflag) >= 2,
        'cutting_cell_fok': p => (+p.data.gopflag) === 3,
    }



    xc.push({
        width: 80,
        headerName: "PJ#",
        field: "goid",
        sortingOrder: ['asc', 'desc'],
        sort: 'desc',
        sortIndex: 0,
        hide: true
    });

    xc.push({
        headerName: 'PDF',
        field: 'gofilestatus',
        cellRenderer: (p) => {
            if (p?.data?.filestatus?.toString() === "0") {
                return '-'
            } else {
                return `
                <div style="margin-top: 3px;
                display: flex;
                gap: 8px;
                align-items: center;">
                <a href="${print_location}/assets/cuttinglists/go/${p.data.goid}.pdf" download="${p.data.goprojectname} GO : ${p.data.gonodisp}.pdf" class="link">
                    <img src="${print_location}/assets/pdfdownload.png?v=2.4.1.4" style="width:15px;">
                </a>
                <a href="${print_location}/assets/cuttinglists/go/${p.data.goid}.pdf" target="_blank" class="link">
                    <i class='fa fa-eye'></i>
                </a>
                </div>
                `;
            }
        },
        width: 80,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Go#",
        field: "gonodisp",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 220,
        cellStyle: {
            "color": "#003934",
            "font-weight": "bold"
        },
        cellClassRules: celltheme,
        pinned: 'left',
        checkboxSelection: true,
        headerCheckboxSelection: true,
    })
    xc.push({
        headerName: "Department",
        field: "godepartment",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        cellStyle: {
            "color": "#003934",
            "font-weight": "bold"
        },
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "To Dep",
        field: "godeparmentdate",
        filter: 'agDateColumnFilter',
        cellRenderer: (p) => {
            return `<div>${p.data.godeparmentdate_d.normal}</div>`
        },
        cellStyle: {
            "color": "#003934",
            "font-weight": "bold"
        },
        width: 120,
        cellClassRules: celltheme,
        filterParams: filterParams,
        sortingOrder: ['asc', 'desc'],
        sort: 'desc',
        sortIndex: 0
    })
    xc.push({
        headerName: "PJ#",
        field: "goproject",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        cellClassRules: celltheme,

    })
    xc.push({
        headerName: "Project",
        field: "goprojectname",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        cellClassRules: celltheme,

    })
    xc.push({
        headerName: "Type",
        field: "goglasstype",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        cellClassRules: celltheme,

    })
    xc.push({
        headerName: "Specification",
        field: "goglassspec",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 220,
        cellClassRules: celltheme,
        autoHeight: true,
        wrapText: true,

    })
    xc.push({
        headerName: "Marking",
        field: "gomarking",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 190,
        cellClassRules: celltheme,
        autoHeight: true,
        wrapText: true,

    })
    xc.push({
        headerName: "Qty",
        field: "goqty",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme,

    })
    xc.push({
        headerName: "Area",
        field: "goarea",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme,

    })
    xc.push({
        headerName: "Engg",
        field: "godoneby",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme,

    })
    xc.push({
        headerName: "Remark",
        field: "remarks",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 190,
        cellClassRules: celltheme,
        autoHeight: true,
        wrapText: true,
    })



    return xc;
}


export const procurementgrid = (s, a, c) => {
    let xc = [];

    xc.push({
        width: 190,
        headerName: "GO#",
        field: "gonodisp",
        cellRenderer: (p) => a.editaccess ? c(`
        <button type="button" class="ism-btns btn-normal" ng-click="updateProcurement('${p.data.goid}')" style="padding:2px;border-radius:2px;cursor:pointer">
            ${p.data.gonodisp}
        </button>
        `)(s)[0] : p.data.gonodisp,
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    });

    xc.push({
        width: 80,
        headerName: "PDF",
        cellRenderer: (p) => {
            if (p?.data?.pfstatus?.toString() === "0") {
                if (p?.data?.filestatus?.toString() === "0") {
                    return '-'
                } else {
                    return `
                    <div style="margin-top: 3px;
                    display: flex;
                    gap: 8px;
                    align-items: center;">
                    <a href="${print_location}/assets/cuttinglists/go/${p.data.goid}.pdf" download="${p.data.goprojectname} GO : ${p.data.gonodisp}.pdf" class="link">
                        <img src="${print_location}/assets/pdfdownload.png?v=2.4.1.4" style="width:15px;">
                    </a>
                    <a href="${print_location}/assets/cuttinglists/go/${p.data.goid}.pdf" target="_blank" class="link">
                        <i class='fa fa-eye'></i>
                    </a>
                    </div>
                    `;
                }
            } else {
                return `
                <div style="margin-top: 3px;
                display: flex;
                gap: 8px;
                align-items: center;">
                <a href="${print_location}/assets/cuttinglists/gosp/${p.data.goid}.pdf" download="${p.data.goprojectname} GO : ${p.data.gonodisp}.pdf" class="link">
                    <img src="${print_location}/assets/pdfdownload.png?v=2.4.1.4" style="width:15px;">
                </a>
                <a href="${print_location}/assets/cuttinglists/gosp/${p.data.goid}.pdf" target="_blank" class="link">
                    <i class='fa fa-eye'></i>
                </a>
                </div>
                `;
            }
        }
    });

    if (a.pdfupdate) {
        xc.push({
            headerName: 'GO PDF',
            cellRenderer: (p) => {
                return c(`<button class="ism-btns btn-normal" style="padding:2px 2px" ng-click="uploadmox('${p.data.goid}')"><i class="fa fa-file-pdf-o"></i></button>`)(s)[0]
            },
            width: 60,

        })
    }
    xc.push({
        width: 80,
        headerName: "PJ#",
        field: "goproject",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    });
    xc.push({
        width: 317,
        headerName: "Project",
        field: "goprojectname",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    });
    xc.push({
        width: 100,
        headerName: "Go Type",
        field: "gootype_txt",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    });
    xc.push({
        width: 120,
        headerName: "Date",
        field: "procurement_orderdate",
        cellRenderer: (p) => (+p.data.procurement_status) === 0 ? '-' : p.data.procurement_orderdate_d?.display ?? '-',
        sortingOrder: ['asc', 'desc'],
        filter: 'agDateColumnFilter',
        sort: 'desc',
        sortIndex: 0
    });
    xc.push({
        width: 160,
        headerName: "Supplier",
        field: "procurement_supplier",
        cellRenderer: (p) => (+p.data.procurement_status) === 0 ? '' : p.data.procurement_supplier,
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    })
    xc.push({
        width: 120,
        headerName: "Coating",
        field: "procurement_coating",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    })
    xc.push({
        width: 120,
        headerName: "Thickness",
        field: "procurement_thickness",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    })
    xc.push({
        width: 120,
        headerName: "Out",
        field: "procurement_out",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    })
    xc.push({
        width: 120,
        headerName: "Inner",
        field: "procurement_inner",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    })
    xc.push({
        width: 90,
        headerName: "Qty",
        field: "procurement_qty",
        cellRenderer: (p) => {
            if ((+p.data.procurement_status) === 0) {
                return p.data.goqty;
            } else {
                if (p.data.procurement_qty === p.data.goqty) {
                    return p.data.procurement_qty
                } else {
                    return `${p.data.procurement_qty} <span style="font-size:10px">(${p.data.goqty})</span>`
                }
            }
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    })
    xc.push({
        width: 90,
        headerName: "Area",
        field: "procurement_area",
        cellRenderer: (p) => {
            if ((+p.data.procurement_status) === 0) {
                return p.data.goarea;
            } else {
                if (p.data.procurement_area === p.data.goarea) {
                    return p.data.procurement_area;
                } else {
                    return `${p.data.procurement_area} <span style="font-size:10px">(${p.data.goarea})</span>`
                }
            }
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    })
    xc.push({
        width: 90,
        headerName: "Received Qty",
        field: "receipt_qty",
        cellRenderer: (p) => {
            // return '0';
            if ((+p.data.procurement_status) !== 0 && p?.data?.pfstatus?.toString() !== "0") {
                return a.receiptaccess ? c(`
                <button type="button" class="ism-btns btn-normal" ng-click="receiptlist('${p.data.goid}')" style="padding:2px;border-radius:2px;cursor:pointer">
                    ${p.data.receipt_qty}
                </button>
                `)(s)[0] : p.data.receipt_qty
            } else {
                return '0';
            }
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    })
    xc.push({
        width: 90,
        headerName: "Received Area",
        field: "receipt_area",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    })
    xc.push({
        width: 90,
        headerName: "Balance Qty",
        field: "go_balance_qty",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    })
    xc.push({
        width: 90,
        headerName: "Balance Area",
        field: "go_balance_area",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    })
    xc.push({
        width: 150,
        headerName: "Glass Type",
        field: "goglasstype",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    })
    xc.push({
        width: 350,
        headerName: "Glass Specification",
        field: "goglassspec",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    })
    if (a.priceaccess) {
        xc.push({
            width: 120,
            headerName: "Unit Price",
            field: "procurment_orderunitprice",
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
        })
        xc.push({
            width: 120,
            headerName: "Others",
            field: "procurement_otherprice",
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
        })
        xc.push({
            width: 120,
            headerName: "Total Price",
            field: "procurement_totalprice",
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
        })
        xc.push({
            width: 120,
            headerName: "Receipt Total",
            field: "receipt_amount",
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
        })
        xc.push({
            width: 120,
            headerName: "Balance Total",
            field: "go_balance_amount",
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
        })
    }
    return xc;
}




export const procurementgridashraf = (s, a, c) => {
    let xc = [];
    xc.push({
        width: 120,
        headerName: "Date",
        field: "procurement_orderdate",
        cellRenderer: (p) => (+p.data.procurement_status) === 0 ? '-' : p.data.procurement_orderdate_d?.display ?? '-',
        sortingOrder: ['asc', 'desc'],
        filter: 'agDateColumnFilter',
        sort: 'desc',
        sortIndex: 0,
        
    });
    xc.push({
        width: 100,
        headerName: "Go Type",
        field: "goreceipttype",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        
    });
    xc.push({
        width: 160,
        headerName: "Supplier",
        field: "procurement_supplier",
        cellRenderer: (p) => (+p.data.procurement_status) === 0 ? '' : p.data.procurement_supplier,
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
       
    })
    xc.push({
        width: 120,
        headerName: "Coating",
        field: "procurement_coating",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
       
    })

    xc.push({
        width: 80,
        headerName: "Contract",
        field: "goproject",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
       
    });
    xc.push({
        width: 317,
        headerName: "Project Name",
        field: "goprojectname",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
       
    });
    if (s.editoptions) {
        xc.push({
            width: 190,
            headerName: "GO#",
            field: "gonodisp",
            cellRenderer: (p) => a.editaccess ? c(`
        <button type="button" class="ism-btns btn-normal" ng-click="updateProcurement('${p.data.goid}')" style="padding:2px;border-radius:2px;cursor:pointer">
            ${p.data.gonodisp}
        </button>
        `)(s)[0] : p.data.gonodisp,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
        

        });
    } else {
        xc.push({
            width: 190,
            headerName: "GO#",
            field: "gonodisp",           
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
        });
    }

    xc.push({
        width: 125,
        headerName: "P.I",
        field: "invoiceno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
       
    });

    xc.push({
        width: 120,
        headerName: "Thickness",
        field: "procurement_thickness",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
       
    })
    xc.push({
        width: 120,
        headerName: "Out",
        field: "procurement_out",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        
    })
    xc.push({
        width: 120,
        headerName: "Inner",
        field: "procurement_inner",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
       
    })
    xc.push({
        width: 90,
        headerName: "Qty",
        field: "procurement_qty",
        cellRenderer: (p) => {
            if ((+p.data.procurement_status) === 0) {
                return p.data.goqty;
            } else {
                if (p.data.procurement_qty === p.data.goqty) {
                    return p.data.procurement_qty
                } else {
                    return `${p.data.procurement_qty} <span style="font-size:10px">(${p.data.goqty})</span>`
                }
            }
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
       
    })

    xc.push({
        width: 90,
        headerName: "Received Qty",
        field: "receipt_qty",
        cellRenderer: (p) => {
            // return '0';
            //if ((+p.data.procurement_status) !== 0 && p?.data?.pfstatus?.toString() !== "0") {
            if ((+p.data.procurement_status) !== 0) {
                return a.receiptaccess ? c(`
                <button type="button" class="ism-btns btn-normal" ng-click="receiptlist('${p.data.goid}')" style="padding:2px;border-radius:2px;cursor:pointer">
                    ${p.data.receipt_qty}
                </button>
                `)(s)[0] : p.data.receipt_qty
            } else {
                return '0';
            }
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        
    })

    xc.push({
        width: 90,
        headerName: "Balance Qty",
        field: "go_balance_qty",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        
    })

    xc.push({
        width: 130,
        headerName: "U-Insert",
        field: "uinsert",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
       
    })
    xc.push({
        width: 170,
        headerName: "Remark",
        field: "procurementremark",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
      
    })
    xc.push({
        width: 130,
        headerName: "Location",
        field: "dellocation",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        
    })

    xc.push({
        width: 130,
        headerName: "ETA",
        field: "proucrementeta",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
       
    })
    xc.push({
        width: 130,
        headerName: "W.O.R#",
        field: "proucrementeta",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
       
    })

    xc.push({
        width: 90,
        headerName: "SQM",
        field: "procurement_area",
        cellRenderer: (p) => {
            if ((+p.data.procurement_status) === 0) {
                return p.data.goarea;
            } else {
                if (p.data.procurement_area === p.data.goarea) {
                    return p.data.procurement_area;
                } else {
                    return `${p.data.procurement_area} <span style="font-size:10px">(${p.data.goarea})</span>`
                }
            }
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        
    })

    if (a.priceaccess) {
        xc.push({
            width: 120,
            headerName: "Unit Price",
            field: "procurment_orderunitprice",
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            
        })
        xc.push({
            width: 120,
            headerName: "Others",
            field: "procurement_otherprice",
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            
        })
        xc.push({
            width: 120,
            headerName: "Total Price",
            field: "procurement_totalprice",
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            
        })
        xc.push({
            width: 120,
            headerName: "Receipt Total",
            field: "receipt_amount",
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            
        })
        xc.push({
            width: 120,
            headerName: "Balance Total",
            field: "go_balance_amount",
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            
        })
        xc.push({
            width: 120,
            headerName: "Broken By",
            field: "broken_by",
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            
        })
        xc.push({
            width: 120,
            headerName: "Broken By If nafco",
            field: "broken_naf_by",
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            
        })
    }

    xc.push({
        width: 80,
        headerName: "PDF",
        cellRenderer: (p) => {
            if (p?.data?.pfstatus?.toString() === "0") {
                if (p?.data?.filestatus?.toString() === "0") {
                    return '-'
                } else {
                    return `
                    <div style="margin-top: 3px;
                    display: flex;
                    gap: 8px;
                    align-items: center;">
                    <a href="${print_location}/assets/cuttinglists/go/${p.data.goid}.pdf" download="${p.data.goprojectname} GO : ${p.data.gonodisp}.pdf" class="link">
                        <img src="${print_location}/assets/pdfdownload.png?v=2.4.1.4" style="width:15px;">
                    </a>
                    <a href="${print_location}/assets/cuttinglists/go/${p.data.goid}.pdf" target="_blank" class="link">
                        <i class='fa fa-eye'></i>
                    </a>
                    </div>
                    `;
                }
            } else {
                return `
                <div style="margin-top: 3px;
                display: flex;
                gap: 8px;
                align-items: center;">
                <a href="${print_location}/assets/cuttinglists/gosp/${p.data.goid}.pdf" download="${p.data.goprojectname} GO : ${p.data.gonodisp}.pdf" class="link">
                    <img src="${print_location}/assets/pdfdownload.png?v=2.4.1.4" style="width:15px;">
                </a>
                <a href="${print_location}/assets/cuttinglists/gosp/${p.data.goid}.pdf" target="_blank" class="link">
                    <i class='fa fa-eye'></i>
                </a>
                </div>
                `;
            }
        }
    });

    if (a.pdfupdate) {
        xc.push({
            headerName: 'GO PDF',
            cellRenderer: (p) => {
                return c(`<button class="ism-btns btn-normal" style="padding:2px 2px" ng-click="uploadmox('${p.data.goid}')"><i class="fa fa-file-pdf-o"></i></button>`)(s)[0]
            },
            width: 60,

        })
    }

    xc.push({
        width: 90,
        headerName: "Received Area",
        field: "receipt_area",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        
    })

    xc.push({
        width: 90,
        headerName: "Balance Area",
        field: "go_balance_area",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        
    })
    xc.push({
        width: 150,
        headerName: "Glass Type",
        field: "goglasstype",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
       
    })
    xc.push({
        width: 350,
        headerName: "Glass Specification",
        field: "goglassspec",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    
    })

    return xc;
}

export const goreceipts = (s, a, c) => {
    let xc = [];
    xc.push({
        width: 100,
        headerName: "PDF",
        field: "pfstatusx",
        cellRenderer: (p) => {
            if (p.data.pfstatus.toString() === "1") {
                return c(`
                <div style="display:flex;gap:2px">
                    <a href="${print_location}/assets/cuttinglists/gor/${p.data.goreceiptid}.pdf" target="_blank" download="Go Receipt _ ${p.data.goreceiptinvoiceno}.pdf">
                        <img src="${print_location}/assets/pdfdownload.png?v=2.4.1.4" style="width:15px;">
                    </a>
                    <a href="${print_location}/assets/cuttinglists/gor/${p.data.goreceiptid}.pdf" target="_blank">
                        <i class="fa fa-eye"></i>
                    </a>
                </div> 
            `)(s)[0];
            } else {
                return '-';
            }
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',    
    })
    xc.push({
        width: 100,
        headerName: "Project#",
        field: "goreceipt_project",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',    
    })
    xc.push({
        width: 190,
        headerName: "Project Name",
        field: "goreceipt_projectname",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',    
    })
    xc.push({
        width: 100,
        headerName: "GO#",
        field: "gonumber",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',    
    })
    xc.push({
        width: 100,
        headerName: "Order Type",
        field: "goreceipttype",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',    
    })
    xc.push({
        width: 100,
        headerName: "Receipt#",
        field: "goreceiptinvoiceno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',    
    })
    xc.push({
        width: 120,
        headerName: "Date",
        field: "goreceiptdate",
        cellRenderer : (p) => p.data.goreceiptdate_s.display,
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        sort: 'desc',
        sortIndex : 0,    
    })
    xc.push({
        width: 100,
        headerName: "Supplier",
        field: "goreceiptsupplier",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',    
    })
    xc.push({
        width: 200,
        headerName: "Glass Type",
        field: "goglasstype",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',    
    })
    xc.push({
        width: 250,
        headerName: "Glass Spec",
        field: "procurement_thickness",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',    
    })
    xc.push({
        width: 100,
        headerName: "Qty",
        field: "goreceiptqty",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',    
    })
    xc.push({
        width: 100,
        headerName: "Area",
        field: "goreceiptarea",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',    
    })
    return xc;
}