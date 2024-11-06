import _ from './../../../masterlog/js/service/index.js';
export default class POService extends _ {
    #page = "budget";
    async materialtype(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "materialtype", fd);
        return req;
    }

    async pomaterialtypes(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "pomaterialtypes", fd);
        return req;
    }
    
    async savepo(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, "savepo", fd);
        return req;
    }

    async pos(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, 'pos', fd);
        return res;
    }
    async searchpo(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, 'searchpo', fd);
        return res;
    }
    async savepob(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, 'savepob', fd);
        return res;
    }
    async pobprintinfo(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, 'pobprintinfo', fd);
        return res;
    }

    async pobs(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, 'pobs', fd);
        return res;
    }

    async refnos(fd = this.FormData()) {
        const res = await this.servicecall(this.#page, 'refnos', fd);
        return res;
    }

    async ponewsave(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, 'ponewsave', fd);
        return req;
    }

    async ponewinfo(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, 'ponewinfo', fd);
        return req;
    }

    async ponview(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, 'ponview', fd);
        return req;
    }
    
    async newadvice(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, 'newadvice', fd);
        return req;
    }
    async padvice(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, 'padvice', fd);
        return req;
    }

    async getadvice(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, 'getadvice', fd);
        return req;
    }

    async budgetsummary(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, 'budgetsummary', fd);
        return req;
    }

    
    async porpt(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, 'porpt', fd);
        return req;
    }

    async projectbudgetsummary(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, 'projectbudgetsummary', fd);
        return req;
    }

    async posummary(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, 'posummaryallproject', fd);
        return req;
    }

    async posummarybysupplier(fd = this.FormData()) {
        const req = await this.servicecall(this.#page, 'posummarybysupplier', fd);
        return req;
    }
    
    pocols(s,c,a) {
        let xc = [];
        xc.push({
            headerName: "Print",
            cellRenderer: (p) => c(`<button
            type = "button" 
            class = "ism-new-page-header-button normalbtn" 
            ng-click = "print_data('${p.data.poid}')" 
            >
            <i class = "fa fa-print"></i>
            </button>`)(s)[0],
            width : 75,
        })
        xc.push({
            headerName: "Ref NO",
            field: 'porefno',
            cellRenderer : (p) => p.data.porefno,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Date",
            field: 'podate',
            cellRenderer : (p) => p.data.podate_d,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Material Type",
            field: 'itemtype',
            cellRenderer : (p) => p.data.itemtype,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Supplier",
            field: 'posupplier',
            cellRenderer : (p) => p.data.posupplier,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Address",
            field: 'posupplieraddress',
            cellRenderer : (p) => p.data.posupplieraddress,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Address",
            field: 'posupplieraddress',
            cellRenderer : (p) => p.data.posupplieraddress,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Qty",
            field: 'poqty',
            cellRenderer : (p) => p.data.poqty,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Area",
            field: 'poarea',
            cellRenderer : (p) => p.data.poarea,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Unit Price",
            field: 'pounitprice',
            cellRenderer : (p) => p.data.pounitprice,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Value",
            field: 'povalue',
            cellRenderer : (p) => p.data.povalue,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        return xc;
    }


    pobcols(s,c,a) {
        let xc = [];
        xc.push({
            headerName: "Print",
            cellRenderer: (p) => c(`<button
            type = "button" 
            class = "ism-new-page-header-button normalbtn" 
            ng-click = "print_data('${p.data.pobproject}','${p.data.pobporefno}','${p.data.pobprefno}')" 
            >
            <i class = "fa fa-print"></i>
            </button>`)(s)[0],
            width : 75,
        })
        xc.push({
            headerName: "Ref NO",
            field: 'pobprefno',
            cellRenderer : (p) => p.data.pobprefno,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Date",
            field: 'pobdate',
            cellRenderer : (p) => p.data.pobdate_d,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Order Type",
            field: 'pobtype',
            cellRenderer : (p) => p.data.pobtype,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Material Type",
            field: 'itemtype',
            cellRenderer : (p) => p.data.itemtype,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Po#Ref NO",
            field: 'porefno',
            cellRenderer : (p) => p.data.porefno,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "PO#Date",
            field: 'podate',
            cellRenderer : (p) => p.data.podate_d,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Supplier",
            field: 'posupplier',
            cellRenderer : (p) => p.data.posupplier,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Address",
            field: 'posupplieraddress',
            cellRenderer : (p) => p.data.posupplieraddress,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })      
        xc.push({
            headerName: "Area",
            field: 'pobqty',
            cellRenderer : (p) => p.data.pobqty,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })               
        xc.push({
            headerName: "Budget Value",
            field: 'pobtotbudget',
            cellRenderer : (p) => p.data.pobtotbudget,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Previous Value",
            field: 'pobprvalue',
            cellRenderer : (p) => p.data.pobprvalue,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Value",
            field: 'pobcvalue',
            cellRenderer : (p) => p.data.pobcvalue,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Balance Availabe Budget",
            field: 'pobavailablebudget',
            cellRenderer : (p) => p.data.pobavailablebudget,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        return xc;
    }

    ponewcols(s, c, a) {
        let xc = [];
        xc.push({
            cellRenderer: (p) => {
                return c(`<button 
                type="button"
                class = "ism-new-page-header-button normalbtn" 
                ng-click="printpo('${p.data.ponewid}')">
                    <i class="fa fa-print"></i>
                </button>`)(s)[0]
            },
            width:60
        })
        // xc.push({
        //     headerName : "Make Finance Advice",
        //     cellRenderer: (p) => {
        //         return c(`<button 
        //         type="button"
        //         class = "ism-new-page-header-button normalbtn" 
        //         ng-click="mkfin('${p.data.ponewid}')">
        //             <i class="fa fa-usd"></i>
        //             Print
        //         </button>`)(s)[0]
        //     },
        //     width:120
        // })
        xc.push({
            headerName: "Ref.No #",
            field: 'ponewrefno',
            cellRenderer : (p) => p.data.ponewrefno,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 220
        })
        xc.push({
            headerName: "Date",
            field: 'ponewdate',
            cellRenderer : (p) => p.data.ponewdate_d,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120
        })
        xc.push({
            headerName: "Supplier",
            field: 'glasssuppliername',
            cellRenderer : (p) => p.data.glasssuppliername.toUpperCase(),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 250
        })
        xc.push({
            headerName: "Mateiral Type",
            field: 'ponewtype',
            cellRenderer : (p) => p.data.ponewtype,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Total Qty",
            field: 'qty',
            cellRenderer : (p) => (+p.data.qty) === 0 ? '-' : (+p.data.qty).toLocaleString(),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Total Tonnage",
            field: 'wght',
            cellRenderer : (p) => (+p.data.wght) === 0 ? '-' : ((+p.data.wght).toFixed(3)).toLocaleString(),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Total Area",
            field: 'area',
            cellRenderer : (p) => (+p.data.area) === 0 ? '-' : ((+p.data.area).toFixed(3)).toLocaleString(),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Sub Total",
            field: 'totalprice',
            cellRenderer : (p) => (+p.data.totalprice) === 0 ? '-' : ((+p.data.totalprice).toFixed(2)).toLocaleString(2),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "VAT",
            field: 'ponewvat',
            cellRenderer: (p) => {
                if ((+p.data.ponewvat) !== 0) {
                    let _subtot = p.data.totalprice;
                    let _vat = p.data.ponewvat;
                    let _vatval = (+_subtot) * (+_vat) / 100;
                    //return `${(+(_vatval).toFixed(2)).toLocaleString()} (${p.data.ponewvat}%)`;
                    return `${(+(_vatval).toFixed(2)).toLocaleString()}`;
                } else {
                    return '0';
                }
            },
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Total Amount",
            field: 'ponewtotval',
            cellRenderer : (p) => (+p.data.ponewtotval) === 0 ? '-' : ((+p.data.ponewtotval).toFixed(2)).toLocaleString(2),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        return xc;
    }

    advicecols(s, c, a) {
        let xc = [];
        xc.push({
            headerName: "Print",            
            cellRenderer: (p) => c(`
            <button 
                class = "ism-new-page-header-button normalbtn" 
                type="button"
                ng-click="printadivcef('${p.data.padvanceid}','${p.data.ponewid}')"
                >
                <i class = "fa fa-print"></i>                
            </button>
            `)(s)[0],
            sortingOrder: false,
            filter: 'agMultiColumnFilter',
            width:60
        })
        xc.push({
            headerName: "Ref No",
            field: 'padvancesno',
            cellRenderer : (p) => p.data.padvancesno,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 210
        })
        xc.push({
            headerName: "Date",
            field: 'padvancedate',
            cellRenderer : (p) => p.data.padvancedate_d,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120
        })
        xc.push({
            headerName: "PO # Ref No",
            field: 'ponewrefno',
            cellRenderer : (p) => p.data.ponewrefno,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 210
        })
        xc.push({
            headerName: "Supplier",
            field: 'glasssuppliername',
            cellRenderer : (p) => p.data.glasssuppliername.toUpperCase(),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 240
        })
        xc.push({
            headerName: "From",
            field: 'ponewfrom',
            cellRenderer : (p) => p.data.ponewfrom,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 210
        })
        xc.push({
            headerName: "TO",
            field: 'padviceto',
            cellRenderer : (p) => p.data.padviceto,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 210
        })
        xc.push({
            headerName: "Amount",
            field: 'paymentamount',
            cellRenderer : (p) => p.data.paymentamount,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120
        })
        xc.push({
            headerName: "Payment Description",
            field: 'padvancesno',
            cellRenderer : (p) => p.data.padvicetypedescription,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            flex: 1,
            autoHeight: true,
            
        })
        xc.push({
            headerName: "Currency Type",
            field: 'paymentcountry',
            cellRenderer : (p) => p.data.paymentcountry,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })
        xc.push({
            headerName: "Ref No",
            field: 'Note',
            cellRenderer : (p) => p.data.paymentnotes,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 180
        })

        return xc;
    }
    #budgetall(s, c, a) {
        let xc = [];
        xc.push({
            headerName: "Total Budget",
            field: 'totbudget',
            cellRenderer: (p) => {
                return (+p.data.totbudget) === 0 ? 
                    '-' :
                    (+p.data.totbudget).toLocaleString(
                        undefined,
                        {
                            maximumFractionDigits:2
                        }
                    )
            },
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120,
            cellStyle: {                
                "text-align": "right",
                "font-weight": "bold",
                "color" : "#970023"
            },

            cellClass: 'th-fullbudget',
            headerClass: 'th-fullbudget',
            
        })

        xc.push({
            headerName: "Total PO",
            field: 'poamount',
            cellRenderer: (p) => {
                return (+p.data.poamount) === 0 ? 
                    '-' :
                    (+p.data.poamount).toLocaleString(
                        undefined,
                        {
                            maximumFractionDigits:2
                        }
                    )
            },
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120,
            cellStyle: {                
                "text-align": "right",
                "font-weight": "bold",
                "color" : "#48005a"
            },
            cellClass: 'th-fullbudget',
            headerClass: 'th-fullbudget',
        })

        xc.push({
            headerName: "Balance Budget",
            field: 'balancebudget',
            cellRenderer: (p) => {
                return (+p.data.balancebudget) === 0 ?
                    '-' :
                    (+p.data.balancebudget).toLocaleString(
                        undefined,
                        {
                            maximumFractionDigits: 2
                        }
                    )
            },
            cellRenderer: (p) => {
                if ((+p.data.balancebudget) >= 0) {
                    return `
                    <div style="display:flex;gap:4px;align-items:center;flex-direction: row-reverse;width:150px">
                    <div style="flex:1;color:#084920">${(+p.data.balancebudget).toLocaleString(
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
                    <div style="display:flex;gap:4px;align-items:center;flex-direction: row-reverse;width:150px" ng-click="getpurchase('${p.data.type}')">
                    <div style="flex:1; font-weight: bold;
                    color: #f00;">${(+p.data.balancebudget).toLocaleString(
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
            width: 180,
            cellStyle: {
                'display': "flex",
                "flex-direction": "row",
                "align-items": "center",
                "text-align": "right",
                "font-weight": "bold",
                "color": "#11341e",
                "border-right" : "1px solid #000 !important"
            },
            cellClass: 'th-fullbudget',
            headerClass: 'th-fullbudget',
        });
        return xc;
    }
    #summarybudgetmaterials(s, c, a) {
        let xc = [];
        xc.push({
            headerName: "Material Budget",
            field: 'materialtotal',
            cellRenderer: (p) => {
                return (+p.data.materialtotal) === 0 ?
                    '-' :
                    (+p.data.materialtotal).toLocaleString(
                        undefined,
                        {
                            maximumFractionDigits: 2
                        }
                    );
            },
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120,
            cellStyle: {                
                "text-align": "right",
                "font-weight": "bold",
                "color" : "#002bff"
            },
            cellClass: 'th-material',
            headerClass: 'th-material',
        })

        xc.push({
            headerName: "Material PO",
            field: 'pomtotal',
            cellRenderer: (p) => {
                return (+p.data.pomtotal) === 0 ? 
                    '-' :
                    (+p.data.pomtotal).toLocaleString(
                        undefined,
                        {
                            maximumFractionDigits:2
                        }
                    )
            },
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120,
            cellStyle: {                
                "text-align": "right",  
               
            },
            cellClass: 'th-material',
            headerClass: 'th-material',
        })

        xc.push({
            headerName: "Material Balance",
            field: 'mbalance',
            cellRenderer: (p) => {
                return (+p.data.mbalance) === 0 ?
                    '-' :
                    (+p.data.mbalance).toLocaleString(
                        undefined,
                        {
                            maximumFractionDigits: 2
                        }
                    )
            },
            cellRenderer: (p) => {
                if ((+p.data.mbalance) >= 0) {
                    return `
                    <div style="display:flex;gap:4px;align-items:center;flex-direction: row-reverse;width:150px">
                    <div style="flex:1;color:#084920">${(+p.data.mbalance).toLocaleString(
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
                    <div style="display:flex;gap:4px;align-items:center;flex-direction: row-reverse;width:150px" ng-click="getpurchase('${p.data.type}')">
                    <div style="flex:1; font-weight: bold;
                    color: #f00;">${(+p.data.mbalance).toLocaleString(
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
            width: 180,
            cellStyle: {
                'display': "flex",
                "flex-direction": "row",
                "align-items": "center",
                "text-align": "right",
                "font-weight": "bold",
                "color": "#11341e",
                "border-right" : "1px solid #000 !important"
            },
            cellClass: 'th-material',
            headerClass: 'th-material',
        });

        return xc;
    }

    #summarybudgetGlass(s, c, a) {
        let xc = [];
        xc.push({
            headerName: "Glass Budget",
            field: 'gtot',           
            cellRenderer: (p) => {
                return (+p.data.gtot) === 0 ?
                    '-'
                    :
                    (+p.data.gtot).toLocaleString(
                        undefined,
                        {
                            maximumFractionDigits: 2
                        }
                    );
            },
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120,
            cellStyle: {                
                "text-align": "right",
                "font-weight": "bold",
                "color" : "#1c5047"
            },
            cellClass: 'th-glass',
            headerClass: 'th-glass',
        })

        xc.push({
            headerName: "Glass PO",
            field: 'pogtotal',
            cellRenderer: (p) => {
                return (+p.data.pogtotal) === 0 ? 
                    '-' :
                    (+p.data.pogtotal).toLocaleString(
                        undefined,
                        {
                            maximumFractionDigits:2
                        }
                    )
            },
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120,
            cellStyle: {                
                "text-align": "right",                     
            },
            cellClass: 'th-glass',
            headerClass: 'th-glass',
        })

        xc.push({
            headerName: "Glass Balance",
            field: 'gbalance',
            cellRenderer: (p) => {
                return (+p.data.gbalance) === 0 ?
                    '-' :
                    (+p.data.gbalance).toLocaleString(
                        undefined,
                        {
                            maximumFractionDigits: 2
                        }
                    )
            },
            cellRenderer: (p) => {
                if ((+p.data.gbalance) >= 0) {
                    return `
                    <div style="display:flex;gap:4px;align-items:center;flex-direction: row-reverse;width:150px">
                    <div style="flex:1;color:#084920">${(+p.data.gbalance).toLocaleString(
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
                    <div style="display:flex;gap:4px;align-items:center;flex-direction: row-reverse;width:150px" ng-click="getpurchase('${p.data.type}')">
                    <div style="flex:1; font-weight: bold;
                    color: #f00;">${(+p.data.gbalance).toLocaleString(
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
            width: 180,
            cellStyle: {
                'display': "flex",
                "flex-direction": "row",
                "align-items": "center",
                "text-align": "right",
                "font-weight": "bold",
                "color": "#11341e",
                "border-right" : "1px solid #000 !important"
            },
            cellClass: 'th-glass',
            headerClass: 'th-glass',
        });
        return xc;
    }
    budgetsummarycols(s, c, a) {
        let xc = []
        xc.push({
            headerName: "Project No",
            field: 'project_no',
            cellRenderer: (p) => {
                return `<button type="button" class="ism-btns btn-normal" onclick="goprojectbudget('${p.data.project_no_enc}','${p.data.project_id}')" style="padding:2px;border-radius:2px">
                ${p.data.project_no}
                </button>`
            },
            // cellRenderer: (p) => c(
            //     `<div ng-click="goprojectbudget('${p.data.project_no_enc}','${p.data.project_id}',)">                
            //     ${p.data.project_no}
            //     </div>`
              
            // )(s)[0],
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 80
        })
        xc.push({
            headerName: "Project Name",
            field: 'project_name',
            cellRenderer : (p) => p.data.project_name,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 380
        })

        xc.push({
            headerName: "Total Budget",
            children: this.#budgetall(s, c, a),
            headerClass: 'th-fullbudget',
            
        })

        xc.push({
            headerName: "Materials Summary",
            children: this.#summarybudgetmaterials(s, c, a),
            headerClass: 'th-material',
        })

        xc.push({
            headerName: "Glass Summary",
            children: this.#summarybudgetGlass(s, c, a),            
            headerClass: 'th-glass',
        })
        return xc;
    }

    colsporpt(s, c, a) {
        let xc = [];
        xc.push({
            headerName: "Project NO",
            field: 'project_no',
            cellRenderer: (p) =>
                c(
                    `
                    <button ng-click="gotoprojectpo('${p.data.project_no_enc}','${p.data.project_id}')" type="button" class="ism-btns btn-normal" style="padding:2px 5px">
                        ${p.data.project_no.toUpperCase()}
                    </button>
                    `
                )(s)[0],
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 110
        })
        xc.push({
            headerName: "Project Name",
            field: 'project_name',
            cellRenderer: (p) =>
            c(
                `
                <button ng-click="gotoprojectpo('${p.data.project_no_enc}','${p.data.project_id}')" type="button"  class="ism-btns btn-normal" style="padding:2px 5px">
                    ${p.data.project_name}
                </button>
                `
            )(s)[0],
            // cellRenderer : (p) => p.data.project_name,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 320
        })
       
        xc.push({
            headerName: "Ref.No #",
            field: 'ponewrefno',
            cellRenderer : (p) => p.data.ponewrefno,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 160
        })
        xc.push({
            headerName: "Date",
            field: 'ponewdate',
            cellRenderer : (p) => p.data.ponewdate_d,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120
        })
        xc.push({
            headerName: "Supplier",
            field: 'glasssuppliername',
            cellRenderer : (p) => p.data.glasssuppliername.toUpperCase(),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 250
        })
        xc.push({
            headerName: "Mateiral Type",
            field: 'ponewtype',
            cellRenderer : (p) => p.data.ponewtype,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 155,
            cellStyle: {
                "text-align": "center",                    
                "color" : "#002bff"
                
            }
            
        })
        xc.push({
            headerName: "Total Qty",
            field: 'qty',
            cellRenderer : (p) => (+p.data.qty) === 0 ? '-' : (+p.data.qty).toLocaleString(undefined,{maximumFractionDigits:3}),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 105,
            cellStyle: {
                "text-align": "right",    
                'font-weight': "bold",
                "color" : "#207e20"
                
            }
        })
        xc.push({
            headerName: "Total Tonnage",
            field: 'wght',
            cellRenderer : (p) => (+p.data.wght) === 0 ? '-' : (+p.data.wght).toLocaleString(undefined,{maximumFractionDigits:3}),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 135,
            cellStyle: {
                "text-align": "right",                                
            }
        })
        xc.push({
            headerName: "Total Area",
            field: 'area',
            cellRenderer : (p) => (+p.data.area) === 0 ? '-' : (+p.data.area).toLocaleString(undefined,{maximumFractionDigits:3}),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 135,
            cellStyle: {
                "text-align": "right",                                
            }
        })
        xc.push({
            headerName: "Sub Total",
            field: 'totalprice',
            cellRenderer : (p) => (+p.data.totalprice) === 0 ? '-' : (+p.data.totalprice).toLocaleString(undefined,{maximumFractionDigits:2}),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 135,
            cellStyle: {
                "text-align": "right",                                
            }
        })
        xc.push({
            headerName: "VAT",
            field: 'ponewvat',
            cellRenderer: (p) => {
               return (+p.data.vatvalue) === 0 ? '-' : (+p.data.vatvalue).toLocaleString(undefined,{maximumFractionDigits:2})
            },
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 135,
            cellStyle: {
                "text-align": "right",                                
            }
        })
        xc.push({
            headerName: "Total Amount",
            field: 'ponewtotval',
            cellRenderer: (p) => (+p.data.ponewtotval) === 0 ? '-' :
                (+p.data.ponewtotval).toLocaleString(undefined,{maximumFractionDigits:2}),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 135,
            cellStyle: {
                "text-align": "right",
                'color': "#f00",
                "font-weight": 'bold'
            }
        })


        xc.push({
            headerName: "Location",
            field: 'project_location',
            cellRenderer : (p) => p.data.project_location,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 125
        })
        xc.push({
            headerName: "Region",
            field: 'projectRegion',
            cellRenderer : (p) => p.data.projectRegion,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 160
        })

        return xc;
    }

    colsdef_projectBudget(s, c, a) {
        let xc = [];
        xc.push({
            headerName: "Type",
            field: 'bmtype',
            cellRenderer : (p) => p.data.bmtype,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 410,
            cellStyle: { "color": "#000", "font-weight": 'bold' },
            
        })
        xc.push({
            headerName: "Qty",
            field: 'bmqty',
            cellRenderer : (p) =>  (+p.data.bmqty) === 0 ? "-" : (+p.data.bmqty).toLocaleString(undefined,{maximumFractionDigits:3}),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 150,
            cellStyle: { "color": "#ff0f0f", "text-align": 'right' },
           
        })
        if (a.priceaccess) {
            xc.push({
                headerName: "Estimated Price",
                field: 'bmeprice',
                cellRenderer: (p) =>
                    (+p.data.bmeprice) === 0 ? "-" : (+p.data.bmeprice).toLocaleString(undefined, { maximumFractionDigits: 2 }),
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 150,
                cellStyle: { "color": "#001fff", "font-weight": 'bold', "text-align": 'right' }
            })
            xc.push({
                headerName: "Estimated Amount",
                field: 'bmeval',
                cellRenderer: (p) => (+p.data.bmeval) === 0 ? "-" : (+p.data.bmeval).toLocaleString(undefined, { maximumFractionDigits: 2 }),
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 150,
                cellStyle: { "color": "#1f6024", "text-align": 'right' }
            })
            xc.push({
                headerName: "Discount Price",
                field: 'bmdiscountprice',
                cellRenderer: (p) => (+p.data.bmdiscountprice) === 0 ? "-" : (+p.data.bmdiscountprice).toLocaleString(undefined, { maximumFractionDigits: 2 }),
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 150,
                cellStyle: { "color": "#1f3060", "text-align": 'right' }
            })

            xc.push({
                headerName: "Discount Amount",
                field: 'bmdiscountval',
                cellRenderer: (p) => (+p.data.bmdiscountval) === 0 ? "-" : (+p.data.bmdiscountval).toLocaleString(undefined, { maximumFractionDigits: 2 }),
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 150,
                cellStyle: { "color": "#9b0040", "font-weight": 'bold', "text-align": 'right' }
            })
        }
        return xc;
    }

    colsposummary(s, c, a) {
        let xc = [];
        xc.push({
            headerName: "Project No",
            field: 'project_no',
            cellRenderer: (p) => {
                return c(`<button type="button" class="ism-btns btn-normal" ng-click="gotoprojectpo('${p.data.project_no_enc}','${p.data.project_id}')" style="padding:2px;border-radius:2px">
                ${p.data.project_no}
                </button>`)(s)[0]
            },
            // cellRenderer: (p) => c(
            //     `<div ng-click="goprojectbudget('${p.data.project_no_enc}','${p.data.project_id}',)">                
            //     ${p.data.project_no}
            //     </div>`
              
            // )(s)[0],
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 80
        })
        xc.push({
            headerName: "Project Name",
            field: 'project_name',
            cellRenderer : (p) => p.data.project_name,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 380
        })
        xc.push({
            headerName: "Material Ordered",
            field: 'materialtotal',
            cellRenderer: (p) => (+p.data.materialtotal) === 0 ? "-" : (+p.data.materialtotal).toLocaleString(undefined, { maximumFractionDigits: 2 }),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 150,
            cellStyle: { "color": "#9b0040", "font-weight": 'bold', "text-align": 'right' }
        })
        xc.push({
            headerName: "Glass Ordered",
            field: 'glasstotal',
            cellRenderer: (p) => (+p.data.glasstotal) === 0 ? "-" : (+p.data.glasstotal).toLocaleString(undefined, { maximumFractionDigits: 2 }),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 150,
            cellStyle: { "color": "#0d8500", "font-weight": 'bold', "text-align": 'right' }
        })
        xc.push({
            headerName: "Total Ordered",
            field: 'totalpo',
            cellRenderer: (p) => (+p.data.totalpo) === 0 ? "-" : (+p.data.totalpo).toLocaleString(undefined, { maximumFractionDigits: 2 }),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 150,
            cellStyle: { "color": "#f75d00", "font-weight": 'bold', "text-align": 'right' }
        })
        return xc;
    }

    colssuppliersummary(s, c, a) {
        let xc = [];
        xc.push({
            headerName: "Supplier",
            field: 'glasssuppliername',            
            // cellRenderer: (p) => c(
            //     `<div ng-click="goprojectbudget('${p.data.project_no_enc}','${p.data.project_id}',)">                
            //     ${p.data.project_no}
            //     </div>`
              
            // )(s)[0],
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 380
        })
        xc.push({
            headerName: "country",
            field: 'glasssuppliercountry',
            cellRenderer : (p) => p.data.glasssuppliercountry,
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 120
        })
        xc.push({
            headerName: "Material Ordered",
            field: 'materialtotal',
            cellRenderer: (p) => (+p.data.materialtotal) === 0 ? "-" : (+p.data.materialtotal).toLocaleString(undefined, { maximumFractionDigits: 2 }),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 150,
            cellStyle: { "color": "#9b0040", "font-weight": 'bold', "text-align": 'right' }
        })
        xc.push({
            headerName: "Glass Ordered",
            field: 'glasstotal',
            cellRenderer: (p) => (+p.data.glasstotal) === 0 ? "-" : (+p.data.glasstotal).toLocaleString(undefined, { maximumFractionDigits: 2 }),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 150,
            cellStyle: { "color": "#0d8500", "font-weight": 'bold', "text-align": 'right' }
        })
        xc.push({
            headerName: "Total Ordered",
            field: 'totalpo',
            cellRenderer: (p) => (+p.data.totalpo) === 0 ? "-" : (+p.data.totalpo).toLocaleString(undefined, { maximumFractionDigits: 2 }),
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width: 150,
            cellStyle: { "color": "#f75d00", "font-weight": 'bold', "text-align": 'right' }
        })
        return xc;
    }
}