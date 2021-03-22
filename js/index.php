<?php
require "inc/common.php";
$route = empty($_GET['route']) ? [] : explode('/',$_GET['route']);
$u = new School();
$a = new Admin();
if(empty($route[0])) {
    $u->main();
}
if(count($route)>0) {
    switch ($route[0]){
        case 'error':
            $u->main($route[0]);
        break;
        case 'login':
            $a->login();
        break;
        case 'logout':
            $a->logout();
        break;
        case 'deleted':
            $u->main($route[0]);
        break;
        case 'showperson':
            if(isset($route['2'])) {
                $u->main($route['0'],$route['1'],$route['2']);
            }
            else {
                $u->main($route['0'],$route['1']);
            }
        break;
        case 'showcourse':
            if(isset($route['2'])) {
                $u->main($route['0'],$route['1'],$route['2']);
            }
            else {
                $u->main($route['0'],$route['1']);
            }
        break;
        case 'addstudent':
        if(isset($route['1'])) {
            $u->main($route['0'],NULL,$route['1']);
        }
        else {
            $u->main($route['0']);
        }
        break;
        case 'editstudent':
            if(isset($route['2'])) {
                $u->main($route['0'],$route['1'],$route['2']);
            }
            else {
                $u->main($route['0'],$route['1']);
            }
        break;
        case 'managestudent':
            if(isset($route['1'])) {
                switch ($route['1']) {
                    case 'add':
                        $u->manageStudent($route['1'],$_POST);
                    break;
                    case 'delete':
                        $u->manageStudent($route['1'],$route['2']);
                    break;
                    case 'edit':
                        $u->manageStudent($route['1'],$_POST);
                    break;
                }
            }
            else {
                header("location: /College-Management-System");
            }
        break;
        case 'addcourse':
            if(isset($route['1'])) {
                $u->main($route['0'],NULL,$route['1']);
            }
            else {
                $u->main($route['0']);
            }
        break;
        case 'editcourse':
            if(isset($route['2'])) {
                $u->main($route['0'],$route['1'],$route['2']);
            }
            else {
                $u->main($route['0'],$route['1']);
            }
        break;
        case 'managecourse':
            if(isset($route['1'])) {
                switch ($route['1']) {
                    case 'delete':
                        $u->manageCourse($route['1'],$route['2']);
                    break;
                    case 'edit':
                        $u->manageCourse($route['1'],$_POST);
                    break;
                    case 'add':
                        $u->manageCourse($route['1'],$_POST);
                    break;
                }
            }
            else {
                header("location: /College-Management-System");
            }
        break;
        case 'adminstration':
            if(isset($route['1'])) {
                switch($route['1']) {
                    case 'addAdmin':
                        if(isset($route['2'])) {
                            $a->main($route['1'],NULL,$route['2']);
                        }
                        else {
                            $a->main($route['1']);
                        }
                    break;
                    case 'edit':
                        if(isset($route['3'])) {
                            $a->main($route['1'],$route['2'],$route['3']);
                        }
                        else {
                            $a->main($route['1'],$route['2']);
                        }
                    break;
                    case 'manageadmin':
                        switch($route['2']) {
                            case 'add':
                                $a->manageAdmin($route['2'],$_POST);
                            break;
                            case 'delete':
                                $a->manageAdmin($route['2'],$route['3']);
                            break;
                            case 'edit':
                                $a->manageAdmin($route['2'],$_POST);
                            break;
                        }
                    break;
                    case 'showadmin':
                        $a->main($route['1'],$route['2']);
                    break;
                    case 'notice':
                        $a->main($route['1'],NULL,$route['2']);
                    break;
                }
            }
            else {
                $a->main();
            }
        break;
    }
}