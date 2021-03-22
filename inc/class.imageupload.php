<?php

class imageUpload {
    function upload() {
        $logged = session::logged();
        if($logged != NULL) {
            if(!empty($_POST)||!empty($_POST['image'])) {
                $uploaded = NULL;

                if(!empty($_FILES) && !empty($_FILES['image']['tmp_name'])) {
                    try {
                    $f =& $_FILES['image'];
                    $uploaded['debug'] =& $f;
                    if($f['error']!=0) {
                        throw new RuntimeException($this->errorStr($f['error']));
                    }
                    if($f['size']>10000000000) {
                        throw new RuntimeException('File too big');
                    }
                    $ext = pathinfo($f['name'],PATHINFO_EXTENSION);
                    if(!in_array($ext,['jpg','png','jpeg','gif'])) {
                        throw new RuntimeException("Invalid file type {$ext}");
                    }
                    $filename = $logged['first_name'] . time() . '.' . $ext;
                    rename($f['tmp_name'],'../College-Management-System/image/'.$filename);
                    $uploaded['result'] = $filename;
                    }
                    catch(RuntimeException $e) {
                    $uploaded['result'] = 'Error: '.$e->getMessage();
                        }
                    }
                }
            }
            return $uploaded['result'];
        }
        
    private function errorStr($code) {
        switch($code) {
        case 1: return 'The uploaded file exceeds the upload_max_filesize directive in php.ini'; break;
        case 2: return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form'; break;
        case 3: return 'The uploaded file was only partially uploaded'; break;
        case 4: return 'No file was uploaded'; break;
        case 6: return 'Missing a temporary folder'; break;
        case 7: return 'Failed to write file to disk.'; break;
        case 8: return 'A PHP extension stopped the file upload.'; break;
        default: return "Unknown error occured {$code}";
        }
    }

    function deleteImage($param) {
        unlink ("../College-Management-System/image/{$param}");
    }

}