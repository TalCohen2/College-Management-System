<?php

class schoolModel {
    private $conn = NULL;

    function __construct(){
        $instance = ConnectDb::getInstance();
        $this->conn = $instance->getConnection();
    }

    function getStudents() {
        $ret = NULL;
        $sql = <<<SQL
        SELECT * FROM students
SQL;
        try {
            $students = $this->conn->query($sql)->fetchAll();
            $ret = [
                'count' => $students
            ];
            return $ret;
        }
        Catch (PDOExpection $e) {
            echo 'DB ERROR: '.$e->getMessage();
            die;
        }
    }

    function getCourses() {
        $ret = NULL;
        $sql = <<<SQL
            SELECT * FROM courses
SQL;
        try {
            $courses = $this->conn->query($sql)->fetchAll();
            $ret = [
                'count' => $courses
            ];
            return $ret;
        }
        Catch (PDOExpection $e) {
            echo 'DB ERROR: '.$e->getMessage();
            die;
        }
    }

    function getStudent($userId) {
        $sql = <<<SQL
            SELECT * FROM `students` WHERE id = $userId
SQL;
        $ret = NULL;
        try {
            $students = $this->conn->query($sql)->fetchAll();
            foreach($students as $student => $studentdata) {
                $ret = [
                    'id' => $studentdata['id'],
                    'first_name' => $studentdata['first_name'],
                    'last_name' => $studentdata['last_name'],
                    'phone' => $studentdata['phone'],
                    'email' => $studentdata['email'],
                    'image' => $studentdata['image']
                ];
            }
            return $ret;
        }
        Catch (PDOExpection $e) {
            echo 'DB ERROR: '.$e->getMessage();
            die;
        }
    }

    function getCourse($courseId) {
        $sql = <<<SQL
            SELECT * FROM courses WHERE id = $courseId
SQL;
        $ret = NULL;
        try {
            $courses = $this->conn->query($sql)->fetchAll();
            foreach($courses as $course => $coursedata) {
                $ret = [
                    'id' => $coursedata['id'],
                    'name' => $coursedata['name'],
                    'description' => $coursedata['description'],
                    'image' => $coursedata['image'],
                ];
            }
            return $ret;
        }
        Catch (PDOExpection $e) {
            echo 'DB ERROR: '.$e->getMessage();
            die;
        }
    }

    function getStudentByCourse($id) {
        $ret = NULL;
        $sql = <<<SQL
        SELECT * FROM pivot
        WHERE course_id = $id
SQL;
        try {
            $students = $this->conn->query($sql)->fetchAll();
            foreach($students as $student => $studentdata) {
                $s[] = $studentush = $this->getStudent($studentdata['student_id']);
            }
            if(!empty($s)) {
                $ret = [
                    'students' => $s
                ];
            }
            return $ret;
        }
        Catch (PDOExpection $e) {
            echo 'DB ERROR: '.$e->getMessage();
            die;
        }
    }

    function getCourseByStudent($id) {
        $ret = NULL;
        $sql = <<<SQL
        SELECT * FROM pivot
        WHERE student_id = $id
SQL;
        try {
            $courses = $this->conn->query($sql)->fetchAll();
            foreach($courses as $course => $coursedata) {
                $s[] = $studentush = $this->getCourse($coursedata['course_id']);
            }
            if(!empty($s)) {
                $ret = [
                    'courses' => $s
                ];
            }
            return $ret;
        }
        Catch (PDOExpection $e) {
            echo 'DB ERROR: '.$e->getMessage();
            die;
        }
    }

    
    function emailValidate($userEm,$id=NULL) {
        $userEm = Strtolower($userEm);
        $sql = <<<SQL
            SELECT email FROM students
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
                $s = new schoolModel();
                $sd = $s->getStudent($id);
                if($sd['email']==$userEm) {
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

    
    function createStudent($post) {
        $sql = <<<SQL
        INSERT INTO students(first_name,last_name,phone,email,image)
        VALUES (:firstname,:lastname,:phone,:email,:image)
SQL;
        try {
            $stmnt = $this->conn->prepare($sql);
            $params = [
                'firstname' => $post['firstName'],
                'lastname' => $post['lastName'],
                'phone' => $post['phone'],
                'email' => $post['email'],
                'image' => $post['image']
            ];
            $stmnt->execute($params);
            $i = $this->conn->lastInsertId();
            if(!empty($post['course'])) {
                foreach($post['course'] as $id => $coursename) {
                    $sql = <<<SQL
                        INSERT INTO pivot(student_id,course_id)
                        VALUES (:student,:course)
SQL;
                    $stmnt = $this->conn->prepare($sql);
                    $params = [
                        'student' => $i,
                        'course' => $coursename
                    ];
                    $stmnt->execute($params);
                }
            }
            return $i;
        }
        Catch (PDOException $e) {
            echo 'DB ERROR: '.$e->getMessage();
            die;
        }
    }

    function deleteStudent($id) {
        $sql = <<<SQL
        DELETE FROM pivot WHERE student_id={$id}
SQL;
        $sql2 = <<<SQL
        DELETE FROM students WHERE id={$id}
SQL;
        try {
            $this->conn->query($sql);
            $this->conn->query($sql2);
        }
        Catch (PDOException $e) {
            echo 'DB CONNECT ERROR: '.$e->getMessage();
            die;
        }
    }

    function updateStudent($post) {
        $sql = <<<SQL
            UPDATE students
            SET first_name = :firstname, last_name=:lastname, phone=:phone, email=:email,image=:image
            WHERE id = :id;
SQL;
        try {
            $stmnt = $this->conn->prepare($sql);
            $params = [
                'firstname' => $post['firstName'],
                'lastname' => $post['lastName'],
                'phone' => $post['phone'],
                'email' => $post['email'],
                'image' => $post['image'],
                'id' => $post['id']
            ];
            $stmnt->execute($params);
            $i = $params['id'];
            $sql = <<<SQL
            DELETE FROM pivot WHERE student_id = {$post['id']}
SQL;
            $this->conn->query($sql);
            if(!empty($post['course'])) {
                foreach($post['course'] as $id => $coursename) {
                    $sql = <<<SQL
                        INSERT INTO pivot(student_id,course_id)
                        VALUES (:student,:course)
SQL;
                    $stmnt = $this->conn->prepare($sql);
                    $params = [
                        'student' => $i,
                        'course' => $coursename
                    ];
                    $stmnt->execute($params);
                }
            }
            return $i;
        }
        Catch (PDOException $e) {
            echo 'DB ERROR: '.$e->getMessage();
            die;
        }
    }

    function courseValidate($course,$id=NULL) {
        $sql = <<<SQL
            SELECT name FROM courses
SQL;
        $ret = TRUE;
        try {
            $courses = $this->conn->query($sql)->fetchAll();
            foreach($courses as $coursedata => $coursename) {
                if($coursename['name']==$course) {
                    $ret = FALSE;
                }
            }
            if(!empty($id)) {
                $s = new schoolModel();
                $sd = $s->getCourse($id);
                if($sd['name']==$course) {
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

    function createCourse($post) {
        $sql = <<<SQL
        INSERT INTO courses(name,description,image)
        VALUES (:coursename,:description,:image)
SQL;
        try {
            $stmnt = $this->conn->prepare($sql);
            $params = [
                'coursename' => $post['course'],
                'description' => $post['description'],
                'image' => $post['image']
            ];
            $stmnt->execute($params);
            $i = $this->conn->lastInsertId();
            return $i;
        }
        Catch (PDOException $e) {
            echo 'DB ERROR: '.$e->getMessage();
            die;
        }
    }

    function deleteCourse($id) {
        $sql = <<<SQL
            DELETE FROM pivot WHERE course_id={$id}
SQL;
        $sql2 = <<<SQL
        DELETE FROM courses WHERE id={$id}
SQL;
        try {
            $this->conn->query($sql);
            $this->conn->query($sql2);
        }
        Catch (PDOException $e) {
            echo 'DB CONNECT ERROR: '.$e->getMessage();
            die;
        }
    }

    function updateCourse($post) {
        $sql = <<<SQL
        UPDATE courses
        SET name = :coursename, description = :description, image= :image
        WHERE id = :id
SQL;
        try {
            $stmnt = $this->conn->prepare($sql);
            $params = [
                'coursename' => $post['course'],
                'description' => $post['description'],
                'image' => $post['image'],
                'id' => $post['id']
            ];
            $stmnt->execute($params);
            $i = $post['id'];
            return $i;
        }
        Catch (PDOException $e) {
            echo 'DB ERROR: '.$e->getMessage();
            die;
        }
    }
}

?>