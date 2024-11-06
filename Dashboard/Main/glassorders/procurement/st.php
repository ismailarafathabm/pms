<style>
    .ism-new-pms-auto-dia {
        position: absolute;
        top: -1px;
        left: -10px;
        z-index: 1;
        overflow: hidden;
    }

    .ism-new-pms-auto-container {
        padding: 15px;
        border-radius: 15px;
        background: #fff;
        border: 1px solid #ebebeb;
        display: flex;
        flex-direction: column;
        gap: 10px;
        box-shadow: -10px 6px 12px -6px #00000061;
    }

    .ism-new-pms-auto-row {
        display: flex;
        flex-direction: row;
    }

    .ism-new-pms-auto-search-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        gap: 20px;

    }

    .ism-new-pms-auto-search-controller {
        flex: 1 1 245px;
        padding: 5px;
        border: 1px solid #bdbdbd;
        background: #fff;
        border-radius: 3px;
        line-height: 12px;
        font-size: 1em;
        font-family: 'ui', sans-serif;
    }

    .ism-new-pms-auto-search-controller-button {
        height: 25px;
        width: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        /* background: #b2e6ff; */
        border: 1px solid #0000;
        background: linear-gradient(45deg, #1dc0f1, #9a5bff);
        transition: background 0.3ms;
    }

    .ism-new-pms-auto-search-controller-button .fa {
        margin-right: 0 !important;
        color: #fff;
    }

    .ism-new-pms-auto-search-controller-button:hover {
        background: linear-gradient(145deg, #1dc0f1, #9a5bff);
        transition: all 0.5s;
        transition-delay: initial;
        transition-timing-function: ease-in;
    }

    .ism-new-pms-auto-table-container {
        display: flex;
        max-height: 220px;
        overflow: auto;
        width: 100%;
        flex-direction: column;
        gap: 10px;
        padding: 0 8px;
    }


    .ism-new-psm-auto-table {
        white-space: nowrap;
        border-collapse: separate;
        border-spacing: 0px;
    }

    .ism-new-psm-auto-table thead {
        position: sticky;
        top: 0;
    }

    .ism-new-psm-auto-table th,
    .ism-new-psm-auto-table td {
        border: 1px solid #bfbfbf;
        padding: 3px 7px;
    }

    .ism-new-psm-auto-table th {
        background: #b5c9df;
        font-size: 0.9em;
        line-height: 1.5em;

    }

    /* .ism-new-psm-auto-table td {} */

    .ism-new-psm-auto-list-item {
        border: 1px solid #c5c5c5;
        padding: 8px;
        width: 100%;
        border-radius: 10px;
        background: #fff;
        box-shadow: 5px 4px 12px -6px #dfdfdf;
        cursor: pointer;
    }

    .ism-new-psm-auto-list-item:hover {
        background-color: #ededed;
        background: linear-gradient(45deg, #ffe6e6, #e8e4ff33);
    }


    .ism-new-pms-list-container {
        display: block;
        width: 100%;
    }

    .ism-new-pms-list-rows {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
    }

    .ism-new-pms-list-columns {
        width: 100%;
        flex-basis: max-content;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 3px;
    }

    .ism-new-pms-list-cells {
        display: block;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .projectname {
        color: #f74343;
        font-size: 1em;
        font-weight: 600;
    }

    .contractor {
        font-size: 0.95em;
        color: #ababab;
    }

    .contractno {
        padding: 3px;
        border-radius: 3px;
        background: #1039ff;
        color: #fff;
        font-size: 0.9em;
    }

    .location {
        font-size: 0.85em;
        color: #0051b5;
    }

    .region {
        font-size: 0.85em;
        color: #329735;
    }
    .budget-area{
        background-color: #e6f9ff;
        font-weight: bold;
    }
    .budget-price{
        background-color: #d4f2fb;
        font-weight: bold;
    }
    .budget-amount{
        background-color: #c7e3eb;
        font-weight: bold;
    }
    .budget-re-qty{
        background-color: #e8f9f6;
        font-weight: bold;
    }
.budget-re-area{
    background-color: #deefec;
    font-weight: bold;
}
    .budget-re-val{
        background-color: #d6e7e4;
        font-weight: bold;
    }
    .budget-pen-val{
        background-color: #fefff5;
        font-weight: bold;
    }
    .budget-pen-amunt{
        background-color: #f0f1e8;
        font-weight: bold;
    }
</style>