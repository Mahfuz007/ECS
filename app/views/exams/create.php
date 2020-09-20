<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container-lg">
    <div class="row">
        <!-- Main Part -->
        <div class="col-9">
            <div class="container ui segment">
                <h2 class="center">Create Exam</h2>

                <form class="ui form" action="<?php echo URLROOT ;?>exams/create" method="POST">

                    <div class="field">
                        <label for="type">Type:</label>
                        <select name="type" id="type" required>
                            <option value="lab-exam" <?php (!empty($data['type']) && $data['type']=="lab-exam")?"selected":"";?> >Lab Exam</option>
                            <option value="lab-assesment" <?php (!empty($data['type']) && $data['type']=="lab-assesment")?"selected":"";?>>Lab Assesment</option>
                        </select>

                        <label for="title">Title:</label>
                        <input type="text" name="title" value="<?php echo (!empty($data['title']))? $data['title']:"";?>" required>

                        <label for="time">Begin Time: </label>
                        <input class="form-control" type="datetime" name="time" value="<?php echo (!empty($data['time']))? $data['time']:date('Y-m-d H:i:s',strtotime('+5 minutes'));?>" required>

                        <label for="duration">Duration: </label>
                        <input type="text" name="duration" value="<?php echo (!empty($data['title']))? $data['title']:"0:30";?>" required>

                    </div>

                    <button class="btn btn-primary center" type="submit">Next<i class="arrow alternate circle right icon"></i></button>
                
                </form>
            </div>
        </div>
        
        <!-- Right Side Bar -->
        <?php include APPROOT . '/views/inc/rightSideBar.php';?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>