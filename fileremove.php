<?php
session_start();
if (isset($_SESSION['nafco_alu_user_name']) && $_SESSION['nafco_alu_user_name'] && isset($_SESSION['nafco_alu_user_department']) && $_SESSION['nafco_alu_user_department']) {
    $dep = $_SESSION['nafco_alu_user_department'];
    if ($dep === 'engineering') {

        echo "staring file removeing process.....";
        extract($_GET);
        echo "checking process.....";
        if (isset($index) && $index !== '') {
            switch ($index) {
                case 'cuttinglist':
                    if (isset($folder) && $folder !== '' && isset($filename) && $filename !== '') {
                        $del_file = "assets/cuttinglist/" . $folder . '/' . $filename;
                        if (file_exists($del_file)) {
                            unlink($del_file);
?>
                            <script>
                                alert("file removed....");
                                window.history.back();
                            </script>
                        <?php
                        } else {
                        ?>
                            <script>
                                alert("system can not find this file.....");
                                window.history.back();
                            </script>
                        <?php
                        }
                    } else {
                        echo "error";
                    }
                    break;
                case 'glassorder':
                    if (isset($folder) && $folder !== '' && isset($filename) && $filename !== '') {
                        $del_file = "assets/glassorder/" . $folder . '/' . $filename;
                        echo $del_file;
                        if (file_exists($del_file)) {
                            unlink($del_file);
                        ?>
                            <script>
                                alert("file removed....");
                                window.history.back();
                            </script>
                        <?php
                        } else {
                        ?>
                            <script>
                                //alert("system can not find this file.....");
                                //window.history.back();
                            </script>
<?php
                        }
                    } else {
                        echo "error";
                    }
                    break;
                default:
                    echo "error";
                    break;
            }
        } else {
            echo "Missing page informations";
        }
    } else {
        echo "You Can not Delete Engineering Department Files.......";
    }
} else {
    echo "Login Error....";
}
?>