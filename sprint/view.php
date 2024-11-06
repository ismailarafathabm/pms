<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<iframe id="my_iframe" style="display:block;"></iframe>
<script>
    Download() 
function Download() {
    let url = "https://172.0.100.17:8082/PMS/assets/approvals/test.pdf";
    document.getElementById('my_iframe').src = url;
};
</script>
</body>
</html>