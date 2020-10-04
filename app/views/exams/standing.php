<?php require APPROOT . '/views/inc/header.php';?>

<div class="container-lg">
    <div class="row">
        <div class="col-9">
            <h1>Standing</h1>

            <?php
                echo "<table class = \"table table-striped table-bordered\">";
                $firstrowmark = 0;
                foreach ($data as $key => $value)
                {
                    echo "<tr>";
                    echo "<td><strong>" . $key . "</strong></td>";

                    $totalscore = 0;
                    foreach ($value as $verdict)
                    {
                        if ($firstrowmark == 0)
                        {
                            echo "<td><strong>" . $verdict[0] . "</strong></td>";
                        }
                        else
                        {
                            //echo "<td><a href=\"#\">" . $verdict[0] . "</a></td>";
                            if ($verdict[0][0] == "Accepted")
                            {
                                echo "<td> <a class=\"text-secondary\" target=\"_blank\" href=\" " . URLROOT . "exams/submission/" . $key . "/" . $verdict[1] . "/" . $verdict[2] . " \"><p style=\"color:green;\"><strong>" . $verdict[0][0] ." (". $verdict[0][1].")" . "</strong></p></a> </td>";
                                $totalscore += $verdict[0][1];
                            }
                            else if($verdict[0][0] == "Wrong Answer")
                            {
                                echo "<td> <a class=\"text-secondary\" target=\"_blank\" href=\" " . URLROOT . "exams/submission/" . $key . "/" . $verdict[1] . "/" . $verdict[2] . " \"><p style=\"color:red;\"><strong>" .  $verdict[0][0] ." (". $verdict[0][1].")" . "</strong></p></a> </td>";
                            }
                            else 
                            {
                                echo "<td></td>";
                            }

                        }

                    }
                    if($firstrowmark == 0)
                    {
                       echo "<td><strong>Total Marks</strong></td>";
                    }
                    else
                    {
                        echo "<td><strong>". $totalscore."</strong></td>";
                    }
                    $firstrowmark = 1;
                    echo "</tr>";
                }
                echo "</table>";
                // echo "<pre>";
                // print_r($data);
                // echo "</pre>"
             ?>
        </div>
        <?php include APPROOT . '/views/inc/rightSideBar.php';?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php';?>
