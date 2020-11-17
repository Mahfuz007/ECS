<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container-lg">
    <div class="row">
        <!-- Main Part -->
        <div class="col-9">
            <div class="container ui segment">
                <h1 class="center">Review Registered Student</h1>

                <?php foreach ($data as $user) { ?>
                    <form action="<?php echo URLROOT; ?>exams/review/<?php echo $user->examid; ?>" method="post">
                        <div class="ui cards">
                            <div class="card">
                                <div class="content">
                                    <span class="header">
                                        <?php echo $user->studentid; ?>
                                    </span>
                                    <input type="hidden" name='sid' value="<?php echo $user->studentid; ?>">
                                    <button type="submit" name='action' value="accept" class="ui basic green button">Approve</button>
                                    <button type="submit" name='action' value="decline" class="ui basic red button">Decline</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>

        <!-- Right Side Bar -->
        <?php include APPROOT . '/views/inc/rightSideBar.php'; ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>