<?php
session_start();
include_once('../../../conf.php');
$userdep = $_SESSION['nafco_alu_user_department'];
$update_access = ['superadmin', 'engineering'];
$_update_access = false;
foreach ($update_access as $a) {
    if ($userdep === $a) {
        $_update_access = true;
        break;
    }
}
$price_access = ['superadmin', 'engineering', 'Management', 'engineeringuser'];
$_price_acces = false;
foreach ($price_access as $p) {
    if ($userdep === $p) {
        $_price_acces = true;
    }
}
include_once('../menu1.php');
include_once 'style.php';
?>
<div class="sub-body" style="margin-top:70px">
    <div class="sub-body-container">
        <div class="sub-body-container-title" style="width:500px;margin:0px auto;border:1px solid #0000">
            <div class="sub-container-left">
                <div class="rpt-backbtn" id="back_btn">
                    <i class="fa fa-arrow-left"></i>
                </div>
                {{'ADD NEW Maintenance Work' | uppercase}}
            </div>
        </div>
        <div class="sub-body-container-contents" ng-show="!searchcomplate">
            <div class="ism-project-search-container">
                <div class="ism-project-search-controller">
                    <div class="ism-project-search-control">
                        <input ng-keyup="searchmntw.projectinfo_keyup($event)" id="search_project_txt" type="search" class="ism-project-search-input-controller" placeholder="Enter Project Number..." />
                    </div>
                    <div class="ism-project-search-control-button">
                        <button ng-click="searchmntw.projectinfo_click()" type="button" class="ism-project-search-input-button">
                            <i class="fa fa-search" style="margin: 0px !important;"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- <form name="mtwork_save_new" id="save_new_mtwork" ng-submit="mtwork_save_new_submit()" ng-show="searchcomplate">
               
                
            </form> -->
        </div>
        <div class="ism-project-save-conatiner" ng-show="searchcomplate">
            <form name="maintwork_save" id="save_maintwork" ng-submit="save_maintwork_click()">
                <div class="ism-prject-save-controll-container">
                    <div class="ism-project-save-rows">
                        <div class="ism-project-save-controllers w-h">
                            <div class="ism-project-save-controller-lable">
                                Project No
                            </div>
                            <div class="ism-project-save-controller-input-container">
                                <input type="text" class="ism-project-save-input-controllers" ng-keyup="changevlaue_projectno()" ng-model="mntw.projectinfo.mnt_pjcno" name="mnt_pjcno" id="mnt_pjcno" required ng-blur="check_dublicate_blur()"/>
                            </div>
                            <div ng-show="ishavedublicate" style="    
                            font-size: 12px;
                            font-family: 'segoeui';
                            font-weight: 500;
                            color: #ff5151;
                            background: #fdd;
                            padding: 3px;
                            border-radius: 3px;
                            margin: 0px 3px;
                        ">This Project Number Already Found.</div>
                        </div>
                        <div class="ism-project-save-controllers w-h">
                            <div class="ism-project-save-controller-lable">
                                Project Name
                            </div>
                            <div class="ism-project-save-controller-input-container">
                                <input type="text" class="ism-project-save-input-controllers" ng-model="mntw.projectinfo.projectname" name="projectname" id="projectname" required />
                            </div>
                        </div>
                    </div>

                    <div class="ism-project-save-rows">
                        <div class="ism-project-save-controllers w-h">
                            <div class="ism-project-save-controller-lable">
                                Contractor Name
                            </div>
                            <div class="ism-project-save-controller-input-container">
                                <input type="text" class="ism-project-save-input-controllers" ng-model="mntw.projectinfo.mnt_contractor" name="mnt_contractor" id="mnt_contractor" required />
                            </div>
                        </div>
                        <div class="ism-project-save-controllers w-h">
                            <div class="ism-project-save-controller-lable">
                                Contact Persion
                            </div>
                            <div class="ism-project-save-controller-input-container">
                                <input type="text" class="ism-project-save-input-controllers" ng-model="mntw.projectinfo.mnt_contactpersion" name="mnt_contactpersion" id="mnt_contactpersion" required />
                            </div>
                        </div>
                    </div>

                    <div class="ism-project-save-rows">
                        <div class="ism-project-save-controllers w-h">
                            <div class="ism-project-save-controller-lable">
                                Location
                            </div>
                            <div class="ism-project-save-controller-input-container">
                                <input type="text" class="ism-project-save-input-controllers" ng-model="mntw.projectinfo.mnt_location" name="mnt_location" id="mnt_location" required />
                            </div>
                        </div>
                        <div class="ism-project-save-controllers w-h">
                            <div class="ism-project-save-controller-lable">
                                Region
                            </div>
                            <div class="ism-project-save-controller-input-container">
                                <select class="ism-project-save-input-controllers" ng-model="mntw.projectinfo.mnt_region" name="mnt_region" id="mnt_region" required>
                                    <option value="">-</option>
                                    <option value="central region">Central Region</option>
                                    <option value="western region">Western Region</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="ism-project-save-rows">
                        <div class="ism-project-save-controllers w-h">
                            <div class="ism-project-save-controller-lable">
                                Start Date
                            </div>
                            <div class="ism-project-save-controller-input-container">
                                <input type="text" class="ism-project-save-input-controllers" ng-model="mntw.projectinfo.mnt_startdate" name="mnt_startdate" id="mnt_startdate" required placeholder="dd-mm-yyyy" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_paymentdate"/>
                            </div>
                        </div>
                        <div class="ism-project-save-controllers w-h">
                            <div class="ism-project-save-controller-lable">
                                End Date
                            </div>
                            <div class="ism-project-save-controller-input-container">
                                <input type="text" class="ism-project-save-input-controllers" ng-model="mntw.projectinfo.mnt_enddate" name="mnt_enddate" id="mnt_enddate" required placeholder="dd-mm-yyyy" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val2_paymentdate"/>
                            </div>
                        </div>
                    </div>

                    <div class="ism-project-save-rows">
                        <div class="ism-project-save-controllers w-h">
                            <div class="ism-project-save-controller-lable">
                                Warranty
                            </div>
                            <div class="ism-project-save-controller-input-container">
                                <select class="ism-project-save-input-controllers" ng-model="mntw.projectinfo.mnt_warrenty" name="mnt_warrenty" id="mnt_warrenty" required>
                                    <option value="">-</option>
                                    <option value="with warranty">With Warranty</option>
                                    <option value="without warranty">Without warranty</option>

                                </select>
                            </div>
                        </div>
                        <div class="ism-project-save-controllers w-h">
                            <div class="ism-project-save-controller-lable">
                                Billing Type
                            </div>
                            <div class="ism-project-save-controller-input-container">
                                <select class="ism-project-save-input-controllers" ng-model="mntw.projectinfo.mnt_billingtype" name="mnt_billingtype" id="mnt_billingtype" required>
                                    <option value="">-</option>
                                    <option value="quotation">Quotation</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="ism-project-save-rows">
                        <div class="ism-project-save-controllers w-h">
                            <div class="ism-project-save-controller-lable">
                                Project Manager
                            </div>
                            <div class="ism-project-save-controller-input-container">
                                <input type="text" class="ism-project-save-input-controllers" ng-model="mntw.projectinfo.mnt_pjmanager" name="mnt_pjmanager" id="mnt_pjmanager" required />
                            </div>
                        </div>
                        <div class="ism-project-save-controllers w-h">
                            <div class="ism-project-save-controller-lable">
                                Engineer
                            </div>
                            <div class="ism-project-save-controller-input-container">
                                <input type="text" class="ism-project-save-input-controllers" ng-model="mntw.projectinfo.mnt_project_eng" name="mnt_project_eng" id="mnt_project_eng" required />
                            </div>
                        </div>

                    </div>

                    <div class="ism-project-save-rows">
                        <div class="ism-project-save-controllers w-h">
                            <div class="ism-project-save-controller-lable">
                                Foreman
                            </div>
                            <div class="ism-project-save-controller-input-container">
                                <input type="text" class="ism-project-save-input-controllers" ng-model="mntw.projectinfo.mnt_project_foreman" name="mnt_project_foreman" id="mnt_project_foreman" required />

                            </div>
                        </div>
                        <div class="ism-project-save-controllers w-h">
                            <div class="ism-project-save-controller-lable">
                                Status
                            </div>
                            <div class="ism-project-save-controller-input-container">
                                <select class="ism-project-save-input-controllers" ng-model="mntw.projectinfo.mnt_status" name="mnt_status" id="mnt_status" required>
                                    <option value="">-</option>
                                    <option selected value="1">Open</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="ism-project-save-rows">
                        <div class="ism-project-save-controllers w-f">
                            <div class="ism-project-save-controller-lable">
                                Scope Of Work
                            </div>
                            <div class="ism-project-save-controller-input-container">
                                <input type="text" class="ism-project-save-input-controllers" ng-model="add_scopework" name="scope_workadd" id="scope_workadd" ng-keyup="workadd_keyup($event)" />
                                <button type="button" class="ism-project-save-input-buttons" ng-click="workadd_click()">
                                    <i class='fa fa-plus'></i>
                                    ADD
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="ism-project-save-list-scopework" style="margin-bottom:30px">
                        <div class="ism-project-save-scopework-table">
                            <div class="ism-project-save-scopework-table-rows">
                                <div class="ism-project-save-scopework-table-cell cell-headers">
                                    S.NO
                                </div>
                                <div class="ism-project-save-scopework-table-cell cell-headers">
                                    Scope Of Work
                                </div>
                                <div class="ism-project-save-scopework-table-cell cell-headers">
                                    Action
                                </div>
                            </div>
                            <div class="ism-project-save-scopework-table-rows" ng-repeat="x in scopeworklist">
                                <div class="ism-project-save-scopework-table-cell">
                                    {{$index+1}}
                                </div>
                                <div class="ism-project-save-scopework-table-cell">
                                    {{x}}
                                </div>
                                <div class="ism-project-save-scopework-table-cell">
                                    <button type="button" class="ism-btn-scopeofwork-remove" ng-click="removelistitem(x)">
                                        <i class="fa fa-times" style="margin-right:0px !important"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ism-project-save-rows btnrows">
                        <button type="button" ng-disabled="mntw.isloading" class="ism-project-save-input-buttons ism-btn btn-close">
                            <i class="fa fa-times"></i>
                            Cancel
                        </button>
                        <button type="submit" class="ism-project-save-input-buttons ism-btn btn-save" ng-disabled="maintwork_save.$invalid || scopeworklist.length===0 || mntw.isloading">
                            <i ng-show="!mntw.isloading" class="fa fa-check"></i>
                            <i ng-show="mntw.isloading" class="fa fa-cog fa-spin"></i>
                            Save
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>