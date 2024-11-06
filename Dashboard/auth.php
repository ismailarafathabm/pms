<?php

if (
    !isset($_SESSION["nafco_alu_user_name"],
    $_SESSION["nafco_alu_user_token"],
    $_SESSION["nafco_alu_user_department"])
) {
?>
    <script>
        location.href = "<?php echo $url_router ?>index.php";
    </script>
    <?php
} else {
    if ($_SESSION["nafco_alu_user_department"] === "") {
    ?>
        <script>
            location.href = "<?php echo $url_router ?>logout.php";
        </script>
    <?php
    } else if ($_SESSION["nafco_alu_user_department"] === "its") {
    ?>
        <script>
            locaiton.href = "<?php echo $url_router ?>Admins/"
        </script>
<?php
    } else {
    }
}
?>