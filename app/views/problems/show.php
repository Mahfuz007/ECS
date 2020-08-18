<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container-lg">
    <div class="row">
        <!-- Main Part -->
        <div class="col-9">
            <div class="container ui segment">
                <h2 class="center"><?php echo $data->name;?></h2>
                <p>Problem Id: <?php echo $data->id;?></p>
                <p>Author: <a href="<?php echo URLROOT;?>users/profile/<?php echo $data->userid;?>"><?php echo $data->author ;?></a></p>
                <p><?php echo $data->description;?></p>
                <a class="ui primary button center" href="<?php echo URLROOT;?>problems/submit/<?php echo $data->id;?>">Submit</a>
            </div>
        </div>
        
        <!-- Right Side Bar -->
        <?php include APPROOT . '/views/inc/rightSideBar.php';?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>