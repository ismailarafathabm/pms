export const mrgridview = (s, a, c) => {
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
        'cutting_cell_fok': p => (+p.data.balqty) === 0
    }
    xc.push({
        headerName: "View MR",
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
    if (a.edit) {
        xc.push({
            headerName: "Edit",
            cellRenderer: (p) => (+p.data.balqty) === 0 ? '-': c(`
                <div style="display:flex;gap:2px">
                  <button
                  class="ism-btns btn-normal"
                  style = "padding : 3px" 
                  type="button" ng-click="mrpedit('${p.data.mrid}')">
                  <i class="fa fa-edit"></i>
                  Edit
                  </button>              
                </div>
            `
            )(s)[0],
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 110,
            cellClassRules: celltheme

        })
        xc.push({
            headerName: "Receipt",
            cellRenderer: (p) => c(`
                <div style="display:flex;gap:2px" >
                  <button type="button"                
                  class="ism-btns btn-delete"
                  style = "padding : 3px" 
                  ng-click="mrpreceipts('${p.data.mrid}')">Receipt</button>              
                </div>
            `
            )(s)[0],
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 110,
            cellClassRules: celltheme
        })
    }
    xc.push({
        headerName: "Order No",
        field: "mrp_orderno",       
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Supplier",
        field: "mrp_supplier",       
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "MR Date",
        field: "mrdate",
        cellRenderer : (p) => p.data.mrdates.display,
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Date Conf",
        field: "mrp_okdate",
        cellRenderer : (p) => p.data.mrp_okdate_d.display,
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Project#",
        field: "project_no",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 80,
        cellClassRules: celltheme
        
    })
    xc.push({
        headerName: "Name",
        field: "project_name",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "MR#",
        field: "mrno",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Date",
        field: "mrdate",
        cellRenderer : (p) => p.data.mrdates.display,
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "System",
        field: "mrp_system",       
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "mritem",
        field: "mritem",       
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Part#",
        field: "mrpartno",       
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Die Weight",
        field: "mrdieweight",       
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Length",
        field: "mrreqlength",       
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Weight",
        field: "mraviweight",       
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Qty",
        field: "mrorderedqty",       
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Tot.Weight",
        field: "mrorderedweight",       
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })


    xc.push({
        headerName: "ETA",
        field: "mrp_eta",
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Ordered",
        field: "mrp_totorder",       
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Received",
        field: "rcqty",               
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Received Weight",
        field: "rcweight",       
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Balance",
        field: "balqty",       
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })
    xc.push({
        headerName: "Balance Weight",
        field: "balwt",       
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })

    xc.push({
        headerName: "Status",
        field: "status_mrp",       
        sortingOrder: ['asc', 'desc'],
        filter: 'agMultiColumnFilter',
        width: 150,
        cellClassRules: celltheme
    })

   
   
    return xc;
}