<?php
session_start();
include_once("conf.php");
//echo $_SESSION['nafco_alu_user_department'];

if (!isset($_SESSION['nafco_alu_user_department'])) {
?>
    <script>
        location.href = "<?php echo $url_router ?>logout.php";
    </script>
    <?php
} else {
    if ($_SESSION['nafco_alu_user_department'] === "") {
    ?>
        <script>
            location.href = "<?php echo $url_router ?>logout.php";
        </script>
        <?php
    } else {     
        if($_SESSION['nafco_alu_user_department'] === 'ita')   {
            ?>
            <script>
                alert("You Cannot access This Site....");
            </script>
            <?php
        }else{

        
        ?>
        <script>
            location.href = "<?php echo $url_router?>Dashboard/"
        </script>
        <?php      
        }
           
    }
}
?>