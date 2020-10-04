<?php require APPROOT . '/views/inc/header.php'; ?>
<?php
flash('invalid-id', 'alert alert-danger');
?>

<?php if(!empty($data->error)){ ?>
    <div class="alert alert-danger">
        <?php echo $data->error;?>
    </div>
<?php } ?>

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
                            <option <?php if (!empty($data->lang) && $data->lang == 'c') echo "selected"; ?> value="c">C</option>
                            <option <?php if (!empty($data->lang) && $data->lang == 'cpp') echo "selected"; ?> value="cpp">C++</option>
                            <option <?php if (!empty($data->lang) && $data->lang == 'java') echo "selected"; ?> value="java">JAVA</option>
                        </select>
                        <label for="">Please Write Your Source Code</label>
                        <textarea oncopy="return false" onpaste="return false" oncut="return false" onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}" name="submit-code" rows="15" cols="70"><?php echo (!empty($data->code) ? $data->code : ""); ?></textarea>
                        <!-- oncopy="return false" onpaste="return false" oncut="return false" -->

                    </div>
                    <div class="ui toggle checkbox">
                        <input type="checkbox" id="custom-test" onclick="addCustomTest()" <?php echo(!empty($data->checked)?$data->checked:
                        "") ;?>>
                        <label>Custom Test</label>
                    </div>
                    <div class="center">
                        <button class="ui positive button center " type="submit" name="action" value="submit-code">Submit</button>
                    </div>

                    <div style="display: <?php echo (!empty($data->checked)?"block":"none");?>" class="container ui segment" id="custom-field">
                        <div class="row">
                            <div class="col-6">
                                <label for=""><strong>Input</strong></label>
                                <textarea name="inputtext" rows="10" cols="40"><?php echo (!empty($data->input) ? $data->input : ""); ?></textarea></br>
                            </div>

                            <div class="col-6">
                                <label for=""><strong>Output</strong></label>
                                <textarea class="<?php echo (!empty($data->checked)?"shadow":"");?>" name="outputtext" rows="10" cols="40" disabled><?php echo (!empty($data->output) ? $data->output : ""); ?></textarea></br>
                            </div>
                        </div>
                        <br>
                        <div class="">
                            <button class="ui btn btn-primary" type="submit" type="submit" formaction="<?php echo URLROOT; ?>problems/submit">Run</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side Bar -->
        <?php include APPROOT . '/views/inc/rightSideBar.php'; ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>