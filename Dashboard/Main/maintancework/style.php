<style>
.ism-project-search-container{
    display: block;
    position: relative;
    width: 400px;
    margin: 5px auto;
    background: #ffffff;
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0px 13px 15px -5px #d8d8d8;
}
.ism-project-search-controller{
    position: relative;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
    gap: 5px;
}
.ism-project-search-control{
    width: 98%;
    display: block;
}
.ism-project-search-input-controller{
    width: 100%;
    padding: 5px;
    border: 1px solid #cdcaca;
    outline: 1px solid #0000;
    font-size: 16px;
    line-height: 16px;
    border-radius: 3px;
    font-family: 'segoeui';
    font-weight: 700;
    color: #692cab;
    background: #fff;
    box-shadow: inset 7px 7px 11px -5px #e6e6e6;
}
.ism-project-search-control-button{
    width: 15%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    right: -48px;
}
.ism-project-search-input-button{
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 1px solid #0000;
    background: #1b9cff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    box-shadow: -7px 0px 12px -6px #0083ff8a;
}
.ism-project-search-input-button:hover{
    background: #1b73b6; 
}
.ism-project-save-conatiner{
    position: relative;
    display: flex;
    align-items: flex-start;
    justify-content: flex-start;
    width: 500px;  
    margin: 10px auto;
    padding: 10px;
}
.ism-prject-save-controll-container{
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-start;
    gap: 5px;
    width: 100%;
}

.ism-project-save-rows{
    position: relative;
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    justify-content: flex-start;
    gap: 5px;
    width: 100%;
}

.ism-project-save-controllers{
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.w-h{
    width: 50%;
}

.w-f{
    width: 100%;
}

.ism-project-save-controller-lable{
    font-size: 12px;
    font-family: 'segoeui';
    font-weight: 600;
    color: #434343;
    padding: 0px 4px;
}

.ism-project-save-controller-input-container{
    width: 100%;
    padding: 3px;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
    gap: 5px;
}

.ism-project-save-input-controllers{
    width: 100%;
    padding: 5px;
    border-radius: 2px;
    background: #fff;
    border: 1px solid #b7b7b7;
    outline: 1px solid #0000;
    font-size: 12px;
    font-family: 'roboto';
    line-height: 12px;
    box-shadow: inset -5px -6px 11px -5px #e6e6e6;
    transition:all 0.3s;
    -webkit-transition:all 0.3s;
    -moz-transition:all 0.3s;
    -ms-transition:all 0.3s;
    -o-transition:all 0.3s;
}
.ism-project-save-input-controllers:hover,
.ism-project-save-input-controllers:focus{    
    box-shadow: inset -5px -6px 11px -5px #ffffff;
}
.ism-project-save-input-buttons{
    background: #ffd69c;
    border: 1px solid #0000;
    padding: 3px 15px;
    border-radius: 3px;
    font-family: 'segoeui';
    font-size: 14px;
    font-weight: 600;
    display: flex;
    gap:2px;
    align-items: center;
    justify-content: center;
    
}
.ism-project-save-input-buttons:hover{
    background-color: #f3d6ae;
}

.ism-project-save-list-scopework{
    width: 500px;
    display: block;
    margin-top: 15px;
}
.ism-project-save-scopework-table{
    display: table;
    width: 100%;
}
.ism-project-save-scopework-table-rows{
    display: table-row;
}
.ism-project-save-scopework-table-cell{
    display: table-cell;
    font-family: 'segoeui';
    padding: 2px 0px;
    border-bottom: 1px solid #dbdbdb;
    font-size: 12px;
}
.cell-headers{
    font-weight: 600;
    color: #0c7e31;
}
.ism-btn-scopeofwork-remove{
    background: #ff6544;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #0000;
    color: #fff;
    width: 30px;
    height: 30px;
    border-radius: 50%;
}
.btnrows{
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-direction: row;
}
.ism-btn{
    background: #f1f1f1;
}
.btn-close:hover{
    background-color: #ff1010;
}
.btn-save:hover{
    background-color: #2b7618;
}
.ng-hg-datepicker{
    font-family: 'segoeui';
}


</style>