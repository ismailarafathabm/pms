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
        font-family: 'lato';
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
        font-size: 12px;
        padding: 4px;
        line-height: 13px;
        border: 1px solid #d1d1d1;
        outline: 1px solid #0000;
        font-family: 'lato';
        color: #000E47;
        font-weight: 500;
        
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
        font-family: 'lato';
    }

    .ism-metro-left-button-group {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: flex-start;
        gap: 5px;
    }

    .ism-metro-button {
        font-family: 'lato';
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
    .nodis{display:none;}
</style>