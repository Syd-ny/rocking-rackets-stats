<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?=$router->generate('main-home')?>">Rocking Rackets stats</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="<?=$router->generate('main-home')?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?=$router->generate('player-list')?>">Players <span class="sr-only">(current)</span></a>
                </li>
                

                    <?php if(isset($_SESSION['user'])):?>
                        <a class="nav-link" href="<?=$router->generate('security-logout')?>">Logout</a>
                    <?php else :?>
                        <a class="nav-link" href="<?=$router->generate('security-login')?>">Login</a>
                    <?php endif ?>
                </li>
            </ul>
        </div>
    </div>
</nav>