<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMPORT</title>
</head>

<body>
    <button id="saveclick" type="button">Import</button>
    <div>
        <table>
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Project</th>
                    <th>Project Name</th>
                    <th>For Account</th>
                    <th>To Account</th>
                    <th>Material For</th>
                    <th>Material To</th>
                    <th>Cutting List</th>
                    <th>Mo</th>
                    <th>Mr</th>                    
                    <th>Description</th>
                    <th>Location</th>
                    <th>Qty</th>
                    <th>Unit</th>
                    <th>Height</th>
                    <th>Width</th>
                    <th>area</th>
                    <th>go NO</th>
                    <th>Material Status</th>
                    <th>Material Ref NO</th>
                    <th>For Operation</th>
                    <th>To Operation</th>
                    <th>R production</th>
                </tr>
            </thead>
            <tbody id="print">

            </tbody>
        </table>
    </div>
    <script>
        let saveData = [];
        getAllData()
        async function getAllData() {
            const req = await fetch('http://localhost:8082/PMS/cuttinglist.json');
            const res = await req.json();
            let p = "";
            let sno = 0;
            res.map((i, index) => {
                const qty = i.qty.split("+")
                //console.log(qty);
                qty.map(j => {
                    const xu = j.split(" ");
                    console.log(xu);
                    
                    const qtys = xu.length;
                    let cqty = "";
                    let cunit = "";
                    if(qtys === 1){
                        cqty = xu[0];
                    }else{
                        cqty = xu[0];
                        cunit = xu[1];
                    }
                    if(cqty === "" || isNaN(cqty)){
                        cqty = 0;
                    }

                    saveData.push({
                        projectcode : i.projectcode,
                        projectname : i.projectname,
                        faccount : i.faccount,
                        raccount : i.raccount,
                        fmaterial : i.fmaterial,
                        rmaterial : i.rmaterial,
                        cuttinglistno : i.cuttinglistno,
                        monumber : i.monumber,
                        marking : i.marking,
                        description : i.description,
                        location : i.location,
                        qty : cqty,
                        units : cunit,
                        height : i.height,
                        width : i.width,
                        area : i.area,
                        gono : i.gono,
                        mstatus : i.mstatus,
                        mrefno : i.mrefno,
                        foperation : i.foperation,
                        roperation : i.roperation,
                        rproecution : i.rproecution,
                    });
                    sno += 1;
                    p += `<tr>`;
                    p += `<td>${sno}</td>`
                    p += `<td>${i.projectcode}</td>`
                    p += `<td>${i.projectname}</td>`
                    p += `<td>${i.faccount}</td>`
                    p += `<td>${i.raccount}</td>`
                    p += `<td>${i.fmaterial}</td>`
                    p += `<td>${i.rmaterial}</td>`
                    p += `<td>${i.cuttinglistno}</td>`
                    p += `<td>${i.monumber}</td>`
                    p += `<td>${i.marking}</td>`
                    p += `<td>${i.description}</td>`
                    p += `<td>${i.location}</td>`
                    p += `<td>${cqty}</td>`
                    p += `<td>${cunit}</td>`
                    p += `<td>${i.height}</td>`
                    p += `<td>${i.width}</td>`
                    p += `<td>${i.area}</td>`
                    p += `<td>${i.gono}</td>`
                    p += `<td>${i.mstatus}</td>`
                    p += `<td>${i.mrefno}</td>`
                    p += `<td>${i.foperation}</td>`
                    p += `<td>${i.roperation}</td>`
                    p += `<td>${i.rproecution}</td>`
                    p += `</tr>`;
                })



                // if (qty.length === 0) {

                // } else {
                //     for (var j = 0; j <= qty.length; j++) {

                //     }
                // }
                
            })
            document.getElementById("print").innerHTML = p;

        }

        document.getElementById("saveclick").addEventListener("click",async ()=>{
            const fd = new FormData();
            fd.append('import',JSON.stringify(saveData));
            const res = await fetch('api/ctnew.php',{
                method : "POST",
                body : fd
            });
            
        })
    </script>
</body>

</html>
