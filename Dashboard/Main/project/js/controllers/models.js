export const projectgrid = (s, c, a) => {
    console.log(a);
    var filterParams = {
        comparator: function (filterLocalDateAtMidnight, cellValue) {
            var dateAsString = cellValue;
            var dateParts = dateAsString.split('-');
            var cellDate = new Date(
                Number(dateParts[0]),
                Number(dateParts[1]) - 1,
                Number(dateParts[2])
            );

            if (filterLocalDateAtMidnight.getTime() === cellDate.getTime()) {
                return 0;
            }

            if (cellDate < filterLocalDateAtMidnight) {
                return -1;
            }

            if (cellDate > filterLocalDateAtMidnight) {
                return 1;
            }
        },
        /// <div style="width:20"></div>
        // <button type="button" class="ism-btns btn-normal" style="padding:2px 5px">
        //     <i class="fa fa-pencil"></i>
        //     Edit Quotation
        // </button>
    };
    const pdfaccess = a.pdfaccess;
    const columndef = [];
    if (pdfaccess) {
        columndef.push({
            field: 'f_status',
            headerName: 'PDF',
            cellRenderer: function (p) {
                return p.data.f === '1' ? `
                <a href="${print_location}assets/contract/${p.data.project_no_enc}.pdf" download="${p.data.project_no}#${p.data.project_name} - CONTRACT " class="link">
                    <img src="${print_location}assets/pdfdownload.png?v=${v}" style="width:15px;"/>
                </a>
                ` : '-';
            },
            width: 50,
            headerClass: 'green-leaves',
            filter: false,
            pinned: 'left'
        })
    }
    columndef.push({
        headerName: 'Contract#',
        field: 'projectsnodisp',
        filter: 'agMultiColumnFilter',
        cellRenderer: function (p) {
            return c(`
            <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" ng-click="xgoproject('${p.data.project_no_enc}','${p.data.project_id}','viewproject')">
                <div>${p.data.project_no.toUpperCase()}</div>
            </button>           
            `)(s)[0];
        },
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        sort: 'desc',
        hide: true,
    })
    if (a.budetacces) {
        columndef.push({
            headerName: 'Contract No',
            field: 'project_no',

            cellRenderer: function (p) {
                return c(`
                <div style="display:flex;gap:2px">
                <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" ng-click="xgoproject('${p.data.project_no_enc}','${p.data.project_id}','viewproject')">
                ${p.data.project_no.toUpperCase()}
            </button>
            
            <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" ng-click="xgoproject('${p.data.project_no_enc}','${p.data.project_id}','projectbudget')">
            <i class="fa fa-usd"></i> Budget            
        </button>
        </div>
                `)(s)[0];
            },
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
            width: 150,
            headerClass: 'green-leaves',
            cellClass: 'yellow-leaves',
            pinned: 'left'
        })
    } else {
        columndef.push({
            headerName: 'Contract No',
            field: 'project_no',
            cellRenderer: function (p) {
                return c(`
                <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" ng-click="xgoproject('${p.data.project_no_enc}','${p.data.project_id}','viewproject')">
                ${p.data.project_no.toUpperCase()}
            </button>
           
            `)(s)[0];
            },
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
            width: 150,
            headerClass: 'green-leaves',
            cellClass: 'yellow-leaves',
            pinned: 'left'
        })
    }
    columndef.push({
        headerName: 'Project Name',
        field: 'project_name',
        width: 320,
        cellRenderer: function (p) {
            return c(`
            <button type="button" class="ism-btns btn-normal" style="padding:2px 5px"  ng-click="xgoproject('${p.data.project_no_enc}','${p.data.project_id}','viewproject')">
                ${p.data.project_name.toUpperCase()}
            </button>
            `)(s)[0];
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        pinned: 'left'
    })
    columndef.push({
        headerName: 'Contractor Name',
        field: 'project_cname',
        filter: 'agMultiColumnFilter',
        width: 280,
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })
    columndef.push({
        headerName: 'Location',
        field: 'project_location',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        width: 120,

    })
    if (pdfaccess) {
        columndef.push({
            headerName: 'Contract Value',
            field: 'project_amount',
            cellRenderer: (p) => { return (+p.data.project_amount).toLocaleString(2) },
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
            headerClass: 'green-leaves',
            cellClass: 'yellow-leaves numcells',
            width: 110,

        })
    }
    columndef.push({
        headerName: 'Sales Man',
        field: 'Sales_Representative',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        width: 120,

    })

    columndef.push({
        headerName: 'Sign Date',
        field: 'project_singdate',
        cellRenderer: function (d) {
            return `<div>${d.data.project_singdate_d.display}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        sort: 'desc',
        // sortIndex: 0,
        width: 100,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })

    columndef.push({
        headerName: 'Duration (MONTHS)',
        field: 'project_contract_duration',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        width: 90,

    })


    columndef.push({
        headerName: 'Expiry Date',
        field: 'project_expiry_date',
        cellRenderer: function (d) {
            return `<div>${d.data.project_expiry_date_d.display}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        sort: 'desc',
        // sortIndex: 0,
        width: 110,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })

    columndef.push({
        headerName: 'Tech.Approvals',
        field: 'techapprovals_status',
        cellRenderer: function (p) {
            if (p.data.techapprovals_status === "NO") {
                return '-'
            } else {
                return c(`
                <button type="button" class="ism-btns btn-normal" style="padding:2px 5px"  ng-click="xgoproject('${p.data.project_no_enc}','${p.data.project_id}','approval')">                
                ${p.data.techapprovals_cnt}
                </button>
                `)(s)[0]
            }
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        width: 90,
    })

    columndef.push({
        headerName: 'Drawing.Approvals',
        field: 'drawingapprovals_status',
        cellRenderer: function (p) {
            if (p.data.drawingapprovals_status === "NO") {
                return '-'
            } else {
                return c(`
                <button type="button" class="ism-btns btn-normal" style="padding:2px 5px"  ng-click="xgoproject('${p.data.project_no_enc}','${p.data.project_id}','techdraw')">                
                ${p.data.drawingapprovals_cnt}
                </button>
                `)(s)[0]
            }
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        width: 90,
    })

    columndef.push({
        headerName: 'M.R',
        field: 'mr_status',
        cellRenderer: function (p) {
            if (p.data.mr_status === "NO") {
                return '-'
            } else {
                return c(`
                <button type="button" class="ism-btns btn-normal" style="padding:2px 5px"  ng-click="xgoproject('${p.data.project_no_enc}','${p.data.project_id}','mr')">                
                ${p.data.mr_cnt}
                </button>
                `)(s)[0]
            }
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        width: 90,
    })

    columndef.push({
        headerName: 'BOM',
        field: 'bom_status',
        cellRenderer: function (p) {
            if (p.data.bom_status === "NO") {
                return '-'
            } else {
                return c(`
                <button type="button" class="ism-btns btn-normal" style="padding:2px 5px"  ng-click="xgoproject('${p.data.project_no_enc}','${p.data.project_id}','nbom')">                
                ${p.data.bom_cnt}
                </button>
                `)(s)[0]
            }
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        width: 90,
    })

    columndef.push({
        headerName: 'Cutting List',
        field: 'cl_status',
        cellRenderer: function (p) {
            if (p.data.cl_status === "NO") {
                return '-'
            } else {
                return c(`
                <button type="button" class="ism-btns btn-normal" style="padding:2px 5px"  ng-click="xgoproject('${p.data.project_no_enc}','${p.data.project_id}','cuttinglistsusersp')">                
                ${p.data.cl_cnt}
                </button>
                `)(s)[0]
            }
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        width: 90,
    })

    columndef.push({
        headerName: 'Glass Orders',
        field: 'gos_status',
        cellRenderer: function (p) {
            if (p.data.gos_status === "NO") {
                return '-'
            } else {
                return c(`
                <button type="button" class="ism-btns btn-normal" style="padding:2px 5px"  ng-click="xgoproject('${p.data.project_no_enc}','${p.data.project_id}','goviewusersp')">                
                ${p.data.gos_cnt}
                </button>
                `)(s)[0]
            }
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        width: 90,
    })

    columndef.push({
        headerName: 'Production',
        field: 'clp_status',
        cellRenderer: function (p) {
            if (p.data.clp_status === "NO") {
                return '-'
            } else {
                return c(`
                <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" >                
                ${p.data.clp_cnt}
                </button>
                `)(s)[0]
            }
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        width: 90,
    })


    columndef.push({
        headerName: 'Hand Over',
        field: 'project_hadnover',
        cellRenderer: function (p) {
            let _status = "";
            if (p.data.project_hadnover === '1')
                _status = "Initial Handing Over";
            else if (p.data.project_hadnover === "2")
                _status = "Partial Handing Over";
            else if (p.data.project_hadnover === "3")
                _status = "Final Handing Over";
            else
                _status = "-";

            return `<div>${_status}</div>`
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        width: 90,

    })

    columndef.push({
        headerName: 'Hand Over Date',
        field: 'project_handover_date',
        cellRenderer: function (d) {
            return d.data.project_hadnover === '0' ? '-' : d.data.project_handover_date_d.display;
        },
        sortingOrder: ['asc', 'desc'],
        sort: 'desc',
        // sortIndex: 0,
        width: 150,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        width: 110,

    })
    return columndef
}