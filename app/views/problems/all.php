<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container-lg">
    <div class="row">
        <!-- Main Part -->
        <div class="col-9">
            <div class="container ui segment">
                <h1 class="center">Showing All Problems</h1>
                <?php foreach ($data as $data) { ?>
                    <div class="ui celled list">
                        <div class="item">
                            <div  class="shadow p-3">
                                <a target="_blank" href="<?php echo URLROOT;?>problems/show/<?php echo $data->id;?>"><?php echo $data->id;?></a>
                                - 
                                <a target="_blank" href="<?php echo URLROOT;?>problems/show/<?php echo $data->id;?>"><?php echo $data->name;?></a>
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