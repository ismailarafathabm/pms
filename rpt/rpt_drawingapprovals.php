<html>

<head>
    <title>Nafco Drawings Approvals Report Print</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Teko&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Squada+One&display=swap" rel="stylesheet">

    <style>
        @page {
            size: A4 portride;
            margin: 5px;
        }

        table {
            border-collapse: collapse;
            font-family: 'Roboto Slab', serif;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
            font-size: 9px;
            padding: 1px;
        }

        table th {
            background-color: black;
            color: white;
            text-align: left;
        }

        #con {
            padding: 3px;
        }
    </style>
</head>

<body>
    <div id="con">
        <table id="tb">

        </table>
    </div>

    <script>
        var tbl_data = localStorage.getItem("rpt_techapprovals");
        var t = document.getElementById("tb");
        t.innerHTML = tbl_data;
        window.print();
    </script>
</body>

</html>