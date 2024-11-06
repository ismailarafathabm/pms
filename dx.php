<!DOCTYPE html>
<html>

<head>
    <style>
        .hiddenRow {
            display: none;
        }

        .detailRow {
            background-color: pink;
        }

        .visibleRow {
            background-color: orange;
        }
    </style>
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script>
        function showDetail(selector) {
            // console.log("selector = "+ selector);      
            if ($(selector).hasClass("hiddenRow")) {
                $(selector).removeClass("hiddenRow");
            } else {
                $(selector).addClass("hiddenRow");
            }

        };
    </script>
</head>

<body>
    <h1>Master Detail Table!</h1>
    <div>This is an answer to a stackoverflow question regarding a master detail table. The question is:
        <a href="http://stackoverflow.com/questions/17651358/">html nested table hide or show table last td by clicking table row first td</a>
    </div>
    <h2>The master-detail-demo </h2>
    <div>
        <table class="toptable" border="1">
            <tbody>
                <tr class="accordion">
                    <td class="id1 n1">
                        <button onClick="showDetail('#m1-detail');">show detail</button>
                    </td>
                    <td class="id1 n1">master row 1</td>
                    <td class="id1 n1">some </td>
                    <td class="nested">information</td>
                </tr>
                <tr id="m1-detail" class="hiddenRow">
                    <td></td>
                    <td colspan="3">
                        <table border="1">
                            <tbody>
                                <tr>
                                    <td>nestedTD1</td>
                                    <td>nestedTD2</td>
                                </tr>
                                <tr>
                                    <td>nestedTD3</td>
                                    <td>nestedTD4</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr class="accordion">
                    <td class="id1 n1">
                        <button onClick="showDetail('#m2-detail');">show detail</button>
                    </td>
                    <td class="id1 n1">master row 1</td>
                    <td class="id1 n1">some </td>
                    <td class="nested">information</td>
                </tr>
                <tr id="m2-detail" class="hiddenRow">
                    <td></td>
                    <td colspan="3">
                        <table border="1">
                            <tbody>
                                <tr>
                                    <td>nestedTD1</td>
                                    <td>nestedTD2</td>
                                </tr>
                                <tr>
                                    <td>nestedTD3</td>
                                    <td>nestedTD4</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>