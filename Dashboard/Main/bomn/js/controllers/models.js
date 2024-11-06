function getToday() {
    const _d = new Date();
    return `${_d.getDate()}-${_d.getMonth() - 1}-${_d.getFullYear()}`
}
export const newbom = {
    clientname: '',
    bom_id: '',
    bom_projectid: '',
    bom_projectno: '',
    bom_projectname: '',
    bom_boqid: '',
    bom_profileno: '',
    bom_description: '',
    bom_dieweight: '',
    bom_qrlenght: '',
    bom_qrbar: '',
    bom_qrtotweight: '',
    bom_avilength: '',
    bom_avaibar: '',
    bom_orderlength: '',
    bom_orderbar: '',
    bom_orderweight: '',
    bom_itemfinish: '',
    bom_remarks: '',
    bom_prefixno: '',
    bom_no: '',
    bom_cby: '',
    bom_eby: '',
    bom_cdate: '',
    bom_edate: '',
    bom_postflag: '0',
    bom_mflag: '0',
    bom_date: getToday(),
    bom_mdate: getToday(),
    bom_projectencno: '',
    bom_registerno: 'NAF-MS-F-001-00',
    bom_checkedby: 'Mr.JOHN LACRO',
    bom_makeby: '',
    alsowithlenght: true
};

export const cols = (s, c, a, rpmode = 'P') => {
    const xc = [];

    xc.push({
        headerName: '-',
        cellRenderer: (p) => c(`
            <button type="button" class="ism-btns btn-normal" style="padding:2px 2px" ng-click="print_bom('${p.data.bom_projectno}','${p.data.bom_no}')">            
            <i class='fa fa-print'></i>
            Print
            </button>`
        )(s)[0],
        width: 80
    })
    if (a.post) {
        
        xc.push({
            headerName: '-',
            cellRenderer: (p) => p.data.bom_postflag.toString() === "1" ? 
            c(`
            <button type="button" class="ism-btns btn-delete" style="padding:2px 2px" ng-click="bom_unpost('${p.data.bom_projectno}','${p.data.bom_no}')">            
            <i class='fa fa-times'></i>
            UN POST
            </button>`
            )(s)[0]
            : c(`
            <button type="button" class="ism-btns btn-normal" style="padding:2px 2px" ng-click="bom_post('${p.data.bom_projectno}','${p.data.bom_no}')">            
            <i class='fa fa-check'></i>
            POST
            </button>`
            )(s)[0],
            width: 110
        })
    }

    xc.push({
        headerName: 'POST?',
        field: 'bom_postflag_txt',
        width: 110,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    })
    if (rpmode === 'A') {
        xc.push({
            headerName: 'Project#',
            field: 'bom_projectno',
            width: 110,
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
        })
        xc.push({
            headerName: 'Project',
            field: 'bom_projectname',
            width: 180,
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
        })
    }
    xc.push({
        headerName: 'NO#',
        field: 'bomfno',
        width: 130,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    })
    xc.push({
        headerName: 'Date',
        field: 'bom_date',
        cellRenderer: function (params) {
            var dips = params.data.bom_date_s.normal;
            return `<div>${dips}</div>`
        },
        width: 120,
        sortingOrder: ['asc', 'desc'],
        headerClass: 'th-contractinfo',
        filter: 'agDateColumnFilter',
        sort: 'desc',
        sortIndex: 0
        
    })

    xc.push({
        headerName: 'Profile',
        field: 'bom_profileno',
        width: 110,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    })

    xc.push({
        headerName: 'Description',
        field: 'bom_description',
        width: 250,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    })

    xc.push({
        headerName: 'Die Weight',
        field: 'bom_dieweight',
        cellRenderer: (p) => (+p.data.bom_dieweight) === 0 ? '-' : (+p.data.bom_dieweight).toLocaleString(undefined, { maximumFractionDigits: 3 }),
        width: 70,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    })

    xc.push({
        headerName: 'Required lenght',
        field: 'bom_qrlenght',
        cellRenderer: (p) => (+p.data.bom_qrlenght) === 0 ? '-' : (+p.data.bom_qrlenght).toLocaleString(undefined, { maximumFractionDigits: 3 }),
        width: 70,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    })
    xc.push({
        headerName: 'Required Bar',
        field: 'bom_qrbar',
        cellRenderer: (p) => (+p.data.bom_qrbar) === 0 ? '-' : (+p.data.bom_qrbar).toLocaleString(undefined, { maximumFractionDigits: 3 }),
        width: 70,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    })
    xc.push({
        headerName: 'Avi Weight',
        field: 'bom_qrtotweight',
        cellRenderer: (p) => (+p.data.bom_qrtotweight) === 0 ? '-' : (+p.data.bom_qrtotweight).toLocaleString(undefined, { maximumFractionDigits: 3 }),
        width: 70,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    })
    xc.push({
        headerName: 'Avi Length',
        field: 'bom_avilength',
        cellRenderer: (p) => (+p.data.bom_avilength) === 0 ? '-' : (+p.data.bom_avilength).toLocaleString(undefined, { maximumFractionDigits: 3 }),
        width: 70,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    })

    xc.push({
        headerName: 'Avi Bar',
        field: 'bom_avaibar',
        cellRenderer: (p) => (+p.data.bom_avaibar) === 0 ? '-' : (+p.data.bom_avaibar).toLocaleString(undefined, { maximumFractionDigits: 3 }),
        width: 70,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    })

    xc.push({
        headerName: 'Order Length',
        field: 'bom_orderlength',
        cellRenderer: (p) => (+p.data.bom_orderlength) === 0 ? '-' : (+p.data.bom_orderlength).toLocaleString(undefined, { maximumFractionDigits: 3 }),
        width: 70,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    })

    xc.push({
        headerName: 'Order Bar',
        field: 'bom_orderbar',
        cellRenderer: (p) => (+p.data.bom_orderbar) === 0 ? '-' : (+p.data.bom_orderbar).toLocaleString(undefined, { maximumFractionDigits: 3 }),
        width: 70,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    })

    xc.push({
        headerName: 'Order Weight',
        field: 'bom_orderweight',
        cellRenderer: (p) => (+p.data.bom_orderweight) === 0 ? '-' : (+p.data.bom_orderweight).toLocaleString(undefined, { maximumFractionDigits: 3 }),
        width: 70,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    })

    xc.push({
        headerName: 'Finish',
        field: 'bom_itemfinish',
        width: 350,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    })

    xc.push({
        headerName: 'Remarks',
        field: 'bom_remarks',
        width: 450,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    })
    return xc;
}