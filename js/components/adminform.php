<form action="/" method="post" name="adminform" enctype="multipart/form-data">
<?php
  $data = $this->data['data'];
?>
  <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
  <div class="col-md-12">
  <?php
    if(isset($data['id'])) {
      echo "<input name=\"id\" type=\"hidden\" value=\"{$data['id']}\">";
      if($this->data['logged']['role_id']!=$data['role_id']) {
        echo "<button type=\"button\" data-id=\"{$data['id']}\" name=\"delete\" class=\"pull-right btn btn-lg btn-danger\">delete</button>";
      }

      echo <<<HTM
        <button type="button" data-id="{$data['id']}" name="edit" class="pull-left btn btn-lg btn-success">save</button>
        </div>
        <div class="col-md-8">
        <h2>Edit Admin</h2>
HTM;
    }
    else {
      echo <<<HTM
        <button type="button" name="add" class="btn btn-lg btn-success pull-left">add</button>
        </div>
        <div class="col-md-8">
        <h2 class="col-md-6">Add Admin</h2>
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
        <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo isset($data['email']) ? $data['email'] : NULL ?>">
      </div>
      <div class="input-group">
        <span class="input-group-addon"><?php echo isset($data['id']) ? '' : '*' ?>password:</span>
        <input type="password" name="password" placeholder="password" class="form-control">
      </div>
      <div class="input-group">
<?php
  if(isset($data['image'])) {
    echo "<input type='hidden' name='image' value='{$data['image']}'>";
  }
?>
        <span class="input-group-addon"><?php echo isset($data['id']) ? '' : '*' ?>Image:</span>
        <input type="file" name="image" class="form-control">
      </div>
      <div class="input-group">
        <span class="input-group-addon">*role:</span>
        <select name="role" class="form-control">
        <?php
          if($this->data['logged']['role_id']=='1') {
            for($i=0;$i<count($data['roles']);$i++) {
              if(isset($data['role_id']) && $data['role_id']=='1') {
                echo "<option value=\"{$data['role_id']}\">{$data['role']}</option>";
                $i=count($data['roles']);
              }
              else if(isset($data['role_id']) && $data['role_id']=='2' || !isset($data['id'])) {
                $i++;
                echo "<option value=\"{$data['roles'][$i]['id']}\">{$data['roles'][$i]['role_name']}</option>";
                $i++;
                echo "<option value=\"{$data['roles'][$i]['id']}\">{$data['roles'][$i]['role_name']}</option>";
              }
              else if($data['role_id']=='3') {
                $i++;
                $i++;
                echo "<option value=\"{$data['roles'][$i]['id']}\">{$data['roles'][$i]['role_name']}</option>";
                $i--;
                echo "<option value=\"{$data['roles'][$i]['id']}\">{$data['roles'][$i]['role_name']}</option>";
                $i=count($data['roles']);
              }
            }
          }
          else if($this->data['logged']['role_id']=='2') {
            if(isset($data['id']) && $this->data['logged']['id']==$data['id']) {
              echo "<option value=\"{$data['role_id']}\">{$data['role']}</option>";
            }
            else {
              echo "<option value=\"{$data['roles'][2]['id']}\">{$data['roles'][2]['role_name']}</option>";
            }
          }
        ?>
        </select>
      </div>
      <p>* zones must be filled</p>
    </div>
    <div class="col-md-3 col-md-push-1">
      <?php
        if(isset($data['image'])) {
          echo "<img src=\"/College-Managment-System/image/{$data['image']}\" class='pull-right'>";
        }
      ?>
    </div>
    <?php
      if(isset($data['notice'])) {
        switch($data['notice']) {
            case '1':
              $notice ='Email Exist';
            break;
            case '2':
            $notice = 'Missing Data';
            break;
            case '3':
              $notice = 'You Cant Change Your Role';
            break;
            case '4':
              $notice = 'Access Denied!';
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






