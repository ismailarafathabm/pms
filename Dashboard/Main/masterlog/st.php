<style>
    

    * {
        transition: all 0.1s;
    }

    .ism-metro-project-dialog {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 100000000000;
        background: #2e2e2e73;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(10px);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .ism-metro-project-dialog-container {
        position: relative;
        display: block;
        background: #f1f1f1;
        font-family: 'roboto', sans-serif;
        border: 1px solid #989898;
        box-shadow: 0px 20px 20px -10px #211f566b;
        font-size: 12px;
    }

    .md {
        width: 600px;
    }

    .sm {
        width: 350px;
    }


    .ism-metro-project-dialog-container-titles {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #000E47;
        color: #fff;
        padding: 10px;
    }

    .ism-metro-project-dialog-titles-title {
        display: flex;
        flex-direction: row;
        align-items: center;
        position: relative;
    }

    .ism-metro-project-dialog-title-main-headers {
        font-size: 15px;
        font-weight: 500;
        line-height: 15px;
        padding: 5px;
        -webkit-font-smoothing: auto;
        -webkit-font-smoothing: subpixel-antialiased;
    }

    .ism-metro-project-dialog-title-closebtn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 25px;
        height: 25px;
        /* background: #f00000; */
        position: relative;
        border-radius: 50%;
        color: #f00;
        font-size: 14px;
    }

    .ism-metro-project-dialog-title-closebtn:hover {
        background-color: #f00;
        color: #fff;
    }

    .ism-metro-project-dialog-title-closebtn .fa {
        margin-right: 0 !important;
    }

    .ism-metro-project-dialog-container-subtitle {
        position: relative;
        display: flex;
        background: #EDEDFD;
        padding: 5px;
        color: #000e47;
        margin-bottom: 5px;
        align-items: center;
    }


    .ism-metro-project-dialog-main-body {
        position: relative;
        display: flex;
        padding: 5px 20px;
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
        justify-content: flex-start;
    }

    .ism-metro-project-mainbody-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        gap: 20px;
    }



    .ism-metro-project-mainbody-controllers {
        width: 50%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        gap: 2px;
    }

    .sm-ctrl {
        width: 100%;
    }



    .ism-metro-project-mainbody-label {
        font-size: 12.5px;
    }

    .ism-metro-project-mainbody-inputs {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        gap: 2px;
    }

    .ism-metro-inputs {
        width: 100%;
        display: flex;
        font-size: 0.95em;
        padding: 4px;
        line-height: 13px;
        border: 1px solid #d1d1d1;
        outline: 1px solid #0000;
        font-family: 'roboto', sans-serif;
        color: #000E47;
        font-weight: 500;

    }

    .ism-metro-inputs::placeholder {
        color: #c7c7c7;
        font-weight: 400;

    }

    .ism-metro-inputs:focus,
    .ism-metro-inputs:active {
        border: 1px solid #000E47;
        outline: 1px solid transparent;
    }

    .ism-metro-new-addbutton {
        font-size: 12.5px;
        line-height: 12.5px;
        background: #0066ce;
        border: 1px solid #dcdcdc94;
        padding: 5px 5px;
        color: #fff;
        border-radius: 3px;
    }

    .ism-metro-new-addbutton:hover {
        background: #06407a;
    }

    .ism-metro-project-dialog-footer {
        position: relative;
        display: block;
        background: #e8e8e8;
        border-top: 1px solid #ffffff96;
        padding: 5px 20px;
    }

    .ism-metro-project-dialog-footer-buttons {
        display: flex;
        align-items: center;
        flex-direction: row;
        justify-content: space-between;
        font-family: 'roboto', sans-serif;
    }

    .ism-metro-left-button-group {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: flex-start;
        gap: 5px;
    }

    .ism-metro-button {
        font-family: 'roboto', sans-serif;
        font-weight: 500;
        background: #9e404000;
        border: 1px solid #0000;
        font-size: 12px;
        line-height: 13px;
        padding: 4px 10px;
        border-radius: 3px;
    }

    .ism-metro-danger {
        background: #fed2d2;
        color: #c80000;
    }

    .ism-metro-danger:hover {
        background-color: #eebaba;
        box-shadow: 1px 10px 14px -10px #e93535;
    }

    .ism-metro-success {
        background: #000e47;
        color: #fff;
    }

    .ism-metro-success:hover {
        background-color: #079462;
        box-shadow: 1px 10px 14px -10px #079462;
    }

    .nodis {
        display: none;
    }

    .ism-new-page-headers {
        padding: 3px 15px;
        display: flex;
        position: relative;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        border: 1px solid #ded4d4;
    }

    .ism-new-page-header-page-title {
        display: flex;
        align-items: center;
        font-weight: 800;
    }

    .ism-new-page-header-page-buttons {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        gap: 3px;
    }

    .ism-new-page-header-button {
        border: 1px solid #0000;
        font-family: 'roboto', sans-serif;
        font-size: 11px;
        line-height: 1rem;
        padding: 3px;
        transition: all 0.5s;
        letter-spacing: 1px;
        word-break: break-word;
        border-radius: 3px;
        cursor: pointer;

    }

    .normalbtn {
        background: #105aaf;
        color: #fff;
    }

    .normalbtn:hover {
        background-color: #0b386c;
    }


    .dangerbtn {
        background: #ff5e2e;
        color: #fff;
    }

    .dangerbtn:hover {
        background-color: #95371c;
    }

    .successbtn {
        background: #10af74;
        color: #fff;
    }

    .successbtn:hover {
        background-color: #108d5e;
    }

    .pageloader {
        position: absolute;
        left: 50%;
        top: 50%;
        font-size: 3rem;
        color: #0001c1;
    }

    .ag-cell-wrap-text {
        /* font-family: 'roboto', sans-serif; */
        font-family: 'apple', 'roboto', sans-serif, ui-sans-serif;
        font-size: 0.90rem;
    }

    .ag-header-viewport {
        background: #f3f3f3;
        font-family: 'apple', 'roboto', sans-serif, ui-sans-serif;
        font-size: 0.90rem;
        /* font-family: 'roboto', sans-serif;
        font-size: 12px; */
    }

    .ism-pms-dialog {
        position: fixed;
        width: 100%;
        height: 100vh;
        background-color: #b6cbff7d;
        top: 0;
        left: 0;
        z-index: 10000000;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(8px);
    }

    .ism-pms-dialog-container {
       
        position: relative;
        background-color: #fff;
        display: block;
        overflow: hidden;
        font-family: 'apple', 'roboto', sans-serif, ui-sans-serif;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #f5f4f4;
        box-shadow: 5px 20px 45px -10px #ccc;
    }

    .ism-pms-dialog-headers {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-direction: row;
        gap: 40px;
        padding: 8px;
        border-bottom: 1px solid #d6d6d6;
    }

    .ism-pms-dialog-header-title {
        flex: 2;
        font-size: 1em;
        font-weight: bold;
        line-height: 1.4em;
        color: #444040;
    }

    .ism-pms-idalog-header-closebtn {

        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .closebtn {
        padding: 5px;
        flex: 1;
        font-size: 0.95em;
        font-weight: bold;
        color: #ff8c8c;
        transition: all 0.3s;
    }

    .closebtn:hover {
        color: #fff;
        scale: 1.2;
        rotate: 272deg;
        background: #ff8c8c;
        border-radius: 50%;

    }

    .ism-pms-dialog-loader {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: auto;
        font-size: 2.0rem;
    }

    .ism-pms-dialog-footer {
        border-top: 1px solid #d6d6d6;
        position: relative;
        display: flex;
        gap: 3px;
        flex-direction: row-reverse;
        padding: 8px;
    }

    .ism-pms-dialog-btn {
        position: relative;
        display: block;
        font-family: 'menu', 'roboto', sans-serif;
        font-size: 0.85em;
        text-align: center;
        font-weight: 500;
        padding: 8px 16px;
        background: #0000;
        border: 1px solid #0000;
        outline: 1px solid #0000;
        line-height: 1em;
        border-radius: 4px;
        cursor: pointer;
    }

    .ism-btn-dialog-dagner {
        color: #000;
    }

    .ism-btn-dialog-dagner:hover {
        color: #ff8c8c;
    }

    .ism-btn-dialog-save {
        letter-spacing: 0.8;
        background: #06b;
        color: #fff;
    }

    .ism-btn-dialog-save:hover {
        background: #115d5e;
    }

    .ism-pms-dialog-body {
        max-height: 85vh;
        padding: 8px;
        font-size: 0.895em;
        color: #747474;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;

    }

    .ism-pms-dialog-body-group-title {
        flex: 1;
        font-size: 0.8em;
        color: #3a3838;
        margin-bottom: 5px;
        font-weight: 900;
    }

    .ism-pms-dialog-body-group-title .active {
        color: #1169c7;
    }

    .ism-pms-dialog-body-rows {
        overflow: auto;
        max-height: calc(100vh - 50px);
        display: flex;
        gap: 5px;
        flex-direction: row;
        /* align-items: center; */
        justify-content: center;
        margin: 10px 0px;
        flex-wrap: wrap;

    }

    .ism-pms-dialog-body-row-input-container {
        padding: 6px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        gap: 5px;
        position: relative;

    }

    .full-widht {
        flex: 1 0 100%;
    }

    .half-widht {
        flex: 1 0 150px
    }

    .ism-dialog-body-rows-input-container-lable {
        font-size: 0.845em;
        font-weight: 700;
        line-height: 1rem;
    }


    .ism-dialog-body-rows-input-container-input {
        position: relative;
        width: 100%;
        display: flex;
        align-items: center;
        gap: 3px;
    }



    .ism-dialog-rows-input-controller {
        width: 100%;
        font-size: 1em;
        line-height: 1.2em;
        font-family: 'apple', 'roboto', sans-serif;
        padding: 6px 10px;
        border: 1px solid #8f8686;
        border-radius: 3px;
        font-weight: bolder;
        color: #655e5e;
        letter-spacing: 0.3px;
        outline: 1px solid transparent;
        background: #f9f9f9;
    }

    .ism-dialog-rows-input-controller:active,
    .ism-dialog-rows-input-controller:focus {
        border: 1px solid #000;
        color: #000;
    }

    .ism-dialog-input-error {
        font-size: 0.835em;
        color: #e93535;
        background-color: #fff0f0;
        padding: 5px;
        border-radius: 5px;
        display: block;
        width: 100%;
        overflow: hidden;
        white-space: normal;
    }

    .ism-dialog-input-success {
        font-size: 0.835em;
        color: #006c85;
        background-color: #e4fff0;
        padding: 5px;
        border-radius: 5px;
        display: block;
        width: 100%;
        overflow: hidden;
        white-space: normal;
    }

    .gridheadercells {
        text-align: center;
        align-items: center;
    }




    .ism-pms-dia-optionbox-list-items:hover {
        color: #72789b;
        border: 1px solid #72789b;
        font-weight: bold;
    }

    .ism-pms-dialog-table {
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid #d7d7d7;
    }

    .ism-pms-dialog-table-headers {
        position: sticky;
        top: 0;
    }

    .ism-pms-dialog-tbale-header-cell {
        border: 1px solid #d5cece;
        padding: 2px 15px;
        background: #e9e9e9;
        font-size: 0.85rem;
        line-height: 1.8rem;
    }

    /* .ism-pms-dialog-table-body {} */

    .ism-table-dialog-table-body-cells {
        border: 1px solid #ebe6e6;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 0.80rem;
        padding: 3px;
        line-height: 1.5rem;
    }

    .ag-theme-balham .ag-ltr .ag-cell {
        border-right: 1px solid #e1e1e1;
    }

    .bar {
        display: block;
        position: relative;
        padding: 3px;
    }

    .bar-container {
        display: block;
        width: 120px;
    }

    .bar-main-total {
        display: block;
        position: relative;
        width: 100%;
        height: 11px;
        border: 1px solid #4dbfd7;
        box-shadow: 0px -2px 12px -4px #4dbfd7;
        background: #fff;

    }

    .bar-main-value {
        height: 100%;
        background: #4dbfd7;
        overflow: hidden;
        max-width: 100%;
    }

    #ismx:hover {
        color: #0032ff;
    }

    .errortheme {
        background-color: #fff8f8;
        color: #ff9090;
    }

    .successtheme {
        background-color: #f8feff;
        color: #00a39b;
    }

    .ism-pms-dialog-body-rows-single {
        position: relative;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        border: 1px solid #dbcece;
        background: #efefef;
    }

    .ism-pms-dialog-body-rows-single-cols {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        gap: 2px;
        padding: 5px;
    }


    .ism-loaderdiv-new {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .ism-loader-container {
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: #fff;
        z-index: 30;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .srcico {
        background-image: url(./masterlog/srcico.png);
        background-size: 1em;
        background-repeat: no-repeat;
        background-position: 5px center;
        padding: 6px 2em 6px 2em;
    }
    .calendar{
        background-image: url(./masterlog/calendar.png);
        background-size: 1em;
        background-repeat: no-repeat;
        background-position: calc(100% - 15px) center;
        padding: 6px 2em 6px 10px;
    }

    /* select[readonly]{
        
    } */

    @media (max-height: 600px) {


        .ism-dialog-rows-input-controller {
            width: 100%;
            font-size: 0.75em;
            line-height: 0.80;
            font-family: 'apple', 'roboto', sans-serif;
            padding: 3px 5px;
            border: 1px solid #8f8686;
            border-radius: 3px;
            font-weight: bolder;
            color: #655e5e;
            letter-spacing: 0.3px;
            outline: 1px solid #0000;
        }

        .ism-pms-dialog-tbale-header-cell {
            border: 1px solid #d5cece;
            padding: 2px 15px;
            background: #e9e9e9;
            font-size: 0.85rem;
            line-height: 1rem;
        }

        .ism-pms-dialog-body-rows {
            overflow: auto;
            max-height: calc(100vh - 50px);
            display: flex;
            gap: 0;
            flex-direction: row;
            /* align-items: center; */
            justify-content: center;
            margin: 2px 0px;
            flex-wrap: wrap;
        }

        .ism-pms-dialog-body {
            padding: 4px;
            font-size: 0.745em;
        }

        .ism-pms-dialog-header-title {
            flex: 2;
            font-size: 0.80rem;
            font-weight: bold;
            line-height: 1em;
            color: #444040;
        }

        .ism-pms-dialog-btn {
            position: relative;
            font-size: 0.70em;
            font-weight: 500;
            padding: 4;
            line-height: 0.8em;
            border-radius: 4px;

        }

        .ism-dialog-input-error {
            font-size: 0.70em;
            padding: 2px;
            border-radius: 3px;
        }
    }
</style>