<?php

require_once 'app/Models/Teacher.php';
require_once './routes/RTeacher.php';
//load thư viện PhpSpreadSheet
require './vendors/SpreadSheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TeacherController
{
    public $info =  array();

    public function __construct()
    {
        $user_info = $this->get_teacher_info($_SESSION['username']);
        $this->info['id'] = $user_info->id;
        $this->update_last_login($this->info['id']);
        $this->info['username'] = $user_info->username;
        $this->info['name'] = $user_info->name;
        $this->info['avatar'] = $user_info->avatar;
    }

    public function get_teacher_info($username)
    {
        $info = new Teacher();
        return $info->get_teacher_info($username);
    }

    public function show_dashboard()
    {
        $route = new RTeacher();
        $route->show_head();
        $route->show_navbar($this->info);
        $route->show_dashboard();
        $route->show_foot();
    }

    public function show_class_detail()
    {
        $route = new RTeacher();
        $route->show_head();
        $route->show_navbar($this->info);
        $route->show_class_detail();
        $route->show_foot();
    }

    public function list_test()
    {
        $model = new Teacher();
        $tests = $model->get_list_test($this->info['id']);

        $route = new RTeacher();
        $route->show_head();
        $route->show_navbar($this->info);
        $route->show_list_test($tests);
        $route->show_foot();
    }

    public function update_last_login()
    {
        $info = new Teacher();
        $info->update_last_login($this->info['id']);
    }

    public function get_list_classes_by_teacher()
    {
        $list = new Teacher();
        echo json_encode($list->get_list_classes_by_teacher($this->info['id']));
    }

    // public function profiles()
    // {
    //     $profiles = new Teacher();
    //     return $profiles->get_profiles($_SESSION['username']);
    // }

    public function valid_email_on_profiles()
    {
        $result = array();
        $valid = new Teacher();
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
        $info = new Teacher();
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

    public function update_profiles($username, $name, $email, $password, $gender, $birthday)
    {
        $info = new Teacher();
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

    public function get_score()
    {
        $student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '1';
        $score = new Teacher();
        echo json_encode($score->get_score($student_id));
    }

    public function get_class_detail()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '1';
        $class = new Teacher();
        echo json_encode($class->get_class_detail($id));
    }

    public function export_score()
    {
        $test_code = isset($_GET['test_code']) ? htmlspecialchars($_GET['test_code']) : '';

        $model = new Teacher();
        $scores = $model->get_test_score($test_code);

        //Create Excel Data
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Danh Sách Điểm Bài Thi ' . $test_code);
        $sheet->setCellValue('A3', 'STT');
        $sheet->setCellValue('B3', 'Tên');
        $sheet->setCellValue('C3', 'Tài Khoản');
        $sheet->setCellValue('D3', 'Lớp');
        $sheet->setCellValue('E3', 'Điểm');

        for ($i = 0; $i < count($scores); $i++) {
            $sheet->setCellValue('A' . ($i + 4), $i + 1);
            $sheet->setCellValue('B' . ($i + 4), $scores[$i]->name);
            $sheet->setCellValue('C' . ($i + 4), $scores[$i]->username);
            $sheet->setCellValue('D' . ($i + 4), $scores[$i]->class_name);
            $sheet->setCellValue('E' . ($i + 4), $scores[$i]->score_number);
        }

        //Output File
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attactment;filename="danh-sach-diem-' . $test_code . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function logout()
    {
        $result = array();
        $confirm = isset($_POST['confirm']) ? $_POST['confirm'] : false;
        if ($confirm) {
            $result['status_value'] = "Đăng xuất thành công!";
            $result['status'] = 1;
            session_destroy();
        }
        echo json_encode($result);
    }

    public function show_about()
    {
        $route = new RTeacher();
        $route->show_head($this->info);
        $route->show_about();
        $route->show_foot();
    }

    public function test_score()
    {
        $test_code = isset($_GET['test_code']) ? htmlspecialchars($_GET['test_code']) : '';
        $model = new Teacher();
        $scores = $model->get_test_score($test_code);

        $route = new RTeacher();
        $route->show_head($this->info);
        $route->show_test_score($scores);
        $route->show_foot();
    }

    public function show_404()
    {
        $route = new RTeacher();
        $route->show_head($this->info);
        $route->show_404();
        $route->show_foot();
    }

    // public function show_profiles()
    // {
    //     $route = new RTeacher();
    //     $route->show_head($this->info);
    //     $route->show_profiles($this->profiles());
    //     $route->show_foot();
    // }
}
