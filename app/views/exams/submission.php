<?php require APPROOT . '/views/inc/header.php';?>

<div class="container-lg">
    <div class="row">
        <div class="col-9">
            <h2>Contest Submissions</h2>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>SubmissionId</th>
                    <th>Time</th>
                    <th>UserID</th>
                    <th>ProblemID</th>
                    <th>Language</th>
                    <th>Verdict</th>
                </tr>
                <?php
                    foreach ($data as $key => $value)
                    {
                    ?>
                        <tr>
                        <td><a href="<?php echo URLROOT;?>/exams/showcode/<?php echo $value->id;?>"><?php echo $value->id; ?></a></td>
                            <td><?php echo $value->date; ?></td>
                            <td><?php echo $value->userid; ?></td>
                            <td><?php echo $value->problemid; ?></td>
                            <td><?php echo $value->language; ?></td>
                            <?php
                                if ($value->res == "ACCEPTED")
                                    {
                            ?>
                                    <td><p style="color: green;"><strong><?php echo ucwords(strtolower($value->res)); ?></strong></p></td>
                            <?php
                                    }
                                    else
                                    {
                            ?>
                                        <td><p style="color: red;"><strong><?php echo ucwords(strtolower($value->res)); ?></strong></p></td>
                             <?php
                                    }
                            ?>

                        </tr>
                <?php
                    }
                ?>

            </table>
        </div>
        <?php include APPROOT . '/views/inc/rightSideBar.php';?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php';?>