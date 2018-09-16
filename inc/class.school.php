<?php
class School {

    function main($route=NULL,$value=NULL,$notice=NULL) {
        $logged = session::logged();
        $data = [
            'logged' => $logged,
        ];

        if($logged) {
            $s = new schoolModel();
            $st = $s->getStudents();
            $ct = $s->getCourses();
            $data+= [
                'students' => $st,
                'courses' => $ct
            ];
            $arr = $this->getComponent($route,$value,$notice);
            $data += [
                'data' => $arr
            ];
            $v = new pageView($data['data']['title']);
            $v->addCss('nav.css');
            $v->addCss('main.css');
            $v->setComponent('components/loggedpage.php',$data);
            if(isset($data['data']['css'])) {
                $v->addCss($data['data']['css']);
            }
            if(isset($data['data']['js'])) {
                $v->addJs($data['data']['js']);
            }
            $v->dump();
        }
        else {
            $v = new pageView('Log Page');
            $v->addCss('nav.css');
            $data += [
                'notice' => $route==NULL ? '' : $route
            ];
            $v->setComponent('components/logpage.php',$data);
            $v->addJs('login.js');
            $v->addCss('logpage.css');
            $v->dump();
        }
    }

    function getComponent($component,$value,$notice) {
        $s = new schoolModel();
        switch ($component) {
            case 'deleted':
              return [
                'notice' => 'deleted',
                'title' => 'Main Page'
              ];
            break;
            case 'showcourse':
                $cd = $s->getCourse($value);
                $sd = $s->getStudentByCourse($value);
                if(!empty($sd)) {
                   $cd += $sd;
                }  
                if($notice && $notice=='edited' || $notice && $notice=='new') {
                  $cd['notice']=$notice;
                }
                $cd += [
                    'js' => "actionbuttons.js",
                    'css' => "show.css",
                    'component' => 'showcourse.php',
                    'title' => 'course page'
                ];
                return $cd;
            break;
            case 'showperson':
                $sd = $s->getStudent($value);
                $cd = $s->getCourseByStudent($value);
                if(!empty($cd)) {
                    $sd += $cd;
                }
                if($notice && $notice=='edited' || $notice && $notice=='new') {
                  $sd['notice']=$notice;
                }
                $sd += [
                    'js' => "actionbuttons.js",
                    'css' => "show.css",
                    'component' => 'showstudent.php',
                    'title' => 'student page' 

                ];
                return $sd;
            break;
            case 'addstudent':
                $as =  [
                  'js' => "studentform.js",
                  'css' => "form.css",
                  'component' => 'studentform.php',
                  'title' => 'add student'
                ];
                if($notice) {
                  $as['notice'] = $notice;
                }           
                return $as;
            break;
            case 'addcourse':
                if(session::logged()['role_id']=='3') {
                  header ("location: /talcohenproject");
                }
                else {
                  $ac = [
                    'js' => "courseform.js",
                    'css' => "form.css",
                    'component' => 'courseform.php',
                    'title' => 'course add'
                  ];
                  if($notice) {
                    $ac['notice'] = $notice;
                  }
                  return $ac;
                }
            break;
            case 'editstudent':
                $sd = $s->getStudent($value);
                $cd = $s->getCourseByStudent($value);
                if(!empty($cd)) {
                    $sd += $cd;
                }
                if($notice) {
                  $sd['notice'] = $notice;
                }   
                $sd += [
                  'js' => "studentform.js",
                  'css' => "form.css",
                  'component' => 'studentform.php',
                  'title' => 'student edit'
                ];
                return $sd;
            break;
            case 'editcourse':
              if(session::logged()['role_id']=='3') {
                header ("location: /talcohenproject");
              }
              else {
                $cd = $s->getCourse($value);
                $students = $s->getStudentByCourse($value);
                if(!empty($students)) {
                  $cd+=$students;
                }
                $cd += [
                  'js' => "courseform.js",
                  'css' => "form.css",
                  'component' => 'courseform.php',
                  'title' => 'course edit'
                ];
                if($notice) {
                  $cd['notice'] = $notice;
                }
                return $cd;
              }
            break;
        }
    }

    function manageStudent($route,$value) {
        $logged = session::logged();
        if(!$logged||empty($value)) {
          header("location: /talcohenproject");
        }
        else {
          $sm = new schoolModel();
          $u = new imageUpload();
          switch($route) {
            case 'add':
              $flag = TRUE;
              foreach($value as $id => $data) {
                if(empty($data)) {
                  $flag = FALSE;
                }
              }
              if($flag) {
                $a = $sm->emailValidate($value['email']);
                if($a) {
                  $path = $u->upload($_FILES);
                  $value += [
                    'image' => $path
                  ];
                  $i = $sm->createStudent($value);
                  header("location: /talcohenproject/showperson/{$i}/new");
                }
                else {
                  header("location: /talcohenproject/addstudent/1");
                }
              }
              else {
                header("location: /talcohenproject/addstudent/2");
              }
            break;
            case 'delete':
              $path = $sm->getStudent($value);
              $u->deleteImage($path['image']);
              $sm->deleteStudent($value);
              header("location: /talcohenproject/deleted");
            break;
            case 'edit':
              $flag = TRUE;
              foreach($value as $id => $data) {
                if(empty($data)) {
                  $flag = FALSE;
                }
              }
              if($flag) {
                $a = $sm->emailValidate($value['email'],$value['id']);
                if($a) {
                  if(!empty($_FILES['image']['name'])) {
                    $u->deleteImage($value['image']);
                    $path = $u->upload($_FILES);
                    $value['image'] = $path;
                  }
                  $i = $sm->updateStudent($value);
                  header("location: /talcohenproject/showperson/{$i}/edited");
                }
                else {
                  header("location: /talcohenproject/editstudent/{$value['id']}/1");
                }
              }
              else {
                header("location: /talcohenproject/editstudent/{$value['id']}/2");
              }
            break;
          }
        }
      }
    
      function manageCourse($route,$value) {
        $logged = session::logged();
        if(!$logged||empty($value)||$logged['role_id']=='3') {
          header("location: /talcohenproject");
        }
        else {
          $sm = new schoolModel();
          $u = new imageUpload();
          switch($route) {
            case 'add':
              $flag = TRUE;
              foreach($value as $id => $data) {
                if(empty($data)) {
                  $flag = FALSE;
                }
              }
              if($flag) {
                $a = $sm->courseValidate($_POST['course']);
                if($a) {
                  $path = $u->upload($_FILES);
                  $value += [
                    'image' => $path
                  ];
                  $i = $sm->createCourse($value);
                  header("location: /talcohenproject/showcourse/{$i}/new");
                }
                else {
                  header("location: /talcohenproject/addcourse/1");
                }
              }
              else {
                header("location: /talcohenproject/addcourse/2");
              }
            break;
            case 'delete':
              $sc = $sm->getStudentByCourse($value);
              if(!empty($sc)) {
                header("location: /talcohenproject/editcourse/{$value}/3");
              }
              else {
                $path = $sm->getCourse($value);
                $u->deleteImage($path['image']);
                $sm->deleteCourse($value);
                header("location: /talcohenproject/deleted");
              }
            break;
            case 'edit':
              $flag = TRUE;
              foreach($value as $id => $data) {
                if(empty($data)) {
                  $flag = FALSE;
                }
              }
              if($flag) {
                $a = $sm->courseValidate($value['course'],$value['id']);
                if($a) {
                  if(!empty($_FILES['image']['name'])) {
                    $u->deleteImage($value['image']);
                    $path = $u->upload($_FILES);
                    $value['image'] = $path;
                  }
                  $i = $sm->updateCourse($value);
                  header("location: /talcohenproject/showcourse/{$i}/edited");
                }
                else {
                  header("location: /talcohenproject/editcourse/{$value['id']}/1");
                }
              }
              else {
                header("location: /talcohenproject/editcourse/{$value['id']}/2");
              }
            break;
          }
        }
      }    
}

