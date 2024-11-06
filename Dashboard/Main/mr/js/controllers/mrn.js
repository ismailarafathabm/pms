import * as models from "./models.js";
import WhServices from "../../../bom/js/services/wh.js";
export default function mrnctrl($scope, $http, $routeParams) {
  const ws = new WhServices();
  $scope.whitems = [];
  GetAllData();
  async function GetAllData(src = "") {
    $scope.whitems = [];
    const res = await ws.getRequest('stocks');
    $scope.whitems = res;
    $scope.$apply();
    return;

  }
  $scope.itemtypes = [];
  GetItemTypes()
  async function GetItemTypes() {
    $scope.itemtypes = [];
    const res = await ws.getRequest("ItemTypes");
    $scope.itemtypes = res;
    $scope.$apply();
    return;
  }
  $scope.getitemsboq = async ($event) => {
    $scope.whitems = [];
    console.log("working");
    const sr = document.getElementsByName("src_bom_item_model")[0].value;
    const page = `stocks/${sr}`;
    ///console.log(page);
    const res = await ws.getRequest(page);
    $scope.whitems = res;
    $scope.$apply();
    return;
  }
  $scope.getItembyTypes = async () => {
    if (!$scope.dia_mcategory) {
      alert("Enter Material Category");
      return;
    }
    //document.style.cursor = "wait";
    const page = `ItemTypes/${$scope.dia_mcategory}`;
    const res = await ws.getRequest(page);
    $scope.whitems = res;
    //document.style.cursor = "default";
    $scope.$apply();
  }
  document.getElementById("newbom").classList.add('menuactive');
  let _mode = "N";
  _checkmode();
  function _checkmode() {
    if (!$routeParams.mode) {
      _mode = "N";
      $scope.mode = "N";
      $scope.mrinpust = models.mrinputs;
      console.log("New Page");
      return;
    }
    const m = $routeParams.mode.toUpperCase();
    console.log(m);
    if (!m) {
      _mode = "N";
      $scope.mode = "N";
      $scope.mrinpust = models.mrinputs;
      console.log(_mode);
    }
    if (m === "E") {
      _mode = "E";
      $scope.mode = "E";
      console.log(_mode);
    }
    return;
  }
  $scope.gregorianDatepickerConfigdotravels = {
    allowFuture: true,
    dateFormat: "DD-MM-YYYY",
    defaultDisplay: "gregorian",
  };

  moment.locale("en");
  //moment.locale('ar-sa');
  $scope.locale = moment.locale();
  $scope.switchLocale = function (value) {
    moment.locale(value);
    $scope.locale = moment.locale();
  };
  moment.locale("en");
  //moment.locale('ar-sa');

  $scope.locale = moment.locale();
  $scope.switchLocale = function (value) {
    moment.locale(value);
    $scope.locale = moment.locale();
  };
  getBoqs();
  $scope.boqlist = [];
  $scope.boqinfo_dia = models.boqdata_dialog(false);
  console.log($scope.boqinfo_dia);
  get_projectinfo();
  function get_projectinfo() {
    let project_id = sessionStorage.getItem("nafco_project_current");
    let post_data = {
      naf_user: userinfo,
      project_no: project_id,
    };
    var req = $http.post(api_url + "Project/view.php", post_data);
    req.then((res) => {
      //console.log(res.data);
      if (res.data.msg === "1") {
        $scope.viewproject = res.data.data;
        //console.log($scope.viewproject);
        localStorage.removeItem("currentproject");
        localStorage.setItem(
          "pms_currentproject",
          JSON.stringify($scope.viewproject)
        );

        //console.log($scope.viewproject);
        $scope.newproject = res.data.data;
        //console.log($scope.ts);
      } else {
        alert(res.data.data);
      }
    });
  }

  $scope.autcompleatlist = {
    items: [],
    itemnos: [],
    itemnosti: [],
    finish: [],
  };
  autoCompleate();
  async function autoCompleate() {
    const mr = await import("./../services/mr.js").then((r) => new r.default());
    const res = await mr.apicall(mr.FormData(), "autocomplete");
    if (res?.msg !== 1) {
      alert(res.data);
      return;
    }
    $scope.autcompleatlist = {
      items: res.data.items,
      itemnos: res.data.itemnos,
      itemnosti: res.data.itemalthaiseer,
      finish: res.data.finish,
    };

    $scope.$apply();
  }
  $scope.itemlist = [];

  $scope.getitemsboq = ($event) => {
    console.log("working");
    // console.log($event.target.value);
    const srcname = document.getElementsByName("src_bom_item_model")[0].value;
    AllItems(srcname);
  };

  async function AllItems(x) {
    $scope.itemlist = [];
    const mr = await import("./../services/mr.js").then((r) => new r.default());
    const fd = mr.FormData();
    fd.append("params", x);
    const res = await mr.apicall(fd, "mritems");
    if (res?.msg !== 1) {
      alert(res.data);
      return;
    }
    $scope.itemlist = res.data;
    $scope.$apply();
    return;
  }
  async function getBoqs() {
    $scope.boqlist = [];
    const mi = await import("./../services/mr.js").then((n) => new n.default());
    const fd = mi.FormData();

    fd.append("project_enc", sessionStorage.getItem("nafco_project_current"));
    const res = await mi.apicall(fd, "getboq");

    if (res?.msg !== 1) {
      alert(res.data);
      return;
    }

    $scope.boqlist = res.data;
    $scope.$apply();
  }
  $scope.show_boq_dialog = false;
  $scope.getboqinfo = (id) => {
    if (+id === 0) {
      return;
    }
    $scope.show_boq_dialog = true;
    _getBoqinfo(id);
    return;
  };
  $scope.setSystemNewStatus = (_status) => {
    $scope.show_boq_dialog = _status;
  };
  async function _getBoqinfo(id) {
    $scope.boqinfo_dia = models.boqdata_dialog(true);
    const mi = await import("./../services/mr.js").then((n) => new n.default());
    const fd = mi.FormData();
    fd.append("boqid", id);
    const res = await mi.apicall(fd, "boqinfo");
    if (res?.msg !== 1) {
      $scope.boqinfo_dia = models.boqdata_dialog(false);
      alert(res.data);
      $scope.$apply();
      return;
    }

    $scope.boqinfo_dia = models.boqdata_dialog(false, res.data);
    console.log($scope.boqinfo_dia);
    $scope.$apply();
    return;
  }
  // $scope.mrinpust = models.mrinputs;
  // $scope.materiallist = [];
  fillmodebase();
  //$scope.mode = "N";
  async function fillmodebase() {
    if (_mode === "E") {
      const mrview = await JSON.parse(localStorage.getItem("pms_print_mr_info"));
      console.log(mrview);
      $scope.mrinpust = {
        ...$scope.mrinpust,
        mrdate: mrview.infos.mrdates.normal,
        mrcode: mrview.infos.mrcode,
        mrno: mrview.infos.mrno,
        mrcheckedby: mrview.infos.mrcheckedby,
        mrapprovedby: mrview.infos.mrapprovedby,
        preparedby: mrview.infos.preparedby,
        releaseddate: mrview.infos.releaseddates.normal,
        mrflags: mrview.infos.mrflags,
      };

      console.log("This one", mrview.infos)

      $scope.materiallist = mrview.dt;
      console.log($scope.materiallist);
      TotlqtyCalc($scope.materiallist);
      $scope.$apply();
    } else {
      console.log(models.mrinputs);

      //console.log(_data);
      let currDate = new Date().toLocaleDateString('en-GB');
      let inputDate = new Date();
      $scope.mrinpust = models.mrinputs;
      $scope.mrinpust = {
        ...$scope.mrinpust,
        mrdate: `${inputDate.getDay()}-${inputDate.getMonth() + 1}-${inputDate.getFullYear()}`,
        preparedby: userinfo.user_name
      }
      $scope.materiallist = [];
    }

  }

  function _xcal() {
    const mrdieweight = document.getElementById("mrdieweight").value;
    const mrreqlength = document.getElementById("mrreqlength").value;
    const mrreqqty = document.getElementById("mrreqqty").value;
    const mravaiqty = document.getElementById("mravaiqty").value;
    const mrorderedqty = document.getElementById("mrorderedqty").value;

    //total weight calc
    let _mrdieweight = mrdieweight === "" || isNaN(mrdieweight) ? 0 : +mrdieweight;
    let _mrreqlength = mrreqlength === "" || isNaN(mrreqlength) ? 0 : +mrreqlength;
    let _mrreqqty = mrreqqty === "" || isNaN(mrreqqty) ? 0 : +mrreqqty;
    let required_tot_weight = 0;
    if (_mrreqlength === 0) {
      required_tot_weight = +_mrdieweight * +_mrreqlength * +_mrreqqty;
    } else {
      required_tot_weight = (+_mrdieweight * +_mrreqlength * +_mrreqqty) / 1000;
    }


    let _mravaiqty = mravaiqty === "" || isNaN(mravaiqty) ? 0 : +mravaiqty;
    let available_qty = 0;
    if (_mrreqlength !== 0) {
      available_qty = (+_mrdieweight * +_mrreqlength * +_mravaiqty) / 1000;
    } else {
      available_qty = +_mrdieweight * +_mrreqlength * +_mravaiqty;
    }

    const orderedqty = +_mrreqqty - +_mravaiqty;

    //let _mrorderedqty = mrorderedqty === "" || isNaN(mrorderedqty) ? 0 : (+mrorderedqty);
    let ordered_qty = 0;
    if (_mrreqlength === 0) {
      ordered_qty = (+_mrdieweight * +_mrreqlength * +orderedqty);
    } else {
      ordered_qty = +_mrdieweight * +_mrreqlength * +orderedqty / 1000;
    }


    $scope.mrinpust = {
      ...$scope.mrinpust,
      mrreqtotweight: required_tot_weight,
      mraviweight: available_qty,
      mrorderedqty: orderedqty,
      mrorderedweight: ordered_qty,
    };
  }
  $scope.calcu = () => {
    _xcal();

    //$scope.$apply();
  };

  $scope.calcux = () => {
    const mrdieweight = document.getElementById("mrdieweight").value;
    let _mrdieweight = mrdieweight === "" || isNaN(mrdieweight) ? 0 : +mrdieweight;
    const mrreqlength = document.getElementById("mrreqlength").value;
    let _mrreqlength = mrreqlength === "" || isNaN(mrreqlength) ? 0 : +mrreqlength;
    const mrorderedqty = document.getElementById("mrorderedqty").value;
    let ordered_wt = +_mrdieweight * +_mrreqlength * + (+mrorderedqty) / 1000;
    $scope.mrinpust = {
      ...$scope.mrinpust,     
      mrorderedweight: ordered_wt,
    };
  }
  $scope.boqiteminfo = "";
  $scope.poq_item_no = "";
  $scope.getInfoboqiteminfo = () => {
    const val = $scope.mrinpust.mrboqno;
    if (+val === 0) {
      $scope.boqiteminfo = "Miscellaneous";
      $scope.poq_item_no = "0";
      $scope.mrinpust = {
        ...$scope.mrinpust,
        mrfinish: "-",
      };
      return;
    }
    const findval = $scope.boqlist.find((x) => x.poq_id === val);
    $scope.boqiteminfo = findval.ptype_name;
    $scope.poq_item_no = findval.poq_item_no;
    // $scope.mrinpust = {
    //   ...$scope.mrinpust,
    //   mrfinish: findval.finish_name,
    // };
    return;
    //document.getElementById("mravaiqty").focus();
  };

  function _validate() {
    const mrdate = document.getElementById("mrdate");
    const mrcode = document.getElementById("mrcode");
    const mrno = document.getElementById("mrno");
    const mrcheckedby = document.getElementById("mrcheckedby");
    const mrapprovedby = document.getElementById("mrapprovedby");
    const mritem = document.getElementById("mritem");
    const mrpartno = document.getElementById("mrpartno");
    const mrpartnotai = document.getElementById("mrpartnotai");
    const mrdieweight = document.getElementById("mrdieweight");
    const mrreqlength = document.getElementById("mrreqlength");
    const mrreqqty = document.getElementById("mrreqqty");
    const mrreqtotweight = document.getElementById("mrreqtotweight");
    const mrboqno = document.getElementById("mrboqno");
    const mravaiqty = document.getElementById("mravaiqty");
    const mraviweight = document.getElementById("mraviweight");
    const mrorderedqty = document.getElementById("mrorderedqty");
    const mrorderedweight = document.getElementById("mrorderedweight");
    const mrfinish = document.getElementById("mrfinish");


    if (mrdate.value === "") {
      alert("Enter Date");
      mrdate.focus();
      return false;
    }
    if (mrcode.value === "") {
      alert("Enter Code");
      mrcode.focus();
      return false;
    }
    if (mrno.value === "") {
      alert("Enter Mr NO");
      mrno.focus();
      return false;
    }
    if (mrcheckedby.value === "") {
      alert("Enter Checked By");
      mrcheckedby.focus();
      return false;
    }
    if (mrapprovedby.value === "") {
      alert("Enter Approved By");
      mrapprovedby.focus();
      return false;
    }
    if (mritem.value === "") {
      alert("Enter Item");
      mritem.focus();
      return false;
    }
    // if (mrpartno.value === "") {
    //   alert("Enter Part No");
    //   mrpartno.focus();
    //   return false;
    // }
    // if (mrpartnotai.value === "") {
    //   alert("Enter Part No Taiseer");
    //   mrpartnotai.focus();
    //   return false;
    // }
    // if (mrdieweight.value === "") {
    //   alert("Enter Die Weight");
    //   mrdieweight.focus();
    //   return false;
    // }
    // if (mrreqlength.value === "") {
    //   alert("Enter Required Lenght");
    //   mrreqlength.focus();
    //   return false;
    // }
    if (mrreqqty.value === "") {
      alert("Enter Required Qty");
      mrreqqty.focus();
      return false;
    }

    // if (mrreqtotweight.value === "") {
    //   alert("Enter Required  Qty");
    //   mrreqtotweight.focus();
    //   return false;
    // }
    if (mrboqno.value === "") {
      alert("Enter BOQ Number");
      mrboqno.focus();
      return false;
    }

    // if (mravaiqty.value === "") {
    //   alert("Enter Available Qty");
    //   mravaiqty.focus();
    //   return false;
    // }
    // if (mraviweight.value === "") {
    //   alert("Enter Available Weight");
    //   mraviweight.focus();
    //   return false;
    // }
    // if (mrorderedqty.value === "") {
    //   alert("Enter Ordered Qty");
    //   mrorderedqty.focus();
    //   return false;
    // }
    // if (mrorderedweight.value === "") {
    //   alert("Enter Ordered Weight");
    //   mrorderedweight.focus();
    //   return false;
    // }

    // if (mrfinish.value === "") {
    //   alert("Enter Finish");
    //   mrfinish.focus();
    //   return false;
    // }
    return true;
  }
  function itemaddtolist() {
    const validate = _validate();
    if (!validate) return;
    const mrremarks = document.getElementById("mrremarks").value;
    const _remarks = mrremarks.trim() === "" ? "-" : mrremarks.trim();
    $scope.mrinpust = {
      ...$scope.mrinpust,
      boqiteminfo: $scope.boqiteminfo,
      poq_item_no: $scope.poq_item_no,
      mrremarks: _remarks,
    };
    console.log($scope.mrinpust?.mrpartno || "notig");
    const _data = {
      boqiteminfo: $scope.boqiteminfo,
      poq_item_no: $scope.poq_item_no,
      mrproject: sessionStorage.getItem("nafco_project_current_sno"),
      mrdate: $scope.mrinpust?.mrdate || '',
      mrcode: $scope.mrinpust?.mrcode || '-',
      mrno: $scope.mrinpust?.mrno || '-',
      mrcheckedby: $scope.mrinpust?.mrcheckedby || '-',
      mrapprovedby: $scope.mrinpust?.mrapprovedby || '-',
      mritem: $scope.mrinpust?.mritem || '-',
      mrpartno: $scope.mrinpust?.mrpartno || '-',
      mrpartnotai: $scope.mrinpust?.mrpartnotai || '-',
      mrdieweight: $scope.mrinpust?.mrdieweight || '0',
      mrreqlength: $scope.mrinpust?.mrreqlength || '0',
      mrreqqty: $scope.mrinpust?.mrreqqty || '0',
      mrreqtotweight: $scope.mrinpust?.mrreqtotweight || '0',
      mrboqno: $scope.mrinpust?.mrboqno || '0',
      mravaiqty: $scope.mrinpust?.mravaiqty || '0',
      mraviweight: $scope.mrinpust?.mraviweight || '0',
      mrorderedqty: $scope.mrinpust?.mrorderedqty || '0',
      mrorderedweight: $scope.mrinpust?.mrorderedweight || '0',
      mrfinish: $scope.mrinpust?.mrfinish || '-',
      mrremarks: $scope.mrinpust?.mrremarks || '-',
      releaseddate: $scope.mrinpust?.releaseddate || models._today(),
      mrunit: $scope.mrinpust?.mrunit || '-',
      preparedby: $scope.mrinpust?.preparedby || '-',
    }

    $scope.materiallist.push(_data);
    console.log("data", _data, "list", $scope.materiallist);

    $scope.mrinpust = {
      ...$scope.mrinpust,
      boqiteminfo: "",
      poq_item_no: "",
      mrproject: sessionStorage.getItem("nafco_project_current_sno"),
      mritem: "",
      mrpartno: "",
      mrpartnotai: "",
      mrdieweight: "",
      mrreqlength: "",
      mrreqqty: "",
      mrreqtotweight: "",
      mrboqno: "",
      mrboqdescription: "",
      mravaiqty: "",
      mraviweight: "",
      mrorderedqty: "",
      mrorderedweight: "",
      mrcby: "",
      mreby: "",
      mrcdate: "",
      mredate: "",
      mrfinish: "",
      mrremarks: "",
      releaseddate: "",
      mrunit: "",
      preparedby: '',
    };
    $scope.boqiteminfo = "";
    TotlqtyCalc($scope.materiallist);
  }

  async function _saveData() {
    const mr = await import("./../services/mr.js").then((r) => new r.default());
    const fd = mr.FormData();
    fd.append("params", JSON.stringify($scope.materiallist));
    const res = await mr.apicall(fd, "mrsave");
    if (res?.msg !== 1) {
      alert(res.data);
      $scope.$apply();
      return;
    }
    localStorage.removeItem("pms_print_mr_info");
    localStorage.setItem("pms_print_mr_info", JSON.stringify(res.data));
    window.open(`${print_location}/sprint/mr.html`, "_blank");


    $scope.mrinpust = {
      mrid: "",
      mrproject: sessionStorage.getItem("nafco_project_current_sno"),
      mrcode: "",
      mrno: "",
      mrdate: "",
      mrdates: "",
      mritem: "",
      mrpartno: "",
      mrpartnotai: "",
      mrdieweight: "",
      mrreqlength: "",
      mrreqqty: "",
      mrreqtotweight: "",
      mrboqno: "",
      mrboqdescription: "",
      mravaiqty: "",
      mraviweight: "",
      mrorderedqty: "",
      mrorderedweight: "",
      mrcby: "",
      mreby: "",
      mrcdate: "",
      mredate: "",
      mrfinish: "",
      mrremarks: "",
      mrcheckedby: "",
      mrapprovedby: "",
      releaseddate: "",
      mrunit: "",
      preparedby: '',
    };
    $scope.materiallist = [];
    $scope.$apply();
    return;
  }

  function _updatedata() { }
  $scope.savedata = async () => {
    if ($scope.mode === "E") {
      //localStorage.removeItem("pms_print_mr_info_method");
      window.open(`${print_location}/sprint/mr.html`, "_blank");
      return;
    }
    await _saveData();
  };
  $scope.printdata = () => {
    window.open(`${print_location}/sprint/mr.html`, "_blank");
    return;
}
  $scope.insert_data = ($event) => {
    console.log($scope.mode);
    if ($event.which === 13) {
      $scope.mode === "N" ? itemaddtolist() : ItemTODb();
    }
  };
  async function ItemTODb() {
    $scope.mrinpust = {
      ...$scope.mrinpust,
      mrproject: sessionStorage.getItem("nafco_project_current_sno"),
    };
    const mr = await import("./../services/mr.js").then((r) => new r.default());
    const fd = mr.FormData();
    fd.append("params", JSON.stringify($scope.mrinpust));
    const res = await mr.apicall(fd, "newmr");
    if (res?.msg !== 1) {
      alert(res?.data);
      return;
    }
    alert("Updated");
    const mrview = await res.data;
    $scope.mrinpust = {
      ...$scope.mrinpust,
      mrdate: mrview.infos.mrdates.normal,
      mrcode: mrview.infos.mrcode,
      mrno: mrview.infos.mrno,
      mrcheckedby: mrview.infos.mrcheckedby,
      mrapprovedby: mrview.infos.mrapprovedby,
      mritem: "",
      mrpartno: "",
      mrpartnotai: "",
      mrdieweight: "",
      mrreqlength: "",
      mrreqqty: "",
      mrreqtotweight: "",
      mrboqno: "",
      mrboqdescription: "",
      mravaiqty: "",
      mraviweight: "",
      mrorderedqty: "",
      mrorderedweight: "",
      mrcby: "",
      mreby: "",
      mrcdate: "",
      mredate: "",
      mrfinish: "",
      mrremarks: "",
      mrunit: "",
      preparedby: '',
    };

    $scope.materiallist = mrview.dt;
    localStorage.removeItem("pms_print_mr_info");
    localStorage.setItem("pms_print_mr_info", JSON.stringify(res.data));
    console.log($scope.mrinpust);
    TotlqtyCalc($scope.materiallist);
    return;
  }
  $scope.add_new_item_click = () =>
    $scope.mode === "N" ? itemaddtolist() : ItemTODb();
  $scope.totalinfos = {
    stavi: 0,
    sttotwt: 0,
    rqqty: 0,
    reqwt: 0
  };
  function TotlqtyCalc(x = []) {
    console.log(x);
    $scope.totalinfos = {
      rqqty: 0,
      reqwight: 0,
      stavi: 0,
      sttotwt: 0,
      rqqty: 0,
      reqwt: 0
    };
    let stavi = 0;
    let sttotwt = 0;
    let rqqty = 0;
    let reqwt = 0;
    console.log($scope.materiallist);
    x.map(i => {
      stavi += (+i.mravaiqty);
      sttotwt += (+i.mraviweight);
      rqqty += (+i.mrorderedqty);
      reqwt += (+i.mrorderedweight);
    })
    $scope.totalinfos = {
      stavi: stavi,
      sttotwt: sttotwt,
      rqqty: rqqty,
      reqwt: reqwt
    };

    console.log($scope.totalinfos);
    // try {
    //   $scope.$apply();
    // } catch (e) {
    //   console.log(e);
    // }

  }

  const show_auto_complete_items = document.getElementById(
    "show_auto_complete_items"
  );
  show_auto_complete_items.style.display = "none";
  $scope.show_search_dialogs = () => {
    show_auto_complete_items.style.display = "flex";
    document.getElementsByName("src_bom_item_model")[0].focus();
  };
  $scope.removeitems = (id) => {

    $scope.materiallist.splice(id, 1);
    TotlqtyCalc($scope.materiallist);
  };

  $scope.bomitemselect_click = (x) => {
    $scope.mrinpust = {
      ...$scope.mrinpust,
      mritem: x.itemdescription,
      mrpartno: x.itempartno,
      mrdieweight: x.itemdieweight,
    };

    show_auto_complete_items.style.display = "none";
    document.getElementById("mrpartnotai").focus();
  };
  $scope.closecurrent = () => {
    show_auto_complete_items.style.display = "none";
  };

  function _frw(code) {
    switch (code) {
      case "R":
        document.getElementById("mrcode").focus();
        return;
      case "M":
        document.getElementById("mrno").focus();
        return;
      case "C":
        document.getElementById("mrcheckedby").focus();
        return;
      case "A":
        document.getElementById("mrapprovedby").focus();
        return;
      case "A":
        document.getElementById("mritem").focus();
        return;
      case "mrpartno":
        document.getElementById("mrpartno").focus();
        return;
      case "mrpartnotai":
        document.getElementById("mrpartnotai").focus();
        return;
      case "mrdieweight":
        document.getElementById("mrdieweight").focus();
        return;
      case "mrreqlength":
        document.getElementById("mrreqlength").focus();
        return;
      case "mrreqqty":
        document.getElementById("mrreqqty").focus();
        return;
      case "mrboqno":
        document.getElementById("mrboqno").focus();
        return;
      case "mraviweight":
        document.getElementById("mraviweight").focus();
        return;
      case "mrfinish":
        document.getElementById("mrfinish").focus();
        return;
      case "mrremarks":
        document.getElementById("mrremarks").focus();
        return;
    }
  }

  $scope.moveTOnxtContrl = ($event, code) => {
    //console.log($event.which);
    if ($event.which === 13) {
     // document.getElementById(code).focus();
      //_frw(code);
    }
  };

  $scope.deleteitems = async (id, p, c, n) => {
    console.log("working");
    const mr = await import("./../services/mr.js").then((r) => new r.default());
    const fd = mr.FormData();
    let params = {
      mrproject: p,
      mrcode: c,
      mrno: n,
    };
    fd.append("mrid", id);
    fd.append("params", JSON.stringify(params));
    const res = await mr.apicall(fd, "removemr");
    if (res?.msg !== 1) {
      alert(res.data);
      return;
    }
    const mrview = await res.data;
    $scope.mrinpust = {
      ...$scope.mrinpust,
      mrdate: mrview.infos.mrdates.normal,
      mrcode: mrview.infos.mrcode,
      mrno: mrview.infos.mrno,
      mrcheckedby: mrview.infos.mrcheckedby,
      mrapprovedby: mrview.infos.mrapprovedby,
    };

    $scope.materiallist = mrview.dt;
    console.log($scope.materiallist);
    localStorage.removeItem("pms_print_mr_info");
    localStorage.setItem("pms_print_mr_info", JSON.stringify(res.data));
    TotlqtyCalc($scope.materiallist);
    $scope.$apply();
  };

  show_auto_complete_items.style.display = "none";
  $scope.search_box = () => {
    show_auto_complete_items.style.display = "flex";
  }

  $scope.calcgridChnage = ($event, id) => {
    const _data = $scope.materiallist[id];
    console.log(_data);
    let mrreqlength = $scope.materiallist[id].mrreqlength;
    let mrreqqty = $scope.materiallist[id].mrreqqty;
    let mravaiqty = $scope.materiallist[id].mravaiqty;
    let mrdieweight = $scope.materiallist[id].mrdieweight;

    let mrreqtotweight = ((+mrdieweight) * (+mrreqlength) * (+mrreqqty)) / 1000;
    let mraviweight = ((+mrdieweight) * (+mrreqlength) * (+mravaiqty)) / 1000;
    let balanceorder = (+mrreqtotweight) - (+mraviweight)
    let mrorderedweight = ((+mrdieweight) * (+mrreqlength) * (+balanceorder)) / 1000;
    $scope.materiallist[id].mrreqtotweight = mrreqtotweight;
    $scope.materiallist[id].mraviweight = mraviweight;
    $scope.materiallist[id].mrorderedqty = balanceorder;
    $scope.materiallist[id].mrorderedweight = mrorderedweight;
    TotlqtyCalc($scope.materiallist);
  }
  $scope.isposting = false
  $scope.postmr = async () => {
    console.log("working")
    if ($scope.isposting) return;
    const c = confirm("Are You Sure Post This M.R");
    if (!c) return;
    $scope.isposting = true;
    const mr = await import("./../services/mr.js").then((r) => new r.default());
    const fd = mr.FormData();
    let infos = JSON.parse(localStorage.getItem("pms_print_mr_info"));
    fd.append("project", infos.infos.mrproject);
    fd.append("mrno", infos.infos.mrno);


    const res = await mr.apicall(fd, "mrpost");
    if (res?.msg !== 1) {
      $scope.isposting = false;
      alert(res.data);
      $scope.$apply();
      return;
    }
    localStorage.removeItem('pms_print_mr_info');
    localStorage.setItem("pms_print_mr_info", JSON.stringify(res.data));
    window.history.back();
  }

  $scope.unpostmr = async () => {
    console.log("working")
    if ($scope.isposting) return;
    const c = confirm("Are You Sure Post This M.R");
    if (!c) return;
    $scope.isposting = true;
    const mr = await import("./../services/mr.js").then((r) => new r.default());
    const fd = mr.FormData();
    let infos = JSON.parse(localStorage.getItem("pms_print_mr_info"));
    fd.append("project", infos.infos.mrproject);
    fd.append("mrno", infos.infos.mrno);


    const res = await mr.apicall(fd, "mrupost");
    if (res?.msg !== 1) {
      $scope.isposting = false;
      alert(res.data);
      $scope.$apply();
      return;
    }
    localStorage.removeItem('pms_print_mr_info');
    localStorage.setItem("pms_print_mr_info", JSON.stringify(res.data));
    window.history.back();
  }
  $scope.upatemr = {
    diashow: false,
    isloading: false,
    data: {
      mrid: 0,
      mritem: "",
      mrpartno: "",
      mrpartnotai: "",
      mrdieweight: "",
      mrreqlength: "",
      mrreqqty: "",
      mrunit: "",
      mrreqtotweight: "",
      mrboqno: "",
      mravaiqty: "",
      mraviweight: "",
      mrorderedqty: "",
      mrorderedweight: "",
      mrfinish: "",
      mrremarks: "",
    }
  }
  $scope.edititem = (x) => {
    $scope.upatemr = {
      diashow: true,
      isloading: false,
      data: {
        mrid: x.mrid,
        mritem: x.mritem,
        mrpartno: x.mrpartno,
        mrpartnotai: x.mrpartnotai,
        mrdieweight: x.mrdieweight,
        mrreqlength: x.mrreqlength,
        mrreqqty: x.mrreqqty,
        mrunit: x.mrunit,
        mrreqtotweight: x.mrreqtotweight,
        mrboqno: x.mrboqno,
        mravaiqty: x.mravaiqty,
        mraviweight: x.mraviweight,
        mrorderedqty: x.mrorderedqty,
        mrorderedweight: x.mrorderedweight,
        mrfinish: x.mrfinish,
        mrremarks: x.mrremarks,
      }
    }
  }

  $scope.calNewAreas = ($event) => EditDiaCalc();
  function EditDiaCalc() {
    const mrdieweight = $scope.upatemr?.data?.mrdieweight ?? 0;
    const mrreqlength = $scope.upatemr?.data?.mrreqlength ?? 0;
    const mrreqqty = $scope.upatemr?.data?.mrreqqty ?? 0;
    const mravaiqty = $scope.upatemr?.data?.mravaiqty ?? 0;

    const mrorderedqty = $scope.upatemr?.data?.mrorderedqty ?? 0;

    let totwight = (+mrdieweight) * ((+mrreqlength) / 1000) * (+mrreqqty);
    let aviweight = (+mrdieweight) * ((+mrreqlength) / 1000) * (+mravaiqty);
    let ordwt = (+mrdieweight) * ((+mrreqlength) / 1000) * (+mrorderedqty);

    $scope.upatemr = {
      ...$scope.upatemr,
      data: {
        ...$scope.upatemr.data,
        mrreqtotweight: Math.round(totwight),
        mraviweight: Math.round(aviweight),
        mrorderedweight: Math.round(ordwt),
      }
    }

  }

  $scope.UpdateMr = async () => {
    const mr = await import("./../services/mr.js").then((r) => new r.default());
    const fd = mr.FormData();
    
    fd.append("projectno", sessionStorage.getItem("nafco_project_current_sno"));
    fd.append("mrno", $scope.mrinpust.mrno);
     fd.append("payload", JSON.stringify($scope.upatemr.data));
    const res = await mr.apicall(fd, "updatemrx");
    
    if (res?.msg !== 1) {
      alert(res.data);
      return;
    }
    alert("Data has updated")
    localStorage.removeItem('pms_print_mr_info');
    localStorage.setItem("pms_print_mr_info", JSON.stringify(res.data));
    window.location.reload();
    return;

  }


 
  // window.onscroll = (e) => {
  //   console.log(e);
  // }
}
