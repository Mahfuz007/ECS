<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container-lg">
    <div class="row">
        <!-- Main Part -->
        <div class="col-9">
            <div class="container ui segment">

            <h2 class="center">Current or Upcoming Exams</h2>
                <table class="table">
                    <thead class="table table-striped table-dark">
                        <tr>
                            <th scope="col">When</th>
                            <th scope="col">Title</th>
                            <th scope="col">Type</th>
                        </tr>
                    </thead>
                    
                    <tbody class=".table-striped">
                        <?php foreach($data as $exam) {;?>

                            <?php if(date("Y-m-d H:i:s") < $exam->end){ ?>
                                <tr>
                                    <td><?php echo (date("Y-m-d H:i:s")>= $exam->begin_time && date("Y-m-d H:i:s") <= $exam->end)?"Running       ":$exam->begin_time;?></td>
    
                                    <td><a href="<?php echo URLROOT;?>/exams/show/<?php echo $exam->id;?>"><?php echo $exam->title ;?></a></td>
    
                                    <td><?php echo $exam->type ;?></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>

                <h2 class="center">Privious Exams</h2>
                <table class="table">
                    <thead class="table table-striped table-dark">
                        <tr>
                            <th scope="col">When</th>
                            <th scope="col">Title</th>
                            <th scope="col">Type</th>
                        </tr>
                    </thead>
                    
                    <tbody class=".table-striped">
                        <?php foreach($data as $exam) {;?>

                            <?php if(date("Y-m-d H:i:s") > $exam->end){ ?>
                                <tr>
                                    <td><?php echo $exam->begin_time ;?></td>
    
                                    <td><a href="<?php echo URLROOT;?>/exams/show/<?php echo $exam->id;?>"><?php echo $exam->title ;?></a></td>
    
                                    <td><?php echo $exam->type ;?></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
        
        <!-- Right Side Bar -->
        <?php include APPROOT . '/views/inc/rightSideBar.php';?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>