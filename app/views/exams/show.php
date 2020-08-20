<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container-lg">
    <div class="row">
        <!-- Main Part -->
        <div class="col-9">
            <div class="container ui segment">

                <h1 class="center">Exam Information</h1>

                <!-- Exam details -->
                <p><strong>Type: </strong><?php echo $data[sizeof($data) - 1]->type; ?></p>
                <p><strong>Title: </strong><?php echo $data[sizeof($data) - 1]->title; ?></p>
                <p><strong>Date and Time: </strong><?php echo $data[sizeof($data) - 1]->begin_time; ?></p>
                <p><strong>Duration: </strong><?php echo $data[sizeof($data) - 1]->duration; ?></p>
                <p><strong>Author: <a target="_blank" href="<?php echo URLROOT; ?>/users/profile/<?php echo $data[sizeof($data) - 1]->author; ?>"><?php echo $data[sizeof($data) - 1]->authorName; ?></a></strong></p>
                

                <!-- Display Problem Set -->
                <h2 class="center">Problem Set</h2>

                <?php for ($i = 0; $i < sizeof($data) - 1; $i++) { ?>
                    <div class="ui celled list">
                        <div class="item">
                            <div class="shadow p-3">
                                <a target="_blank" href="<?php echo URLROOT; ?>problems/show/<?php echo $data[$i]->id; ?>"><?php echo $data[$i]->id; ?></a>
                                -
                                <a target="_blank" href="<?php echo URLROOT; ?>problems/show/<?php echo $data[$i]->id; ?>"><?php echo $data[$i]->name; ?></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Right Side Bar -->
        <?php include APPROOT . '/views/inc/rightSideBar.php'; ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>