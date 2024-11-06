<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @font-face {
            font-family: 'wh';
            src: url('themes/fonts/segoeui/segoeui.ttf');
        }

        * {
            padding: 0;
            margin: 0;
            font-family: 'wh';
        }

        body {
            padding: 10px;
        }

        .loaddata {
            border: 1px solid #000;
            padding: 3px
        }

        table {
            border-collapse: collapse;
            border: 1px solid #000;
        }

        table th,
        table td {
            border: 1px solid #000;
            font-size: 0.85rem;
            padding: 0.3rem;
        }

        table th {
            font: 15px 500;
            background-color: #f1f1f1;
            padding: 3px 5px;
        }
    </style>
</head>

<body>
    <button type="button" id="hide_btn" onclick="import_data()">
        Import
    </button>
    <div id="loaddata">

    </div>
    <script>
        async function import_data() {
            const fd = new FormData();
            let fddata = []
            _data.map(d => {
                fddata.push({
                    goproject: d.projectno,
                    goprojectname: d.pjname,
                    gonumber: d.gono,
                    gosupplier: d.supplier,
                    gomarking: d.marking,
                    goqty: d.qty,
                    goarea: d.sqm,
                    godate: d.date,
                    procurment_orderunitprice: d.unitprice,
                    procurement_totalprice: d.toprice,
                    goreceipttype: d.otype,
                    broken_naf_by: d.bkby,
                    dellocation: d.delloc,
                });
            })
            console.log(fddata);
            fd.append('payload', JSON.stringify(fddata));
            const url = "./api/gos/goimport.php";
            const req = await fetch(url, {
                method: 'post',
                body: fd
            });

        }
        let _data = [];
        fetchdatas();
        async function fetchdatas() {
            document.getElementById("hide_btn").style.display = "none";
            const url = "./api/gos/nimport.json";
            const req = await fetch(url);
            const res = await req.json();
            console.log(res);
            _data = await res;
            console.log(_data);
            document.getElementById("hide_btn").style.display = "block";


            let p = `<table>`
            p += `<thead>`
            p += `<tr>`;
            p += `<th>S.NO</th>`;
            p += `<th>Date</th>`;
            p += `<th>O.Type</th>`;
            p += `<th>Supplier</th>`;
            p += `<th>Project</th>`;
            p += `<th>Project Name</th>`;
            p += `<th>GO#</th>`;
            p += `<th>qty</th>`;
            p += `<th>Sqm</th>`;
            p += `<th>Unit Price</th>`;
            p += `<th>Price</th>`;
            p += `<th>Bk By</th>`;
            p += `<th>del lock</th>`;
            p += `<th>Marking</th>`;
            p += `</tr>`;
            p += `</thead>`
            p += `<tbody>`;
            _data.map((i, index) => {
                p += `<tr>`;
                p += `<td>${index+1}</td>`
                p += `<td>${i.date}</td>`
                p += `<td>${i.otype}</td>`
                p += `<td>${i.supplier}</td>`
                p += `<td>${i.projectno}</td>`
                p += `<td>${i.pjname}</td>`
                p += `<td>${i.gono}</td>`
                p += `<td>${i.qty}</td>`
                p += `<td>${i.sqm}</td>`
                p += `<td>${i.unitprice}</td>`
                p += `<td>${i.toprice}</td>`
                p += `<td>${i.bkby}</td>`
                p += `<td>${i.delloc}</td>`
                p += `<td>${i.marking}</td>`
                p += `</tr>`;
            })
            p += `</tbody>`;
            p += `</table>`
            document.getElementById("loaddata").innerHTML = p;
        }
    </script>
</body>

</html>