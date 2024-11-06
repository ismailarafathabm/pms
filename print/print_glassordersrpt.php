<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAFCO - PRINT</title>
    <style>
        @font-face {
            font-family: roboto;
            src: url('../themes/fonts/roboto/Roboto-Regular.ttf');
        }

        @font-face {
            font-family: overpass;
            src: url('../themes/fonts/Overpass/Overpass-Regular.ttf');
        }



        @font-face {
            font-family: muli;
            src: url('../themes/fonts/muli/Muli-Regular.ttf');
        }

        body {
            box-sizing: border-box;
            padding: 1px;
            margin: 0px;
        }

        .errordiv {
            width: 50%;
            margin: 100px auto;
            background-color: pink;
            border: 1px solid maroon;
            padding: 16px;
            backdrop-filter: blur(2px);
            border-radius: 3px;
            box-shadow: 5px 9px 11px 0px #ffdfe5;
            font-size: 1.3rem;
            font-family: roboto;
            color: #4d0000;
        }

        table {
            border-collapse: collapse;

            font-family: roboto;
            font-size: 12px;
        }

        table th {
            background-color: #c4d0d2;
            color: #000;
        }

        table td {
            border: 1px solid #000 !important;
            padding: 5px;
            font-size: 12px;

        }

        table th {
            border: 1px solid #000 !important;
            padding: 5px;
            font-size: 12px;


        }


        .headcell {
            background-color: #d6e0f0;
            font-weight: bold;
        }

        .main-title {
            margin-top: 0px;
            font-family: muli;
            font-weight: 600;
            color: #4d0000;
        }

        .main_div {
            display: block;
            margin-bottom: 40px;
            padding: 10px;
            margin-right: 25px;

        }

        .projectinfo {
            font-family: overpass;
            font-weight: 600;
            background: #fbfbfb;
            padding: 5px;
            margin-bottom: 7px;
            border-radius: 6px;
            border: 1px dashed;
        }

        .title_tos {
            float: right;
            color: #b70000;
        }

        h3 {
            font-family: roboto;
        }

        .main_div>.totalinfo {
            position: absolute;
            right: 0px;
            padding: 5px;
            border: 1px dashed #a90000;
            border-radius: 5px;
            background: #ff000017;
            font-weight: 600;
            font-size: 14px;
            font-family: roboto;
            color: #670000;
            margin-top: 5px;
            margin-bottom: 20px;
            margin-right: 35px;
        }

        @page {
            size: A4;
            size: landscape;
        }

        @media print {
            .prtbtn {
                display: none;
            }

            body {

                box-sizing: border-box;
                padding: 1px;
                margin: 0px;
            }

            button {
                display: none;
            }
        }
    </style>
</head>

<body>
    <button type="print" onclick="window.print()">Print</button>
    <h3>Glass Orders - Reports</h3>

    <div id="print_data"></div>



</body>
<script>
    if (localStorage.getItem('print_glassorderreport')) {
        var infos = localStorage.getItem('print_glassorderreport');
        document.getElementById('print_data').innerHTML = infos;
        localStorage.removeItem('print_glassorderreport');
    }
</script>

</html>