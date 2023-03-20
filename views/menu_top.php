<header data-uid="<?php echo $_SESSION['userid']; ?>">
        <nav>
            <div class="top-nav">
                <a href="home.php" class="logo">
                    <img src="assets/images/Uitwerking logo cheapcart.svg" alt="logo">
                </a>
                <div class="profile">
                    <i class="fa fa-user"></i>
                    <a>Hallo,
                        <?php echo $_SESSION['firstname']; ?>
                    </a>
                </div>
            </div>

            <div class="bottom-nav">
                <h2>
                    <?php 
                    if(isset($page)){
                        echo $page;
                    }else{
                        echo "paginanaam";
                    }
                ?>
                </h2>
            </div>
        </nav>
    </header>