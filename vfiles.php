<body style="display: flex;flex-direction: column;align-items: center;justify-content: top;min-height: 100vh;">
    <div style="width: 95%;box-shadow:1px 3px 5px #000;padding:25px">
        <?php
        extract($_GET);

        if (isset($page) && $page !== "") {
            switch ($page) {
                case 'glasssorder':
                    if (isset($folder) && $folder !== '') {
                        $fbath = "assets/glassorder/" . $folder . "/";
                        if (file_exists($fbath)) {
        ?>
                            <div style="font-size:25px;margin-bottom:20px;display:inline-block">
                                Glass Order UPLOADED - FILES
                            </div>
                            <?php
                            if ($handle = opendir('assets/glassorder/' . $folder . '/')) {
                                // echo "Directory handle: $handle\n";
                                // echo "Entries:\n";

                                /* This is the correct way to loop over the directory. */
                                $i = 0;
                                while (false !== ($entry = readdir($handle))) {
                                    if ($i == 0) {
                                    } else if ($i == 1) {
                                    } else {
                            ?>



                                        <?php
                                        echo "<div style='margin-top:13px;'><a target='_blank' href='assets/glassorder/" . $folder . "/" . $entry . "\n'>" . $entry . " - download</a></div>";
                                        ?>
                                        <?php
                                        echo "<div style='margin-top:13px;'><a href='fileremove.php?index=glassorder&folder=" . $folder . "&filename=" . $entry . "\n'>Delete</a></div>";
                                        ?>
                                        <div class="margin-top:20px;">
                                            <object data="assets/glassorder/<?php echo $folder ?>/<?php echo $entry ?>" type="application/pdf" width="100%" height="900px" style="padding:5px;">
                                                <p>View PDF : <a href="assets/glassorder/<?php echo $folder ?>/<?php echo $entry ?>">to the PDF!</a></p>
                                            </object>
                                        </div>

                            <?php
                                    }
                                    $i += 1;
                                }

                                /* This is the WRONG way to loop over the directory. */
                                while ($entry = readdir($handle)) {
                                    echo "$entry\n";
                                }

                                closedir($handle);
                            }
                            ?>
        <?php
                        } else {
                            echo 'error: this folder not exists in this server...';
                        }
                    } else {
                        echo 'error:folder Name Missing...';
                    }
                    break;
                default:
                    echo 'error:this page not found in this server...';
                    break;
            }
        } else {
            echo "error";
        }
        ?>
    </div>
</body>