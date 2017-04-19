<?php
    if(isset($_SESSION['userIDloggedin'])) {
?>
<h1 class="page-header">Brugere</h1>

<div class="container-fluid">
    <div class="row row-eq-height col-md-12">
        <?php
            
            $sqlQuery = $conn->query("SELECT id, firstName, lastName, username 
                                      FROM users
                                      ORDER BY firstName
                                      ASC");
            echo '<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#new">
    <i class="fa fa-plus" aria-hidden="true"></i>
</button> - Ny Bruger</h3></div>';
echo '
  <table class="table table-hover">
    <tr>
        <th>Fornavn</th>
        <th>Efternavn</th>
        <th>Rediger</th>
        <th>Slet</th>
    </tr>';


            while($row = $sqlQuery->fetch_assoc()){
                echo '<tr>
                        <td>'.$row['firstName'].'</td>
                        <td>'.$row['lastName'].'</td>
                        <td><a href="#"><i class="fa fa-pencil" data-toggle="modal" data-target="#edit'.$row['id'].'" ></i></a></td>
                        <td><a  href="javascript:void();" onclick="confirmDelete(\'Er du sikker på, du vil slette brugeren - '.$row['firstName'].' '.$row['lastName'].'?\', '.$row['id'].')">
                                    <i class="fa fa-trash"></i>
                                </a></td>
                        <td class="text-muted"></td>
                      </tr>
                        
                        <div class="modal fade" id="edit'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content form-horizontal">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabelEdit">Rediger Bruger - <span class="text-muted">'.$row['firstName'].' '.$row['lastName'].'</span></h4>
                                    </div>
                                    <div class="modal-body">

                                        <form action="index.php?p=userEdit&userID='.$row['id'].'" method="post" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="editFirstName">Fornavn</label>  
                                            <div class="col-md-6">
                                                <input id="editFirstName" name="editFirstName" placeholder="Fornavn" class="form-control input-md" required="" type="text" value="'.$row['firstName'].'">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="editLastName">Efternavn</label>
                                            <div class="col-md-6">
                                                <input id="editLastName" name="editLastName" placeholder="Efternavn" class="form-control input-md" required="" type="text" value="'.$row['lastName'].'">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="editUsername">Efternavn</label>
                                            <div class="col-md-6">
                                                <input id="editUsername" name="editUsername" placeholder="Username" class="form-control input-md" required="" type="text" value="'.$row['username'].'">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="opdater"></label>
                                            <div class="col-md-4">
                                                <button id="opdater" name="opdater" class="btn btn-success">Opdater</button>
                                            </div>
                                        </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        

            }

            echo '</table></div>';
        ?>
                       <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Ny Ansat</h4>
                        </div>
                        <div class="modal-body">
                            <?php
                    if(!empty($success)) {
                        echo $success;
                    }
                ?>

<form action="index.php?p=userNew" method="post" class="form-horizontal" enctype="multipart/form-data">

<!-- Text input-->
<div class="form-group">
	<label class="col-md-4 control-label" for="firstName">Fornavn</label>  
	<div class="col-md-4">
		<input id="firstName" name="firstName" placeholder="Fornavn" class="form-control input-md" required="" type="text">
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="lastName">Efternavn</label>  
	<div class="col-md-4">
		<input id="lastName" name="lastName" placeholder="Efternavn" class="form-control input-md" required="" type="text">
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="username">Brugernavn</label>  
	<div class="col-md-4">
		<input id="username" name="username" placeholder="Brugernavn" class="form-control input-md" required="" type="text">
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="password">Password</label>  
	<div class="col-md-4">
		<input id="password" name="password" placeholder="Password" class="form-control input-md" required="" type="text">
	</div>
</div>

<!-- Button -->
<div class="form-group">
	<label class="col-md-4 control-label" for="Opret"></label>
	<div class="col-md-4">
		<button id="Opret" name="Opret" class="btn btn-success">Opret</button>
	</div>
</div>

</form>



                        </div>
                        </div>


                        
    </div>
</div>

<script>
function confirmDelete(msg, id) {
	var r=confirm(msg);
	if (r) {
		//write redirection code
		window.location = "index.php?p=userDelete&id=" + id;
	} else {
		//do nothing
	}
}
</script>

<?php
    }
?>