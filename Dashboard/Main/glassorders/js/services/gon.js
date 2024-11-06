import _ from './../../../masterlog/js/service/index.js';
export default class GONServices extends _{
    #page = "gon";
    async projectgon(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "getprojectgo", fd);
        return req;
    }

    async savegon(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "savegon", fd);
        return req;
    }

    async savegopn(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "savegopn", fd);
        return req;
    }

    async getprojectgop(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "getprojectgop", fd);
        return req;
    } 
    
    async savegoprc(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "savegoprc", fd);
        return req;
    }

    async getgopnrc(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "getgopnrc", fd);
        return req;
    }

    colsdef(s,c,a) {
        let xc = [];
        
        xc.push({
            headerName: "Edit",
            width: 80,
            fitler: false,
            sortingOrder: false,
            cellRenderer: (p) => c(`
                <button
                    type= "button" 
                    class = "ism-new-page-header-button normalbtn" 
                    ng-click = "editgo('${p.data.gonewid}')">                    
                    Edit
                </button>
            `)(s)[0]
        })       
        xc.push({
            headerName: "Glass Order No",
            field: 'gonorderno',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Done By",
            field: 'gondoneby',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Relesed to Purhcase",
            field: 'gonrelesetopurcahse',
            cellRenderer : (p) => p.data.gonrelesetopurcahse_d,  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Status",
            field: 'statustxt',
            cellRenderer: (p) => p.data.statustxt,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Received Form Purhcase",
            field: 'gonrecivedfrompurchase',
            cellRenderer: function(p) {
                return p.data.gostatus === '1' ? '' : p.data.gonrecivedfrompurchase_d;
            },  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Supplier",
            field: 'glasssuppliername',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Glass Type",
            field: 'gonglasstype',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })      

        xc.push({
            headerName: "Glass Specification",
            field: 'gonglassspc',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            
            width: 230
        })

        xc.push({
            headerName: "Marking Location",
            field: 'gonmakringlocation',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 190,
            
        })
       
        xc.push({
            headerName: "Qty",
            field: 'gonqty',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        xc.push({
            headerName: "Remark",
            field: 'gonremark',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        return xc;
    }

    colsgopn(s, c, a) {
        let xc = [];
        xc.push({
            headerName: "Recive",
            width: 80,
            fitler: false,
            sortingOrder: false,
            cellRenderer: (p) => c(`
                <button
                    type= "button" 
                    class = "ism-new-page-header-button normalbtn" 
                    ng-click = "receivego('${p.data.gonp_id}')">                    
                    Receive
                </button>
            `)(s)[0]
        })  

        xc.push({
            headerName: "",
            width: 80,
            fitler: false,
            sortingOrder: false,
            cellRenderer: (p) => {
                if ((+p.data.rcsqm) === 0) {
                    return '-';
                } else {
                    return c(`
                        <button
                            type= "button" 
                            class = "ism-new-page-header-button normalbtn" 
                            ng-click = "receivedlist('${p.data.gonp_id}')">                    
                            View
                        </button>
                    `)(s)[0]
                }
            }
        })
        xc.push({
            headerName: "Date",
            field: 'gonp_date',
            cellRenderer : (p) => p.data.gonp_date_d,  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120,
            
        })
        
        xc.push({
            headerName: "Type",
            field: 'gonp_type',
            cellRenderer : (p) => p.data.gonp_type,  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 90,
            cellStyle : {"text-align":"center",'color':"#019900"}
        })
        xc.push({
            headerName: "Order No",
            field: 'gonp_gorefno',
            cellRenderer : (p) => p.data.gonp_gorefno,  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180,
            cellStyle : {"text-align":"center",'color':"#e96300",'font-weight':'bold'}
        })
        xc.push({
            headerName: "Supplier",
            field: 'glasssuppliername',
            cellRenderer : (p) => p.data.glasssuppliername,  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180,
            cellStyle : {"text-align":"left",'color':"#0028f9"}
        })
        xc.push({
            headerName: "Cotings",
            field: 'gonp_gcotting',
            cellRenderer : (p) => p.data.gonp_gcotting,  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        
        xc.push({
            headerName: "Thickness",
            field: 'gonp_gthk',
            cellRenderer : (p) => p.data.gonp_gthk,  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 200
        })
        xc.push({
            headerName: "Out",
            field: 'gonp_gout',
            cellRenderer : (p) => p.data.gonp_gout,  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120
        })
        xc.push({
            headerName: "Inner",
            field: 'gonp_gin',
            cellRenderer : (p) => p.data.gonp_gin,  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120
        })
        xc.push({
            headerName: "QTY",
            field: 'gonp_qty',            
            cellRenderer : (p) => (+p.data.gonp_qty) === 0 ? '-' : (+p.data.gonp_qty).toLocaleString(undefined,{maximumFractionDigits:2}),  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 80,
            cellStyle : {"text-align":"center",'color':"#0028f9"}
        })
        xc.push({
            headerName: "Received",           
            field: "rcqty",            
            cellRenderer : (p) => (+p.data.rcqty) === 0 ? '-' : (+p.data.rcqty).toLocaleString(undefined,{maximumFractionDigits:2}),  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 80,
            cellStyle : {"text-align":"center",'color':"#008317",'font-weight':'bold'}
        })
        xc.push({
            headerName: "Balance",           
            field: "balanceqty",             
            //cellRenderer: (p) => (+p.data.balanceqty) === 0 ? '-' : (+p.data.balanceqty).toLocaleString(undefined, { maximumFractionDigits: 2 }),  
            cellRenderer: (p) => {
                if ((+p.data.balanceqty) >= 0) {
                    return `
                    <div style="display:flex;gap:4px;align-items:center;flex-direction: row-reverse;">
                    <div style="flex:1;color:#084920">${(+p.data.balanceqty).toLocaleString(
                        undefined,
                        {
                            maximumFractionDigits: 2
                        }
                    )}</div>
                    <div><img height='15px' src="${print_location}/assets/okarrow.png"></div>
                    </div>
                    `
                } else {
                    return `
                    <div style="display:flex;gap:4px;align-items:center;flex-direction: row-reverse;">
                    <div style="flex:1; font-weight: bold;
                    color: #f00;">${(+p.data.balanceqty).toLocaleString(
                        undefined,
                        {
                            maximumFractionDigits: 2
                        }
                    )}</div>
                    <div><img height='15px' src="${print_location}/assets/errorup.png"></div>
                    </div>
                    `
                }
            },
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 80,
            cellStyle : {"text-align":"center"}
        })
        xc.push({
            headerName: "Remark",
            field: 'gonp_remarks',
            cellRenderer : (p) => p.data.gonp_remarks,  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 220
        })

        xc.push({
            headerName: "Location",
            field: 'gonp_location',
            cellRenderer : (p) => p.data.gonp_location,  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 130
        })

        xc.push({
            headerName: "ETA",
            field: 'gonp_eta',
            cellRenderer : (p) => p.data.gonp_eta_d,  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120
        })

        xc.push({
            headerName: "SQM",
            field: 'gonp_area',
            cellRenderer: (p) => p.data.gonp_area,  
            cellRenderer : (p) => (+p.data.gonp_area) === 0 ? '-' : (+p.data.gonp_area).toLocaleString(undefined,{maximumFractionDigits:3}),  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 80,
            cellStyle : {"text-align":"center",'color':"#0028f9"}
        })
        xc.push({
            headerName: "Received",           
            field: 'rcsqm',
            cellRenderer: (p) => p.data.rcsqm,  
            cellRenderer : (p) => (+p.data.rcsqm) === 0 ? '-' : (+p.data.rcsqm).toLocaleString(undefined,{maximumFractionDigits:3}),  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 80,
            cellStyle : {"text-align":"center",'color':"#367300",'font-weight':'bold'}
        })
        xc.push({
            headerName: "Balance",           
            field: 'balancesqm',
            cellRenderer: (p) => {
                if ((+p.data.balancesqm) >= 0) {
                    return `
                    <div style="display:flex;gap:4px;align-items:center;flex-direction: row-reverse;">
                    <div style="flex:1;color:#084920">${(+p.data.balancesqm).toLocaleString(
                        undefined,
                        {
                            maximumFractionDigits: 2
                        }
                    )}</div>
                    <div><img height='15px' src="${print_location}/assets/okarrow.png"></div>
                    </div>
                    `
                } else {
                    return `
                    <div style="display:flex;gap:4px;align-items:center;flex-direction: row-reverse;">
                    <div style="flex:1; font-weight: bold;
                    color: #f00;">${(+p.data.balancesqm).toLocaleString(
                        undefined,
                        {
                            maximumFractionDigits: 2
                        }
                    )}</div>
                    <div><img height='15px' src="${print_location}/assets/errorup.png"></div>
                    </div>
                    `
                }
            },
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 80,
            cellStyle : {"text-align":"center",'color':"#0028f9"}
        })

        xc.push({
            headerName: "Price / Sqm",
            field: 'gonp_ppsqm',
            cellRenderer: (p) => p.data.gonp_ppsqm,  
            cellRenderer : (p) => (+p.data.gonp_ppsqm) === 0 ? '-' : (+p.data.gonp_ppsqm).toLocaleString(undefined,{maximumFractionDigits:2}),  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120,
            cellStyle : {"text-align":"right",'background':"#eef0ff"}
        })
        xc.push({
            headerName: "Total",
            field: 'gonp_pptotal',
            cellRenderer: (p) => p.data.gonp_pptotal,  
            cellRenderer : (p) => (+p.data.gonp_pptotal) === 0 ? '-' : (+p.data.gonp_pptotal).toLocaleString(undefined,{maximumFractionDigits:2}),  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120,
            cellStyle : {"text-align":"right",'background':"#defff2",'font-weight':'bold'}
        })
        xc.push({
            headerName: "Extra",
            field: 'gonp_ppextra',            
            cellRenderer : (p) => (+p.data.gonp_ppextra) === 0 ? '-' : (+p.data.gonp_ppextra).toLocaleString(undefined,{maximumFractionDigits:2}),  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120,
            cellStyle : {"text-align":"right",'background':"#ffe9e9"}
        })
        xc.push({
            headerName: "Final Price",
            field: 'finalprice',
            cellRenderer : (p) => (+p.data.finalprice) === 0 ? '-' : (+p.data.finalprice).toLocaleString(undefined,{maximumFractionDigits:2}),  
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120,
            cellStyle : {"text-align":"right",'background':"#e0fdff",'font-weight':'bold'}
        })
        return xc;
    }
}