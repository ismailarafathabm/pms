
export const TechnicalModel = (s, c, a) => {
    const xc = [];
    xc.push({
        headerName: "Print",
        cellRenderer: (p) => {
            return c(`
            <button type="button"
            class = "ism-btns btn-normal" 
            style = "padding : 3px" 
            ng-click="print_ts('${p.data.techsub_id}')"
            >            
            Print
            </button>
            `)(s)[0];
        },
        width: 80,
    });
    xc.push({
        headerName: "Submittal NO",
        field: "techsub_number",
        cellRenderer: (p) => c(`
            <button type="button" ng-click="goeditpage('${p.data.techsub_id}')">
            ${p.data.techsub_number}
            </button>            
        `)(s)[0],
        sortingOrder: ["asc", "desc"],
        filter: "agMultiColumnFilter",
        width: 160,
    });
    xc.push({
        headerName: "Revision NO",
        width: 60,
        field: "techsub_rvno",
        sortingOrder: ["asc", "desc"],
        filter: "agMultiColumnFilter",
    });
    xc.push({
        headerName: "Description",
        width: 450,
        field: "techsub_description",
        sortingOrder: ["asc", "desc"],
        filter: "agMultiColumnFilter",
    });
    xc.push({
        headerName: "Submitted Date",
        width: 120,
        field: "techsub_subdate",
        cellRenderer: (p) => `${p.data.techsub_subdate_d}`,
        sortingOrder: ["asc", "desc"],
        filter: "agMultiColumnFilter",
    });
    xc.push({
        headerName: "Submitted By",
        field: "techsub_submittedby",
        sortingOrder: ["asc", "desc"],
        filter: "agMultiColumnFilter",
    });
    xc.push({
        headerName: "Submitted By",
        field: "techsub_submittedby",
        sortingOrder: ["asc", "desc"],
        filter: "agMultiColumnFilter",
    });
    xc.push({
        headerName: "Revision NO",

        field: "techsub_status",
        cellRenderer: function (p) {

            switch (p.data.techsub_status) {
                case 'A':
                    return c(`
                    <button class="ism-new-page-header-button" style="padding:2px 2px;background:#aef1ce" type="button" ng-click="change_currentStatus('A','${p.data.techsub_id}')">
                    A - Approved as Submitted
                    </button>
                    `)(s)[0];
                case 'B':
                    return c(`
                        <button class="ism-new-page-header-button" style="padding:2px 2px;background:#c9f1dc" type="button" ng-click="change_currentStatus('B','${p.data.techsub_id}')">
                        B - Approved as Noted
                        </button>
                        `)(s)[0];
                case 'BC':
                    return c(`
                        <button class="ism-new-page-header-button" style="padding:2px 2px;background:#d4ae79" type="button" ng-click="change_currentStatus('BC','${p.data.techsub_id}')">
                        BC - Approved with Conditions
                        </button>
                        `)(s)[0];

                case 'C':
                    return c(`
                            <button class="ism-new-page-header-button" style="padding:2px 2px;background:#ffd99b" type="button" ng-click="change_currentStatus('C','${p.data.techsub_id}')">
                            C - Revise and resubmit
                            </button>
                            `)(s)[0];

                case 'D':
                    return c(`
                            <button class="ism-new-page-header-button" style="padding:2px 2px;background:#e0a8ff" type="button" ng-click="change_currentStatus('D','${p.data.techsub_id}')">
                            D - Rejected
                            </button>
                            `)(s)[0];
                case 'U':
                    return c(`<button class="ism-new-page-header-button" style="padding:2px 2px;background:#feffe2" type="button" ng-click="change_currentStatus('U','${p.data.techsub_id}')">
                    U - Under review
                            </button>
                            `)(s)[0];
                case 'E':
                    return c(`<button class="ism-new-page-header-button" style="padding:2px 2px;background:#a8b5ff" type="button" ng-click="change_currentStatus('E','${p.data.techsub_id}')">
                    E - For Information
                                </button>
                                `)(s)[0];
                case 'F':
                    return c(`<button class="ism-new-page-header-button" style="padding:2px 2px;background:#ff8484" type="button" ng-click="change_currentStatus('F','${p.data.techsub_id}')">
                    F - Cancelled
                                </button>
                                `)(s)[0];

            }
        },
        sortingOrder: ["asc", "desc"],
        filter: "agMultiColumnFilter",

    });

    xc.push({
        headerName: "Approved / Cancelled Date",
        field: "techsub_statusdate",
        cellRenderer: (p) =>
            p.data.techsub_status !== "" || p.data.techsub_status !== "1"
                ? "-"
                : p.data.techsub_statusdate_d,
        sortingOrder: ["asc", "desc"],
        filter: "agMultiColumnFilter",
        width: 80,
    });

    return xc;
};


export const ShopDrawingModel = (s, c, a) => {
    let xc = [];
    xc.push({
        headerName: "Print",
        cellRenderer: (p) => {
            return c(`
            <button type="button"
            class = "ism-btns btn-normal" 
            style = "padding : 3px" 
            ng-click="print_ts('${p.data.ds_id}')"
            >            
            Print
            </button>
            `)(s)[0];
        },
        width: 80,
    });
    xc.push({
        headerName: "Submittal NO",
        field: "ds_submitalno",
        cellRenderer: (p) => c(`
            <button type="button" ng-click="goeditpage('${p.data.ds_id}')">
            ${p.data.ds_submitalno}
            </button>            
        `)(s)[0],
        sortingOrder: ["asc", "desc"],
        filter: "agMultiColumnFilter",
        width: 160,
    });
    xc.push({
        headerName: "Revision NO",
        width: 60,
        field: "ds_rvno",
        sortingOrder: ["asc", "desc"],
        filter: "agMultiColumnFilter",
    });
    xc.push({
        headerName: "Submitted Date",
        width: 120,
        field: "ds_date",
        cellRenderer: (p) => p.data.ds_date_f.display,
        sortingOrder: ["asc", "desc"],
        filter: "agMultiColumnFilter",
    });
    
    xc.push({
        headerName: "Status",
        field: "ds_status",
        sortingOrder: ["asc", "desc"],
        filter: "agMultiColumnFilter",
        cellRenderer: (p) => {
            switch (p.data.ds_status) {
                case 'A':
                    return c(`
                    <button class="ism-new-page-header-button" style="padding:2px 2px;background:#aef1ce" type="button" ng-click="change_currentStatus('A','${p.data.techsub_id}')">
                    A - Approved as Submitted
                    </button>
                    `)(s)[0];
                case 'B':
                    return c(`
                        <button class="ism-new-page-header-button" style="padding:2px 2px;background:#c9f1dc" type="button" ng-click="change_currentStatus('B','${p.data.techsub_id}')">
                        B - Approved as Noted
                        </button>
                        `)(s)[0];
                case 'BC':
                    return c(`
                        <button class="ism-new-page-header-button" style="padding:2px 2px;background:#d4ae79" type="button" ng-click="change_currentStatus('BC','${p.data.techsub_id}')">
                        BC - Approved with Conditions
                        </button>
                        `)(s)[0];

                case 'C':
                    return c(`
                            <button class="ism-new-page-header-button" style="padding:2px 2px;background:#ffd99b" type="button" ng-click="change_currentStatus('C','${p.data.techsub_id}')">
                            C - Revise and resubmit
                            </button>
                            `)(s)[0];

                case 'D':
                    return c(`
                            <button class="ism-new-page-header-button" style="padding:2px 2px;background:#e0a8ff" type="button" ng-click="change_currentStatus('D','${p.data.techsub_id}')">
                            D - Rejected
                            </button>
                            `)(s)[0];
                case 'U':
                    return c(`<button class="ism-new-page-header-button" style="padding:2px 2px;background:#feffe2" type="button" ng-click="change_currentStatus('U','${p.data.techsub_id}')">
                    U - Under review
                            </button>
                            `)(s)[0];
                case 'E':
                    return c(`<button class="ism-new-page-header-button" style="padding:2px 2px;background:#a8b5ff" type="button" ng-click="change_currentStatus('E','${p.data.techsub_id}')">
                    E - For Information
                                </button>
                                `)(s)[0];
                case 'F':
                    return c(`<button class="ism-new-page-header-button" style="padding:2px 2px;background:#ff8484" type="button" ng-click="change_currentStatus('F','${p.data.techsub_id}')">
                    F - Cancelled
                                </button>
                                `)(s)[0];

            }
        }       
    })
    xc.push({
        headerName: "Changed Date",
        width: 120,
        field: "ds_submitteddate",
        cellRenderer: (p) => p.data.ds_status === "U" ? '-' : p.data.ds_submitteddate_f.display,
        sortingOrder: ["asc", "desc"],
        filter: "agMultiColumnFilter",
    });
    return xc;
}
