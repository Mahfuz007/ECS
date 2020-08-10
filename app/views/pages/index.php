<?php require APPROOT . '/views/inc/header.php'; ?>

<!-- Display flash message -->
<?php 
flash('register');
flash('login-success');
flash('login-failed','alert alert-danger');
?>

<div class="container-lg">
    <div class="row">
        <!-- Main Part -->
        <div class="col-9">
            <h1> <?php echo $data['title']; ?> </h1>
        </div>
        
        <!-- Right Side Bar -->
        <?php include APPROOT . '/views/inc/rightSideBar.php';?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>