<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container-lg">

    <div class="row">
        <div class="col-9">
            <div class="container-fluid ui segment">
                <div class="row">
                    <div class="col-md-9  admin-content" id="profile">

                        <div class="panel panel-info" style="margin: 1em;">
                            <div class="panel-heading">
                                <h3 class="panel-title">Name</h3>
                            </div>
                            <div class="panel-body">
                                <?php echo $data->name; ?>
                            </div>
                        </div>
                        <div class="panel panel-info" style="margin: 1em;">
                            <div class="panel-heading">
                                <h3 class="panel-title">User ID</h3>
                            </div>
                            <div class="panel-body">
                                <?php echo $data->id; ?>
                            </div>
                        </div>
                        <div class="panel panel-info" style="margin: 1em;">
                            <div class="panel-heading">
                                <h3 class="panel-title">Category</h3>

                            </div>
                            <div class="panel-body">
                                <?php echo $data->category; ?>
                            </div>
                        </div>

                        <div class="panel panel-info" style="margin: 1em;">
                            <div class="panel-heading">
                                <h3 class="panel-title">Email</h3>

                            </div>
                            <div class="panel-body">
                                <?php echo $data->email; ?>
                            </div>
                        </div>

                        <div class="panel panel-info" style="margin: 1em;">
                            <div class="panel-heading">
                                <h3 class="panel-title">Phone</h3>

                            </div>
                            <div class="panel-body">
                                <?php echo $data->phone; ?>
                            </div>
                        </div>

                    </div>


                    <div class="col ui small image">
                        <img 
                            src="<?php echo URLROOT;?>avatar/<?php echo $data->avatar ;?>"
                            alt="profile image"
                        >
                    </div>
                </div>

            </div>


            <div class="container ui segment">
                <!-- side panel for Student-->

                <?php
                if ($data->category == "Student") {
                ?>

                    <div class="col-md-3">
                        <div class="panel panel-info" style="margin: 1em;">
                            <div class="panel-heading">
                                <!-- <h3 class="panel-title">Participated Exam</h3> -->
                                <p style="font-size: 17px;" class="panel-title"> <strong> Participated Exam </strong></p>

                            </div>
                            <div class="panel-body">
                                <li>Last Exam</li>
                                <li>Last Last Exam</li>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

                <!-- Side panel for Teachers -->

                <?php
                if ($data->category == "Teacher") {
                ?>
                    <div class="t-panel">
                        <a target="_blank" href="<?php echo URLROOT; ?>exams/all/<?php echo $data->id;?>" class="btn btn-primary"><i class="paper plane icon"></i>All Exams</a>
                        <br>
                        <a target="_blank" href="<?php echo URLROOT; ?>exams/create" class="btn btn-success"><i class="plus icon"></i>Create Exam</a>
                    </div>

                <?php
                }

                ?>
            </div>
        </div>

        <!-- right sidebar -->
        <?php include APPROOT . '/views/inc/rightSideBar.php'; ?>

    </div>

</div>

<?php require APPROOT . '/views/inc/footer.php' ?>