<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container-lg">
    <div class="row">
        <!-- Main Part -->
        <div class="col-9">

            <?php if ($_SESSION['id'] != $data[sizeof($data) - 1]->author && date("Y-m-d H:i:s") < $data[sizeof($data) - 1]->begin_time) { ?>
                <div class="container ui segment">
                    <div class="timer">
                        <span class="" id="hours">00</span>
                        :
                        <span class="" id="minutes">00</span>
                        :
                        <span class="" id="seconds">00</span>
                    </div>
                    <input type="hidden" name="_time" value="<?php echo strtotime($data[sizeof($data) - 1]->begin_time); ?>">
                </div>
            <?php } else { ?>

                <div class="container ui segment">

                    <h1 class="center">Exam Information</h1>

                    <!-- Exam details -->
                    <div class="row">
                        <div class="col-10">
                            <p><strong>Type: </strong><?php echo $data[sizeof($data) - 1]->type; ?></p>
                        </div>
                        <div class="col-2">

                            <?php if ($data[sizeof($data) - 1]->author == $_SESSION['id']) { ?>
                                <a class="text-secondary" target="_blank" href="<?php echo URLROOT; ?>exams/standing/<?php echo $data[sizeof($data) - 1]->id; ?>"><strong>Standing</strong></a>
                            <?php } ?>

                        </div>
                    </div>

                    <p><strong>Title: </strong><?php echo $data[sizeof($data) - 1]->title; ?></p>
                    <p><strong>Date and Time: </strong><?php echo $data[sizeof($data) - 1]->begin_time; ?> <strong><span class="text-success"><?php echo (date("Y-m-d H:is") > $data[sizeof($data) - 1]->end) ? "(Ended)" : ""; ?></span></strong>

                        <strong><span class="text-danger"><?php echo (date("Y-m-d H:is") <= $data[sizeof($data) - 1]->end && date("Y-m-d H:is") >= $data[sizeof($data) - 1]->begin_time) ? "(Running)" : ""; ?></span></strong>

                    </p>


                    <p><strong>Duration: </strong><?php echo $data[sizeof($data) - 1]->duration; ?></p>
                    <div class="row">
                        <div class="col-10">
                            <p><strong>Author: <a target="_blank" href="<?php echo URLROOT; ?>users/profile/<?php echo $data[sizeof($data) - 1]->author; ?>"><?php echo $data[sizeof($data) - 1]->authorName; ?></a></strong></p>
                        </div>
                        <div class="col-2">
                            <a style="display: <?php ($_SESSION['id']!=$data[sizeof($data) - 1])?"none":"";?>" href="<?php echo URLROOT;?>exams/update/<?php echo $data[sizeof($data) - 1]->id;?>"><i class="sync icon"></i></a>
                        </div>

                    </div>

                    <input type="hidden" name="_time" value="<?php echo null ?>">


                    <!-- Display Problem Set -->
                    <h2 class="center">Problem Set</h2>

                    <?php $x = 'A'; ?>

                    <?php for ($i = 0; $i < sizeof($data) - 1; $i++) { ?>
                        <div class="ui celled list">
                            <div class="item">
                                <div class="shadow p-3">

                                    <a style="display: <?php ($_SESSION['id']!=$data[sizeof($data) - 1])?"none":"";?>" href="<?php echo URLROOT; ?>problems/delete/<?php echo $data[$i]->id; ?>"><i class="trash alternate icon text-danger"></i></a>

                                    <a target="_blank" href="<?php echo URLROOT; ?>problems/show/<?php echo $data[$i]->id; ?>"><?php echo $x++; ?></a>
                                    -
                                    <a target="_blank" href="<?php echo URLROOT; ?>problems/show/<?php echo $data[$i]->id; ?>"><?php echo $data[$i]->name; ?></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>



        <!-- Right Side Bar -->
        <?php include APPROOT . '/views/inc/rightSideBar.php'; ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>