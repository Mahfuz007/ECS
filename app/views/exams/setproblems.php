<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container-lg">
    <div class="row">
        <!-- Main Part -->
        <div class="col-9">
            <div class="container ui segment">
                <h2 class="center">Problem Set</h2>
                <a class="btn" href="<?php echo URLROOT;?>problems/create/<?php echo $data[sizeof($data)-1]->id;?>/<?php echo $data[sizeof($data)-1]->author;?>"><i class="plus icon"></i>Add Problem</a>

                <?php if(sizeof($data)>1){?>
                    <h3 class="center">Problem List</h3>
                <?php } ?>

                <?php for($i=0;$i<sizeof($data)-1;$i++){?>
                    <div class="ui celled list">
                        <div class="item">
                            <div  class="shadow p-3">
                                <a target="_blank" href="<?php echo URLROOT;?>problems/show/<?php echo $data[$i]->id;?>"><?php echo $data[$i]->id;?></a>
                                - 
                                <a target="_blank" href="<?php echo URLROOT;?>problems/show/<?php echo $data[$i]->id;?>"><?php echo $data[$i]->name;?></a>
                            </div>
                        </div>
                    </div>
                <?php } ?> 

                <div class="field">
                    <a class="btn btn-success" href="<?php echo URLROOT;?>exams/show/<?php echo $data[sizeof($data)-1]->id;?>">Finish</a>
                </div>

            </div>
        </div>

        <!-- Right Side Bar -->
        <?php include APPROOT . '/views/inc/rightSideBar.php'; ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>