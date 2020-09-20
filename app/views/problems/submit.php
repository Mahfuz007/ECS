<?php require APPROOT . '/views/inc/header.php'; ?>
<?php 
    flash('invalid-id','alert alert-danger');
    flash('failed','alert alert-danger');
    //echo "<pre>$data</pre>";
;?>
<div class="container-lg">
    <div class="row">
        <!-- Main Part -->
        <div class="col-9">
            <div class="container ui segment">
                <h2 class="center">Submit your code</h2>
                <?php if (!empty($data->name)) { ?>
                    <h4>Problem Name: <?php echo $data->name; ?></h4>
                <?php }; ?>
                <form class="ui form" autocomplete="off" action="<?php echo URLROOT; ?>problems/submission" method="POST">
                    <div class="field">

                        <?php if (!empty($data->id)) { ?>
                            <input type="hidden" name="problem-id" value="<?php echo $data->id; ?>">
                        <?php } else {; ?>
                            <label for="">Enter Problem Id</label>
                            <input type="text" name="problem-id" required>
                        <?php } ?>

                        <label for="language">Select Language</label>
                        <select class="form-control" name="language" required>
                            <option value="c">C</option>
                            <option value="cpp">C++</option>
                        </select>
                        <label for="">Please Enter Your Source Code</label>
                        <textarea onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}" name="submit-code" rows="15" cols="70"></textarea>

                    </div>
                    <div>
                        <button class="ui button center" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side Bar -->
        <?php include APPROOT . '/views/inc/rightSideBar.php'; ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>