<?php
    if(isset($_SESSION['userIDloggedin'])) {
?>
<h1 class="page-header">Nyheder</h1>

<div class="container-fluid">
    <div class="row row-eq-height col-md-12">
        <?php
            
            $sqlQuery = $conn->query("SELECT mynews.id, fkEdited, title, article, c.firstName AS createdFirstName, c.lastName AS createdLastName, e.firstName AS editedFirstName, e.lastName AS editedLastName
                                      FROM mynews
                                      INNER JOIN users c
                                      ON mynews.fkCreated = c.id
                                      LEFT JOIN users e
                                      ON mynews.fkEdited = e.id");
            
            echo '<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#new">
    <i class="fa fa-plus" aria-hidden="true"></i>
</button> - Ny Nyhed</h3></div>';
echo '
  <table class="table table-hover">
    <tr>
        <th>Titel</th>
        <th>Artikel</th>
        <th>Vis Nyhed</th>
        <th>Rediger</th>
        <th>Slet</th>
        <th>Lavet af</th>
        <th>Sidst redigeret af</th>
    </tr>';


            while($row = $sqlQuery->fetch_assoc()){
                if (empty($row['fkEdited'])) {
                $edited = "Nyheden har ikke været redigeret";
            } else {
                $edited = $row['editedFirstName'].' '.$row['editedLastName'];
            }
                echo '<tr>
                        <td>'.$row['title'].'</td>
                        <td>'.$row['article'].'</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#show'.$row['id'].'">
                                        Vis Nyhed
                            </button>
                        </td>
                        <td><a href="#"><i class="fa fa-pencil" data-toggle="modal" data-target="#edit'.$row['id'].'" ></i></a></td>
                        <td><a  href="javascript:void();" onclick="confirmDelete(\'Er du sikker på, du vil slette nyheden - '.$row['title'].'?\', '.$row['id'].')">
                                    <i class="fa fa-trash"></i>
                                </a></td>
                        <td class="text-muted">'.$row['createdFirstName'].' '.$row['createdLastName'].'</td>
                        <td class="text-muted">'.$edited.'</td>
                      </tr>
                        
                        <div class="modal fade" id="edit'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content form-horizontal">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabelEdit">Rediger Nyhed - <span class="text-muted">'.$row['title'].'</span></h4>
                                    </div>
                                    <div class="modal-body">

                                        <form action="index.php?p=newsEdit&newsID='.$row['id'].'" method="post" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="editTitle">Titel</label>  
                                            <div class="col-md-6">
                                                <input id="editTitle" name="editTitle" placeholder="Titel" class="form-control input-md" required="" type="text" value="'.$row['title'].'">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="editArticle">Artikel</label>
                                            <div class="col-md-6">
                                                <input id="editArticle" name="editArticle" placeholder="Artikel" class="form-control input-md" required="" type="text" value="'.$row['article'].'">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="editNewsPicture" class="col-md-4 control-label">Nyheds billede</label>
                                            <div class="col-md-4">
                                                <input type="file" name="editFileToUpload" id="editNewsPicture">
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
                        </div>
                        
                        <div class="modal fade" id="show'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">'.$row['title'].'</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>'.$row['article'].'</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Luk</button>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit'.$row['id'].'">
                                        Rediger Nyhed
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        

            }

            echo '</table></div>
            ';
        ?>
                       <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Ny Nyhed</h4>
                        </div>
                        <div class="modal-body">
                            <?php
                    if(!empty($success)) {
                        echo $success;
                    }
                ?>

<form action="index.php?p=newsNew" method="post" class="form-horizontal" enctype="multipart/form-data">

<!-- Text input-->
<div class="form-group">
	<label class="col-md-4 control-label" for="title">Titel</label>  
	<div class="col-md-4">
		<input id="title" name="title" placeholder="Titel" class="form-control input-md" required="" type="text">
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="article">Artikel</label>  
	<div class="col-md-4">
		<input id="article" name="article" placeholder="Din Artikel" class="form-control input-md" required="" type="text">
	</div>
</div>

<div class="form-group">
	<label for="newsImg" class="col-md-4 control-label">Nyheds Billede</label>
	<div class="col-md-4">
		<input type="file" name="fileToUpload" id="newsImg" required="">
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
		window.location = "index.php?p=newsDelete&id=" + id;
	} else {
		//do nothing
	}
}
</script>

<?php
    }
?>