<?php 
$pjno = "";
$pjname = "";
$cuttinglistno = "";
$mono = "";
$description = "";
$qty = "";
$area = "";
$units = "";
$engg = "";
$cdep = "";
$cdepd = "";
$to = "it@alunafco.net, nafcoit@alunafco.net";
$subject = "CUTTING LIST ENTRY REPORT";
$message = "<!DOCTYPE html>
<html>
<head>
    <title>NAFCO - CUTTING LIST</title>
    <style>
        *{
            margin:0;
            padding:0;            
        }
        body{
            width: 100%;
            font-family: sans-serif;
            font-size: 0.75rem;
        }
        body div{
            margin: 10px 10px;
        }
        table{
            border-collapse: collapse;
            border:1px solid #e9e5e5;
        }
        table td,
        table th{
            border-bottom: 1px solid #c1c1c1;
            padding : 5px;
            font-size: 0.75rem;
        }
        .main{
            background-color: #e5e5e5;            
            font-size: 0.75rem;
        }
        .sub{
            font-weight: bold;
            font-size: 0.75rem;
        }
    </style>
</head>
<body>
    <div>
        <table>
            <thead>                
                <tr>
                    <td class='main'>Project</td>
                    <td class='sub'>".$pjname." [".$pjno."]</td>
                </tr>                
            </thead>
            <tbody>
                <tr>
                    <td class='main'>Cutting List#</td>
                    <td class='sub'>".$cuttinglistno."</tr>
                </tr>
                <tr>
                    <td class='main'>MO#</td>
                    <td class='sub'>".$mono."</tr>
                </tr>
                <tr>
                    <td class='main'>Description</td>
                    <td class='sub'>".$description."</tr>
                </tr>
                <tr>
                    <td class='main'>Qty</td>
                    <td class='sub'>".$qty." [".$units."]</tr>
                </tr>
                <tr>
                    <td class='main'>Area</td>
                    <td class='sub'>".$area."</tr>
                </tr>
                <tr>
                    <td class='main'>Drawing</td>
                    <td class='sub'>".$engg."</tr>
                </tr>
                <tr>
                    <td class='main'>Department</td>
                    <td class='sub'>".$cdep." </tr>
                </tr>
                <tr>
                    <td class='main'>Release Date</td>
                    <td class='sub'>".$cdepd." </tr>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <report@alunafco.net>' . "\r\n";
$headers .= 'Cc: ismailarafath@gmail.com' . "\r\n";

mail($to,$subject,$message,$headers);
?>