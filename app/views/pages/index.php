<?php require APPROOT . '/views/inc/header.php'; ?>

<!-- Display flash message -->
<?php
flash('register');
flash('login-success');
flash('login-failed', 'alert alert-danger');
?>

<div class="container-lg">
    <div class="row">
        <!-- Main Part -->
        <div class="col-9">
            <div class="ui conatiner segment">
                <h4> <?php echo $data['title']; ?> </h4>
                <div class="ui stacked segment">

                    <h1 class="display-4">Laboratory Examination Control System</h1>
                    <p>It is an online-based exam control system for the Department of Information Communication Engineering.</p>
                </div>

                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="https://upload.wikimedia.org/wikipedia/commons/3/3a/Fourth_science_building.jpg" alt="First slide" height="300px" width="400px">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSOLJaY1YTm9yeykuwJqLxdmOpuk_MjIUUX7A&usqp=CAU" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://bangladeshus.com/wp-content/uploads/2019/08/rajshahi-university-review-f.jpg" alt="Third slide" >
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Side Bar -->
        <?php include APPROOT . '/views/inc/rightSideBar.php'; ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>