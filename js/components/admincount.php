<?php
    echo "<div class='col-md-12'>";
    if(empty($this->data['admins']['count'])) {
        echo "<h2 class='text-center'>no admins signed</h2>";
    }
    else {
        echo "<h2 class='text-center'>".count($this->data['admins']['count']). " admins signed</h2>";
    }
    echo "<div>";
?>