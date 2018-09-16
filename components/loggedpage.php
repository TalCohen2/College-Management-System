<div class="col-md-12 rows">
  <div class="col-md-2">
    <h3>courses<?php echo $this->data['logged']['role_id']!= '3' ? "<a href=\"/talcohenproject/addcourse\" class=\"glyphicon glyphicon-plus pull-right\"></a>" : '' ?></h3>
    <ul id="list-example" class="list-group">
    <?php
      $courses = $this->data['courses']['count'];
      echo "<div class='list'>";
      for($i=0;$i<count($courses);$i++) {
        echo <<<HTM
        <a class="list-group-item list-group-item-action col-md-12" href="/talcohenproject/showcourse/{$courses[$i]['id']}"><li>
          <section class="col-md-4">
            <img src='/talcohenproject/image/{$courses[$i]['image']}'>
          </section>
          <section class="col-md-7 col-md-push-1">
            <span>{$courses[$i]['name']}</span>
          </section>
          </li></a>
HTM;
      }
      echo "</div>";
    ?>
    </ul>  
  </div>
  <div class="col-md-2">
    <h3>students<a href="/talcohenproject/addstudent" class="glyphicon glyphicon-plus pull-right"></a></h3>
    <ul id="list-example" class="list-group">
    <?php
      $students = $this->data['students']['count'];
      echo "<div class='list'>";
      for($i=0;$i<count($students);$i++) {
        echo <<<HTM
        <a class="list-group-item list-group-item-action col-md-12" href="/talcohenproject/showperson/{$students[$i]['id']}"><li>
          <section class="col-md-4">
            <img src='/talcohenproject/image/{$students[$i]['image']}'>
          </section>
          <section class="col-md-7 col-md-push-1">
            <span>{$students[$i]['first_name']} {$students[$i]['last_name']}</span>
            <span>{$students[$i]['phone']}</span>
          </section>
          </li></a>  
HTM;
      }
      echo "</div>";
    ?>
    </ul>  
  </div>
  <div class="col-md-8 well well-sm">
  <?php
    if(!empty($this->data['data']['component'])) {
      require $this->data['data']['component'];
    }
    else {
      if(isset($this->data['data']['notice'])) {
        echo "<section class='alert alert-success col-md-6 col-md-push-3 text-center'><span>Successfully Deleted</span></section>";
      }
      require "datacount.php";
    }
  ?>
  </div>
</div>