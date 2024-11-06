<style>
    .ag-header-container {

        background: #c4d0d2;
        font-family: 'roboto';
        font-size: 14px;
        font-weight: 600;
        color: #000 !important;
    }

    .ag-header-cell-text {
        color: #000 !important;

    }

    .ag-cell {
        font-family: 'roboto';
        font-size: 14px;
        white-space: nowrap;
        border: 1px solid #00000012 !important;
    }

    .td-ok {
        color: #015147;
    }

    .td-green {
        background-color: #e7fffc;
        color: #000;
    }

    .td-green {
        background-color: #e7fffc;
        color: #000;
    }

    .td-yellow {
        background: #fff6dc;
        color: #000;
    }

    .ag-pinned-left-header {
        background: #c4d0d2;
        font-family: 'roboto';
        font-size: 14px;
        font-weight: 600;
        color: #000 !important;
    }

    .ag-theme-balham {
        --ag-odd-row-background-color: #f6feff;
    }

    .ag-theme-balham .ag-row-odd {
        background-color: var(--ag-odd-row-background-color);
    }
</style>
<style>
    .ag-header-container {

        background: #c4d0d2;
        font-family: 'roboto';
        font-size: 14px;
        font-weight: 600;
        color: #000 !important;
    }

    .ag-header-cell-text {
        color: #000 !important;

    }

    .ag-cell {
        font-family: 'roboto';
        font-size: 14px;
        white-space: nowrap;
        border: 1px solid #00000012 !important;
    }

    .td-ok {
        color: #015147;
    }

    .td-green {
        background-color: #e7fffc;
        color: #000;
    }

    .td-green {
        background-color: #e7fffc;
        color: #000;
    }

    .td-yellow {
        background: #fff6dc;
        color: #000;
    }

    .filterdialog {

        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10000000;
        background: #00000099;
        backdrop-filter: blur(3px) saturate(180%);
        display: none;
        align-items: center;
        justify-content: center;
    }

    .filterdialog-conatiner {
        font-family: 'roboto', sans-serif;
        font-size: 14px;
        background: #d9d9d9;
        border-radius: 5px;
        color: #000;
        overflow: hidden;
        width: 350px;
        box-shadow: 20px 16px 20px #0000002b, -8px -4px 20px #ffffff2b;
    }


    .fitlerdialogheader {
        display: flex;
        justify-content: space-between;
        background: #bfbfbf;
        padding: 5px 10px;
        align-items: center;
    }

    .filterheadertitle {
        display: flex;
        align-items: center;
        padding: 5px;
    }

    .filterheadericons {
        margin-right: 5px;
    }

    .filterheadertext {
        font-size: 16px;
    }

    .filterheaderclosebtn {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #cdb3b3;
        color: #f00;
        padding: 5px;
        transition: background-color 0.4s ease;
        border-radius: 5px;
    }

    .filterheaderclosebtn:hover {
        background-color: #f00;
        color: #fff;
    }

    .filterheaderclosebtn .fa {
        margin-right: 0px;
    }

    .filterdialogbody {
        display: flex;
        position: relative;
        justify-content: center;
        align-items: center;
        border-bottom: 1px solid #504e4e;
    }



    .filterdialogbodycontainer {
        display: flex;
        flex-direction: column;
        margin-top: 5px;
    }

    .row {
        margin-bottom: 10px;
        width: 300px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
    }

    .new-lable {
        margin-bottom: 3px;
    }

    .inputitmes {
        width: 300px;
    }

    .new-inputs-black {
        width: 100%;
        border: none;
        padding: 8px 5px;
        background-color: #efefef;
        color: #000;
        outline: 2px solid #b6bdff00;
        border-radius: 3px;
        line-height: 15px;
        font-size: 14px;
        transition: background-color 0.5s ease-out, color 0.5s ease-in, outline 0.4s ease;
    }

    .new-inputs-black:hover,
    .new-inputs-black:focus {
        outline: 2px solid #6c7fff;
        background-color: #ffffff;
    }

    .new-inputs-black:focus {
        box-shadow: 6px 6px 16px #00000070, 5px 8px 5px #ffffffd9;
    }


    .filterdialogfooter {
        display: flex;
        padding: 5px;
        margin: 5px 4px;
        justify-content: space-between;
        align-items: center;
    }

    .rightbutton {
        display: flex;
    }

    .leftbuttons {
        display: flex;
    }

    .closenewbutton {
        background-color: #00000003;
        color: #ff8484;
        border: 1px solid transparent;
        font-size: 14px;
        padding: 5px 15px;
        border-radius: 4px;
        letter-spacing: 1px;
        margin-left: 16px;
        transition: color 0.5s ease, background-color 0.6s ease;

    }

    .closenewbutton:hover {
        color: #ffffff;
        background: #504f4f;
    }


    .savenewbutton {
        background-color: #356659;
        color: #ffffff;
        border: 1px solid transparent;
        font-size: 14px;
        padding: 5px 15px;
        border-radius: 4px;
        /* letter-spacing: 1px; */
        margin-right: 15px;
        transition: color 0.5s ease, background-color 0.6s ease;
    }

    .savenewbutton:hover {
        color: #ffffff;
        background: #35665940;
    }

    .savenewbutton:disabled {
        background-color: #414141;
        border: 1px solid transparent;
        cursor: no-drop;
    }

    .savenewbutton:hover:disabled {
        background-color: #414141;
        border: 1px solid transparent;
        cursor: no-drop;
    }

    .old_pgm {
        width: 1300px;
        padding: 5px;
        display: block;
        overflow: auto;
        background-color: #f7f7f7;
    }

    .old_pgm_row {
        display: flex;
        padding: 3px;
        position: relative;
        margin: 4px 0px;
    }

    .old_pgm_column {
        width: 200px;
        padding: 2px;
        display: flex;
        flex-direction: column;
        margin: 10px;
    }

    .old_page_lable {
        padding: 3px 0px;
        font-weight: 100;
        font-size: 12px;
    }

    .old_page_inputs {
        width: 100%;
        padding: 3px 3px;
        border: 1px solid #a7a7a7;
        font-size: 1em;
        line-height: 1em;
    }

    .old_page_inputs:focus {
        border: 1px solid #3d68db;
        outline: none;
    }


    .old_page_inputs:read-only {
        background-color: #fdf5f5;
        color: #ab0000;
    }

    .old_table {
        border-collapse: collapse;
        font-size: 13px;
        font-family: 'roboto', sans-serif, serif;
        font-display: optional;

    }

    .old_table th,
    td {
        border: 1px solid #d3d3d3;
        padding: 1px;

    }

    .old_table th {
        font-weight: 100;
        padding: 5px 10px;
        font-size: 12px;
        background: #fff6f6;
    }

    .n_req {
        background-color: #fffdfd !important;
        color: #ab0000;
    }

    .n_avi {
        background-color: #ecfffc !important;
        color: #00440f;
    }

    .n_need {
        background-color: #edf6ff !important;
        color: #00262c;
    }

    .old_pgm_fitbox {
        display: block;
        /* max-height: 450px; */
        overflow: auto;
    }

    .bottomsavebtn {
        display: flex;
        flex-direction: row-reverse;
        width: 72.5%;
        align-items: center;
        justify-content: space-between;
    }
</style>