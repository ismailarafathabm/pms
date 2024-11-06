
<body style="display: flex;flex-direction: column;align-items: center;justify-content: top;min-height: 100vh;">
    <div style="width: 95%;box-shadow:1px 3px 5px #000;padding:25px">
        <?php

        if (!isset($_GET['foldertoken']) || $_GET['foldertoken'] == "") {
        ?>
            <script>
                window.history.back();
            </script>
        <?php
        } else {
        ?>
            <div style="font-size:25px;margin-bottom:20px;display:inline-block">
                CUTTING LIST AND MO UPLOADED - FILES
            </div>
            <?php
            if ($handle = opendir('assets/cuttinglist/' . $_GET['foldertoken'] . '/')) {
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
                        echo "<div style='margin-top:13px;'><a target='_blank' href='assets/cuttinglist/" . $_GET['foldertoken'] . "/" . $entry . "\n'>" . $entry . " - download</a></div>";
                        ?>
                        <?php
                        echo "<div style='margin-top:13px;'><a href='fileremove.php?index=cuttinglist&folder=". $_GET['foldertoken']."&filename=". $entry . "\n'>Delete</a></div>";
                        ?>
                        <div class="margin-top:20px;">
                            <object data="assets/cuttinglist/<?php echo $_GET['foldertoken'] ?>/<?php echo $entry ?>" type="application/pdf" width="100%" height="900px" style="padding:5px;">
                                <p>View PDF : <a href="assets/cuttinglist/<?php echo $_GET['foldertoken'] ?>/<?php echo $entry ?>">to the PDF!</a></p>
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
            // $dir    = ;
            // $files1 = scandir($dir);
            // $files2 = scandir($dir, 1);

            // //print_r($files1);
            // print_r($files2);
        }

        ?>
    </div>
</body>