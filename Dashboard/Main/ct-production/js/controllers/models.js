export const entry_grid = (s, c, a) => {
    const currentdate = new Date();
    const xc = [];
    xc.push({
        width: 80,
        headerName: "PJ#",
        field: "ct_id",
        sortingOrder: ['asc', 'desc'],
        sort: 'desc',
        sortIndex: 0,
        hide: true
    });
    xc.push({
        headerName: 'MO PDF',
        field : 'mofile_status',
        cellRenderer: (p) => {
            if (p.data.mofile.toString() === "0") {
                return '-'
            } else {
                return `
                <div style="margin-top: 3px;
                display: flex;
                gap: 8px;
                align-items: center;">
                <a href="${print_location}/assets/cuttinglists/mo/${p.data.mofilename}.pdf?version=${currentdate}" download="${p.data.ctprojectname} MO : ${p.data.ct_mono}.pdf" class="link">
                    <img src="${print_location}/assets/pdfdownload.png?v=2.4.1.4" style="width:15px;">
                </a>
                <a href="${print_location}/assets/cuttinglists/mo/${p.data.mofilename}.pdf?version=${currentdate}" target="_blank" class="link">
                    <i class='fa fa-eye'></i>
                </a>
                </div>
                `;
            }
        },
        width: 80,   
    })
    xc.push({
        headerName: 'CT PDF',
        field : 'ctfile_status',
        cellRenderer: (p) => {
            if (p.data.ctfile.toString() === "0") {
                return '-'
            } else {
                return `
                <div style="margin-top: 3px;
                display: flex;
                gap: 8px;
                align-items: center;">
                <a href="${print_location}/assets/cuttinglists/cuttinglist/${p.data.ctfilename}.pdf?version=${currentdate}" download="${p.data.ctprojectname}  CUtting List NO : ${p.data.ct_no} .pdf" class="link">
                    <img src="${print_location}/assets/pdfdownload.png?v=2.4.1.4" style="width:15px;">
                </a>
                <a href="${print_location}/assets/cuttinglists/cuttinglist/${p.data.ctfilename}.pdf?version=${currentdate}" target="_blank" class="link">
                    <i class='fa fa-eye'></i>
                </a>
                </div>
                `;
            }
        },
        width: 80,       
    })
    xc.push({
        headerName: "PJ#",
        field: "ctprojectno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
        cellStyle: {
            "color": "#ff0000",
            "font-weight": "bold"
        },       
        autoHeight: true,
        wrapText: true,
    })
    xc.push({
        headerName: "Name#",
        field: "ctprojectname",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 180,
        cellStyle: {
            "font-weight": "bold"
        },
       
        autoHeight: true,
        wrapText: true,
       
    })
    xc.push({
        headerName: "CL#",
        field: "ctno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 160,      
        cellStyle: (p) => {
            return {
                "color": "#ff0000",
                "font-weight": "bold"
            }
        },        
        checkboxSelection: true,
        pinned: 'left'
    })
    xc.push({
        headerName: "MO#",
        field: "ct_mono",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
    })
    xc.push({
        headerName: "Marking",
        field: "ct_marking",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,                
    })
    xc.push({
        headerName: "Description",
        field: "ct_description",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 250,
    })
    xc.push({
        headerName: "Location",
        field: "ct_location",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 250,        
    })
    xc.push({
        headerName: "Qty",
        field: "ct_qty",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 65,
        cellStyle: {
            "font-weight": "bold"
        },
    })

    xc.push({
        headerName: "Units",
        field: "ctunit",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 60,
       
    })

    xc.push({
        headerName: "Height",
        field: "ct_height",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
       
    })

    xc.push({
        headerName: "Width",
        field: "ct_width",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
       
    })

    xc.push({
        headerName: "Area",
        field: "ct_area",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
        
    })
    xc.push({
        headerName: "M.ST",
        field: "materialstatus",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        
    })

    xc.push({
        headerName: "M.REF#",
        field: "materialrefno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100, 
    })
    return xc;
}

export const production_grid = (s, c, a) => {
    const xc = [];
    const currentdate = new Date();
    
    xc.push({
        width: 80,
        headerName: "PJ#",
        field: "ct_id",
        sortingOrder: ['asc', 'desc'],
        sort: 'desc',   
    });
    xc.push({
        headerName: 'MO PDF',
        field : 'mofile_status',
        cellRenderer: (p) => {
            if (p.data.mofile.toString() === "0") {
                return '-'
            } else {
                return `
                <div style="margin-top: 3px;
                display: flex;
                gap: 8px;
                align-items: center;">
                <a href="${print_location}/assets/cuttinglists/mo/${p.data.mofilename}.pdf?version=${currentdate}" download="${p.data.ctprojectname} MO : ${p.data.ct_mono}.pdf" class="link">
                    <img src="${print_location}/assets/pdfdownload.png?v=2.4.1.4" style="width:15px;">
                </a>
                <a href="${print_location}/assets/cuttinglists/mo/${p.data.mofilename}.pdf?version=${currentdate}" target="_blank" class="link">
                    <i class='fa fa-eye'></i>
                </a>
                </div>
                `;
            }
        },
        width: 80,   
    })
    xc.push({
        headerName: 'CT PDF',
        field : 'ctfile_status',
        cellRenderer: (p) => {
            if (p.data.ctfile.toString() === "0") {
                return '-'
            } else {
                return `
                <div style="margin-top: 3px;
                display: flex;
                gap: 8px;
                align-items: center;">
                <a href="${print_location}/assets/cuttinglists/cuttinglist/${p.data.ctfilename}.pdf?version=${currentdate}" download="${p.data.ctprojectname}  CUtting List NO : ${p.data.ct_no} .pdf" class="link">
                    <img src="${print_location}/assets/pdfdownload.png?v=2.4.1.4" style="width:15px;">
                </a>
                <a href="${print_location}/assets/cuttinglists/cuttinglist/${p.data.ctfilename}.pdf?version=${currentdate}" target="_blank" class="link">
                    <i class='fa fa-eye'></i>
                </a>
                </div>
                `;
            }
        },
        width: 80,       
    })
    xc.push({
        headerName: "MO#",
        field: "ct_mono",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        pinned: 'left'
    })
    xc.push({
        headerName: "CL#",
        field: "ctno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 160,      
        cellStyle: (p) => {
            return {
                "color": "#ff0000",
                "font-weight": "bold"
            }
        },        
        checkboxSelection: true,
        pinned: 'left'
    })
    xc.push({
        headerName: "PJ#",
        field: "ctprojectno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
        cellStyle: {
            "color": "#ff0000",
            "font-weight": "bold"
        },       
        autoHeight: true,
        wrapText: true,
    })
    xc.push({
        headerName: "Name#",
        field: "ctprojectname",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 180,
        cellStyle: {
            "font-weight": "bold"
        },
       
        autoHeight: true,
        wrapText: true,
       
    })
    xc.push({
        headerName: "Trade",
        field: "cttrade",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,                
    })
    
    xc.push({
        headerName: "Location",
        field: "ct_location",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 170,                
    })
    xc.push({
        headerName: "Marking",
        field: "ct_marking",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,                
    })
    xc.push({
        headerName: "Description",
        field: "ct_description",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 250,
    })
   

    xc.push({
        headerName: "Units",
        field: "ctunit",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 60,
       
    })
    xc.push({
        headerName: "Qty",
        field: "ct_qty",
        cellRenderer : (p) => (+p.data.ct_qty) === 0 ? '-' : (+p.data.ct_qty).toLocaleString(undefined,{maximumFractionDigits:2}),
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 65,
        cellStyle: {
            "font-weight": "bold"
        },
    })
    xc.push({
        headerName: "Deliverd",
        field: "dis_qty",
        cellRenderer: (p) => (+p.data.dis_qty) === 0 ? '-' :
            c(`
                <button type="button" class="ism-btns btn-normal" style="padding:2px" ng-click="viewhistory('${p.data.ct_id}')">
                    ${(+p.data.dis_qty).toLocaleString(undefined, { maximumFractionDigits: 2 })}
                </button>`
            )(s)[0],
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 65,
        cellStyle: {
            "font-weight": "bold"
        },
    })
    xc.push({
        headerName: "Balance",
        field: "bal_qty",
        cellRenderer : (p) => (+p.data.bal_qty) === 0 ? '-' : (+p.data.bal_qty).toLocaleString(undefined,{maximumFractionDigits:2}),
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 65,
        cellStyle: {
            "font-weight": "bold",
            "color" : "red"
        },
    })
    xc.push({
        headerName: "Compleate %",
        field: "compleate_pres",
        cellRenderer : (p) => (+p.data.compleate_pres) === 0 ? '-' : `${(+p.data.compleate_pres).toLocaleString(undefined,{maximumFractionDigits:2})} %`,
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 65,
        cellStyle: {
            "font-weight": "bold"
        },
    })
    
    xc.push({
        headerName: "Section",
        field: "currentsection",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellStyle: {
            "font-weight": "bold"
        },
    })
    xc.push({
        headerName: "Material",
        field: "ctmaterialstatus",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 115,       
    })
    xc.push({
        headerName: "Status",
        field: "del_status",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellStyle: {
            "font-weight": "bold"
        },
    })

    xc.push({
        headerName: "Remark",
        field: "ctremarks",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 280,
        autoHeight: true,
        wrapText: true,
       
    })

    xc.push({
        headerName: "Delivery Shedule",
        field: "deliverysh",
        sortingOrder: ['asc', 'desc'],        
        width: 280,
        autoHeight: true,
        wrapText: true,
        filter: 'agDateColumnFilter',
        sort: 'desc',
    })
   
    return xc;
}

export const his_grid = (s, c, a) => {
    const currentdate = new Date();
    const xc = [];
    xc.push({
        headerName: 'FILE',
        field : 'delfile_status',
        cellRenderer: (p) => {
            if (p.data.del_isdelfile_pdf.toString() === "0") {
                return '-'
            } else {
                return `
                <div style="margin-top: 3px;
                display: flex;
                gap: 8px;
                align-items: center;">
                <a href="${print_location}/assets/prodcution/deliver/${p.data.deltoken}.pdf?version=${currentdate}" download="Delivery No_${p.data.outno}_CL#: ${p.data.ct_no} .pdf" class="link">
                    <img src="${print_location}/assets/pdfdownload.png?v=2.4.1.4" style="width:15px;">
                </a>
                <a href="${print_location}/assets/prodcution/deliver/${p.data.deltoken}.pdf?version=${currentdate}" target="_blank" class="link">
                    <i class='fa fa-eye'></i>
                </a>
                </div>
                `;
            }
        },
        width: 80,       
    })
    xc.push({
        headerName: "Date",
        field: "outdate",
        cellRenderer : (p) => p.data.outdate_d.display,
        sortingOrder: ['asc', 'desc'],
        filter: 'agDateColumnFilter',
        sort: 'desc',
        sortIndex: 0,
        width: 150,                
    })
    xc.push({
        width: 80,
        headerName: "PJ#",
        field: "ct_id",
        sortingOrder: ['asc', 'desc'],
      
        hide: true
    });
    xc.push({
        headerName: "Ref#",
        field: "outno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        
    })
    xc.push({
        headerName: "MO#",
        field: "ct_mono",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        
    })
    xc.push({
        headerName: "CL#",
        field: "ctno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 160,      
        cellStyle: (p) => {
            return {
                "color": "#ff0000",
                "font-weight": "bold"
            }
        },        
        
        
    })
    xc.push({
        headerName: "PJ#",
        field: "ctprojectno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
        cellStyle: {
            "color": "#ff0000",
            "font-weight": "bold"
        },       
        autoHeight: true,
        wrapText: true,
    })
    xc.push({
        headerName: "Name#",
        field: "ctprojectname",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 180,
        cellStyle: {
            "font-weight": "bold"
        },
       
        autoHeight: true,
        wrapText: true,
       
    })
    xc.push({
        headerName: "Trade",
        field: "cttrade",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,                
    })
    
    xc.push({
        headerName: "Location",
        field: "ct_location",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 170,                
    })
    xc.push({
        headerName: "Marking",
        field: "ct_marking",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,                
    })
    xc.push({
        headerName: "Description",
        field: "ct_description",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 250,
    })
   

    xc.push({
        headerName: "Units",
        field: "ctunit",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 60,
       
    })

    xc.push({
        headerName: "Qty",
        field: "outqty",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 65,
        cellStyle: {
            "font-weight": "bold"
        },
    })
    xc.push({
        headerName: "Area",
        field: "outarea",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 65,
        cellStyle: {
            "font-weight": "bold"
        },
    })
    return xc;;
}