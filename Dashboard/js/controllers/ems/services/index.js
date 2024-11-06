export default class MAC {
    api = api_pms + "/apipms/index.php?q=";
    ems = api_pms;
    postdata(fd) {
        const pdata = {
            method: 'POST',
            body: JSON.stringify(fd),
            headers: {
                'Accept': 'application/json',
            }
        };
        return pdata;
    }
    async FetchAction(url, postdata) {
        return new Promise((resolve, reject) => {
            const req = fetch(url, postdata);
            const res = req.then((r) => {
                if (!r.ok) {
                    reject("API URL NOT FOUND")
                }
                return r.json();
            });
            res.then((res) => {
                if (res?.msg === '1') {
                    resolve(res.data);
                } else if (res?.msg === "404") {
                    reject("404");
                } else if (res?.msg === "0") {
                    reject(res.data);
                } else {
                    console.log(res);
                    reject("API CALLING ERROR;Check in console")
                }
            }).catch((e) => {
                reject(e);
            })
        });
    }

    gridOptions(cols) {
        const gridoption = {
            columnDefs: cols,
            enableCellChangeFlash: true,
            defaultColDef: {

                sortable: true,
                filter: true,
                floatingFilter: true,
                wrapText: true,
                resizable: true,
            },
            suppressMenuHide: true,
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
            rowHeight: 50,
        };

        return gridoption;

    }
}