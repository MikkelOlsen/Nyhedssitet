    <?php
        $feedQuery = $conn->query("SELECT feedurl, feedName
                                   FROM feed
                                   ORDER BY feedName
                                   ASC");
        while($row = $feedQuery->fetch_assoc()){
            $content = file_get_contents($row['feedurl']);
            $x = new simpleXmlElement($content);
                $i=1; // start count at 1

            echo '<div class="container-fluid">';
            echo '<h1 class="page-header">'.$row['feedName'].'</h1>';
            echo '<div class="row">';

   foreach($x->channel->item as $entry) {
        echo ' <div class="col-sm-4 col-md-3">
               <div class="thumbnail">';
        echo '<div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">'.$entry->title.'</h3>
                </div>
            </div>'; // output link & title
        echo '<div class="caption">';

;
        echo '<div class="imgBox">';
            if(isset ($entry->enclosure)) {
                echo '<img class="img-responsive center-block" src="'.$entry->enclosure->attributes()->url.'" alt="">';
            } else if(isset($entry->image->url)){
                echo '<img class="img-responsive center-block" src="'.$entry->image->url.'" alt="">';
            } else {
                echo '<img class="img-responsive center-block" src="http://placehold.it/320x150" alt="">';
            }
        echo '</div>';
        echo '<p>'.$entry->description.'</p>'; // return post content
        echo '</div>';
        echo '<p class="bottom col-md-3"><a href="'.$entry->link.'" title="'.$entry->title.'" target="_blank" class="btn btn-primary" role="button">Til Artikel</a></p>';
        echo '</div>
                </div>';

                $i++; // increment counter

        if($i >= 5) // if counter more than 2 - quit
        break;  
   }
              echo' </div>';
              echo' </div>';

           //echo '<pre>',print_r($x),'</pre>';
        }
    ?>