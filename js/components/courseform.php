<form action="/" method="post" name="courseform" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
    <div class="col-md-12">
<?php 
    $data = $this->data['data'];
        if(!empty($data['id'])) {
            echo <<<HTM
                <input name="id" type="hidden" value="{$data['id']}"></input>
                <input type="hidden" name="image" value="{$data['image']}"></input>
                <button data-id="{$data['id']}" type="button" name="edit" class="btn btn-lg btn-success">save</button>
HTM;
            if(empty($this->data['data']['students'])) {
                echo "<button data-id=\"{$data['id']}\" type='button' name='delete' class='btn btn-lg btn-danger pull-right'>delete</button>";
            }
            echo <<<HTM
                </div>
                <div class="col-md-8">
                <h2>Edit Course</h2>
HTM;
        }
        else {
            echo <<<HTM
                <button type="button" name="add" class="btn btn-lg btn-success pull-left">add</button>
                </div>
                <div class="col-md-8">
                <h2 class="col-md-6">Add Course</h2>
HTM;
        }
?>
        <div class="input-group">
            <span class="input-group-addon">*course name:</span>
            <input type="text" name="course" placeholder="course name" class="form-control input-lg" value="<?php echo isset($data['name']) ?  $data['name'] : '' ?>"></input>
        </div>
        <div class="input-group">
            <span class="input-group-addon">*description:</span>
            <textarea name="description" placeholder="description" class="form-control input-lg"><?php echo isset($data['description']) ? $data['description'] : '' ?></textarea>
        </div>
        <div class="input-group">
            <span class="input-group-addon"><?php echo isset($data['id']) ? '' : '*' ?>image:</span>
            <input type="file" name="image" class="form-control input-lg"></input>
        </div>
        <p>* zones must be filled</p>
        <?php
            if(!empty($this->data['data']['students'])) {
                echo "<h3>".count($this->data['data']['students']). " Students signed</h3>"; 
            }
            else {
                echo "<h3>No Students signed</h3>"; 
            }
        ?>
    </div>
<?php
    if(isset($data['image'])) {
        echo <<<HTM
        <div class="col-md-3 col-md-push-1">
        <img class='pull-right' src='/College-Managment-System/image/{$data['image']}'>
        </div>
HTM;
    }
?>
    <?php
        if(isset($data['notice'])) {
            switch($data['notice']) {
                case '1':
                    $notice = 'Course Exist';
                break;
                case '2':
                    $notice = 'Missing Data';
                break;
                case '3':
                    $notice = "Cant Delete Course While Student's";
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
