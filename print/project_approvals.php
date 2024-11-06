<html>

<head>

    <title>Nafco Approvals</title>
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
            size: A4;
            margin: 5px;
        }

        table {
            border-collapse: collapse;
            font-family: 'Roboto Slab', serif;
            font-size: 13px;
            width: 100%;
        }

        .table,
        th,
        td {
            border: 1px solid black;
            font-size: 8px;
        }
    </style>
</head>

<body>
    <table id="printval">

    </table>
    <script>
        var m = sessionStorage.getItem('tblinfos');
        document.getElementById('printval').innerHTML = m;
        console.log(m);
        window.print();
    </script>
</body>

</html>