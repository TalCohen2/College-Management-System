<?php
    echo "<div class='col-md-12'>";
    if(empty($this->data['students']['count'])) {
        echo "<h2 class='text-center'>no students signed</h2>";
    }
    else {
        echo "<h2 class='text-center'>".count($this->data['students']['count']). " Students signed</h2>";
    }
    if(empty($this->data['courses']['count'])) {
        echo "<h2 class='text-center'>no Courses signed</h2>";
    }
    else {
        echo "<h2 class='text-center'>".count($this->data['courses']['count']). " Courses signed</h2>";
    }
    echo "</div>";
?>