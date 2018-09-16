<div class="col-md-12">
<?php
if(isset($this->data['data']['notice'])) {
        switch($this->data['data']['notice']) {
                case 'new':
                        $notice = "<span class='alert alert-success col-md-6 col-md-push-2 text-center'>successfully Added</span>";
                break;
                case 'edited':
                        $notice = "<span class='alert alert-success col-md-6 col-md-push-2 text-center'>successfully Edited</span>";
                break;
        }
}
else {
        $notice = NULL;
}
if(!empty($this->data['data']['students'])) {
        $student = $this->data['data']['students'];
}
if($this->data['logged']['role_id']!='3') {
        echo "<button name=\"course\" id=\"editButton\" data-id='{$this->data['data']['id']}' type=\"button\" class=\"btn btn-lg btn-info pull-left\">edit</button>";
        echo $notice;
}
echo <<<HTM
        </div>
        <div class="col-md-7">
        <h2><span class='glyphicon glyphicon-book'></span> {$this->data['data']['name']},
        </h2>
HTM;
        if(isset($student)) {
                echo "<span class='signed'>";
                $student = $this->data['data']['students']; 
                echo count($student)." students signed";   
                echo "</span>"; 
        }
        else {
                echo "<span class='signed'>";
                echo "There are no students in this course";
                echo "</span>"; 
        }
echo <<<HTM
                <h4>Description:</h4>
                <span class="description">{$this->data['data']['description']}</span>
        </div>
        <div col-md-3>
                <img src='/talcohenproject/image/{$this->data['data']['image']}' class="pull-right">
        </div>
HTM;
if(isset($student)) {
        echo "<h4 class='col-md-12'>students in this course:</h4>";
        echo "<div class='col-md-12'>";
        for($i=0;$i<count($student);$i++) {
                echo <<<HTM
                <a class="col-md-2" href="/talcohenproject/showperson/{$student[$i]['id']}">
                <img class="img-circle" src='/talcohenproject/image/{$student[$i]['image']}'>
                <p class="text-center">{$student[$i]['first_name']} {$student[$i]['last_name']}</p>
                </a>
HTM;
        }
        echo "</div>";
}
?>

