<div class="col-md-12 rows">
  <div class="col-md-2 adminshow">
    <h3>Administration<a href="/College-Management-System/adminstration/addAdmin" class="pull-right glyphicon glyphicon-plus"></a></h3>
    <ul id="list-example" class="list-group">
    <?php
      $admins = $this->data['admins']['count'];
      echo "<div class='list'>";
      for($i=0;$i<count($admins);$i++) {
        if($this->data['logged']['role_id'] == '2' && $admins[$i]['role_id']=='1') {
          $i++;
        }
        echo <<<HTM
        <a class="list-group-item list-group-item-action col-md-12" href="/College-Management-System/adminstration/edit/{$admins[$i]['id']}"><li>
          <li>
          <section class="col-md-3">
            <img src='/College-Management-System/image/{$admins[$i]['image']}'>
          </section>
          <section class="col-md-8 pull-right">
            <span>{$admins[$i]['first_name']} {$admins[$i]['last_name']}, {$admins[$i]['role_name']}</span>
            <span>{$admins[$i]['phone']}</span>
            <span>{$admins[$i]['email']}</span>
          </section>
          </li>
        </a>
HTM;
      }
      echo "</div>";
    ?>
    </ul>  
  </div>
  <div class="col-md-8 col-md-push-2 well well-sm">
  <?php
    if(isset($this->data['data']['notice'])) {
      switch ($this->data['data']['notice']) {
        case 'added':
          $notice = 'Successfully Added';
        break;
        case 'edited':
          $notice = 'Successfully edited';
        break;
        case 'deleted':
          $notice = 'Successfully Deleted';
        break;
      }
      if(isset($notice)) {
        echo "<section class='alert alert-success col-md-6 col-md-push-3 text-center'><span>{$notice}</span></section>";
      }
    }
    if(!empty($this->data['data']['component'])) {
     require $this->data['data']['component'];
    }
    else {
      require "admincount.php";
    }
  ?>
  </div>
</div>