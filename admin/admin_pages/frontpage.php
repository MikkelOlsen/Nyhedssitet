<?php
    if( isset($_SESSION['userIDloggedin'])) {
        echo '<h2>Velkommen - '.$_SESSION['firstNameLoggedIn'].' '.$_SESSION['lastNameLoggedIn'].'</h2>';
    } else {
        echo '<div class="container">    
        
    <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3" style="margin-top:250px;"> 
        
        <div class="panel panel-default" >
            <div class="panel-heading">
                <div class="panel-title text-center">Dine Nyheder - Admin</div>
            </div>     

            <div class="panel-body" >

                <form action="index.php?p=login" name="form" id="form" class="form-horizontal" enctype="multipart/form-data" method="POST">
                   
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="username" type="text" class="form-control" name="username" placeholder="Brugernavn">                                        
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Adgangskode">
                    </div>                                                                  

                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button type="submit" href="#" name="login" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-log-in"></i> Log in</button>                       
                        </div>
                    </div>

                </form>     

            </div>                     
        </div>  
    </div>
</div>';
    }
?>