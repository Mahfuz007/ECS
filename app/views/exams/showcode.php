<?php require APPROOT . '/views/inc/header.php';?>

<div class="container-lg">
    <div class="row">
        <div class="col-9">
            <h2>Submission Details</h2>
            <p>Submission ID: <?php echo $data->id;?></p>
            <p>User ID: <?php echo $data->userId;?></p>
            <p>Exam ID: <?php echo $data->examId;?></p>
            <p>Problem ID: <?php echo $data->problemId;?></p>
            <p>Verdict:
                 <?php 
                    if($data->res == "ACCEPTED")
                    { 
                    ?> 
                        <span style="color: green;"><strong > Accepted </strong></span>
                    <?php
                    }
                    else 
                    {
                    ?> 
                        <span style="color: red;"><strong> Wrong Answer </strong></span>
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
