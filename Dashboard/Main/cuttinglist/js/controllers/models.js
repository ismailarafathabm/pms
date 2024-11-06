//cutting list for ALi view
export const rptcols = (s, a, c) => {
    const currentdate = new Date();
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
        'cutting_cell-yellow': p => p.data.issupersede === '2',
        'cutting_cell-red': p => p.data.iscancelled === '2',
        'cutting_cell_production': p => (+p.data.production_flag) >= 2,
        'cutting_cell_fok': p => (+p.data.production_flag) === 3,
       
    }
    let xc = [];
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
        cellClassRules: celltheme
    })
    xc.push({
        headerName: 'MO PDF',
        cellRenderer: (p) => {
            return c(`<button class="ism-btns btn-normal" style="padding:2px 2px" ng-click="uploadmox('${p.data.ctprojectno}','${p.data.ct_mono}')"><i class="fa fa-file-pdf-o"></i></button>`)(s)[0]
        },
        width: 60,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: 'CT PDF',
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
        cellClassRules: celltheme
    })
    xc.push({
        headerName: 'Cuttinglist PDF',
        cellRenderer: (p) => {
            return (+p.data.production_flag) === 3 ? c(`<button class="ism-btns btn-normal" style="padding:2px 2px" ng-click="uploadcuttinglist('${p.data.ct_id}','${p.data.ctprojectno}','${p.data.ct_no}','${p.data.ct_mono}')"><i class="fa fa-file-pdf-o"></i></button>`)(s)[0] : '-';
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
                <button class="ism-btns btn-normal" type="button" style="padding:2px 2px" ng-click="editmode('${p.data.ct_id}')">
                    <i class="fa fa-edit"></i>
                </button>
                <button class="ism-btns btn-normal" type="button" style="padding:2px 2px" ng-click="superseedmode('${p.data.ct_id}')">
                    <i class="fa fa-upload"></i>
                </button>
            </div>
            `)(s)[0]
        },
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Department",
        field: "current_dep",
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
        field: "issuedate",
        filter: 'agDateColumnFilter',
        cellRenderer: (p) => {
            if (p.data.current_dep !== '-') {
                return (+p.data.current_status) >= 2 ? `<div>${p.data.issuedate_d.normal}</div>` : '-';
            } else {
                return '-'
            }
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
        field: "ctprojectno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
        cellStyle: {
            "color": "#ff0000",
            "font-weight": "bold"
        },
        cellClassRules: celltheme,
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
        cellClassRules: celltheme,
        autoHeight: true,
        wrapText: true,
        cellStyle: {
            "text-align": "justify",
            "line-height": "0.8rem"
        }
    })

    xc.push({
        headerName: "To ACC",
        field: "account_release",
        cellRenderer: (p) => {
            return (+p.data.account_flag) >= 2 ? p.data.account_release_l.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "From ACC",
        field: "account_return",
        cellRenderer: (p) => {
            return (+p.data.account_flag) === 3 ? p.data.account_return_l.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "ACC ST",
        field: "account_status",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        cellRenderer: (p) => {
            const csst = {
                '0': 'nacss',
                '1': 'direct_css',
                '2': 'fw_css',
                '3': 'rt_css'
            };
            const current_css = csst[p.data.account_flag.toString()];
            return c(`
                <div ng-click="changestatus(
                    'account_flag',
                    '${p.data.ct_id}',
                    '${p.data.ct_mono}',
                    '${p.data.account_flag.toString()}',
                    '${p.data.projectid}',
                    'Change Account Status',                    
                    '${p.data.account_release_l.normal}',
                    '${p.data.account_return_l.normal}'
                    )"  class="${current_css}" style="width:55px!important">
                ${p.data.account_status}
                </div>
            `)(s)[0]
        },
        width: 70,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "To Mat",
        field: "material_release",
        cellRenderer: (p) => {
            return (+p.data.matterial_flag) >= 2 ? p.data.material_release_l.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "F From Mat",
        field: "material_return",
        cellRenderer: (p) => {
            return (+p.data.matterial_flag) === 3 ? p.data.material_return_l.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Mat ST",
        field: "matterial_status",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 75,
        cellRenderer: (p) => {
            const csst = {
                '0': 'nacss',
                '1': 'direct_css',
                '2': 'fw_css',
                '3': 'rt_css'
            };
            const current_css = csst[p.data.matterial_flag.toString()];
            return c(`
                 <div ng-click="changestatus(
                     'matterial_flag',
                     '${p.data.ct_id}',
                     '${p.data.ct_mono}',
                     '${p.data.matterial_flag.toString()}',
                     '${p.data.projectid}',
                     'Change Material Status',                    
                     '${p.data.material_release_l.normal}',
                     '${p.data.material_return_l.normal}',
                     '${p.data.materialstatus}',
                     '${p.data.materialrefno}'
                     )" class="${current_css}" style="width:55px!important">
                 ${p.data.matterial_status}
                 </div>
             `)(s)[0]
        },
        cellClassRules: celltheme,

    })

    xc.push({
        headerName: "CL#",
        field: "ctno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 160,
        cellRenderer: (p) => {
            if (p.data.ctfile.toString() === '0') {
                return c(`
                    <div style="display: flex;gap: 5px;align-items: center;">
                        <div style="flex:4">${p.data.ctno}</div>
                        <div style="flex:1">
                            <button ng-disabled="isdeleting" class="ism-btns btn-delete" style="padding:2px" ng-click="removeData('${p.data.ct_id}')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    `)(s)[0]
                
            } else {
                return p.data.ctno
            }

        },
        cellStyle: (p) => {
            return {
                "color": "#ff0000",
                "font-weight": "bold"
            }
        },
        cellClassRules: celltheme,
        checkboxSelection: true,
        pinned: 'left'
    })

    xc.push({
        headerName: "MO#",
        field: "ct_mono",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        cellStyle: {
            "color": "#ff0000",
            "font-weight": "bold",
            "line-height": "0.8rem"
        },
        cellClassRules: celltheme,
        pinned: 'left'
    })

    xc.push({
        headerName: "Marking",
        field: "ct_marking",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellStyle: {
            "color": "#ff0000",
            "font-weight": "bold",
            "text-align": "center",
            "font-size": "0.7rem",
            "line-height": "0.8rem"
        },
        cellClassRules: celltheme,

    })

    xc.push({
        headerName: "Description",
        field: "ct_description",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 250,
        cellStyle: {
            "text-align": "justify",
            "font-size": "0.7rem",
            "line-height": "0.8rem"
        },
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Location",
        field: "ct_location",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 250,
        cellClassRules: celltheme,
        cellStyle: {
            "font-size": "0.7rem",
            "line-height": "0.8rem"
        },
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
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Units",
        field: "ctunit",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 60,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Height",
        field: "ct_height",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Width",
        field: "ct_width",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Area",
        field: "ct_area",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
        cellStyle: {
            "color": "#ff0000",
            "font-weight": "bold"
        },
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "GO#",
        field: "mgono",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Eng",
        field: "ct_doneby",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "M.ST",
        field: "materialstatus",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "M.REF#",
        field: "materialrefno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Section",
        field: "ct_section",
        cellRenderer: (p) => {
            const _f = {
                '-': '-',
                'F': 'Fabrication',
                'G': 'Cladding',
                'M': 'Machinery',
                'S': 'Steel Section'
            };
            return _f[p.data.ct_section]
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 110,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Sheet Type",
        field: "ct_mrefno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
        cellClassRules: celltheme
    })



    xc.push({
        headerName: "To Opr",
        field: "operation_release",
        cellRenderer: (p) => {
            return (+p.data.operation_flag) >= 2 ? p.data.operation_release_l.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "From Opr",
        field: "operation_return",
        cellRenderer: (p) => {
            return (+p.data.operation_flag) === 3 ? p.data.operation_return_l.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Opr ST",
        field: "operation_status",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 75,
        cellRenderer: (p) => {
            const csst = {
                '0': 'nacss',
                '1': 'direct_css',
                '2': 'fw_css',
                '3': 'rt_css'
            };
            const current_css = csst[p.data.operation_flag.toString()];
            return c(`
                 <div ng-click="changestatus(
                     'operation_flag',
                     '${p.data.ct_id}',
                     '${p.data.ct_mono}',
                     '${p.data.operation_flag.toString()}',
                     '${p.data.projectid}',
                     'Change Operation Status',                    
                     '${p.data.operation_release_l.normal}',
                     '${p.data.operation_return_l.normal}'                     
                     )" class="${current_css}" style="width:55px!important">
                 ${p.data.operation_status}
                 </div>
             `)(s)[0]
        },

        cellClassRules: celltheme
    })

    xc.push({
        headerName: "To Pro",
        field: "production_release",
        cellRenderer: (p) => {
            return (+p.data.production_flag) >= 2 ? p.data.production_release_l.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "From Pro",
        field: "production_accept",
        cellRenderer: (p) => {
            return (+p.data.production_flag) === 3 ? p.data.production_accept_l.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Pro ST",
        field: "production_status",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 70,
        cellRenderer: (p) => {
            const csst = {
                '0': 'danger_css',
                '1': 'danger_css',
                '2': 'danger_css',
                '3': 'rt_css'
            };
            const current_css = csst[p.data.production_flag.toString()];
            return c(`
                 <div ng-click="changestatus(
                     'production_flag',
                     '${p.data.ct_id}',
                     '${p.data.ct_mono}',
                     '${p.data.production_flag.toString()}',
                     '${p.data.projectid}',
                     'Change Productions Status',                    
                     '${p.data.production_release_l.normal}',
                     '${p.data.production_accept_l.normal}'                  
                     )" class="${current_css}" style="width:55px!important">
                 ${p.data.production_status}
                 </div>
             `)(s)[0]
        },
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Remarks",
        field: "ct_notes",
        cellRenderer: (p) => {
            //     'cutting_cell-yellow': p => p.data.issupersede === '2',
            // 'cutting_cell-red' : p => p.data.iscancelled === '2',
            if (p.data.issupersede === "2") {
                return p.data.supersededescription
            }
            else if (p.data.iscancelled === "2") {
                return p.data.cancelreson
            }
            else {
                return p.data.ct_notes
            }

        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        cellStyle: {
            "font-size": "0.7rem",
            "line-height": "0.8rem"
        },
        cellClassRules: celltheme
    })
    return xc;
}

//glass order for ali view
export const rptcolsgo = (s, a, c) => {
    const currentdate = new Date();
    const celltheme = {
        'x2': p => (+p.data.gostatus) === 3,
    }
    let xc = [];
    // xc.push({
    //     headerName: 'File',
    //     cellRenderer: (p) => {
    //         if (p.data.filestatus.toString() === "0") {
    //             return '-'
    //         } else {
    //             return `
    //             <a href="http://172.0.100.17:8082/PMS/assets/cuttinglists/go/${p.data.goid}.pdf" download="${p.data.goprojectname} - ${p.data.gotype_txt} GONO ${p.data.gono} # ${p.data.gorefno}.pdf" class="link">
    //                 <img src="http://172.0.0.1:8082/PMS/assets/pdfdownload.png?v=2.4.1.4" style="width:15px;">
    //             </a>
    //             `;
    //         }
    //     },
    //     width: 60,
    //     cellClassRules: celltheme
    // })
    // xc.push({
    //     headerName: 'Upload',
    //     cellRenderer: (p) => {
    //         return c(`<button class="ism-btns btn-normal" style="padding:2px 2px" ng-click="uploadpdfgox('${p.data.goid}')"><i class="fa fa-file-pdf-o"></i></button>`)(s)[0]
    //     },
    //     width: 60,
    //     cellClassRules: celltheme
    // })
    // xc.push({
    //     headerName: 'Edit',
    //     cellRenderer: (p) => {
    //         return c(`<button class="ism-btns btn-normal" style="padding:2px 2px" ng-click="editx('${p.data.goid}')"><i class="fa fa-edit"></i></button>`)(s)[0]
    //     },
    //     width: 80,
    //     cellClassRules: celltheme
    // })
    

    xc.push({
        headerName: "Project#",
        field: "goproject",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,       
        cellStyle: {
            'color': '#b51212',
            'font-weight' : 'bold'
        },
        cellClassRules: celltheme,        
    })
    xc.push({
        headerName: "Project Name",
        field: "goprojectname",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 220,     
        cellStyle: {
            'color': '#b51212',
            'font-weight' : 'bold'
        },
        cellClassRules: celltheme,      
    })

    xc.push({
        headerName: "Go#",
        field: "gonodisp",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 160,        
        cellStyle: {
            'color': '#b51212',
            'font-weight' : 'bold'
        },
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Supplier",
        field: "gosupplier",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 180,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "G.Type",
        field: "goglasstype",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 170,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "G.Spc",
        field: "goglassspec",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 220,
        cellClassRules: celltheme
    })

    
    xc.push({
        headerName: "Marking",
        field: "gomarking",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 220,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Qty",
        field: "goqty",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 60,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Area",
        field: "goarea",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 80,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Engg",
        field: "godoneby",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Remarks",
        field: "remarks",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 190,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "To PUR",
        field: "goprelease",
        cellRenderer: (p) => (+p.data.gopflag) >= 2 ? `<div>${p.data.goprelease_d.display}</div>` : '-',
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 110,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "From PUR",
        field: "gopreturn",
        cellRenderer: (p) => (+p.data.gopflag) === 3 ? `<div>${p.data.gopreturn_d.display}</div>` : '-',
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 110,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Type",
        field: "gotype_txt",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 92,        
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "G.Remark",
        field: "gootype_txt",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 60, 
        cellStyle: (p) => {
            if ((+p.data.gootype) === 1) {
                return {
                    'font-weight': "Bold",
                    'color' : 'green'
                }
            } else {
                return {
                    'font-weight': "Bold",
                    'color' : 'red'
                }
            }
        },
        cellClassRules: celltheme
    })
   
    
    xc.push({
        headerName: "Type",
        field: "rgono",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 92,        
        cellClassRules: celltheme
    })

    return xc;

}

//grid defalut options 
export function gridoptionsx(cols = [], filterParams = {}) {
    const currentdate = new Date();
    const _ = {
        suppressContextMenu: true,
        columnDefs: cols,

        enableCellChangeFlash: true,
        defaultColDef: {
            filter: true,
            floatingFilter: true,
            resizable: true,
            sortable: true,
            wrapText: true,
            autoHeight: true,
        },
        suppressMenuHide: true,
        colResizeDefault: 'shift',
        animateRows: true,
        excelStyles: [{
            id: 'dateType',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        },
        {
            id: 'dateTypes',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        },
        {
            id: 'dateType_green',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        }
        ],
        statusBar: {
            statusPanels: [{
                statusPanel: 'agFilteredRowCountComponent',
                align: 'left'
            },
            {
                statusPanel: 'agTotalAndFilteredRowCountComponent',
                align: 'left'
            },
            ],
        },
    }

    return _;
}


//cuttinglist grid columns configuration for user
export const rptcolsusers = (s, a, c) => {
    const today = new Date();
    const tomorrow = new Date(today.getTime() + 24 * 60 * 60 * 1000);
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
        'cutting_cell-yellow': p => p.data.issupersede === '2',
        'cutting_cell-red': p => p.data.iscancelled === '2',
    }
    let xc = [];
    xc.push({
        headerName: 'MO PDF',
        cellRenderer: (p) => {
            if (p.data.mofile.toString() === "0") {
                return '-'
            } else {
                return `
                <div style="margin-top: 3px;
                display: flex;
                gap: 8px;
                align-items: center;">
                <a href="${print_location}/assets/cuttinglists/mo/${p.data.mofilename}.pdf?version=${today}" download="${p.data.ctprojectname} MO : ${p.data.ct_mono}.pdf" class="link">
                    <img src="${print_location}/assets/pdfdownload.png?v=2.4.1.4" style="width:15px;">
                </a>
                <a href="${print_location}/assets/cuttinglists/mo/${p.data.mofilename}.pdf?version=${today}" target="_blank" class="link">
                    <i class='fa fa-eye'></i>
                </a>
                </div>
                `;
            }
        },
        width: 90,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: 'CL PDF',
        cellRenderer: (p) => {
            if (p.data.ctfile.toString() === "0") {
                return '-'
            } else {
                return `
                <div style="margin-top: 3px;
                display: flex;
                gap: 8px;
                align-items: center;">
                <a href="${print_location}/assets/cuttinglists/cuttinglist/${p.data.ctfilename}.pdf?version=${today}" download="${p.data.ctprojectname}  CUtting List NO : ${p.data.ct_no} .pdf" class="link">
                    <img src="${print_location}/assets/pdfdownload.png?v=2.4.1.4" style="width:15px;">
                </a>
                <a href="${print_location}/assets/cuttinglists/cuttinglist/${p.data.ctfilename}.pdf?version=${today}" target="_blank" class="link">
                    <i class='fa fa-eye'></i>
                </a>
                </div>
                `;
            }
        },
        width: 90,
        cellClassRules: celltheme
    })
   

    xc.push({
        headerName: "Entry Date",
        field: "ct_date",
        sortingOrder: ['asc', 'desc'],
        filter: 'agDateColumnFilter',
        width: 120,
        cellRenderer: (p) => p.data.ct_date_l.normal,
        cellClassRules: celltheme,
        filterParams: filterParams,
    })


    xc.push({
        headerName: "Department",
        field: "current_dep",
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
        field: "issuedate",
        filter: 'agDateColumnFilter',
        cellRenderer: (p) => {
            if (p.data.current_dep !== '-') {
                return (+p.data.current_status) >= 2 ? `<div>${p.data.issuedate_d.normal}</div>` : '-';
            } else {
                return '-'
            }
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
        headerName: "Project code",
        field: "ctprojectno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        cellStyle: {
            "color": "#ff0000",
            "font-weight": "bold"
        },
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Project Name",
        field: "ctprojectname",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 250,
        cellStyle: {
            "font-weight": "bold"
        },
        cellClassRules: celltheme,
        wrapText: true,
        autoHeight: true,
    })



    xc.push({
        headerName: "CL#",
        field: "ctno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        cellStyle: {
            "color": "#ff0000",
            "font-weight": "bold"
        },
        cellClassRules: celltheme,
        pinned: "left",
    })

    xc.push({
        headerName: "MO#",
        field: "ct_mono",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        cellStyle: {
            "color": "#ff0000",
            "font-weight": "bold"
        },
        cellClassRules: celltheme,
        pinned: "left",
    })

    xc.push({
        headerName: "Marking",
        field: "ct_marking",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellStyle: {
            "color": "#ff0000",
            "font-weight": "bold",
            "wordBreak": "normal",

        },
        cellClassRules: celltheme,

    })

    xc.push({
        headerName: "Description",
        field: "ct_description",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 250,
        cellClassRules: celltheme,
        cellStyle: {
            "wordBreak": "normal",
        },
    })

    xc.push({
        headerName: "Location",
        field: "ct_location",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 250,
        cellClassRules: celltheme
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
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Units",
        field: "ctunit",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 60,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Height",
        field: "ct_height",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Width",
        field: "ct_width",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Area",
        field: "ct_area",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
        cellStyle: {
            "color": "#ff0000",
            "font-weight": "bold"
        },
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "GO#",
        field: "mgono",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 110,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Done By",
        field: "ct_doneby",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })


    xc.push({
        headerName: "Remarks",
        field: "ct_notes",
        cellRenderer: (p) => {
            //     'cutting_cell-yellow': p => p.data.issupersede === '2',
            // 'cutting_cell-red' : p => p.data.iscancelled === '2',
            if (p.data.issupersede === "2") {
                return p.data.supersededescription
            }
            else if (p.data.iscancelled === "2") {
                return p.data.cancelreson
            }
            else {
                return '-'
            }

        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        cellClassRules: celltheme
    })
    return xc;
}


//detailed cuttinglist view for users
export const rptcolsusersdt = (s, a, c) => {
    const today = new Date();
    const celltheme = {
        'cutting_cell-yellow': p => p.data.issupersede === '2',
        'cutting_cell-red': p => p.data.iscancelled === '2',
        'cutting_cell_fok': p => p.data.ctfile === "1"
    }

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
    let xc = [];
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
        headerName: 'PDF',
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
        cellClassRules: celltheme
    })

    xc.push({
        headerName: 'CT PDF',
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
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Entry Date",
        field: "ct_date",
        sortingOrder: ['asc', 'desc'],
        filter: 'agDateColumnFilter',
        width: 120,
        cellRenderer: (p) => p.data.ct_date_l.normal,
        cellClassRules: celltheme,
        filterParams: filterParams,
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
        cellClassRules: celltheme,
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
        cellClassRules: celltheme,
        autoHeight: true,
        wrapText: true,
        cellStyle: {
            "text-align": "justify",
            "line-height": "0.8rem"
        }
    })

    xc.push({
        headerName: "To ACC",
        field: "account_release",
        cellRenderer: (p) => {
            return (+p.data.account_flag) >= 2 ? p.data.account_release_l.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
    })
    xc.push({
        headerName: "From ACC",
        field: "account_return",
        cellRenderer: (p) => {
            return (+p.data.account_flag) === 3 ? p.data.account_return_l.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
    })
    xc.push({
        headerName: "ACC ST",
        field: "account_status",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        cellRenderer: (p) => {
            return p.data.account_status;
        },
        width: 70,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "To Mat",
        field: "material_release",
        cellRenderer: (p) => {
            return (+p.data.matterial_flag) >= 2 ? p.data.material_release_l.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
    })
    xc.push({
        headerName: "From Mat",
        field: "material_return",
        cellRenderer: (p) => {
            return (+p.data.matterial_flag) === 3 ? p.data.material_return_l.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
    })

    xc.push({
        headerName: "Mat ST",
        field: "matterial_status",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 75,
        cellRenderer: (p) => {
            return p.data.matterial_status
        },
        cellClassRules: celltheme,

    })

    xc.push({
        headerName: "CL#",
        field: "ctno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 130,
        cellStyle: (p) => {
            return {
                "color": "#ff0000",
                "font-weight": "bold"
            }
        },
        cellClassRules: celltheme,
        pinned: 'left'
    })

    xc.push({
        headerName: "MO#",
        field: "ct_mono",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        cellStyle: {
            "color": "#ff0000",
            "font-weight": "bold",
            "line-height": "0.8rem"
        },
        cellClassRules: celltheme,
        pinned: 'left'
    })

    xc.push({
        headerName: "Marking",
        field: "ct_marking",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellStyle: {
            "color": "#ff0000",
            "font-weight": "bold",
            "text-align": "center",
            "font-size": "0.7rem",
            "line-height": "0.8rem"
        },
        cellClassRules: celltheme,

    })

    xc.push({
        headerName: "Description",
        field: "ct_description",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 250,
        cellStyle: {
            "text-align": "justify",
            "font-size": "0.7rem",
            "line-height": "0.8rem"
        },
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Location",
        field: "ct_location",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 250,
        cellClassRules: celltheme,
        cellStyle: {
            "font-size": "0.7rem",
            "line-height": "0.8rem"
        },
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
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Units",
        field: "ctunit",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 60,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Height",
        field: "ct_height",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Width",
        field: "ct_width",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Area",
        field: "ct_area",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
        cellStyle: {
            "color": "#ff0000",
            "font-weight": "bold"
        },
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "GO#",
        field: "mgono",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Eng",
        field: "ct_doneby",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "M.ST",
        field: "materialstatus",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "M.REF#",
        field: "materialrefno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 100,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Section",
        field: "ct_section",
        cellRenderer: (p) => {
            const _f = {
                '-': '-',
                'F': 'Fabrication',
                'G': 'Cladding',
                'M': 'Machinery',
                'S': 'Steel Section'
            };
            return _f[p.data.ct_section]
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 110,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Sheet Type",
        field: "ct_mrefno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 90,
        cellClassRules: celltheme
    })



    xc.push({
        headerName: "To Opr",
        field: "operation_release",
        cellRenderer: (p) => {
            return (+p.data.operation_flag) >= 2 ? p.data.operation_release_l.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
    })
    xc.push({
        headerName: "From Opr",
        field: "operation_return",
        cellRenderer: (p) => {
            return (+p.data.operation_flag) === 3 ? p.data.operation_return_l.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
    })
    xc.push({
        headerName: "Opr ST",
        field: "operation_status",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 75,
        cellRenderer: (p) => {
            return p.data.operation_status;
        },

        cellClassRules: celltheme
    })

    xc.push({
        headerName: "To Pro",
        field: "production_release",
        cellRenderer: (p) => {
            return (+p.data.production_flag) >= 2 ? p.data.production_release_l.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
    })
    xc.push({
        headerName: "From Pro",
        field: "production_accept",
        cellRenderer: (p) => {
            return (+p.data.production_flag) === 3 ? p.data.production_accept_l.print : '-'
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 85,
        cellClassRules: celltheme,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
    })
    xc.push({
        headerName: "Pro ST",
        field: "production_status",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 70,
        cellRenderer: (p) => {
            return p.data.production_status;
        },
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Remarks",
        field: "ct_notes",
        cellRenderer: (p) => {
            //     'cutting_cell-yellow': p => p.data.issupersede === '2',
            // 'cutting_cell-red' : p => p.data.iscancelled === '2',
            if (p.data.issupersede === "2") {
                return p.data.supersededescription
            }
            else if (p.data.iscancelled === "2") {
                return p.data.cancelreson
            }
            else {
                return p.data.ct_notes
            }

        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 120,
        cellStyle: {
            "font-size": "0.7rem",
            "line-height": "0.8rem"
        },
        cellClassRules: celltheme
    })
    return xc;
}