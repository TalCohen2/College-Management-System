<form action="/" method="post" name="studentform" enctype="multipart/form-data">
  <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
<?php
  $data = $this->data['data'];
  if(isset($data['id'])) {
    echo <<<HTM
      <div class="col-md-12">
        <input name="id" type="hidden" value="{$data['id']}">
        <input type='hidden' name='image' value="{$data['image']}">
        <button type="button" data-id="{$data['id']}" name="edit" class="btn btn-lg btn-success">save</button>
        <button type="button" data-id='{$data['id']}' name="delete" class="pull-right btn btn-lg btn-danger">delete</button>
      </div>
      <div class="col-md-8">
      <h2>Edit Student</h2>
HTM;
  }
    else {
    echo <<<HTM
      <div class="col-md-12">
        <button type="button" name="add" class="btn btn-lg btn-success pull-left">add</button>
      </div>
      <div class="col-md-8">
      <h2 class="col-md-6">Add Student</h2>
HTM;
    }
?>
      <div class="input-group">
        <span class="input-group-addon">*First Name:</span>
        <input type="text" name="firstName" placeholder="first name" class="form-control" value="<?php echo isset($data['first_name']) ? $data['first_name'] : NULL ?>">
      </div>
      <div class="input-group">
        <span class="input-group-addon">*Last Name:</span>
        <input type="text" name="lastName" placeholder="last name" class="form-control" value="<?php echo isset($data['last_name']) ? $data['last_name'] : NULL ?>">
      </div>
      <div class="input-group">
        <span class="input-group-addon">*Phone:</span>
        <input type="tel" name="phone" placeholder="phone number" class="form-control" value="<?php echo isset($data['phone']) ? $data['phone'] : NULL ?>">
      </div>
      <div class="input-group">
        <span class="input-group-addon">*Email:</span>
        <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo isset($data['email']) ? $data['email'] : NULL ?>  ">
      </div>
      <div class="input-group">
        <span class="input-group-addon"><?php echo isset($data['image']) ? '' : '*' ?>Image:</span>
        <input type="file" name="image" class="form-control">
      </div>
      <p>* zones must be filled</p>
<?php
  $courses = $this->data['courses']['count'];
  if(!empty($courses)) {
    echo "<h4>courses:</h4>";
    if(!empty($this->data['data']['courses'])) {
      $studentcourses = $this->data['data']['courses'];
      for($i=0;$i<count($courses);$i++) {
        $check = NULL;
        for($o=0;$o<count($studentcourses);$o++) {
          if(!$check) {
            if($studentcourses[$o]['id']==$courses[$i]['id']) {
              $check = "checked";
            }
          }
        }
          echo "<section class='col-md-3'><input type=\"checkbox\" {$check} name=\"course[]\" value=\"{$courses[$i]['id']}\"><span>{$courses[$i]['name']}</span></section>";
      }
    }
    else {
      for($i=0;$i<count($courses);$i++) {
          echo "<section class='col-md-3'><input type=\"checkbox\" name=\"course[]\" value=\"{$courses[$i]['id']}\"><span>{$courses[$i]['name']}</span></section>";
      }
    }
  }
?>
    </div>
<?php
  if(isset($data['id'])) {
    echo <<<HTM
        <div class="col-md-3 col-md-push-1">
          <img src='/College-Management-System/image/{$data['image']}' class="pull-right">
        </div>
HTM;
  }
  if(isset($data['notice'])) {
    switch($data['notice']) {
      case '1':
          $notice = 'Email Exist';
      break;
      case '2':
        $notice = 'Missing Data';
      break;
    }
    if(isset($notice)) {
      echo "<section class='alert alert-danger col-md-6 col-md-push-3 text-center'><span>{$notice}</span></section>";
    }
  }
  else {
    echo "<section></section>";
  }
?>
</form>


