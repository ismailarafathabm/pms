<?php 
    session_start();
    include_once("conf.php");    
    unset(
        $_SESSION["nafco_alu_user_name"],
        $_SESSION["nafco_alu_user_token"],
        $_SESSION["nafco_alu_user_department"],
        $_SESSION["nafco_alu_user_type"]        
    );
    session_destroy();
    
    ?>
    <script>
        location.href = "<?php echo $url_base?>";
    </script>
    <?php
?>