<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container-lg">
    <div class="row">
        <!-- Main Part -->
        <div class="col-9">
            <div class="container ui segment">
                <h2 class="center">My Submission</h2>
                <table class="table">
                    <thead class="table table-striped table-dark">
                        <tr>
                            <th scope="col">When</th>
                            <th scope="col">Problem Name</th>
                            <th scope="col">Verdict</th>
                            <th scope="col">Language</th>
                        </tr>
                    </thead>
                    
                    <tbody class=".table-striped">
                        <?php foreach($data as $problem) {;?>
                            <tr>
                                <td><?php echo $problem->date ;?></td>
                                <td><a href="<?php echo URLROOT;?>/problems/show/<?php echo $problem->problemId;?>"><?php echo $problem->name ;?></a></td>
                                <td style="color: <?php echo ($problem->res=="ACCEPTED")?"green":"red" ;?> "><strong><?php echo $problem->res ;?></strong></td>
                                <td><?php echo $problem->language ;?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right Side Bar -->
        <?php include APPROOT . '/views/inc/rightSideBar.php'; ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>