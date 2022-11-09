<?php

include_once './config/database.php';

class Teacher extends Database
{
    public function get_teacher_info($username)
    {
        $sql = "
        SELECT teachers.id,username,avatar,email,teachers.name,last_login,birthday,permissions.name as permission_detail,genders.name as gender_detail FROM teachers
        INNER JOIN permissions ON teachers.permission_id = permissions.id
        INNER JOIN genders ON teachers.gender_id = genders.id
        WHERE username = '$username'";
        $this->set_query($sql);
        return $this->load_row();
    }

    public function update_last_login($id)
    {
        $sql = "UPDATE teachers set last_login=NOW() where id='$id'";
        $this->set_query($sql);
        $this->execute_return_status();
    }

    public function valid_email_on_profiles($curren_email, $new_email)
    {
        $sql = "SELECT name FROM students WHERE email = '$new_email' AND email NOT IN ('$curren_email')
        UNION SELECT name FROM admins WHERE email = '$new_email' AND email NOT IN ('$curren_email')
        UNION SELECT name FROM teachers WHERE email = '$new_email' AND email NOT IN ('$curren_email')";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        } else {
            return true;
        }
    }

    public function get_list_test($id)
    {
        $sql = "SELECT tests.test_code,tests.test_name,tests.total_questions,tests.time_to_do,tests.note,grades.name as grade_name,subjects.name as subject_name FROM tests
        INNER JOIN grades ON grades.id = tests.grade_id
        INNER JOIN subjects ON subjects.id = tests.subject_id
        WHERE test_code IN (SELECT DISTINCT test_code FROM scores
        INNER JOIN students ON scores.student_id = students.id
        WHERE students.class_id IN (SELECT DISTINCT id FROM classes WHERE classes.teacher_id = '$id'))";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function get_test_score($test_code)
    {
        $sql = "SELECT * FROM scores INNER JOIN students ON scores.student_id = students.student_id 
        INNER JOIN classes ON students.class_id = classes.class_id
        WHERE test_code = '$test_code'";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function get_score($student_id)
    {
        $sql = "SELECT * FROM scores
        WHERE student_id = $student_id";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function update_avatar($avatar, $username)
    {
        $sql = "UPDATE teachers set avatar='$avatar' where username='$username'";
        $this->set_query($sql);
        $this->execute_return_status();
    }

    public function update_profiles($username, $name, $email, $password, $gender, $birthday)
    {
        $sql = "UPDATE teachers set email='$email',password='$password', name ='$name', gender_id ='$gender', birthday ='$birthday' where username='$username'";
        $this->set_query($sql);
        $this->execute_return_status();
        return true;
    }

    public function get_list_classes_by_teacher($id)
    {
        $sql = "SELECT classes.id,classes.name,grades.name as grade FROM classes
        INNER JOIN grades ON grades.id = classes.grade_id
        WHERE teacher_id = '$id'";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function get_class_detail($class_id)
    {
        $sql = "SELECT students.id,students.avatar,students.username,students.name,students.birthday,genders.name as gender_detail,students.last_login,classes.name as class_name FROM students
        INNER JOIN genders ON genders.id = students.gender_id
        INNER JOIN classes ON students.class_id = classes.id
        WHERE students.class_id = '$class_id'";
        $this->set_query($sql);
        return $this->load_rows();
    }
}
