const boqnotes = (x) => { return x ?? [] };

const boqdata = (x) => {
    return {
        poq_id: x?.poq_id ?? "",
        poq_item_no: x?.poq_item_no ?? "",
        poq_item_type: x?.poq_item_type ?? "",
        poq_item_remark: x?.poq_item_remark ?? "",
        poq_item_width: x?.poq_item_width ?? "",
        poq_item_height: x?.poq_item_height ?? "",
        poq_item_glass_spec: x?.poq_item_glass_spec ?? "",
        poq_item_glass_single: x?.poq_item_glass_single ?? "",
        poq_item_glass_double1: x?.poq_item_glass_double1 ?? "",
        poq_item_glass_double2: x?.poq_item_glass_double2 ?? "",
        poq_item_glass_double3: x?.poq_item_glass_double3 ?? "",
        poq_item_glass_laminate1: x?.poq_item_glass_laminate1 ?? "",
        poq_item_glass_laminate2: x?.poq_item_glass_laminate2 ?? "",
        poq_drawing: x?.poq_drawing ?? "",
        poq_finish: x?.poq_finish ?? "",
        poq_system_type: x?.poq_system_type ?? "",
        poq_qty: x?.poq_qty ?? "",
        poq_unit: x?.poq_unit ?? "",
        poq_uprice: x?.poq_uprice ?? "",
        poq_cby: x?.poq_cby ?? "",
        poq_eby: x?.poq_eby ?? "",
        poq_Cdate: x?.poq_Cdate ?? "",
        poq_Edate: x?.poq_Edate ?? "",
        poq_project_code: x?.poq_project_code ?? "",
        poq_status: x?.poq_status ?? "",
        unit_name: x?.unit_name ?? "",
        ptype_name: x?.ptype_name ?? "",
        system_type_name: x?.system_type_name ?? "",
        finish_name: x?.finish_name ?? "",
        tot: x?.tot ?? "",
        area: x?.area ?? "",
        item_aras: x?.item_aras ?? ""
    }
}

export const boqdata_dialog = (status, x = {}) => {
    return {
        isloading: status,
        data: boqdata(x.boq),
        notes: boqnotes(x.notes)
    }
}

export const _today = () => {
    const _data = new Date();
    const _d = _data.getDate();
    const _m = _data.getMonth();
    const _y = _data.getFullYear();
    return `${_d}-${_m}-${_y}`;
}

export const mrinputs = {
    mrid: "",
    mrproject: sessionStorage.getItem("nafco_project_current_sno"),
    mrcode: "NAF-MS-F-002-00",
    mrno: "",
    mrdate: _today(),
    mrdates: "",
    mritem: "",
    mrpartno: "",
    mrpartnotai: "",
    mrdieweight: "",
    mrreqlength: "",
    mrreqqty: "",
    mrreqtotweight: "",
    mrboqno: "",
    mrboqdescription: "",
    mravaiqty: "",
    mraviweight: "",
    mrorderedqty: "",
    mrorderedweight: "",
    mrcby: "",
    mreby: "",
    mrcdate: "",
    mredate: "",
    mrfinish: "",
    mrremarks: "",
    mrcheckedby: "VONN ALDANE",
    mrapprovedby: "JOHN",
    releaseddate: _today()
}

const QUANTITY_REQUIRED = (s, a, c) => {
    let xc = [];
    const celltheme = {
        'cutting_cell-red': p => p.data.mrflags === 'N',
        'cutting_cell-green': p => p.data.mrflags === 'P',
    }
    xc.push({
        headerName: "Lenght mm",
        field: "mrreqlength",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme,
        
    })
    xc.push({
        headerName: "Qty",
        field: "mrreqqty",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme,
    })
    
    xc.push({
        headerName: "Total WT(KG)",
        field: "mrreqtotweight",
        cellRenderer : (p) => (p.data.mrreqtotweight).toLocaleString(undefined,{maximumFractionDigits:2}),
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme,
    })
    return xc;
}

const STOCK_AVAILABLE = (s, a, c) => {
    const celltheme = {
        'cutting_cell-red': p => p.data.mrflags === 'N',
        'cutting_cell-green': p => p.data.mrflags === 'P',
    }
    let xc = [];
    xc.push({
        headerName: "Stock Qty",
        field: "mravaiqty",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: "Stock WT(KG)",
        field: "mraviweight",
        cellRenderer : (p) => (p.data.mraviweight).toLocaleString(undefined,{maximumFractionDigits:2}),
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme,
    })
    return xc;
}

const QTY_TO_BE_ORDERED = (s, a, c) => {
    const celltheme = {
        'cutting_cell-red': p => p.data.mrflags === 'N',
        'cutting_cell-green': p => p.data.mrflags === 'P',
    }
    let xc = [];
    xc.push({
        headerName: "Balance To Order",
        field: "mravaiqty",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: "Total WT(KG)",
        field: "mrorderedweight",
        cellRenderer : (p) => (p.data.mrorderedweight).toLocaleString(undefined,{maximumFractionDigits:2}),
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme,
    })
    return xc;
}

export const mr_gird_cols = (s, a, c) => {
    let xc = [];
    const celltheme = {
        'cutting_cell-red': p => p.data.mrflags === 'N',
        'cutting_cell-green': p => p.data.mrflags === 'P',
    }
    xc.push({
        headerName: "Print MR",
        cellRenderer: (p) => {
            return c(`
            <button type="button"
            class = "ism-btns btn-normal" 
            style = "padding : 3px" 
            ng-click="print_mr_click('${p.data.mrproject}','${p.data.mrcode}','${p.data.mrno}')"
            >            
            Print
            </button>
            `)(s)[0]
        },
        width : 80
    })
    
    xc.push({
        headerName: "Edit",
        cellRenderer: (p) => {
            return p.data.mrflags === 'N' ? c(`
            <button type="button"
            class = "ism-btns btn-normal" 
            style = "padding : 3px" 
            ng-click="edit_mr_click('${p.data.mrproject}','${p.data.mrcode}','${p.data.mrno}')"
            >            
            Edit
            </button>
            `)(s)[0] : c(`
            <button type="button"
            class = "ism-btns btn-normal" 
            style = "padding : 3px" 
            ng-click="edit_mr_click('${p.data.mrproject}','${p.data.mrcode}','${p.data.mrno}')"
            >            
            View
            </button>`)(s)[0];
        },
        width : 80
    })
    xc.push({
        headerName: "Mr NO",
        field: "mrno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 80,
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: "Item Description",
        field: "mritem",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 210,
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: "Part NO",
        field: "mrpartno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: "Part NO Taiseer",
        field: "mrpartnotai",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: "DIE W (KG/M)",
        field: "mrdieweight",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 75,
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: "QUANTITY REQUIRED",
        children : QUANTITY_REQUIRED(s,a,c)
    })
    xc.push({
        headerName: "Contract BOQ",
        field: "poq_item_no",
        cellRenderer: (p) => (+p.data.poq_item_no) === 0 ? '-' :
            c(
                `
                <div style="
                display: flex;
                justify-content: space-between;
                align-items: center;"
                >
                    <div>${p.data.poq_item_no}</div>
                    <div>
                    <i class='fa fa-info' ng-click="getboqinfo('${p.data.mrboqno}')"></i>
                    </div>
                </div>
                `                
            )(s)[0],
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: "Item Description",
        field: "poq_item_type",
        cellRenderer: (p) => p.data.poq_item_type,
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 250,
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: "QUANTITY REQUIRED",
        children : QUANTITY_REQUIRED(s,a,c)
    })
    xc.push({
        headerName: 'STOCK AVAILABLE',
        children : STOCK_AVAILABLE(s,a,c),
    })
    xc.push({
        headerName: 'QTY TO BE ORDERED',
        children : QTY_TO_BE_ORDERED(s,a,c),
    })
    xc.push({
        headerName: "Finish",
        field: "mrfinish",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 200,
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: "Remarks",
        field: "mrremarks",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme,
    })
    return xc;
}



export const mr_girdrpt_cols = (s, a, c) => {
    var filterParams = {
        comparator: function(filterLocalDateAtMidnight, cellValue) {
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
    };
    const celltheme = {
        'cutting_cell-red': p => p.data.mrflags === 'N',
        'cutting_cell-green': p => p.data.mrflags === 'P',
    }
    let xc = [];
    if (a.postaccess) {
        xc.push({
            headerName: "POST",              
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            cellRenderer: (p) => p.data.mrflags === 'N' ? c(`
            <button type="button" class="ism-btns btn-normal" style="padding:2px" ng-click="postmrgrid('${p.data.mrproject}','${p.data.mrno}')">
            POST
            </button>
            `)(s)[0] : '-',
            filterParams: filterParams,
            cellClassRules: celltheme,
            width: 80,
        })
    }
    xc.push({
        headerName: "Status",
        field: "mrflags",        
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        filterParams: filterParams,
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: "Date",
        field: "mrdate",
        cellRenderer : (p) => `<div>${p.data.mrdates.display}</div>`,
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        filterParams: filterParams,
        sort: 'desc',
        sortIndex: 0,
        cellClassRules: celltheme,
        

    })
    
    xc.push({
        headerName: "Contract NO#",
        field: "project_no",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        cellClassRules: celltheme,
        width: 80
    })
    xc.push({
        headerName: "Project",
        field: "project_name",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        cellClassRules: celltheme,
        width: 170
    })   
    xc.push({
        headerName: "Mr NO",
        field: "mrno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        cellClassRules: celltheme,
        width: 80
    })
    xc.push({
        headerName: "Item Description",
        field: "mritem",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        cellClassRules: celltheme,
        width: 210
    })
    xc.push({
        headerName: "Part NO",
        field: "mrpartno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        cellClassRules: celltheme,
        width: 100
    })
    xc.push({
        headerName: "Part NO Taiseer",
        field: "mrpartnotai",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        cellClassRules: celltheme,
        width: 100
    })
    xc.push({
        headerName: "DIE W (KG/M)",
        field: "mrdieweight",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        cellClassRules: celltheme,
        width: 75
    })
    xc.push({
        headerName: "QUANTITY REQUIRED",
        children: QUANTITY_REQUIRED(s, a, c),
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: "Contract BOQ",
        field: "poq_item_no",
        cellRenderer: (p) => (+p.data.poq_item_no) === 0 ? '-' :
            c(
                `
                <div style="
                display: flex;
                justify-content: space-between;
                align-items: center;"
                >
                    <div>${p.data.poq_item_no}</div>
                    <div>
                    <i class='fa fa-info' ng-click="getboqinfo('${p.data.mrboqno}')"></i>
                    </div>
                </div>
                `                
            )(s)[0],
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: "Item Description",
        field: "poq_item_type",
        cellRenderer: (p) => p.data.poq_item_type,
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 250,
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: "Prepare M.R",
        field: "preparedby",
        cellRenderer: (p) => p.data.preparedby.toUpperCase() === '' || p.data.preparedby.toUpperCase() === '-' ? 'JOHN' : p.data.preparedby.toUpperCase(),
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 250,
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: "QUANTITY REQUIRED",
        children: QUANTITY_REQUIRED(s, a, c),
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: 'STOCK AVAILABLE',
        children: STOCK_AVAILABLE(s, a, c),
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: 'QTY TO BE ORDERED',
        children: QTY_TO_BE_ORDERED(s, a, c),
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: "Finish",
        field: "mrfinish",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 200,
        cellClassRules: celltheme,
    })
    xc.push({
        headerName: "Remarks",
        field: "mrremarks",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme,
    })
    return xc;
}