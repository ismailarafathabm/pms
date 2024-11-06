<style>
    body{
        margin:0px;
        padding :0px;
    }
    body img{
        width:100%;
        height: 100%;
    }
  
</style>
<?php 
    session_start();
    //$active = false;
    $active = true;
    if($active === false){
        ?>
        <img src="maintenance.jpg">
        <?php
        exit();
    }
    include_once("conf.php");
?>
<html>
    <head>        
        <title><?php echo $site_name ?></title>
    </head>
    <body>
        <?php 
            if(!isset($_SESSION['nafco_alu_username'])){
                ?>
                <script>
                    location.href = "<?php echo $url_router?>login.php";
                </script>
                <?php
            }else{
                if($_SESSION['nafco_alu_username'] === ""){
                ?>
                <script>
                    location.href = "<?php echo $url_router?>login.php";
                </script>
                <?php 
                }else{
                    
                }
            }
        ?>
    </body>    
</html>