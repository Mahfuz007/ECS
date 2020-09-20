<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container-lg">
    <div class="row">
        <!-- Main Part -->
        <div class="col-9">
            <div class="container ui segment">
                <h2 style="text-align: center;">Registration Form</h2>
                <form autocomplete="off" action="<?php echo URLROOT; ?>users/register" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id">ID: <sub>*</sub></label>
                        <input type="text" name="id" class="form-control <?php echo (!empty($data['id-error'])) ? "is-invalid" : ''; ?> " value="<?php echo $data['id']; ?>">
                        <span class="invalid-feedback"><?php echo $data['id-error']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Name: <sub>*</sub></label>
                        <input type="text" name="name" class="form-control <?php echo (!empty($data['name-error'])) ? "is-invalid" : ''; ?> " value="<?php echo $data['name']; ?>">
                        <span class="invalid-feedback"><?php echo $data['name-error']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email: <sub>*</sub></label>
                        <input type="email" name="email" class="form-control <?php echo (!empty($data['email-error'])) ? "is-invalid" : ''; ?> " value="<?php echo $data['email']; ?>">
                        <span class="invalid-feedback"><?php echo $data['email-error']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone: <sub>*</sub></label>
                        <input type="text" name="phone" class="form-control <?php echo (!empty($data['phone-error'])) ? "is-invalid" : ''; ?> " value="<?php echo $data['phone']; ?>">
                        <span class="invalid-feedback"><?php echo $data['phone-error']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="category">Category: <sub>*</sub></label>
                        <label class="radio-inline">
                            <input type="radio" name="category" checked="checked" value="Teacher">
                            Teacher
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="category" value="Student">
                            Student
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="avatar">Image: </label>
                        <input type="file" name="avatar" class="form-control <?php echo (!empty($data['avatar-error'])) ? "is-invalid" : ''; ?> ">
                        <span class="invalid-feedback"><?php echo $data['avatar-error']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="pass">Password: <sub>*</sub></label>
                        <input type="password" name="pass" class="form-control <?php echo (!empty($data['pass-error'])) ? "is-invalid" : ''; ?> " value="">
                        <span class="invalid-feedback"><?php echo $data['pass-error']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="confirm-pass">Confirm-Password: <sub>*</sub></label>
                        <input type="password" name="confirm-pass" class="form-control <?php echo (!empty($data['confirm-pass-error'])) ? "is-invalid" : ''; ?> " value="">
                        <span class="invalid-feedback"><?php echo $data['confirm-pass-error']; ?></span>
                    </div>

                    <button type="submit" name="submit" class="btn btn-success" value="submit">Submit</button>

                </form>
            </div>
        </div>

        <!-- Right Side Bar -->
        <?php include APPROOT . '/views/inc/rightSideBar.php'; ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>