<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container-lg">
    <div class="row">
        <!-- Main Part -->
        <div class="col-9">
            <div class="container ui segment">
                <h2>Create Problem</h2>
                <form class="ui form error" autocomplete="off" action="<?php echo URLROOT; ?>problems/create/<?php echo $data['examId'];?>/<?php echo $data["author"];?>" method="POST">

                    <div>
                      <?php  if (isset($_SERVER['HTTP_REFERER'])) {
                            $previous = $_SERVER['HTTP_REFERER'];?>
                            <input type="hidden" name="url" value="<?php echo $previous?>">
                       <?php }?>
                    </div>
                    <div class="required field">
                        <label for="name">Enter Problem Name:</label>
                        <input type="text" name="name" value="<?php echo $data['name']; ?>" required>
                    </div>

                    <div class="required field">
                        <label for="problem-description">Enter Problem Description:</label>
                        <textarea name="problem-description" id="problem-description" cols="30" rows="10" value="<?php echo $data['description']; ?>" required></textarea>
                    </div>

                    <div class="required field">
                        <label for="input-case">Input Test Cases:</label>
                        <textarea name="input-case" id="input-case" value="<?php echo $data['input']; ?>" required></textarea>
                    </div>
                    <div class="required field">
                        <label for="output-case">Output Test Cases:</label>
                        <textarea name="output-case" id="output-case" value="<?php echo $data['output']; ?>" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Create Problem</button>
                </form>
            </div>
        </div>

        <!-- Right Side Bar -->
        <?php include APPROOT . '/views/inc/rightSideBar.php'; ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>