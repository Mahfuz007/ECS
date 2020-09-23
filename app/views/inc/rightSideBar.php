<?php
$db = new Database();
$db->query('SELECT * from exam ORDER BY begin_time DESC');
$data = $db->resultSet();

for ($i = 0; $i < min(5, sizeof($data)); $i++) {
    //extract duration hour and minutes
    $end = explode(':', $data[$i]->duration);
    //add duration to start time
    $data[$i]->end = date('Y-m-d H:i:s', strtotime("+{$end[0]} hour +{$end[1]} minute", strtotime($data[$i]->begin_time)));
}
?>

<div class="col-3">
    <div class="container-fluid ui segment">
        <div class="ui cards">
            <div class="card">
                <?php for ($i = 0; $i < min(5, sizeof($data)); $i++) { ?>
                    <div class="content">
                        <div class="header">
                            <a href="<?php echo URLROOT;?>exams/show/<?php echo $data[$i]->id;?>">
                                <?php echo $data[$i]->title; ?>
                            </a>
                            
                        </div>
                        <div class="meta">
                            <?php echo $data[$i]->type; ?>
                        </div>
                        <div class="description">
                            <p><strong>Date and Time: </strong><?php echo $data[$i]->begin_time; ?> <strong><span class="text-success"><?php echo (date("Y-m-d H:is") > $data[$i]->end) ? "(Ended)" : ""; ?></span></strong>

                                <strong><span class="text-danger"><?php echo (date("Y-m-d H:is") <= $data[$i]->end && date("Y-m-d H:is") >= $data[$i]->begin_time) ? "(Running)" : ""; ?></span></strong>

                            </p>
                        </div>
                    </div>
                <?php }; ?>
            </div>
        </div>
    </div>
</div>