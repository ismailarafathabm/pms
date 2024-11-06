<style>
    .rpt-backbtn{
        font-family: 'fig-b',sans-serif; 
        font-size: 1.3rem;
    }
    .sub-body-container-contents h1{
        font-family: 'fig-b',sans-serif;
        font-weight: 900;
        font-size: 1.3rem;        
    }
    .sub-body-container-contents,.ac-new-cols{
        font-family: 'fig',sans-serif;                
    }
    .ac-new-container{
        position: inherit;
        display: block;
        width: 100%;
        height: 100%;
        overflow: hidden;        
    }
    .ac-new-row{
        position:relative;
        display: flex;
        flex-direction: row;
        gap:3px;
        align-items: flex-start;
        justify-self: flex-start;
        justify-content: flex-start;
        flex-wrap: nowrap;
        overflow: none;
        height: 100%;
    }
    .ac-new-cols{       
        position: relative; 
        padding : 10px;
        height: 100%;
        overflow: auto;
    }
    .tbl{
        width: 100%;
        background:#fff;
    }
    .frm{
        flex:1 0 450px;
    }
    .ac-table{
        border-collapse: separate;
        border-spacing: 0px;
        /* border:1px solid #f1f1f1; */
        font-family: 'overpass',sans-serif;
        font-size: 0.85rem;
    }
    .ac-table .ac-table-header{
        position: sticky;
        top:-10px;
    }
    .ac-table .ac-table-th{
        padding : 5px;
        border-spacing: 0px;
        background:#f3f3f3;
        border : 1px solid #f1f1f1;
        font-family: 'fig',sans-serif;
        font-weight: bold;
        font-size: 0.75rem;
        line-height: 1.50rem;
        color :#737373;
    }
    .ac-table .ac-table-td{
        padding : 5px;
        border-spacing: 0px;        
        border : 1px solid #f1f1f1;
        font-family: 'fig',sans-serif;        
        font-size: 0.70rem;
        line-height: 0.80rem;   
        color:#000;
        font-weight: bold;     
    }

    .ac-new-frm-lable {
        flex:1;
        font-family: 'fig', sans-serif;
        font-size: 0.75rem;
        font-weight: bold;
        line-height: 1rem;
        color: #4f4f4f;
    }

    .ac-new-frm-inputs {
        flex:2;
        position: relative;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 3px;
        padding: 2px;
    }

    .ac-new-frm-inputctrl {
        width: 100%;
        padding: 5px 7px;
        border-radius: 2px;
        border: 1px solid #cdcdcd;
        font-family: 'fig', sans-serif;
        font-size: 0.90rem;
        line-height: 1rem;
        font-weight: bold;

        outline: 1px solid transparent;
        transition: all 0.2s;
    }

    .ac-new-frm-inputctrl:hover,
    .ac-new-frm-inputctrl:active {
        outline: 1px solid transparent;
        border: 1px solid #7d7d7d;
    }

    .btn {
        width: 100%;
        background: #f9f9f9;
        border: 1px solid #7d7d7d;
        padding: 9px 8px;
        border-radius: 5px;
        font-family: 'fig', sans-serif;
        font-weight: bold;
        font-size: 0.75rem;
        line-height: 1rem;
        transition: all 0.2s;
    }

    .btn-save {
        color: #fff;
        background-color: #1761de;
        border: 1px solid #1761de;
    }
    .btn-cancel {
        color: #f93b3b;
        background-color: transparent;
        border: 1px solid #f93b3b;
    }

    .btn-save:hover {
        color: #fff;
        background-color: #397def;
        border: 1px solid #397def;
    }
    .btn-cancel:hover {
        color: #bd0606;
        background-color: transparent;
        border: 1px solid #bd0606;
    }
    .ac-new-frm{
        width: 450px;
    }
    .ac-new-frm-container{
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        gap:5px;
        width: 100%;
        align-items: center;
        justify-content: space-between;
    }
    .ac-new-frm-row{
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: flex-start;
        gap:5px;
        width: 100%;       
        flex-wrap: wrap;
    }
    .ac-new-frm-cols{
        flex : 1 0 200px;
        display: flex;
        flex-direction: row;
        align-items: baseline;
        justify-content: space-between;
        gap:5px;
        flex-wrap: wrap;
        
    }
    @media only screen and (max-width:1400) {
        .sub-body-container-contents {
            zoom: 85%;
            font-size: 14px;
        }
        .ac-table{
            zoom: 70%;
        }
    }
</style>