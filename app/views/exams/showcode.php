<?php require APPROOT . '/views/inc/header.php';?>

<div class="container-lg">
    <div class="row">
        <div class="col-9">
            <h2><strong> Solution Details</strong></h2>
            <p><strong>Submission ID: <?php echo $data->id;?></strong></p>
            <p><strong>User ID: <?php echo $data->userId;?></strong></p>
            <p><strong>Exam ID: <?php echo $data->examId;?></strong></p>
            <p><strong>Problem ID: <?php echo $data->problemId;?></strong></p>
            <p><strong> Verdict:</strong>
                 <?php 
                    if($data->res == "ACCEPTED")
                    { 
                    ?> 
                        <span style="color: green;"><strong > Accepted </strong></span>
                    <?php
                    }
                    else if($data->res == "WRONG ANSWER")
                    {
                    ?> 
                        <span style="color: red;"><strong> Wrong Answer </strong></span>
                    <?php 
                    }
                    else
                    {
                    ?>
                        <span style="color: red;"><strong> Compilation Error </strong></span>
                    <?php
                    }
                    ?> 
            </p>
            <div class="form-group">
                <label for="code"><strong> Source Code</strong></label>
                <textarea readonly class="form-control" id="code" cols="30" rows="20" ><?php echo $data->code;?></textarea>
            </div>
        </div>
        <?php include APPROOT . '/views/inc/rightSideBar.php';?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php';?>
