export default class _ {
    #_init_url = `${api_url}index.php?page=`;

    FormData() {
        const fds = new FormData();
        fds.append("user_name", userinfo.user_name);
        fds.append("user_token", userinfo.user_token);
        return fds;
    }

    #pd(fd = this.FormData()) {
        const pdata = {
            method: "post",
            headers: {
                'Accept': 'Application/json',
            },
            body: fd
        };

        return pdata;
    }

    async servicecall(page, func, fd = this.FormData()) {
        const postdata = this.#pd(fd);
        try {
            const res = await this.#FetchAction(`${this.#_init_url}${page}&f=${func}`, postdata);
            return { msg: 1, data: res };
        } catch (e) {
            return { msg: 0, data: e };
        }
    }

    async #FetchAction(url, pd) {
        return new Promise((r, e) => {
            const req = fetch(url, pd);
            const res = req.then(rx => {
                if (!rx.ok) {                    
                    if (rx.status === 400) {
                        e("Bad Request note : some inputs are missing in your request");
                    } else if(rx.status === 404) {
                        e("Api Location Not Found");    
                    } else {
                        e("Error on api calleing");    
                    }
                    
                }
                return rx.json();
            });

            res.then(nr => {
                if (nr?.msg === "1") {
                    r(nr.data);
                } else if (nr.msg === "404") {
                    e(nr.data);
                } else if (nr.msg === "0") {
                    e(nr.data);
                } else {
                    e("API Error check in console");
                    console.log(nr);
                }
            }).catch(ne => { e(ne); })
        })
    }

    gridoptions(cols = [], filterParams = {}) {
        var headerComponentParams = {
            template:
              '<div class="ag-cell-label-container" role="presentation">' +
              '  <span ref="eMenu" class="ag-header-icon ag-header-cell-menu-button"></span>' +
              '  <div ref="eLabel" class="ag-header-cell-label" role="presentation">' +
              '    <span ref="eSortOrder" class="ag-header-icon ag-sort-order"></span>' +
              '    <span ref="eSortAsc" class="ag-header-icon ag-sort-ascending-icon"></span>' +
              '    <span ref="eSortDesc" class="ag-header-icon ag-sort-descending-icon"></span>' +
              '    <span ref="eSortNone" class="ag-header-icon ag-sort-none-icon"></span>' +
              '    <span ref="eText" class="ag-header-cell-text" role="columnheader" style="white-space: normal;"></span>' +
              '    <span ref="eFilter" class="ag-header-icon ag-filter-icon"></span>' +
              '  </div>' +
              '</div>',
          };
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
                resizable: true,  
                wrapText: true,                
                cellStyle: { "wordBreak": "normal" },
                autoHeight: true,
                headerComponentParams: headerComponentParams,  
                

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
}