<?php

include_once './config/database.php';

class Admin extends Database
{
    // ======================= DASHBOARD ================

    // ======================= ADMIN ================
    public function get_admin_info($username)
    {
        $sql = "
        SELECT admins.id,username,avatar,email,admins.name,last_login,birthday,permissions.name as permission_detail,genders.name as gender_detail FROM admins
        INNER JOIN permissions ON admins.permission_id = permissions.id
        INNER JOIN genders ON admins.gender_id = genders.id
        WHERE username = '$username'";
        $this->set_query($sql);
        return $this->load_row();
    }

    public function add_admin($name, $username, $password, $email, $birthday, $gender)
    {
        $sql = "SELECT id FROM admins WHERE username = '$username' OR email = '$email'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        }

        $sql = "INSERT INTO admins (name, username, password, email, birthday, gender_id) VALUES ('$name', '$username', '$password', '$email', '$birthday', '$gender')";
        $this->set_query($sql);
        return $this->execute_return_status();
        // return true;
    }

    public function get_list_admins()
    {
        $sql = "SELECT admins.id,username,avatar,email,admins.name,last_login,birthday,permissions.name as permission_detail,genders.name as gender_detail FROM admins
        INNER JOIN permissions ON admins.permission_id = permissions.id
        INNER JOIN genders ON admins.gender_id = genders.id";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function edit_admin($id, $password, $name, $gender_id, $birthday)
    {
        $sql = "SELECT username FROM admins WHERE id = '$id'";
        $this->set_query($sql);
        if ($this->load_row() == '') {
            return false;
        }
        $sql = "UPDATE admins set password='$password', name ='$name', gender_id ='$gender_id', birthday ='$birthday' where id='$id'";
        $this->set_query($sql);
        $this->execute_return_status();
        return true;
    }

    public function del_admin($id)
    {
        $sql = "DELETE FROM admins where id='$id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "SELECT username FROM admins WHERE id = '$id'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        }
        return true;
    }

    // ======================= TEACHER ================
    public function get_teacher_info($username)
    {
        $sql = "
        SELECT teachers.id,username,avatar,email,teachers.name,last_login,birthday,permissions.name as permission_detail,genders.name as gender_detail FROM teachers
        INNER JOIN permissions ON teachers.permission_id = permissions.id
        INNER JOIN genders ON teachers.gender_id = genders.id WHERE username = '$username'";
        $this->set_query($sql);
        return $this->load_row();
    }

    public function add_teacher($name, $username, $password, $email, $birthday, $gender)
    {
        $sql = "SELECT id FROM teachers WHERE username = '$username' or email = '$email'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        }

        $sql = "INSERT INTO teachers (username,password,name,email,birthday,gender_id) VALUES ('$username','$password','$name','$email','$birthday','$gender')";
        $this->set_query($sql);
        return $this->execute_return_status();
        // return true;
    }

    public function get_list_teachers()
    {
        $sql = "SELECT teachers.id,username,avatar,email,teachers.name,last_login,birthday,permissions.name as permission_detail,genders.name as gender_detail FROM teachers
        INNER JOIN permissions ON teachers.permission_id = permissions.id
        INNER JOIN genders ON teachers.gender_id = genders.id";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function edit_teacher($id, $password, $name, $gender_id, $birthday)
    {
        $sql = "SELECT username FROM teachers WHERE id = '$id'";
        $this->set_query($sql);
        if ($this->load_row() == '') {
            return false;
        }
        $sql = "UPDATE teachers set password='$password', name ='$name', gender_id ='$gender_id', birthday ='$birthday' where id='$id'";
        $this->set_query($sql);
        $this->execute_return_status();
        return true;
    }

    public function del_teacher($id)
    {
        $sql = "DELETE FROM teacher_notifications where teacher_id='$id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "DELETE FROM teachers where id='$id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "SELECT username FROM teachers WHERE id = '$id'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        }
        return true;
    }

    // ======================= GRADE ================
    public function get_grade_info($name)
    {
        $sql = "SELECT * FROM grades WHERE name = '$name'";

        $this->set_query($sql);
        return $this->load_row();
    }

    public function add_grade($name)
    {
        $sql = "SELECT id FROM grades WHERE name = '$name'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        }

        $sql = "INSERT INTO grades (name) VALUES ('$name')";
        $this->set_query($sql);
        return $this->execute_return_status();
        // return true;
    }

    public function get_list_grades()
    {
        $sql = "SELECT * FROM grades";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function edit_grade($id, $name)
    {
        $sql = "SELECT name FROM grades WHERE id = '$id'";
        $this->set_query($sql);
        if ($this->load_row() == '') {
            return false;
        }
        $sql = "UPDATE grades set name ='$name' where id='$id'";
        $this->set_query($sql);
        $this->execute_return_status();
        return true;
    }

    public function del_grade($id)
    {
        $sql = "DELETE FROM grades where id='$id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "SELECT name FROM grades WHERE id = '$id'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        }
        return true;
    }

    // ======================= CLASS ================
    public function get_class_info($name)
    {
        $sql = "
        SELECT classes.id,classes.name as class_name,teachers.name as teacher_name, grades.name as grade_detail FROM classes
        INNER JOIN grades ON classes.grade_id = grades.id
        INNER JOIN teachers ON classes.teacher_id = teachers.id
        WHERE classes.name = '$name'";
        $this->set_query($sql);
        return $this->load_row();
    }

    public function add_class($grade_id, $name, $teacher_id)
    {
        $sql = "SELECT id FROM classes WHERE name = '$name'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        }
        $sql = "INSERT INTO classes (grade_id,name,teacher_id) VALUES ('$grade_id','$name','$teacher_id')";
        $this->set_query($sql);
        return $this->execute_return_status();
    }

    public function get_list_classes()
    {
        $sql = "
        SELECT classes.id,classes.name as class_name,teachers.name as teacher_name,grades.name as grade_detail FROM classes
        INNER JOIN grades ON classes.grade_id = grades.id
        INNER JOIN teachers ON classes.teacher_id = teachers.id";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function edit_class($id, $name, $grade_id, $teacher_id)
    {
        $sql = "UPDATE classes SET name='$name', grade_id='$grade_id', teacher_id ='$teacher_id' where id ='$id'";
        $this->set_query($sql);
        $this->execute_return_status();
    }

    public function del_class($id)
    {
        $sql = "DELETE FROM chats where class_id='$id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "DELETE FROM student_notifications where class_id='$id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "DELETE FROM classes where id='$id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "SELECT name FROM classes WHERE id = '$id'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        }
        return true;
    }

    // ======================= STUDENT ================
    public function get_student_info($username)
    {
        $sql = "
        SELECT students.id,username,students.name,email,avatar,birthday,last_login,permissions.name as permission_detail,genders.name as gender_detail,classes.name as class_name FROM students
        INNER JOIN permissions ON students.permission_id = permissions.id
        INNER JOIN classes ON students.class_id = classes.id
        INNER JOIN genders ON students.gender_id = genders.id WHERE username = '$username'";
        $this->set_query($sql);
        return $this->load_row();
    }

    public function add_student($username, $password, $name, $class_id, $email, $birthday, $gender_id)
    {
        $sql = "SELECT id FROM students WHERE username = '$username' OR email = '$email";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        }
        $sql = "INSERT INTO students (username,password,name,class_id,email,birthday,gender_id) VALUES ('$username','$password','$name','$class_id','$email','$birthday','$gender_id')";
        $this->set_query($sql);
        return $this->execute_return_status();
        // return true;
    }

    public function get_list_students()
    {
        $sql = "
        SELECT students.id,username,students.name,email,avatar,birthday,last_login,permissions.name as permission_detail,genders.name as gender_detail,classes.name as class_name FROM students
        INNER JOIN permissions ON students.permission_id = permissions.id
        INNER JOIN classes ON students.class_id = classes.id
        INNER JOIN genders ON students.gender_id = genders.id";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function edit_student($id, $birthday, $password, $name, $class_id, $gender_id)
    {
        $sql = "UPDATE students set birthday='$birthday', password='$password', name ='$name', class_id ='$class_id', gender_id = '$gender_id' where id='$id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "UPDATE scores set class_id ='$class_id' where id='$id'";
        $this->set_query($sql);
        $this->execute_return_status();
    }

    public function del_student($id)
    {
        $sql = "DELETE FROM scores where student_id='$id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "DELETE FROM students where id='$id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "SELECT username FROM students WHERE id = '$id'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        }
        return true;
    }

    public function get_class_name($class_id)
    {
        $sql = "SELECT name FROM classes WHERE id = '$class_id'";
        $this->set_query($sql);
        return $this->load_rows();
    }

    // ======================= SUBJECT ================
    public function get_subject_info($name)
    {
        $sql = "SELECT * FROM subjects WHERE name = '$name'";

        $this->set_query($sql);
        return $this->load_row();
    }

    public function get_list_subjects()
    {
        $sql = "SELECT * FROM subjects";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function add_subject($name)
    {
        $sql = "INSERT INTO subjects (name) VALUES ('$name')";
        $this->set_query($sql);
        return $this->execute_return_status();
    }

    public function edit_subject($id, $name)
    {
        $sql = "SELECT name FROM subjects WHERE id = '$id'";
        $this->set_query($sql);
        if ($this->load_row() == '') {
            return false;
        }
        $sql = "UPDATE subjects set name='$name' where id='$id'";
        $this->set_query($sql);
        return $this->execute_return_status();
    }

    public function del_subject($id)
    {
        $sql = "DELETE FROM subjects where id='$id'";
        $this->set_query($sql);
        return $this->execute_return_status();
    }

    // ======================= QUESTION ================
    public function get_list_questions()
    {
        $sql = "
        SELECT questions.id,questions.question_content,questions.unit,grades.name as grade_detail, questions.answer_a,questions.answer_b,questions.answer_c,questions.answer_d,questions.correct_answer,subjects.name as subject_detail FROM questions 
        INNER JOIN grades ON grades.id = questions.grade_id 
        INNER JOIN subjects ON subjects.id = questions.subject_id";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function add_question($unit, $question_content, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer, $grade_id, $subject_id)
    {
        $sql = "INSERT INTO questions (unit,question_content,answer_a,answer_b,answer_c,answer_d,correct_answer,grade_id,subject_id) VALUES ($unit,'$question_content','$answer_a','$answer_b','$answer_c','$answer_d','$correct_answer',$grade_id,$subject_id)";
        $this->set_query($sql);
        return $this->execute_return_status();
    }

    public function edit_question($id, $unit, $question_content, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer, $grade_id, $subject_id)
    {
        $sql = "UPDATE questions set unit ='$unit', question_content='$question_content', answer_a ='$answer_a', answer_b ='$answer_b', answer_c ='$answer_c', answer_d ='$answer_d', correct_answer ='$correct_answer', grade_id='$grade_id', subject_id='$subject_id' where id = '$id'";
        $this->set_query($sql);
        return $this->execute_return_status();
    }

    public function del_question($id)
    {
        $sql = "DELETE FROM questions where id='$id'";
        $this->set_query($sql);
        return $this->execute_return_status();
    }

    public function get_question_info($id)
    {
        $sql = "
        SELECT questions.id,questions.question_content,questions.unit,grades.name as grade_detail, questions.answer_a,questions.answer_b,questions.answer_c,questions.answer_d,questions.correct_answer,subjects.name as subject_detail FROM questions 
        INNER JOIN grades ON grades.id = questions.grade_id 
        INNER JOIN subjects ON subjects.id = questions.subject_id WHERE questions.id = '$id'";
        $this->set_query($sql);
        return $this->load_row();
    }

    // ======================= TEST ================

    public function add_test($test_code, $test_name, $password, $total_questions, $time_to_do, $note, $grade_id, $subject_id)
    {

        $sql = "INSERT INTO tests (`test_code`, `test_name`, `password`, `total_questions`, `time_to_do`, `note`, `grade_id`, `subject_id`, `status_id`) VALUES ('$test_code','$test_name','$password','$total_questions','$time_to_do','$note','$grade_id','$subject_id',2)";
        $this->set_query($sql);
        return $this->execute_return_status();
    }

    public function get_list_tests()
    {
        $sql = "
        SELECT tests.test_code,tests.test_name,tests.password,tests.total_questions,tests.time_to_do,tests.note,grades.name as grade_detail,subjects.name as subject_detail,statuses.id as status_id, statuses.name as status_detail FROM tests 
        INNER JOIN grades ON grades.id = tests.grade_id 
        INNER JOIN subjects ON subjects.id = tests.subject_id 
        INNER JOIN statuses ON statuses.id = tests.status_id";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function toggle_test_status($test_code, $status_id)
    {
        $sql = "UPDATE tests set status_id='$status_id' where test_code ='$test_code'";
        $this->set_query($sql);
        return $this->execute_return_status();
    }

    public function get_list_units($grade_id, $subject_id)
    {
        $sql = "SELECT DISTINCT unit, COUNT(unit) as total FROM questions WHERE subject_id = $subject_id and grade_id = $grade_id GROUP BY unit";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function list_quest_of_unit($grade_id, $subject_id, $unit, $limit)
    {
        $sql = "SELECT * FROM questions WHERE grade_id = $grade_id and subject_id = $subject_id and unit = $unit ORDER BY RAND() LIMIT $limit";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function add_quest_to_test($test_code, $question_id)
    {
        $sql = "INSERT INTO quest_of_test (test_code, question_id) VALUES ('$test_code',$question_id)";
        $this->set_query($sql);
        return $this->execute_return_status();
    }

    public function get_quest_of_test($test_code)
    {
        $sql = "SELECT * FROM quest_of_test
        INNER JOIN questions ON quest_of_test.question_id = questions.id
        WHERE test_code = $test_code";
        $this->set_query($sql);
        return $this->load_rows();
    }


    // ======================= COMMON ================
    public function update_last_login($id)
    {
        $sql = "UPDATE admins set last_login=NOW() where id='$id'";
        $this->set_query($sql);
        $this->execute_return_status();
    }

    public function valid_username_or_email($data)
    {
        $sql = "SELECT name FROM students WHERE username = '$data' OR email = '$data'
        UNION
        SELECT name FROM teachers WHERE username = '$data' OR email = '$data'
        UNION
        SELECT name FROM admins WHERE username = '$data' OR email = '$data'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        } else {
            return true;
        }
    }

    public function valid_grade_name($data)
    {
        $sql = "SELECT name FROM grades WHERE name = '$data'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        } else {
            return true;
        }
    }

    public function valid_subject_name($data)
    {
        $sql = "SELECT name FROM subjects WHERE name = '$data'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        } else {
            return true;
        }
    }

    public function valid_class_name($class_name)
    {
        $sql = "SELECT class_id FROM classes WHERE class_name = '$class_name'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        } else {
            return true;
        }
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

    public function get_list_genders()
    {
        $sql = "SELECT * FROM genders";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function get_list_statuses()
    {
        $sql = "
        SELECT * FROM statuses";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function get_test_score($test_code)
    {
        $sql = "SELECT * FROM `scores` INNER JOIN students ON scores.student_id = students.student_id 
        INNER JOIN classes ON students.class_id = classes.class_id
        WHERE test_code = '$test_code'";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function update_profiles($username, $name, $email, $password, $gender, $birthday)
    {
        $sql = "UPDATE admins set email='$email',password='$password', name ='$name', gender_id ='$gender', birthday ='$birthday' where username='$username'";
        $this->set_query($sql);
        $this->execute_return_status();
        return true;
    }

    public function update_avatar($avatar, $username)
    {
        $sql = "UPDATE admins set avatar='$avatar' where username='$username'";
        $this->set_query($sql);
        $this->execute_return_status();
    }

    public function get_total_student()
    {
        $sql = "SELECT COUNT(student_id) as total FROM students";
        $this->set_query($sql);
        return $this->load_row()->total;
    }

    public function get_total_admin()
    {
        $sql = "SELECT COUNT(id) as total FROM admins";
        $this->set_query($sql);
        return $this->load_row()->total;
    }

    public function get_total_teacher()
    {
        $sql = "SELECT COUNT(teacher_id) as total FROM teachers";
        $this->set_query($sql);
        return $this->load_row()->total;
    }

    public function get_total_class()
    {
        $sql = "SELECT COUNT(class_id) as total FROM classes";
        $this->set_query($sql);
        return $this->load_row()->total;
    }

    public function get_total_subject()
    {
        $sql = "SELECT COUNT(subject_id) as total FROM subjects";
        $this->set_query($sql);
        return $this->load_row()->total;
    }

    public function get_total_question()
    {
        $sql = "SELECT COUNT(question_id) as total FROM questions";
        $this->set_query($sql);
        return $this->load_row()->total;
    }

    public function get_total_grade()
    {
        $sql = "SELECT COUNT(grade_id) as total FROM grades";
        $this->set_query($sql);
        return $this->load_row()->total;
    }

    public function get_total_test()
    {
        $sql = "SELECT COUNT(test_code) as total FROM tests";
        $this->set_query($sql);
        return $this->load_row()->total;
    }
}
