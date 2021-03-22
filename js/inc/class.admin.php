<?php

class Admin {

  function main($route=NULL,$value=NULL,$notice=NULL) {
    $logged = session::logged();
    if($logged && $logged['role_id']!='3') {
        $data = [
          'logged' => $logged,
        ];
        $a = new adminModel();
        $at = $a->getAdmins();
        $data+= [
            'admins' => $at
        ];
        $arr = $this->getComponent($route,$value,$notice);
        $data += [
            'data' => $arr
        ];
        $v = new pageView(isset($data['data']['title']));
        $v->addCss('nav.css');
        $v->addCss('main.css');
        $v->setComponent('components/adminstration.php',$data);
        if(isset($data['data']['css'])) {
            $v->addCss($data['data']['css']);
        }
        if(isset($data['data']['js'])) {
            $v->addJs($data['data']['js']);
        }
        $v->dump();
    }
    else {
      header("location: /College-Managment-System");
    }
  }


  function getComponent($component,$value,$notice) {
    $a = new adminModel();
    switch ($component) {
        case 'addAdmin':
          $ad = $a->getRoles();
          $ad +=  [
            'js' => "adminform.js",
            'css' => "form.css",
            'component' => 'adminform.php',
            'title' => 'add admin'
          ];
          if($notice) {
            $ad['notice'] = $notice;
          }
          return $ad;
        break;
        case 'edit':
            $ad = $a->getAdmin($value);
            if(session::logged()['role_id']=='2' && $ad['role_id'] != '3' && session::logged()['id'] != $ad['id']) {
              header("location: /College-Managment-System/adminstration");
            }
            else {
              $ad += $a->getRoles();
              if($notice) {
                $ad['notice'] = $notice;
              }
              $ad += [
                'js' => "adminform.js",
                'css' => "form.css",
                'component' => 'adminform.php',
                'title' => 'edit admin'
              ];
              return $ad;
            }
        break;
        case 'notice':
            return [
              'title' => 'Main Page',
              'notice' => $notice
            ];
        break;
        default:
    }
  }

  function login() {
    $notice = '';
    if(!session::logged()) {
      if(count($_POST)==0 || empty($_POST['email']) || empty($_POST['password'])) {
        $notice = 'error';
      }
      else {
        $am = new adminModel();
        $a = $am->checkAdminEmail($_POST['email']);
        if(empty($a)) {
          $notice = 'error';
        }
        else if(!password_verify($_POST['password'],$a['hash'])) {
          $notice = 'error';
        }
        else {
          session::setLogged([
            'id' => $a['id'],
            'first_name' => $a['first_name'],
            'last_name' => $a['last_name'],
            'role' => $a['role'],
            'role_id' => $a['role_id'],
            'phone' => $a['phone'],
            'email' => $a['email'],
            'hash' => $a['hash'],
            'image' => $a['image']
          ]);
        }
      }
      header("location: /College-Managment-System/{$notice}");
    }
  }

  function logout() {
    session::logout();
    header("location: /College-Managment-System");
  }

  function manageAdmin($route,$value) {
    $logged = session::logged();
    if(!$logged||empty($value)||$logged['role_id']=='3') {
      header("location: /College-Managment-System");
    }
    else {
      $am = new adminModel();
      $u = new imageUpload();
      $ph = new PasswordHash();
      switch($route) {
        case 'add':
          if($value['role']=='1' || $logged['role_id']=='2' && $value['role']!='3') {
            header ("location: /College-Managment-System/adminstration/addAdmin/");
          }
          else {
            $flag = TRUE;
            foreach($value as $id => $data) {
              if(empty($data)) {
                $flag = FALSE;
              }
            }
            if($flag) {
              $a = $am->emailValidateAd($value['email']);
              if($a) {
                $path = $u->upload($_FILES);
                $value += [
                  'image' => $path
                ];
                $ph = new PasswordHash();
                $value['password'] = $ph->getHash($value['password']);
                $am->createAdmin($value);
                header("location: /College-Managment-System/adminstration/notice/added");
              }
              else {
                header("location: /College-Managment-System/adminstration/addAdmin/1");
              }
            }
            else {
              header("location: /College-Managment-System/adminstration/addAdmin/2");
            }
          }
        break;
        case 'delete':
          $path = $am->getAdmin($value);
          if($logged['id']==$path['id'] || $logged['role_id']==$path['role_id'] || $path['role_id']=='1') {
            if($logged['id']==$path['id']) {
            header("location: /College-Managment-System/adminstration/edit/{$value}/4");
            }
            else {
              header("location: /College-Managment-System/adminstration");
            }
          }
          else {
            $u->deleteImage($path['image']);
            $am->deleteAdmin($value);
            header("location: /College-Managment-System/adminstration/notice/deleted");
          }
        break;
        case 'edit':
          if($value['role']=='1' && $logged['role_id']!='1' || $value['role']=='1' && $logged['id']!=$value['id'] || $logged['role_id']=='2' && $value['role']!='3' && $value['id']!=$logged['id'] || $value['id']==$logged['id'] && $value['role']!=$logged['role_id']) {
            if($value['id']==$logged['id'] && $value['role']!=$logged['role_id']) {
              header("location: /College-Managment-System/adminstration/edit/{$value['id']}/3");
            }
            else {
              header("location: /College-Managment-System/adminstration/edit/{$value['id']}/4");
            }
          }
          else {
            $flag = TRUE;
            if(!empty($value['password'])) {
              $value['password'] = $ph->getHash($value['password']);
            }
            foreach($value as $id => $data) {
              if(empty($data)) {
                $flag = FALSE;
                if($flag == FALSE && $id == 'password') {
                  $flag = TRUE;
                }
              }
            }
            if($flag) {
              $a = $am->emailValidateAd($value['email'],$value['id']);
              if($a) {
                if(!empty($_FILES['image']['name'])) {
                  $u->deleteImage($value['image']);
                  $path = $u->upload($_FILES);
                  $value['image'] = $path;
                  if(session::logged()['id']==$value['id']) {
                    session::updateImage($path);
                  }
                }
                $am->updateAdmin($value);
                header("location: /College-Managment-System/adminstration/notice/edited");
              }
              else {
                header("location: /College-Managment-System/adminstration/edit/{$value['id']}/1");
              }
            }
            else {
              header("location: /College-Managment-System/adminstration/edit/{$value['id']}/2");
            }
          }
        break;
      }
    }
  }
}