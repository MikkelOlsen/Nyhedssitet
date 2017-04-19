<?php
    if(isset($_SESSION['userIDloggedin'])) {
?>
<h1 class="page-header">Feeds</h1>

<div class="container-fluid">
    <form action="index.php?p=feedsNew" method="post" class="form-horizontal pull-left" enctype="multipart/form-data">

        <div class="form-group col-md-15">
            <label class="col-md-5" for="feedName">Navn</label>  
            <div class="col-md-10">
                <input id="feedName" name="feedName" placeholder="Navn" class="form-control input-md" required="" type="text">
            </div>
        </div>

        <div class="form-group col-md-15">
            <label class="col-md-5" for="feedUrl">RSS Feed</label>  
            <div class="col-md-10">
                <input id="feedUrl" name="feedUrl" placeholder="URL" class="form-control input-md" required="" type="text">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <button id="Opret" name="Opret" class="btn btn-success">Create</button>
            </div>
        </div>
    </form>
        <table class="table">
            <thead>
                <tr>   
                    <th>Navn</th>
                    <th>Feed Url</th>
                    <th>Rediger</th>
                    <th>Slet</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $brandQuery = $conn->query("SELECT id, feedName, feedurl
                                                FROM feed");
                    while($row = $brandQuery->fetch_assoc()){
                        echo '
                        <tr>
                            <td>'.$row['feedName'].'</td>
                            <td>'.$row['feedurl'].'</td>
                            <td><a href="#"><i class="fa fa-pencil" data-toggle="modal" data-target="#edit'.$row['id'].'" ></i></a></td>
                            <td><a  href="javascript:void();" onclick="confirmDelete(\'Er du sikker på, du vil slette - '.$row['feedName'].'?\', '.$row['id'].')"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        
                        <div class="modal fade" id="edit'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content form-horizontal">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabelEdit">Rediger Feed - <span class="text-muted">'.$row['feedName'].'</span></h4>
                                    </div>
                                    <div class="modal-body">

                                        <form action="index.php?p=feedsEdit&feedID='.$row['id'].'" method="post" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="editFeedName">Feed Navn</label>  
                                            <div class="col-md-4">
                                                <input id="editFeedName" name="editFeedName" placeholder="Navn" class="form-control input-md" required="" type="text" value="'.$row['feedName'].'">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="editFeedUrl">Feed URL</label>  
                                            <div class="col-md-4">
                                                <input id="editFeedUrl" name="editFeedUrl" placeholder="URL" class="form-control input-md" required="" type="text" value="'.$row['feedurl'].'">
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
                ?>
            </tbody>
        </table>
</div>
<script>
function confirmDelete(msg, id) {
	var r=confirm(msg);
	if (r) {
		//write redirection code
		window.location = "index.php?p=feedsDelete&id=" + id;
	} else {
		//do nothing
	}
}
</script>
<?php
    }
?>