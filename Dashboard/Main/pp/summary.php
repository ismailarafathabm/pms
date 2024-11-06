<style>
    .armodal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #181818c0;
        backdrop-filter: blur(3px) saturate(190%);
        z-index: 10000004;
        overflow: auto;
    }

    .armodal .armodel-container {
        position: relative;
        font-family: 'roboto', sans-serif;
        font-size: 14px;
        background-color: #fff;
        width: 1020px;
        margin: 10px auto;
        border-radius: 10px;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        -ms-border-radius: 10px;
        -o-border-radius: 10px;
        overflow: hidden;
    }

    .armodal .armodel-container .armodelhead {
        position: relative;
        background-color: #d7e0e2;
        display: flex;
        justify-content: space-between;
        align-items: center;
        line-height: 1.1rem;
        padding: 12px 8px;
    }

    .armodal .armodel-container .armodelhead .armodel-title {
        position: relative;
        font-size: 16px;
        font-weight: bold;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .armodal .armodel-container .armodelhead .armodel-title .left-titles {
        margin-left: 10px;
    }

    .armodal .armodel-container .armodelhead .armodel-closebtn {
        border: 1px solid transparent;
        padding: 3px;
        border-radius: 6px;
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        -ms-border-radius: 6px;
        -o-border-radius: 6px;
        cursor: pointer;
        font-size: 18px;
    }

    .armodal .armodel-container .armodelhead .armodel-closebtn:hover {
        background-color: #ff9c9c;
        box-shadow: 3px 3px 6px #ffa8a8;
        border: 1px solid #ff5b5b;
    }

    .armodal .armodel-container .armodelhead .armodel-closebtn:hover i {
        color: #481919;
    }

    .armodal .armodel-container .armodelhead .armodel-closebtn .fa {
        margin: 0px !important
    }

    .armodal .armodel-container .armodelbody {
        position: relative;
        overflow: auto;
        margin: 5px 0px 5px 0px;
        padding: 10px;
    }

    .armodal .armodel-container .armodelbody .armodelbodywarper {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: start;
    }

    .armodal .armodel-container .armodelbody .armodelbodywarper .arbodyheader {
        /* background-color: #cde8f4; */
        padding: 3px 3px;
        font-weight: 600;
        color: #076994;
        border-bottom: 1px solid #0591cf;
        /* border-radius: 5px; */
        margin-bottom: 2px;
    }

    .armodal .armodel-container .armodelbody .armodelbodywarper .row {
        display: flex;
        flex-wrap: wrap;
        box-sizing: border-box;
        padding: 5px;
        justify-content: center;
    }

    .armodal .armodel-container .armodelbody .armodelbodywarper .row .frm {
        display: flex;
        width: 180px;
        flex-direction: column;
        justify-content: start;
        align-items: flex-start;
    }



    .armodal .armodel-container .armodelbody .armodelbodywarper .row .frm .frmlable {
        font-weight: bold;
    }

    .armodal .armodel-container .armodelbody .armodelbodywarper .row .frm .frmcontraollers-entry {
        display: flex;
        width: 160px;
        margin: 2px 0;
    }

    .armodal .armodel-container .armodelbody .armodelbodywarper .row .col2 {
        width: 450px;
        margin-right: 2px;
    }

    .armodal .armodel-container .armodelbody .armodelbodywarper .row .col2 .row {
        display: flex;
        flex-wrap: wrap;
        box-sizing: border-box;
        padding: 5px;
    }

    .armodal .armodel-container .armodelbody .armodelbodywarper .row .col2 .frm {
        display: flex;
        width: 220px;
        flex-direction: column;
        justify-content: start;
        align-items: flex-start;
    }

    .armodal .armodel-container .armodelbody .armodelbodywarper .row .col2 .row .frm .frmcontraollers-entry {
        display: flex;
        width: 200px;
        margin: 2px 0;
    }

    .arnewinput {
        border: 1px solid #020202;
        /* border-radius: 3px; */
        font-family: 'roboto', sans-serif;
        font-size: 14px;
        line-height: 1.4rem;
        align-items: center;
        width: 100%;
        outline: 1px solid transparent !important;
    }

    .arnewinput:disabled {
        background-color: #ffdcdc !important;
        cursor: no-drop !important;
        border: 1px solid transparent !important;
        outline: none !important;
    }

    .nomal:hover,
    .nomal:focus,
    .nomal:active {
        background: #fff;
        /* box-shadow: 1px 1px 12px #c3e9fb; */
        border: 1px solid #0085c1;
    }

    .danger:hover,
    .danger:focus,
    .danger:active {
        background: #fff;

        border: 1px solid #861d1d;
    }

    .danger:read-only {
        background-color: #fff3f3;
        /* box-shadow: 1px 1px 12px #fbc3c3; */
        border: 1px solid #ad7676;
    }

    .nomal:read-only {
        background: #eaf4f8;
        /* box-shadow: 1px 1px 12px #c3e9fb; */
        border: 1px solid #2a5163;
    }

    .dangerhead {

        color: #940707 !important;
        border-bottom: 1px solid #cf0505 !important;


    }

    .armodal .armodel-container .arfoot {
        position: relative;
        margin: 5px 0px;
        padding: 5px 8px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .armodal .armodel-container .arfoot .button-list-right .cancelbutn {
        line-height: 1.3rem;
        box-sizing: border-box;
        background: #ffcbcb;
        border: 1px solid #f14c4ca3;
        color: #c70000;


    }

    .armodal .armodel-container .arfoot .button-list-left {
        position: relative;
        display: flex;
        align-items: center;
    }

    .armodal .armodel-container .arfoot .button-list-left .printpayslip {
        line-height: 1.3rem;
        box-sizing: border-box;
        background: #1b87b1;
        border: 1px solid #1b87b1;
        color: #e1f0ff;
        margin-right: 10px;
        text-decoration: none;
        padding: 3px;

    }

    .armodal .armodel-container .arfoot .button-list-left .submitbutton {
        line-height: 1.3rem;
        box-sizing: border-box;
        background: #2c7575;
        border: 1px solid #2c7575;
        color: #9cf3dd;
        padding: 3px;

    }

    .armodal .armodel-container .arfoot .button-list-left .submitbutton:disabled {
        background-color: #aaaaaa;
        color: #000;
        cursor: no-drop;
    }


    .armodal .armodel-container .arfoot .button-list-right .cancelbutn:hover,
    .armodal .armodel-container .arfoot .button-list-left .printpayslip:hover,
    .armodal .armodel-container .arfoot .button-list-left .submitbutton:hover {
        color: #fff9f9;
        background: #2d2b2b;
        border: 1px solid #2d2b2b;
        transition: all 0.3s;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -ms-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
    }

    .divtable {
        margin: 0 auto;
        background: #f1f3fa;
        padding: 6px;
        border: 1px solid #d1d1d1;
        border-collapse: collapse;
        overflow: auto;
    }

    .divrow {
        display: table-row;
    }

    .divcells {
        display: table-cell;
        white-space: nowrap;
    }

    .headersdivrow {
        padding: 8px 5px;
        justify-content: start;
        align-items: start;
        background: #d4d9ea;
        font-size: 14px;
        font-weight: 600;
        border-bottom: 1px solid #999daa;
        border-top: 1px solid #999daa;
        border-right: 1px solid #999daa;
    }

    .divcellbody {
        padding: 2px 5px;
        border-bottom: 1px solid #999daa;
        border-right: 1px solid #999daa;
        font-size: 14px;

    }

    .divcellfirst {
        border-left: 1px solid #999daa;
    }

    .dtboxwarp {
        display: flex;
        justify-content: space-between;
        margin: 10px 20px;
        padding: 3px;
        align-items: center;
    }

    .dtbox {
        display: block;
        position: relative;
        border-radius: 8px;
        border: 1px solid;
    }

    .dtbox-head {
        font-size: 20px;
        margin-bottom: 9px;
        display: block;
        padding: 5px;
        color: #fff;
    }

    .dtbkox-cnt {
        font-size: 24px;
        font-weight: bold;
        display: block;
        text-align: center;
        padding: 5px;
    } 
    .redbox{
        border : 1px solid #891b1b;
        color : #891b1b
    }
    .redbox .dtbox-head{
        background-color: #861d1d;
    }
    .bluebox{
        border: 1px solid #2289b1;
        color: #2289b1;
    }
    .bluebox .dtbox-head{
        background-color: #2289b1;
    }

    .greenbox{
        border: 1px solid #46956d;
        color: #46956d;
    }
    .greenbox .dtbox-head{
        background-color: #46956d;
    }
</style>

<div class="armodal" id="dia_summary_whtopp">
    <div class="armodel-container" style="width:1150px;">
        <div class="armodelhead">
            <div class="armodel-title">
                <div class="left-logo">
                    <i class="fa fa-edit"></i>
                </div>
                <div class="left-titles">WAREHOUSE TO PAINT PLANT - SUMMARY REPORT</div>
            </div>
            <div class="armodel-closebtn" onclick="document.getElementById('dia_summary_whtopp').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="armodelbody">
            <div class="armodelbodywarper">
                <div class="dtboxwarp">
                    <div class="dtbox bluebox">
                        <div class="dtbox-head">
                            TOTAL QTY
                        </div>
                        <div class="dtbkox-cnt">
                            {{count_infos.sum_totqty}}
                        </div>
                    </div>
                    <div class="dtbox greenbox">
                        <div class="dtbox-head">
                            TOTAL RECEIVED
                        </div>
                        <div class="dtbkox-cnt">
                        {{count_infos.sum_totrec}}
                        </div>
                    </div>
                    <div class="dtbox redbox">
                        <div class="dtbox-head">
                            TOTAL BALANCE
                        </div>
                        <div class="dtbkox-cnt">
                        {{count_infos.sum_totbal}}
                        </div>
                    </div>
                </div>
                <div class="row" style="justify-content: flex-start;">
                    <div class="divtable">
                        <div class="divrow headers">
                            <div class="divcells headersdivrow divcellfirst" style="width: 55px;">S.No</div>
                            <div class="divcells headersdivrow" style="width: 95px;">Project</div>                            
                            <div class="divcells headersdivrow" style="width: 80px;">Name</div>
                            <div class="divcells headersdivrow">Part No</div>
                            <div class="divcells headersdivrow" style="width: 80px;">Type</div>
                            <div class="divcells headersdivrow">Alloy</div>
                            <div class="divcells headersdivrow">Length</div>
                            <div class="divcells headersdivrow">D.W</div>
                            <div class="divcells headersdivrow" style="width: 120px;">QTY</div>
                            <div class="divcells headersdivrow" style="width: 120px;">Received</div>
                            <div class="divcells headersdivrow" style="width: 120px;">Balance</div>
                        </div>
                        <div ng-repeat="y in whtoppsummary" class="divrow">
                            <div class="divcells divcellbody divcellfirst">
                                {{$index+1}}
                            </div>
                            <div class="divcells divcellbody">
                                {{y.pr}}
                            </div>
                            <div class="divcells divcellbody">
                                {{y.prname}}
                            </div>
                            <div class="divcells divcellbody">
                                {{y.pppartno}}
                            </div>
                            <div class="divcells divcellbody">
                                {{y.ty}}
                            </div>
                            <div class="divcells divcellbody">
                                {{y.ppalloy}}
                            </div>
                            <div class="divcells divcellbody">
                                {{y.pplenght}}
                            </div>
                            <div class="divcells divcellbody">
                                {{y.pp_dieweight}}
                            </div>
                            <div class="divcells divcellbody">
                                {{y.qt}}
                            </div>
                            <div class="divcells divcellbody">
                                {{y.rc}}
                            </div>
                            <div class="divcells divcellbody" style='color :red;font-weight:bold'>
                                {{y.bl}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="arfoot">
            <div class="button-list-right">
                <button class="cancelbutn" type="button" onclick="document.getElementById('dia_summary_whtopp').style.display='none'">
                    <i class="fa fa-times"></i>
                    Close</button>
            </div>
        </div>
    </div>
</div>




<div class="armodal" id="dia_summary_factopp">
    <div class="armodel-container" style="width:1050px;">
        <div class="armodelhead">
            <div class="armodel-title">
                <div class="left-logo">
                    <i class="fa fa-edit"></i>
                </div>
                <div class="left-titles">PAINT PLANT TO FACTORY - SUMMARY REPORT</div>
            </div>
            <div class="armodel-closebtn" onclick="document.getElementById('dia_summary_factopp').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="armodelbody">
            <div class="armodelbodywarper">
                <div class="dtboxwarp">
                    <div class="dtbox bluebox">
                        <div class="dtbox-head">
                            TOTAL QTY
                        </div>
                        <div class="dtbkox-cnt">
                            {{count_infos.sum_totqty}}
                        </div>
                    </div>
                    <div class="dtbox greenbox">
                        <div class="dtbox-head">
                            TOTAL RECEIVED
                        </div>
                        <div class="dtbkox-cnt">
                        {{count_infos.sum_totrec}}
                        </div>
                    </div>
                    <div class="dtbox redbox">
                        <div class="dtbox-head">
                            TOTAL BALANCE
                        </div>
                        <div class="dtbkox-cnt">
                        {{count_infos.sum_totbal}}
                        </div>
                    </div>
                </div>
                <div class="row" style="justify-content: flex-start;">
                <div class="divtable">
                        <div class="divrow headers">
                        <div class="divcells headersdivrow divcellfirst" style="width: 55px;">S.No</div>
                            <div class="divcells headersdivrow" style="width: 95px;">Project</div>                            
                            <div class="divcells headersdivrow" style="width: 80px;">Name</div>
                            <div class="divcells headersdivrow">Part No</div>
                            <div class="divcells headersdivrow" style="width: 80px;">Type</div>
                            <div class="divcells headersdivrow">Alloy</div>
                            <div class="divcells headersdivrow">Length</div>
                            <div class="divcells headersdivrow">D.W</div>
                            <div class="divcells headersdivrow" style="width: 120px;">QTY</div>
                            <div class="divcells headersdivrow" style="width: 120px;">Received</div>
                            <div class="divcells headersdivrow" style="width: 120px;">Balance</div>
                        </div>
                        <div ng-repeat="y in whtoppsummary" class="divrow">
                        <div class="divcells divcellbody divcellfirst">
                                {{$index+1}}
                            </div>
                            <div class="divcells divcellbody">
                                {{y.pr}}
                            </div>
                            <div class="divcells divcellbody">
                                {{y.prname}}
                            </div>
                            <div class="divcells divcellbody">
                                {{y.pppartno}}
                            </div>
                            <div class="divcells divcellbody">
                                {{y.ty}}
                            </div>
                            <div class="divcells divcellbody">
                                {{y.ppalloy}}
                            </div>
                            <div class="divcells divcellbody">
                                {{y.pplenght}}
                            </div>
                            <div class="divcells divcellbody">
                                {{y.pp_dieweight}}
                            </div>
                            <div class="divcells divcellbody">
                                {{y.qt}}
                            </div>
                            <div class="divcells divcellbody">
                                {{y.rc}}
                            </div>
                            <div class="divcells divcellbody" style='color :red;font-weight:bold'>
                                {{y.bl}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="arfoot">
            <div class="button-list-right">
                <button class="cancelbutn" type="button" onclick="document.getElementById('dia_summary_factopp').style.display='none'">
                    <i class="fa fa-times"></i>
                    Close</button>
            </div>
        </div>
    </div>
</div>