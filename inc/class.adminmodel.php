<?php

class adminModel {

    private $conn = NULL;

    function __construct(){
        $instance = ConnectDb::getInstance();
        $this->conn = $instance->getConnection();
    }

    function checkAdminEmail($userEm) {
        $userEm = Strtolower($userEm);
        $sql = <<<SQL
            SELECT a.*,r.role_name
            FROM admin as a
            JOIN role as r 
            ON a.role_id = r.id
SQL;
        $ret = [];
        try {
            $admins = $this->conn->query($sql)->fetchAll();
            foreach($admins as $admin => $admindata) {
                if($admindata['email']==$userEm) {
                    $ret = [
                        'id' => $admindata['id'],
                        'first_name' =>  $admindata['first_name'],
                        'last_name' =>  $admindata['last_name'],
                        'role' =>  $admindata['role_name'],
                        'role_id' => $admindata['role_id'],
                        'phone' =>  $admindata['phone'],
                        'email' =>  $admindata['email'],
                        'hash' =>  $admindata['hash'],
                        'image' =>  $admindata['image']
                    ];
                }
            }
            return $ret;
        }
        Catch (PDOExpection $e) {
            echo 'DB ERROR: '.$e->getMessage();
            die;
        }
    }

    function emailValidateAd($userEm,$id=NULL) {
        $userEm = Strtolower($userEm);
        $sql = <<<SQL
            SELECT email FROM admin
SQL;
        $ret = TRUE;
        try {
            $emails = $this->conn->query($sql)->fetchAll();
            foreach($emails as $email => $emaildata) {
                if($emaildata['email']==$userEm) {
                    $ret = FALSE;
                }
            }
            if(!empty($id)) {
                $s = $this->getAdmin($id);
                if($s['email']==$userEm) {
                    $ret = TRUE;
                }
            }
            return $ret;
        }
        Catch (PDOExpection $e) {
            echo 'DB ERROR: '.$e->getMessage();
            die;
        }
    }

    function createAdmin($post) {
        $sql = <<<SQL
        INSERT INTO admin(first_name,last_name,phone,email,hash,image,role_id)
        VALUES (:firstname,:lastname,:phone,:email,:hash,:image,:role)
SQL;
        try {
            $stmnt = $this->conn->prepare($sql);
            $params = [
                'firstname' => $post['firstName'],
                'lastname' => $post['lastName'],
                'phone' => $post['phone'],
                'email' => $post['email'],
                'hash' => $post['password'],
                'image' => $post['image'],
                'role' => $post['role']
            ];
            $stmnt->execute($params);
        }
        Catch (PDOException $e) {
            echo 'DB ERROR: '.$e->getMessage();
            die;
        }
    }

    function getAdmin($userId) {
        $sql = <<<SQL
            SELECT a.*,r.role_name
            FROM admin as a
            JOIN role as r 
            ON a.role_id = r.id
            WHERE a.id = $userId
SQL;
        $ret = NULL;
        try {
            $admins = $this->conn->query($sql)->fetchAll();
            foreach($admins as $admin => $admindata) {
                $ret = [
                    'id' => $admindata['id'],
                    'first_name' => $admindata['first_name'],
                    'last_name' => $admindata['last_name'],
                    'phone' => $admindata['phone'],
                    'email' => $admindata['email'],
                    'image' => $admindata['image'],
                    'role_id' => $admindata['role_id'],
                    'role' => $admindata['role_name'],
                    'hash' => $admindata['hash']
                ];
            }
            return $ret;
        }
        Catch (PDOExpection $e) {
            echo 'DB ERROR: '.$e->getMessage();
            die;
        }
    }

    function getAdmins() {
        $ret = NULL;
        $sql = <<<SQL
            SELECT a.*,r.role_name
            FROM admin as a
            JOIN role as r
            ON a.role_id = r.id
SQL;
        try {
            $admins = $this->conn->query($sql)->fetchAll();
                $ret = [
                    'count' => $admins
                ];
            return $ret;
        }
        Catch (PDOExpection $e) {
            echo 'DB ERROR: '.$e->getMessage();
            die;
        }
    }

    function deleteAdmin($id) {
        $sql = <<<SQL
        DELETE FROM admin WHERE id = {$id}
SQL;
        try {
            $this->conn->query($sql);
        }
        Catch (PDOException $e) {
            echo 'DB CONNECT ERROR: '.$e->getMessage();
            die;
        }
    }


    function updateAdmin($post) {
        $sql = <<<SQL
        UPDATE admin
        SET first_name = :firstName, last_name = :lastName, phone = :phone, email = :email, role_id = :role,image= :image
        WHERE id = :id
SQL;
        try {
            $stmnt = $this->conn->prepare($sql);
            $params = [
                'firstName' => $post['firstName'],
                'lastName' => $post['lastName'],
                'phone' => $post['phone'],
                'email' => $post['email'],
                'role' => $post['role'],
                'image' => $post['image'],
                'id' => $post['id']
            ];
            $stmnt->execute($params);
            if(!empty($post['password'])) {
                $pass = <<<SQL
                UPDATE admin
                SET hash = :hash
                WHERE id = :id
SQL;
                $stmnt = $this->conn->prepare($pass);
                $params = [
                    'hash' => $post['password'],
                    'id' => $post['id']
                ];
                $stmnt->execute($params);
            }
        }
        Catch (PDOException $e) {
            echo 'DB ERROR: '.$e->getMessage();
            die;
        }
    }

    function getRoles() {
        $sql = <<<SQL
        SELECT * FROM role
SQL;
        try {
            $roles = $this->conn->query($sql)->fetchAll();
            $ret = [
                'roles' => $roles
            ];
            return $ret;
        }
        Catch (PDOException $e) {
            echo 'DB ERROR: '.$e->getMessage();
            die;
        }
    }
}







