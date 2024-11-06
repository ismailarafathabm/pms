function getToday() {
    const _d = new Date();
    return `${_d.getDate()}-${_d.getMonth()+1}-${_d.getFullYear()}`
}
export const engrelease = {
    boqeng_id: '',
    boqeng_project_id : '',
    boqeng_projectno : '',
    boqeng_projectnoenc : '',
    boqeng_projectname : '',
    boqeng_projectlocation : '',
    boqeng_boqid : '',
    boqeng_qty : '',
    boqeng_area : '',
    boqeng_rdate : getToday(),
    boqeng_enggname : '',
    boqeng_cby : '',
    boqeng_eby : '',
    boqeng_cdate : '',
    boqeng_edate : '',
    boqeng_postflag : '',   
}

export const EngReleaseCols = (s, a, c) => {
    const xc = [];
    xc.push({
        width: 110,
        headerName: "BI.NO#",
        field: "poq_item_no",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    });
    xc.push({
        width: 200,
        headerName: "Description",
        field: "ptype_name",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    });
    xc.push({
        width: 240,
        headerName: "Remark",
        field: "poq_item_remark",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    });
    xc.push({
        width: 150,
        headerName: "Released By",
        field: "boqeng_enggname",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    });
    xc.push({
        width: 120,
        headerName: "Date",
        field: "boqeng_rdate",
        cellRenderer : (p) => p.data.boqeng_rdate_d.display,
        sortingOrder: ['asc', 'desc'],        
        filter: 'agDateColumnFilter',
        sort : 'desc',
        sortIndex : 0
    });
    xc.push({
        width: 100,
        headerName: "Qty",
        field: "boqeng_qty",
        cellRenderer : (p) => `${(+p.data.boqeng_qty).toLocaleString(undefined,{maximumFractionDigits:2})} ${p.data.unit_name}`,
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    });
   
    xc.push({
        width: 120,
        headerName: "Area",
        field: "boqeng_qty",
        cellRenderer : (p) => (+p.data.boqeng_area).toLocaleString(undefined,{maximumFractionDigits:2}),
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
    });
    return xc;
}