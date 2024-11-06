export default class API_Services{
    #def_url = `${api_pms}api/` ;
    async GET(page) {
        const url = this.#def_url + page;
        const pd = {
            method : "GET",
        }
        return await this.fetchdatas(url, pd);
    }
    async fetchdatas(url, pd) {
        const req = await fetch(url, pd) 
        if (req.status === 200 || req.status === 201) {
            try {
                const res = await req.json();
                return res;
            } catch (e) {
                console.log(e.message);
                
                return { isSuccess: false, data: [], msg: e.message };
            }
        } else {
            try {
                const res = await req.json();
                return res;
            }catch(e){
                console.log(e.message);
                return { isSuccess: false, data: [], msg: e.message };
            }
        }
    }

    _gridOptions(columndef) {
        const _gridOptions = {
            suppressContextMenu: true,
            columnDefs: columndef,
            enableCellChangeFlash: true,
            defaultColDef: {
    
                sortable: true,
                filter: true,
                floatingFilter: true,
                wrapText: true,
                resizable: true,
            },
            suppressMenuHide: true,
            colResizeDefault: 'shift',
            multiSortKey: 'ctrl',
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
        };

        return _gridOptions;
    }
}