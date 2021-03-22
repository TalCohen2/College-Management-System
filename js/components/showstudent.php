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
echo <<<HTM
        <div class="col-md-12">
                <button name="student" id="editButton" data-id='{$this->data['data']['id']}' type="button" class="btn btn-lg btn-info pull-left">edit</button>
                $notice
                
        </div>
        <div class="col-md-7">
                <h2><span class='glyphicon glyphicon-user'></span> {$this->data['data']['first_name']} {$this->data['data']['last_name']}</h2>
                <span><span class='glyphicon glyphicon-phone'></span> {$this->data['data']['phone']}</span>
                <span><span class='glyphicon glyphicon-envelope'></span> {$this->data['data']['email']}</span>
        </div>
        <div>
                <img src='/College-Managment-System/image/{$this->data['data']['image']}' class="pull-right">
        </div>
HTM;
if(!empty($this->data['data']['courses'])) {
        $courses = $this->data['data']['courses'];
        echo "<h4 class='col-md-12'>courses of this student:</h4>";
        echo "<div class='col-md-12'>";
        for($i=0;$i<count($courses);$i++) {
                echo <<<HTM
                <a class="col-md-2" href="/College-Managment-System/showcourse/{$courses[$i]['id']}">
                        <img class="img-circle" src='/College-Managment-System/image/{$courses[$i]['image']}'>
                        <p class="text-center">{$courses[$i]['name']}</p>
                </a>
HTM;
        }
        echo "</div>";
}
?>