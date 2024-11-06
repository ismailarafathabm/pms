const technical_system_datas = {
    techsysteid: "",
    techsyssystem: "",
    techsyseby: "",
    techsysecby: "",
    techsyscdate: "",
    techsysedate: "",
    techsysprojectid: sessionStorage.getItem("nafco_project_current_sno"),
}

export const technical_system_dia_model = {
    isloading: false,
    title: "Add New System",
    mode: 1,
    btn: "Save",
    data: technical_system_datas,
}

const technical_color_datas = {
    tcid: "",
    tcmaterial: '',
    tecdescription: '',
    tcsubmittedby: '',
    tcsubmitteddate: '',
    tcapprovedstatus: 'U',
    tcapproveddate: '',
    tcprojectid: sessionStorage.getItem("nafco_project_current_sno"),
}

export const technical_colors_model = {
    isloading: false,
    title: "Colors Approvals",
    mode: 1,
    btn: "Save",
    data: technical_color_datas,
}

const technical_hardware_data_model = {
    thid: "",
    thproject: sessionStorage.getItem("nafco_project_current_sno"),
    thsystem: "",
    thdescriptions: "",
    thnotes: "",
    thsubmittedby: "",
    thsubmitteddate: "",
    thstatus: "U",
    thsapprovedate: "",
}

export const technical_hardware_dialog_models = {
    isloading: false,
    mode: 1,
    btn: "Save",
    title: "Add New Hardware Submittal",
    data: technical_hardware_data_model
}

const technicalapprovals_data = {
    taid: "",
    taid: sessionStorage.getItem("nafco_project_current_sno"),
    taproject: "",
    taapproval: "",
    tadescription: "",
    taremarks: "",
    tasubmittedby: "",
    tasubmitteddate: "",
    tastatus: "U",
    taapproveddate: "",
    tacby: "",
    taeby: "",
    tacdate: "",
    taedate: "",
}

export const technicalapprovals_dialog_model = {
    isloading: false,
    mode: 1,
    btn: "Save",
    title: "Add New Hardware Submittal",
    data: technicalapprovals_data
}

const calculationsubmittal_data = {
    tcid: "",
    tcproject: sessionStorage.getItem("nafco_project_current_sno"),
    tcsubmitall: "",
    tcsubmittedby: "",
    tcsubmittaldate: "",
    tcstatus: "U",
    tcapproveddate: "",
    tcsubmittalno: "",
    tcsubmittalrv: "",
    tccby: "",
    tceby: "",
    tccdate: "",
    tcedate: "",
}

export const technicalcalculations_dialog_model = {
    isloading: false,
    mode: 1,
    btn: "Save",
    title: "Add New Calculation Submittal",
    data: calculationsubmittal_data
}


export const statuslist = [
    { code: "A", code_description: "A - Approved as Submitted" },
    { code: "B", code_description: "B - Approved as Noted" },
    { code: "BC", code_description: "BC - Approved with Conditions" },
    { code: "C", code_description: "C - Revise and resubmit" },
    { code: "D", code_description: "D - Rejected" },
    { code: "U", code_description: "U - Under review" },
    { code: "E", code_description: "E - For Information" },
    { code: "F", code_description: "F - Cancelled" },
]

export const fullaccessuers = ['demo', 'operation@alunafco.com'];


