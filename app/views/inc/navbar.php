<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="<?php echo URLROOT; ?>">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT;?>problems/all">Archives</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Custom Test</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT . 'pages/about'; ?>">About</a>
            </li>
        </ul>

        <?php if (isset($_SESSION['id'])) : ?>
            <ul class="nav navbar-nav navbar-right">
                <li style="margin-right: 1rem;">
                    <a href="<?php echo URLROOT; ?>users/profile/<?php echo $_SESSION['id']; ?>"><?php echo $_SESSION['name']; ?></a>
                </li>

                <li>
                    <a href="<?php echo URLROOT; ?>users/logout">
                        Sign Out
                    </a>
                </li>
            </ul>
        <?php else : ?>
            <form class="form-inline mt-2 mt-md-0" method="POST" action="<?php echo URLROOT; ?>users/login">
                <input class="form-control mr-sm-2" name="id" type="text" placeholder="id" aria-label="ID">
                <input class="form-control mr-sm-2" name="pass" type="password" placeholder="Password" aria-label="Password">

                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Sign In</button>
                <br>
            </form>
            
            <a class="btn btn-outline-success my-2 my-sm-0" href="<?php echo URLROOT;?>users/register">Sign Up</a>
        <?php endif; ?>

    </div>
</nav>