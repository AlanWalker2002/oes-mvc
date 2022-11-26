<?php

include_once './config/database.php';

class Student extends Database
{
	// public function get_profiles($username)
	// {
	// 	$sql = "SELECT students.student_id as ID,students.username,students.name,students.email,students.avatar,students.class_id,students.birthday,students.last_login,genders.gender_id,genders.gender_detail,classes.grade_id,students.doing_exam,students.time_remaining FROM `students`
	// 	INNER JOIN genders ON genders.gender_id = students.gender_id
	// 	INNER JOIN classes ON classes.class_id = students.class_id
	// 	WHERE username = '$username'";
	// 	$this->set_query($sql);
	// 	return $this->load_row();
	// }

	public function get_student_info($username)
	{
		$sql = "
        SELECT students.id,username,students.name,email,avatar,birthday,last_login,permissions.name as permission_detail,genders.name as gender_detail,classes.name as class_name, students.doing_exam, students.time_remaining FROM students
        INNER JOIN permissions ON students.permission_id = permissions.id
        INNER JOIN classes ON students.class_id = classes.id
        INNER JOIN genders ON students.gender_id = genders.id WHERE username = '$username'";
		$this->set_query($sql);
		return $this->load_row();
	}

	public function get_list_grades()
	{
		$sql = "SELECT * FROM grades";
		$this->set_query($sql);
		return $this->load_rows();
	}

	public function get_list_subjects()
	{
		$sql = "SELECT * FROM subjects";
		$this->set_query($sql);
		return $this->load_rows();
	}

	public function get_list_statuses()
	{
		$sql = "SELECT * FROM statuses";
		$this->set_query($sql);
		return $this->load_rows();
	}

	public function get_score($student_id, $test_code)
	{
		$sql = "SELECT * FROM scores WHERE student_id = $student_id AND test_code = $test_code";
		$this->set_query($sql);
		return $this->load_row();
	}

	public function get_scores($student_id)
	{
		$sql = "SELECT * FROM scores WHERE student_id = $student_id";
		$this->set_query($sql);
		return $this->load_rows();
	}

	public function update_last_login($id)
	{
		$sql = "UPDATE students set last_login=NOW() where id='$id'";
		$this->set_query($sql);
		$this->execute_return_status();
	}

	public function update_doing_exam($test_code, $time, $id)
	{
		$sql = "UPDATE students SET doing_exam= '$test_code', time_remaining = '$time', starting_time = NOW() where id='$id'";
		$this->set_query($sql);
		$this->execute_return_status();
	}

	public function reset_doing_exam($id)
	{
		$sql = "UPDATE students set doing_exam= NULL, time_remaining = NULL, starting_time = NULL WHERE id='$id'";
		$this->set_query($sql);
		$this->execute_return_status();
	}

	public function valid_email_on_profiles($curren_email, $new_email)
	{
		$sql = "SELECT name FROM teachers WHERE email = '$new_email' AND email NOT IN ('$curren_email')
		UNION SELECT name FROM admins WHERE email = '$new_email' AND email NOT IN ('$curren_email')
		UNION SELECT name FROM students WHERE email = '$new_email' AND email NOT IN ('$curren_email')";
		$this->set_query($sql);
		if ($this->load_row() != '') {
			return false;
		} else {
			return true;
		}
	}

	public function update_avatar($avatar, $username)
	{
		$sql = "UPDATE students set avatar='$avatar' where username='$username'";
		$this->set_query($sql);
		$this->execute_return_status();
	}

	public function update_profiles($username, $name, $email, $password, $gender, $birthday)
	{
		$sql = "UPDATE students set email='$email',password='$password', name ='$name', gender_id ='$gender', birthday ='$birthday' where username='$username'";
		$this->set_query($sql);
		$this->execute_return_status();
		return true;
	}

	public function get_list_tests($limit, $next_page, $class_id)
	{
		$sql = "SELECT tests.test_code,tests.test_name,tests.password,tests.total_questions,tests.time_to_do,tests.note,grades.name as grade, subjects.name as subject_detail, statuses.id as status_id,statuses.name as status, class_id FROM class_of_test 
		INNER JOIN tests ON tests.test_code = class_of_test.test_code 
		INNER JOIN grades ON grades.id = tests.grade_id 
		INNER JOIN subjects ON subjects.id = tests.subject_id 
		INNER JOIN statuses ON statuses.id = tests.status_id 
		WHERE class_id = $class_id
		LIMIT $limit OFFSET $next_page";
		$this->set_query($sql);
		return $this->load_rows();
	}

	public function get_list_tests_filter($subject_id, $grade_id, $status_id, $limit, $next_page, $class_id)
	{
		$sql = "SELECT tests.test_code,tests.test_name,tests.password,tests.total_questions,tests.time_to_do,tests.note,grades.name as grade, subjects.name as subject_detail, statuses.id as status_id,statuses.name as status, class_id FROM class_of_test 
		INNER JOIN tests ON tests.test_code = class_of_test.test_code 
		INNER JOIN grades ON grades.id = tests.grade_id 
		INNER JOIN subjects ON subjects.id = tests.subject_id 
		INNER JOIN statuses ON statuses.id = tests.status_id  
		WHERE subject_id = $subject_id AND grade_id = $grade_id AND status_id = $status_id AND class_id = $class_id LIMIT $limit OFFSET $next_page";
		$this->set_query($sql);
		return $this->load_rows();
	}

	public function get_all_test($class_id)
	{
		$sql = "SELECT tests.test_code,tests.test_name,tests.password,tests.total_questions,tests.time_to_do,tests.note,grades.name as grade, subjects.name as subject_detail, statuses.id as status_id,statuses.name as status, class_id FROM class_of_test 
		INNER JOIN tests ON tests.test_code = class_of_test.test_code 
		INNER JOIN grades ON grades.id = tests.grade_id 
		INNER JOIN subjects ON subjects.id = tests.subject_id 
		INNER JOIN statuses ON statuses.id = tests.status_id 
		WHERE class_id = $class_id";
		$this->set_query($sql);
		return $this->load_rows();
	}

	public function get_all_test_filter($subject_id, $grade_id, $status_id, $class_id)
	{
		$sql = "SELECT tests.test_code,tests.test_name,tests.password,tests.total_questions,tests.time_to_do,tests.note,grades.name as grade, subjects.name as subject_detail, statuses.id as status_id,statuses.name as status, class_id FROM class_of_test 
		INNER JOIN tests ON tests.test_code = class_of_test.test_code 
		INNER JOIN grades ON grades.id = tests.grade_id 
		INNER JOIN subjects ON subjects.id = tests.subject_id 
		INNER JOIN statuses ON statuses.id = tests.status_id  
		WHERE subject_id = $subject_id AND grade_id = $grade_id AND status_id = $status_id AND class_id = $class_id";
		$this->set_query($sql);
		return $this->load_rows();
	}

	public function get_test($test_code)
	{
		$sql = "SELECT * FROM tests WHERE test_code = '$test_code'";
		$this->set_query($sql);
		return $this->load_row();
	}

	public function get_quest_of_test($test_code)
	{
		$sql = "SELECT * FROM quest_of_test
		INNER JOIN questions ON questions.id = quest_of_test.question_id
		WHERE test_code = $test_code ORDER BY RAND()";
		$this->set_query($sql);
		return $this->load_rows();
	}

	public function add_student_quest($id, $student_id, $test_code, $question_id, $answer_a, $answer_b, $answer_c, $answer_d)
	{
		$sql = "INSERT INTO student_test_detail (id, student_id, test_code, question_id, answer_a, answer_b, answer_c, answer_d) VALUES ($id, $student_id, $test_code, $question_id, '$answer_a', '$answer_b', '$answer_c', '$answer_d');";
		$this->set_query($sql);
		return $this->execute_return_status();
	}

	public function get_doing_quest($test_code, $student_id)
	{
		$sql = "SELECT student_test_detail.*,questions.question_content, questions.answer_a as answer_qa, questions.answer_b as answer_qb, questions.answer_c as answer_qc, questions.answer_d as answer_qd, students.name as student_name, classes.name as class_name, students.avatar, tests.time_to_do, tests.total_questions FROM student_test_detail
		INNER JOIN questions ON student_test_detail.question_id = questions.id
        INNER JOIN students ON student_test_detail.student_id = students.id
        INNER JOIN tests ON student_test_detail.test_code = tests.test_code
		INNER JOIN classes ON students.class_id = classes.id
		WHERE student_test_detail.test_code = $test_code AND student_id = $student_id ORDER BY student_test_detail.id";
		$this->set_query($sql);
		return $this->load_rows();
	}

	public function get_result_quest($test_code, $student_id)
	{
		$sql = "SELECT student_test_detail.*,questions.question_content, questions.answer_a as answer_qa, questions.answer_b as answer_qb, questions.answer_c as answer_qc, questions.answer_d as answer_qd, students.name as student_name, classes.name as class_name, students.avatar, questions.correct_answer, questions.explanation, tests.total_questions FROM student_test_detail
		INNER JOIN questions ON student_test_detail.question_id = questions.id
        INNER JOIN students ON student_test_detail.student_id = students.id
        INNER JOIN tests ON student_test_detail.test_code = tests.test_code
		INNER JOIN classes ON students.class_id = classes.id
		WHERE student_test_detail.test_code = $test_code AND student_id = $student_id ORDER BY student_test_detail.id";
		$this->set_query($sql);
		return $this->load_rows();
	}

	public function update_answer($student_id, $test_code, $question_id, $student_answer)
	{
		$sql = "UPDATE student_test_detail SET student_answer='$student_answer' WHERE student_id=$student_id AND test_code=$test_code AND question_id=$question_id";
		$this->set_query($sql);
		$this->execute_return_status();
	}

	public function update_timing($student_id, $time)
	{
		$sql = "UPDATE students SET time_remaining='$time' WHERE id=$student_id";
		$this->set_query($sql);
		$this->execute_return_status();
	}

	public function insert_score($student_id, $test_code, $score, $score_detail)
	{
		$sql = "INSERT INTO scores (student_id, test_code, score_number, score_detail, completion_time) VALUES ('$student_id', '$test_code', '$score', '$score_detail', NOW())";
		$this->set_query($sql);
		return $this->execute_return_status();
	}
}
