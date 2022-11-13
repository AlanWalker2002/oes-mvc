<?php

require_once 'app/Models/Student.php';
require_once './routes/RStudent.php';

class StudentController
{
	public $info = array();
	public function __construct()
	{
		$user_info = $this->get_student_info($_SESSION['username']);
		$this->info['id'] = $user_info->id;
		$this->update_last_login($this->info['id']);
		$this->info['username'] = $user_info->username;
		$this->info['name'] = $user_info->name;
		$this->info['avatar'] = $user_info->avatar;
		$this->info['class_id'] = $user_info->class_id;
		$this->info['grade_id'] = $user_info->grade_id;
		$this->info['doing_exam'] = $user_info->doing_exam;
		$this->info['time_remaining'] = $user_info->time_remaining;
	}

	public function get_student_info($username)
	{
		$info = new Student();
		return $info->get_student_info($username);
	}

	public function update_last_login()
	{
		$info = new Student();
		$info->update_last_login($this->info['id']);
	}

	public function show_dashboard()
	{
		$route = new RStudent();
		$route->show_head();
		$route->show_dashboard($this->info);
		$route->show_foot_st();
	}

	public function list_test()
	{
		$route = new RStudent();
		$model = new Student();

		if ($this->info['doing_exam'] == '') {
			$limit = 2;
			if (!isset($_GET['page'])) {
				$current_page = 1;
			} else {
				$current_page = $_GET['page'];
			}
			$next_page = ($current_page - 1) * $limit;
			$route->show_head($this->info);
			$tests = $model->get_list_tests($limit, $next_page);
			$scores = $model->get_scores($this->info['id']);
			$get_all_test = $model->get_all_test();
			$subjects = $model->get_list_subjects();
			$grades = $model->get_list_grades();
			$statuses = $model->get_list_statuses();
			$count_test = count($tests);
			$route->list_test($this->info, $tests, $scores, $count_test, $get_all_test, $subjects, $grades, $statuses);
			$route->show_foot_st();
		} else {
			$test = $model->get_doing_quest($this->info['doing_exam'], $this->info['id']);
			$time_string[] = explode(":", $this->info['time_remaining']);
			$min = $time_string[0][0];
			$sec = $time_string[0][1];
			$route->show_head();
			$route->show_exam($test, $min, $sec);
			$route->custom_theme();
			$route->show_foot_exam();
		}
	}

	public function list_test_filter()
	{
		$route = new RStudent();
		$model = new Student();

		if ($this->info['doing_exam'] == '') {
			$limit = 2;
			if (!isset($_GET['page'])) {
				$current_page = 1;
			} else {
				$current_page = $_GET['page'];
			}

			if (isset($_GET['subject_id']) && $_GET['subject_id'] && $_GET['subject_id']) {
				$subject_id = $_GET['subject_id'];
				$grade_id = $_GET['grade_id'];
				$status_id = $_GET['status_id'];
			}

			$next_page = ($current_page - 1) * $limit;

			$route->show_head($this->info);
			$tests = $model->get_list_tests_filter($subject_id, $grade_id, $status_id, $limit, $next_page);
			$scores = $model->get_scores($this->info['id']);
			$get_all_test_filter = $model->get_all_test_filter($subject_id, $grade_id, $status_id);
			$subjects = $model->get_list_subjects();
			$grades = $model->get_list_grades();
			$statuses = $model->get_list_statuses();
			$count_test = count($tests);
			$route->list_test_filter($this->info, $tests, $scores, $count_test, $get_all_test_filter, $subject_id, $grade_id, $status_id, $subjects, $grades, $statuses);
			$route->show_foot_st();
		} else {
			$test = $model->get_doing_quest($this->info['doing_exam'], $this->info['id']);
			$time_string[] = explode(":", $this->info['time_remaining']);
			$min = $time_string[0][0];
			$sec = $time_string[0][1];
			$route->show_head();
			$route->show_exam($test, $min, $sec);
			$route->custom_theme();
			$route->show_foot_exam();
		}
	}

	public function get_list_grades()
	{
		$list_grades = new Student();
		echo json_encode($list_grades->get_list_grades());
	}

	public function get_list_subjects()
	{
		$list_grades = new Student();
		echo json_encode($list_grades->get_list_subjects());
	}

	public function get_list_statuses()
	{
		$list_statuses = new Student();
		echo json_encode($list_statuses->get_list_statuses());
	}

	// public function profiles()
	// {
	// 	$profiles = new Student();
	// 	return $profiles->get_profiles($_SESSION['username']);
	// }

	// public function get_question($id)
	// {
	// 	$answer = new Student();
	// 	return $answer->get_question($id);
	// }

	public function get_doing_exam()
	{
		return $this->info['doing_exam'];
	}

	public function update_doing_exam($exam, $time)
	{
		$info = new Student();
		$info->update_doing_exam($exam, $time, $this->info['id']);
	}

	public function update_answer()
	{
		$question_id = $_POST['id'];
		$student_answer = $_POST['answer'];
		$update = new Student();
		$update->update_answer($this->info['id'], $this->info['doing_exam'], $question_id, $student_answer);
		echo $time = $_POST['min'] . ':' . $_POST['sec'];
		$update->update_timing($this->info['id'], $time);
	}

	public function update_timing()
	{
		$update = new Student();
		$time = $_POST['min'] . ':' . $_POST['sec'];
		$update->update_timing($this->info['id'], $time);
	}

	public function reset_doing_exam()
	{
		$info = new Student();
		$info->reset_doing_exam($this->info['id']);
	}

	public function valid_email_on_profiles()
	{
		$result = array();
		$valid = new Student();
		$new_email = isset($_POST['new_email']) ? htmlspecialchars($_POST['new_email']) : '';
		$curren_email = isset($_POST['curren_email']) ? htmlspecialchars($_POST['curren_email']) : '';
		if (empty($new_email)) {
			$result['status'] = 0;
		} else {
			if ($valid->valid_email_on_profiles($curren_email, $new_email)) {
				$result['status'] = 1;
			} else {
				$result['status'] = 0;
			}
		}
		echo json_encode($result);
	}

	public function update_avatar($avatar, $username)
	{
		$info = new Student();
		return $info->update_avatar($avatar, $username);
	}

	public function submit_update_avatar()
	{
		$username = isset($_POST['username']) ? $_POST['username'] : '';
		if (isset($_FILES['file'])) {
			$duoi = explode('.', $_FILES['file']['name']);
			$duoi = $duoi[(count($duoi) - 1)];
			if ($duoi === 'jpg' || $duoi === 'png') {
				if (move_uploaded_file($_FILES['file']['tmp_name'], 'res/img/avatar/' . $username . '_' . $_FILES['file']['name'])) {
					$avatar = $username . '_' . $_FILES['file']['name'];
					$update = $this->update_avatar($avatar, $username);
				}
			}
		}
	}

	public function check_password()
	{
		$result = array();
		$model = new Student();
		$test_code = isset($_POST['test_code']) ? $_POST['test_code'] : '493205';
		$password = isset($_POST['password']) ? md5($_POST['password']) : 'e10adc3949ba59abbe56e057f20f883e';

		if ($password != $model->get_test($test_code)->password) {
			$result['status_value'] = "Sai mật khẩu";
			$result['status'] = 0;
		} else {
			$list_quest = $model->get_quest_of_test($test_code);
			foreach ($list_quest as $quest) {
				$array = array();
				$array[0] = strip_tags(explode('.', $quest->answer_a)[0]);
				$array[1] = strip_tags(explode('.', $quest->answer_b)[0]);
				$array[2] = strip_tags(explode('.', $quest->answer_c)[0]);
				$array[3] = strip_tags(explode('.', $quest->answer_d)[0]);
				// Xếp thứ tự ngẫu nhiên của các phần tử trong mảng:
				// shuffle($array);
				$id = rand(1, time()) + rand(100000, 999999);
				$time = $model->get_test($test_code)->time_to_do . ':00';
				$model->add_student_quest($id, $this->info['id'], $test_code, $quest->question_id, $array[0], $array[1], $array[2], $array[3]);
				$model->update_doing_exam($test_code, $time, $this->info['id']);
			}
			$result['status_value'] = "Nhập mật khẩu thành công chuyển hướng trang làm bài!";
			$result['status'] = 1;
		}
		echo json_encode($result);
	}

	public function update_profiles($username, $name, $email, $password, $gender, $birthday)
	{
		$info = new Student();
		return $info->update_profiles($username, $name, $email, $password, $gender, $birthday);
	}

	public function submit_update_profiles()
	{
		$result = array();
		$name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
		$email = isset($_POST['email']) ? Htmlspecialchars(addslashes($_POST['email'])) : '';
		$username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
		$gender = isset($_POST['gender']) ? Htmlspecialchars(addslashes($_POST['gender'])) : '';
		$birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
		$password = isset($_POST['password']) ? md5($_POST['password']) : '';
		if (empty($name) || empty($gender) || empty($birthday) || empty($password) || empty($email)) {
			$result['status_value'] = "Không được bỏ trống các trường nhập!";
			$result['status'] = 0;
		} else {
			$update = $this->update_profiles($username, $name, $email, $password, $gender, $birthday);
			if (!$update) {
				$result['status_value'] = "Tài khoản không tồn tại!";
				$result['status'] = 0;
			} else {
				// $result = json_decode(json_encode($this->profiles($username)), true);
				$result['status_value'] = "Sửa thành công!";
				$result['status'] = 1;
			}
		}
		echo json_encode($result);
	}

	public function show_result()
	{
		$route = new RStudent();
		$model = new Student();
		if ($this->info['doing_exam'] == '') {
			$test_code = htmlspecialchars($_GET['test_code']);
			$score = $model->get_score($this->info['id'], $test_code);
			$result = $model->get_result_quest($test_code, $this->info['id']);
			if ($score && $result) {
				$route->show_head();
				$route->show_result($score, $result);
				$route->custom_theme();
				$route->show_foot_exam();
			} else {
				$this->show_404();
			}
		} else {
			$test = $model->get_doing_quest($this->info['doing_exam'], $this->info['id']);
			$time_string[] = explode(":", $this->info['time_remaining']);
			$min = $time_string[0][0];
			$sec = $time_string[0][1];
			$route->show_head();
			$route->show_exam($test, $min, $sec);
			$route->custom_theme();
			$route->show_foot_exam();
		}
	}

	public function show_about()
	{
		$route = new RStudent();
		$route->show_head($this->info);
		$route->show_about();
		$route->show_foot();
	}

	public function show_profiles()
	{
		$route = new RStudent();
		$route->show_head($this->info);
		// $route->show_profiles($this->profiles());
		$route->show_foot();
	}

	public function show_404()
	{
		$route = new RStudent();
		$route->show_head($this->info);
		$route->show_404();
		$route->show_foot();
	}

	public function accept_test()
	{
		$model = new Student();
		$test = $model->get_result_quest($this->info['doing_exam'], $this->info['id']);
		$test_code = $test[0]->test_code;
		$total_questions = $test[0]->total_questions;
		$correct = 0;
		$sentence_point = 10 / $total_questions;
		foreach ($test as $t) {
			if (trim($t->student_answer) == trim($t->correct_answer))
				$correct++;
		}
		$score = $correct * $sentence_point;
		$score_detail = $correct . '/' . $total_questions;
		$model->insert_score($this->info['id'], $test_code, $score, $score_detail);
		$model->reset_doing_exam($this->info['id']);
		header("Location: index.php?action=show_result&test_code=" . $test_code);
	}

	public function logout()
	{
		$result = array();
		$confirm = isset($_POST['confirm']) ? $_POST['confirm'] : true;
		if ($confirm) {
			$result['status_value'] = "Đăng xuất thành công!";
			$result['status'] = 1;
			session_destroy();
		}
		echo json_encode($result);
	}
}
