                        <?php
                            if( isset($_SESSION['userIDloggedin'])) {
                                
                        ?>
<!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php?p=frontpage"><i class="fa fa-newspaper-o fa-fw"></i> Nyheder Admin</a>
            </div>
                <p class="navbar-text pull-right">Du er logget ind som: <?php echo ''.$_SESSION['firstNameLoggedIn'].' '.$_SESSION['lastNameLoggedIn'].'';?></p>
            <!-- /.navbar-header -->

            <!-- /.navbar-top-links -->

            <div class="navbar-inverse sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li>
                            <a href="index.php?p=users"><i class="fa fa-user fa-fw"></i> Brugere</a>
                        </li>
                        <li>
                            <a href="index.php?p=news"><i class="fa fa-newspaper-o fa-fw"></i> Nyheder</a>
                        </li>
                        <li>
                            <a href="index.php?p=feeds"><i class="fa fa-rss fa-fw"></i> RSS Feeds</a>
                        </li>
                        <li>
                            <a href="index.php?p=logout"><i class="fa fa-sign-out fa-fw"></i> Log Ud</a>
                        </li>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

            <?php
                            }
            ?>