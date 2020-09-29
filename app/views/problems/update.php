<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container-lg">
    <div class="row">
        <!-- Main Part -->
        <div class="col-9">
            <div class="container ui segment">
                <h2 class="center">Update Problem details</h2>
                <form class="ui form error" autocomplete="off" action="<?php echo URLROOT; ?>problems/update/<?php echo $data['id']; ?>" method="POST">

                    <div>
                        <?php if (isset($_SERVER['HTTP_REFERER'])) {
                            $previous = $_SERVER['HTTP_REFERER']; ?>
                            <input type="hidden" name="url" value="<?php echo $previous ?>">
                        <?php } ?>
                    </div>

                    <div class="required field">
                        <label for="name">Enter Problem Name:</label>
                        <input type="text" name="name" value="<?php echo $data['name']; ?>" required>
                    </div>
                    <div class="required field">
                        <label for="marks">Enter Problem Marks:</label>
                        <input type="text" name="marks" value="<?php echo $data['marks']; ?>" required>
                    </div>

                    <div class="required field">
                        <label for="description">Enter Problem Description:</label>
                        <textarea name="description" id="description" cols="30" rows="10" required><?php echo $data['description']; ?></textarea>
                    </div>

                    <div class="required field">
                        <label for="input">Input Test Cases:</label>
                        <textarea name="input" id="input" required><?php echo $data['input']; ?></textarea>
                    </div>
                    <div class="required field">
                        <label for="output">Output Test Cases:</label>
                        <textarea name="output" id="output" required><?php echo $data['output']; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-success center">Update</button>
                </form>
            </div>
        </div>

        <!-- Right Side Bar -->
        <?php include APPROOT . '/views/inc/rightSideBar.php'; ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>