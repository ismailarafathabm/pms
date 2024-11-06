import MAC from './index.js';

export default class Employees extends MAC {
    cd = new Date();
    async getAllEmployees() {
        const fd = {};
        const postdata = this.postdata(fd);
        const url = `${this.api}allemployee`;
        try {
            const res = await this.FetchAction(url, postdata);
            return { msg: 1, data: res };
        } catch (e) {
            return { msg: 0, data: e };
        }
    }



    columns(filterParams) {
        let loc = this.ems;
        let cols = [];
        cols.push(
            {
                headerName: 'Sl.No',
                //cellRenderer: 'node.rowIndex + 1',
                valueGetter: "node.rowIndex + 1",
                width: 70,
                filter: false,
                sortable: false,
                suppressMenu: false,
            },
        );

        cols.push({

            headerName: 'Image',
            filter: false,
            sortable: false,
            cellRenderer: function (params) {
                var img = params.data.efile;
                var isimage = params.data.f;
                return isimage === 'Y' ? `<div>
                <img src='${loc}uploads/staffs/${img}.jpg?v=<?php echo date("d-m-Y h:i:s a") ?>' width="35px" height="35px" style="border-radius:50%" loading='lazy'>
                </div>` : `<div>
                <img src='${loc}uploads/staffs/000.png?v=<?php echo date("d-m-Y h:i:s a") ?>' width="35px" height="35px" style="border-radius:50%" loading='lazy'>
                </div>`;
            },
            width: 75,
            headerClass: 'th-geninfos',
            cellClass: 'th-geninfos'
        }
        );
        cols.push({
            headerName: 'File No.',
            field: 'efile',            
            width: 150,
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
        });
        cols.push(
            {
                headerName: 'Name',
                field: 'ename',
                filter: 'agTextColumnFilter',
                width: 200,
                sortingOrder: ['asc', 'desc'],
            }
        );
        cols.push({
            headerName: 'Department',
            field: 'edpartment',
            sortingOrder: ['asc', 'desc'],
            sort: 'asc',
            sortIndex: 0
        });
        cols.push({
            headerName: 'Location',
            field: 'elocation',
            sortingOrder: ['asc', 'desc'],
            sort: 'asc',
            sortIndex: 1
        });
        cols.push({
            headerName: 'Designation',
            field: 'eposition',
            sortingOrder: ['asc', 'desc'],
            sort: 'asc',
            sortIndex: 2
        });
        cols.push({
            headerName: 'Nationality',
            field: 'enationality',
            width: 100,
            sortingOrder: ['asc', 'desc'],
        });
        cols.push({
            headerName: 'Age',
            field: 'age',
            filter: 'agNumberColumnFilter',
            width: 100,
            sortingOrder: ['asc', 'desc'],
        });
        cols.push({
            headerName: 'Sponsor',
            field: 'eiqamasponser',
            sortingOrder: ['asc', 'desc'],
            width: 100,
        });
        cols.push({
            headerName: 'Iqama Expiry',
            field: 'eiqamaedate',
            cellRenderer: function (params) {
                return `${params.data.eiqamaedate_d}`
            },
            sortingOrder: ['asc', 'desc'],
            width: 150,
            filter: 'agDateColumnFilter',
            filterParams: filterParams,
        });

        cols.push({
            headerName: 'Joining Date',
            field: 'ejod',
            cellRenderer: function (params) {
                var dips = params.data.ejod_d;
                return `<div>${dips}</div>`
            },
            width: 150,
            sortingOrder: ['asc', 'desc'],
            filter: 'agDateColumnFilter',
            filterParams: filterParams,
            sort: 'asc',
            sortIndex: 3
        })
        cols.push({
            headerName: 'Exp in Nafco',
            sort: 'desc',
            field: 'exp',
            // cellRenderer: function(params) {
            //     var disp = params.data.experiance;
            //     return `${disp}`;
            // },
            width: 150,
            sort: false,
            sortingOrder: ['asc', 'desc'],
        });
        cols.push({
            headerName: 'Contract Start Date',
            field: 'pc_start',
            cellRenderer: function (params) {
                var disp = params.data.pc_start_d;
                return `<div>${disp}</div>`
            },
            sortingOrder: ['asc', 'desc'],
            width: 150,
            filter: 'agDateColumnFilter',
            filterParams: filterParams,
        })
        cols.push({
            headerName: 'Contract Duration',
            field: 'ecduration',
            sortingOrder: ['asc', 'desc'],
            width: 95,

        });
        cols.push({
            headerName: 'Contract Expiry',
            field: 'econtractexpdate',
            cellRenderer: function (params) {
                var disp = params.data.econtractexpdate_d;
                return `<div>${disp}</div>`
            },
            sortingOrder: ['asc', 'desc'],
            width: 150,
            filterParams: filterParams,
        })
        cols.push({
            headerName: 'Section',
            field: 'esection',
            sortingOrder: ['asc', 'desc'],

        });
        cols.push({
            headerName: 'Category',
            field: 'ecategory',
            sortingOrder: ['asc', 'desc'],
            width: 130,
            getQuickFilterText: function (params) {
                return params.data.ecategory;
            }
        });

        cols.push({
            headerName: 'Tools',
            field: 'etoolinfo',
            cellRenderer: function (params) {
                return params.data.etoolinfo === false ? '-' : `${params.data.etoolinfo}`
            },
            sortingOrder: ['asc', 'desc'],
            width: 80,

        })

        cols.push({
            headerName: 'Dependent',
            field: 'eiqamadepents',
            cellRenderer: function (params) {
                return params.data.eiqamadepents === false || params.data.eiqamadepents === 'false' ? '0' : `${params.data.eiqamadepents}`
            },
            sortingOrder: ['asc', 'desc'],
            width: 80,
            cellClass: 'th-otherinfo1',
            headerClass: 'th-otherinfo1',
        });

        cols.push(
            {
                headerName: 'Iqama No',
                field: 'eiqamano',
                sortingOrder: ['asc', 'desc'],
                width: 100,
            },
        );
        cols.push(
            {
                headerName: 'Iqama Profession',
                field: 'eiqamaprofessional',
                sortingOrder: ['asc', 'desc'],
            })

        cols.push({
            headerName: 'Status',
            field: 'status_text',
            sortingOrder: ['asc', 'desc'],
            width: 80,
        });
        cols.push({
            headerName: 'Contact Number',
            field: 'econtactno',
            sortingOrder: ['asc', 'desc'],
        });

        cols.push(
            {
                headerName: 'Last Vacation Start',
                field: 'lastvacaton_start',
                cellRenderer: function (params) {
                    return params.data.have_last_vacation_info === '1' ? params.data.lastvacaton_start_d : '-'
                },
                sortingOrder: ['asc', 'desc'],
                width: 150,
                filter: 'agDateColumnFilter',
                filterParams: filterParams,
            },
        );


        cols.push(
            {
                headerName: 'Last Vacation End',
                field: 'lastvacaton_end',
                cellRenderer: function (params) {
                    return params.data.have_last_vacation_info === '1' ? params.data.lastvacaton_end_d : '-'
                },
                sortingOrder: ['asc', 'desc'],
                width: 150,
                filter: 'agDateColumnFilter',
                filterParams: filterParams,
            },
        );

        cols.push(
            {
                headerName: 'Approved Days',
                field: 'lastvacation_approved_days',
                cellRenderer: function (params) {
                    return params.data.have_last_vacation_info === '1' ? params.data.lastvacation_approved_days : '-'
                },
                sortingOrder: ['asc', 'desc'],
                width: 150,
                filter: 'agDateColumnFilter',
                filterParams: filterParams,
            },
        );

        cols.push(
            {
                headerName: 'Approved Days',
                field: 'lastvacation_type',
                cellRenderer: function (params) {
                    return params.data.have_last_vacation_info === '1' ? params.data.lastvacation_type : '-'
                },
                sortingOrder: ['asc', 'desc'],
                width: 150,
                filter: 'agDateColumnFilter',
                filterParams: filterParams,
            },
        );

        return cols;
    }

    async getVacaton() {
        const fd = {};
        const postdata = this.postdata(fd);
        const url = `${this.api}vacationlist`;
        try {
            const res = await this.FetchAction(url, postdata);
            return { msg: 1, data: res };
        } catch (e) {
            return { msg: 0, data: e };
        }
    }

    columnsVacation(filterParams) {
        let loc = this.ems;
        let cols = [];
        cols.push(
            {
                headerName: 'Sl.No',
                //cellRenderer: 'node.rowIndex + 1',
                valueGetter: "node.rowIndex + 1",
                width: 70,
                filter: false,
                sortable: false,
                suppressMenu: false,
            },

        );
        cols.push({

            headerName: 'Image',
            filter: false,
            sortable: false,
            cellRenderer: function (params) {
                var img = params.data.efile;
                var isimage = params.data.f;
                return isimage === 'Y' ? `<div>
                <img src='${loc}uploads/staffs/${img}.jpg?v=<?php echo date("d-m-Y h:i:s a") ?>' width="35px" height="35px" style="border-radius:50%" loading='lazy'>
                </div>` : `<div>
                <img src='${loc}uploads/staffs/000.png?v=<?php echo date("d-m-Y h:i:s a") ?>' width="35px" height="35px" style="border-radius:50%" loading='lazy'>
                </div>`;
            },
            width: 75,
            headerClass: 'th-geninfos',
            cellClass: 'th-geninfos'
        });
        cols.push({
            headerName: 'File No.',
            field: 'efile',
            width: 150,
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
        });
        cols.push(
            {
                headerName: 'Name',
                field: 'ename',
                filter: 'agTextColumnFilter',
                width: 200,
                sortingOrder: ['asc', 'desc'],
            }
        );
        cols.push({
            headerName: 'Department',
            field: 'edpartment',
            sortingOrder: ['asc', 'desc'],
            sort: 'asc',
            sortIndex: 0
        });
        cols.push({
            headerName: 'Location',
            field: 'elocation',
            sortingOrder: ['asc', 'desc'],
            sort: 'asc',
            sortIndex: 1
        });
        cols.push({
            headerName: 'Designation',
            field: 'eposition',
            sortingOrder: ['asc', 'desc'],
            sort: 'asc',
            sortIndex: 2
        });
        cols.push({
            headerName: 'Nationality',
            field: 'enationality',
            width: 100,
            sortingOrder: ['asc', 'desc'],
        });
        cols.push({
            headerName: 'Age',
            field: 'age',
            filter: 'agNumberColumnFilter',
            width: 100,
            sortingOrder: ['asc', 'desc'],
        });
        cols.push({
            headerName: 'Sponsor',
            field: 'eiqamasponser',
            sortingOrder: ['asc', 'desc'],
            width: 100,
        });
        cols.push({
            headerName: 'Iqama Expiry',
            field: 'eiqamaedate',
            cellRenderer: function (params) {
                return `${params.data.eiqamaedate_d}`
            },
            sortingOrder: ['asc', 'desc'],
            width: 150,
            filter: 'agDateColumnFilter',
            filterParams: filterParams,
        });
        cols.push({
            headerName: 'Category',
            field: 'ecategory',
            sortingOrder: ['asc', 'desc'],
            width: 130,
            getQuickFilterText: function (params) {
                return params.data.ecategory;
            }
        });
        cols.push({
            headerName: 'Contract Start Date',
            field: 'pc_start',
            cellRenderer: function (params) {
                var disp = params.data.pc_start_d;
                return `<div>${disp}</div>`
            },
            sortingOrder: ['asc', 'desc'],
            width: 150,
            filter: 'agDateColumnFilter',
            filterParams: filterParams,
        })
        cols.push({
            headerName: 'Contract Duration',
            field: 'ecduration',
            sortingOrder: ['asc', 'desc'],
            width: 95,

        });
        cols.push({
            headerName: 'Contract Expiry',
            field: 'econtractexpdate',
            cellRenderer: function (params) {
                var disp = params.data.econtractexpdate_d;
                return `<div>${disp}</div>`
            },
            sortingOrder: ['asc', 'desc'],
            width: 150,
            filterParams: filterParams,
        })
        cols.push({
            headerName: 'Approved By',
            field: 'vacation.approved_by',
            sortingOrder: ['asc', 'desc'],
            width: 120,

        });
        cols.push({
            headerName: 'Approved Date',
            field: 'vacation.approved_date',
            cellRenderer: function (params) {
                var disp = params.data.vacation.approved_date_d;
                return `<div>${disp}</div>`
            },
            sortingOrder: ['asc', 'desc'],
            width: 150,
            filterParams: filterParams,
        });
        cols.push({
            headerName: 'Type',
            field: 'vacation.vaccation_type',
            sortingOrder: ['asc', 'desc'],
            width: 120,
        });
        cols.push({
            headerName: 'Visa Days',
            field: 'vacation.vaccation_visa_days',
            sortingOrder: ['asc', 'desc'],
            width: 120,
        });
        cols.push({
            headerName: 'Last Working Date',
            field: 'vacation.lastworkingdate',
            cellRenderer: function (params) {
                var disp = params.data.vacation.lastworkingdate_d;
                return `<div>${disp}</div>`
            },
            sortingOrder: ['asc', 'desc'],
            width: 150,
            filterParams: filterParams,
        });
        cols.push({
            headerName: 'Start Date',
            field: 'vacation.vaccation_stardate',
            cellRenderer: function (params) {
                var disp = params.data.vacation.vaccation_stardate_d;
                return `<div>${disp}</div>`
            },
            sortingOrder: ['asc', 'desc'],
            width: 150,
            filterParams: filterParams,
        });
        cols.push({
            headerName: 'End Date',
            field: 'vacation.vaccation_end_date',
            cellRenderer: function (params) {
                var disp = params.data.vacation.vaccation_end_date_d;
                return `<div>${disp}</div>`
            },
            sortingOrder: ['asc', 'desc'],
            width: 150,
            filterParams: filterParams,
        });
        cols.push({
            headerName: 'Approved Days',
            field: 'vacation.vaccation_approved_days',
            sortingOrder: ['asc', 'desc'],
            width: 120,
        });
        cols.push({
            headerName: 'Ticket By',
            field: 'vacation.vaticketinfos',
            sortingOrder: ['asc', 'desc'],
            width: 120,
        });
        cols.push({
            headerName: 'Ticket Start Date',
            field: 'vacation.ticket_date',
            cellRenderer: function (params) {
                var disp = params.data.vacation.ticket_date_d;
                return `<div>${disp}</div>`
            },
            sortingOrder: ['asc', 'desc'],
            width: 150,
            filterParams: filterParams,
        });
        cols.push({
            headerName: 'Ticket End Date',
            field: 'vacation.ticket_enddate',
            cellRenderer: function (params) {
                var disp = params.data.vacation.ticket_enddate_d;
                return `<div>${disp}</div>`
            },
            sortingOrder: ['asc', 'desc'],
            width: 150,
            filterParams: filterParams,
        });
        cols.push({
            headerName: 'Leave By Ticket',
            field: 'vacation.vaccation_approved_days',
            sortingOrder: ['asc', 'desc'],
            width: 120,
        });
        cols.push({
            headerName: 'Completed Days',
            field: 'vacation.vaccation_approved_days',
            sortingOrder: ['asc', 'desc'],
            width: 120,
        });
        return cols;
    }

    async finalExit() {
        const fd = {};
        const postdata = this.postdata(fd);
        const url = `${this.api}exitlist`;
        try {
            const res = await this.FetchAction(url, postdata);
            return { msg: 1, data: res };
        } catch (e) {
            return { msg: 0, data: e };
        }
    }

    columnsExit(filterParams) {
        let loc = this.ems;
        let cols = [];
        cols.push(
            {
                headerName: 'Sl.No',
                //cellRenderer: 'node.rowIndex + 1',
                valueGetter: "node.rowIndex + 1",
                width: 70,
                filter: false,
                sortable: false,
                suppressMenu: false,
            },

        );
        cols.push({

            headerName: 'Image',
            filter: false,
            sortable: false,
            cellRenderer: function (params) {
                var img = params.data.efile;
                var isimage = params.data.f;
                return isimage === 'Y' ? `<div>
                <img src='${loc}uploads/staffs/${img}.jpg?v=<?php echo date("d-m-Y h:i:s a") ?>' width="35px" height="35px" style="border-radius:50%" loading='lazy'>
                </div>` : `<div>
                <img src='${loc}uploads/staffs/000.png?v=<?php echo date("d-m-Y h:i:s a") ?>' width="35px" height="35px" style="border-radius:50%" loading='lazy'>
                </div>`;
            },
            width: 75,
            headerClass: 'th-geninfos',
            cellClass: 'th-geninfos'
        });
        cols.push({
            headerName: 'File No.',
            field: 'efile',
            width: 150,
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
        });
        cols.push(
            {
                headerName: 'Name',
                field: 'ename',
                filter: 'agTextColumnFilter',
                width: 200,
                sortingOrder: ['asc', 'desc'],
            }
        );
        cols.push({
            headerName: 'Department',
            field: 'edpartment',
            sortingOrder: ['asc', 'desc'],
            sort: 'asc',
            sortIndex: 0
        });
        cols.push({
            headerName: 'Location',
            field: 'elocation',
            sortingOrder: ['asc', 'desc'],
            sort: 'asc',
            sortIndex: 1
        });
        cols.push({
            headerName: 'Designation',
            field: 'eposition',
            sortingOrder: ['asc', 'desc'],
            sort: 'asc',
            sortIndex: 2
        });
        cols.push({
            headerName: 'Nationality',
            field: 'enationality',
            width: 100,
            sortingOrder: ['asc', 'desc'],
        });

        cols.push({
            headerName: 'Last Working Date',
            field: 'exit.ex_lswd',
            cellRenderer: function (params) {
                var disp = params.data.exit.ex_lswd_d;
                return `<div>${disp}</div>`
            },
            sortingOrder: ['asc', 'desc'],
            width: 150,
            filterParams: filterParams,
        })

        cols.push({
            headerName: 'Type',
            field: 'exit.ex_type',
            width: 130,
            sortingOrder: ['asc', 'desc'],
        });
        cols.push({
            headerName: 'Reson',
            field: 'exit.ex_reson',
            width: 190,
            sortingOrder: ['asc', 'desc'],
        });
        cols.push({
            headerName: 'Contract Compleate',
            field: 'exit.ex_iscontrcatcompleate',
            width: 100,
            sortingOrder: ['asc', 'desc'],
        });
        cols.push({
            headerName: 'Age',
            field: 'age',
            filter: 'agNumberColumnFilter',
            width: 100,
            sortingOrder: ['asc', 'desc'],
        });
        cols.push({
            headerName: 'Sponsor',
            field: 'eiqamasponser',
            sortingOrder: ['asc', 'desc'],
            width: 100,
        });
        cols.push({
            headerName: 'Iqama Expiry',
            field: 'eiqamaedate',
            cellRenderer: function (params) {
                return `${params.data.eiqamaedate_d}`
            },
            sortingOrder: ['asc', 'desc'],
            width: 150,
            filter: 'agDateColumnFilter',
            filterParams: filterParams,
        });
        cols.push({
            headerName: 'Category',
            field: 'ecategory',
            sortingOrder: ['asc', 'desc'],
            width: 130,
            getQuickFilterText: function (params) {
                return params.data.ecategory;
            }
        });
        cols.push({
            headerName: 'Contract Start Date',
            field: 'pc_start',
            cellRenderer: function (params) {
                var disp = params.data.pc_start_d;
                return `<div>${disp}</div>`
            },
            sortingOrder: ['asc', 'desc'],
            width: 150,
            filter: 'agDateColumnFilter',
            filterParams: filterParams,
        })
        cols.push({
            headerName: 'Contract Duration',
            field: 'ecduration',
            sortingOrder: ['asc', 'desc'],
            width: 95,

        });
        cols.push({
            headerName: 'Contract Expiry',
            field: 'econtractexpdate',
            cellRenderer: function (params) {
                var disp = params.data.econtractexpdate_d;
                return `<div>${disp}</div>`
            },
            sortingOrder: ['asc', 'desc'],
            width: 150,
            filterParams: filterParams,
        })
        cols.push({
            headerName: 'Section',
            field: 'esection',
            sortingOrder: ['asc', 'desc'],

        });
        cols.push({
            headerName: 'Category',
            field: 'ecategory',
            sortingOrder: ['asc', 'desc'],
            width: 130,
            getQuickFilterText: function (params) {
                return params.data.ecategory;
            }
        });
        cols.push({
            headerName: 'Dependent',
            field: 'eiqamadepents',
            cellRenderer: function (params) {
                return params.data.eiqamadepents === false || params.data.eiqamadepents === 'false' ? '0' : `${params.data.eiqamadepents}`
            },
            sortingOrder: ['asc', 'desc'],
            width: 80,
            cellClass: 'th-otherinfo1',
            headerClass: 'th-otherinfo1',
        });

        cols.push(
            {
                headerName: 'Iqama No',
                field: 'eiqamano',
                sortingOrder: ['asc', 'desc'],
                width: 100,
            },
        );
        cols.push(
            {
                headerName: 'Iqama Profession',
                field: 'eiqamaprofessional',
                sortingOrder: ['asc', 'desc'],
            })

        cols.push({
            headerName: 'Status',
            field: 'status_text',
            sortingOrder: ['asc', 'desc'],
            width: 80,
        });
        return cols;
    }
}