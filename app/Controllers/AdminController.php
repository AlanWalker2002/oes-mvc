<?php

require_once './app/Models/Admin.php';
require_once './routes/RAdmin.php';
require_once './routes/RLogin.php';
// Load thư viện PhpSpreadSheet
require './vendors/SpreadSheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AdminController
{
    private $info  = array();

    public function __construct()
    {
        $user_info = $this->get_admin_info($_SESSION['username']);
        $this->info['permission_id'] = $user_info->permission_id;
        $this->info['id'] = $user_info->id;
        $this->update_last_login($this->info['id']);
        $this->info['username'] = $user_info->username;
        $this->info['name'] = $user_info->name;
        $this->info['avatar'] = $user_info->avatar;
    }

    // ======================= PANELS ================

    // === DASHBOARD ===
    public function show_dashboard()
    {
        $title = 'Trang Tổng Quan';
        $route = new RAdmin();
        $route->show_head($title);
        $route->show_navbar($this->info);
        $route->show_dashboard($this->get_dashboard_info());
        $route->show_foot();
    }

    // === ADMIN ===
    public function show_admins_panel()
    {
        $title = 'Trang Quản Lý Admin';
        $route = new RAdmin();
        $route->show_head($title);
        $route->show_navbar($this->info);
        $route->show_admins_panel();
        $route->show_foot();
    }

    // === TEACHER ===
    public function show_teachers_panel()
    {
        $title = 'Trang Quản Lý Giáo Viên';
        $route = new RAdmin();
        $route->show_head($title);
        $route->show_navbar($this->info);
        $route->show_teachers_panel();
        $route->show_foot();
    }

    // === GRADE ===
    public function show_grades_panel()
    {
        $title = 'Trang Quản Lý Khối';
        $route = new RAdmin();
        $route->show_head($title);
        $route->show_navbar($this->info);
        $route->show_grades_panel();
        $route->show_foot();
    }

    // === CLASS ===
    public function show_classes_panel()
    {
        $title = 'Trang Quản Lý Lớp Học';
        $route = new RAdmin();
        $route->show_head($title);
        $route->show_navbar($this->info);
        $route->show_classes_panel();
        $route->show_foot();
    }

    // === STUDENT ===
    public function show_students_panel()
    {
        $title = 'Trang Quản Lý Học Sinh';
        $route = new RAdmin();
        $route->show_head($title);
        $route->show_navbar($this->info);
        $route->show_students_panel();
        $route->show_foot();
    }

    // === SUBJECT ===
    public function show_subjects_panel()
    {
        $title = 'Trang Quản Lý Môn Học';
        $route = new RAdmin();
        $route->show_head($title);
        $route->show_navbar($this->info);
        $route->show_subjects_panel();
        $route->show_foot();
    }

    // === QUESTION ===
    public function show_questions_panel()
    {
        $title = 'Trang Quản Lý Câu Hỏi';
        $route = new RAdmin();
        $model = new Admin();
        $route->show_head($title);
        $route->show_navbar($this->info);
        $route->show_questions_panel($model->get_list_questions());
        $route->show_foot();
    }

    // === TEST ===
    public function show_tests_panel()
    {
        $title = 'Trang Quản Lý Đề Thi';
        $route = new RAdmin();
        $route->show_head($title);
        $route->show_navbar($this->info);
        $route->show_tests_panel();
        $route->show_foot();
    }

    public function test_detail()
    {
        $title = 'Trang Chi Tiết Điểm Thi';
        $route = new RAdmin();
        $model = new Admin();
        $test_code = htmlspecialchars($_GET['test_code']);
        $route->show_head($title);
        $route->show_navbar($this->info);
        $route->show_tests_detail($model->get_quest_of_test($test_code));
        $route->show_foot();
    }

    // ======================= FUNCTIONS ================

    // === DASHBOARD ===

    // === 2. ADMIN ===
    // == 2.1 CREATE ==
    public function add_admin($name, $username, $password, $email, $birthday, $gender)
    {
        $add = new Admin();
        return $add->add_admin($name, $username, $password, $email, $birthday, $gender);
    }

    public function check_add_admin()
    {
        $result = array();
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        $email = isset($_POST['email']) ? Htmlspecialchars(addslashes($_POST['email'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $gender_id = isset($_POST['gender_id']) ? Htmlspecialchars(addslashes($_POST['gender_id'])) : '';
        if (empty($name) || empty($username) || empty($password) || empty($email) || empty($birthday) || empty($gender_id)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $add = $this->add_admin($name, $username, $password, $email, $birthday, $gender_id);
            if ($add) {
                $result = json_decode(json_encode($this->get_admin_info($username)), true);
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! Tài khoản đã tồn tại!";
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }

    public function check_add_admin_via_file()
    {
        $inputFileType = 'Xlsx';
        $result = array();
        $reader = IOFactory::createReader($inputFileType);
        move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        $spreadsheet = $reader->load($_FILES['file']['name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        unlink($_FILES['file']['name']);
        $count = 0;
        $err_list = '';
        for ($i = 4; $i < count($sheetData); $i++) {
            if ($sheetData[$i]['A'] == '')
                continue;
            $stt = $sheetData[$i]['A'];
            $name = $sheetData[$i]['B'];
            $username = $sheetData[$i]['C'];
            $email = $sheetData[$i]['D'];
            $password = md5($sheetData[$i]['E']);
            $birthday = $sheetData[$i]['F'];
            if ($sheetData[$i]['G'] == 'Nam')
                $gender_id = 2;
            else if ($sheetData[$i]['G'] == 'Nữ')
                $gender_id = 3;
            else
                $gender_id = 1;
            $add = $this->add_admin($name, $username, $password, $email, $birthday, $gender_id);
            if ($add)
                $count++;
            else
                $err_list += $stt . ' ';
        }
        if ($err_list == '') {
            $result['status_value'] = "Thêm thành công " . $count . ' tài khoản!';
            $result['status'] = 1;
        } else {
            $result['status_value'] = "Lỗi! Không thể thêm tài khoản có STT: " . $err_list . ', vui lòng xem lại.';
            $result['status'] = 0;
        }
        echo json_encode($result);
    }

    // == 2.2 READ ==
    public function get_list_admins()
    {
        $list_admins = new Admin();
        echo json_encode($list_admins->get_list_admins());
    }

    // == 2.3 UPDATE ==
    public function edit_admin($id, $password, $name, $gender_id, $birthday)
    {
        $edit = new Admin();
        return $edit->edit_admin($id, $password, $name, $gender_id, $birthday);
    }

    public function check_edit_admin()
    {
        $result = array();
        $id = isset($_POST['id']) ? Htmlspecialchars($_POST['id']) : '';
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $gender_id = isset($_POST['gender_id']) ? Htmlspecialchars(addslashes($_POST['gender_id'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (empty($name) || empty($gender_id) || empty($birthday) || empty($id) || empty($password)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $update = $this->edit_admin($id, $password, $name, $gender_id, $birthday);
            if (!$update) {
                $result['status_value'] = "Tài khoản không tồn tại!";
                $result['status'] = 0;
            } else {
                $result = json_decode(json_encode($this->get_admin_info($username)), true);
                $result['status_value'] = "Sửa thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
    }

    // == 2.4 DELETE ==
    public function del_admin($id)
    {
        $del = new Admin();
        return $del->del_admin($id);
    }

    public function check_del_admin()
    {
        $result = array();
        $id = isset($_POST['id']) ? Htmlspecialchars($_POST['id']) : '';
        $del = $this->del_admin($id);
        if ($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['id'] = $id;
        } else {
            $result['status_value'] = "Không thể xóa!";
            $result['status'] = 0;
            $result['id'] = $id;
        }
        echo json_encode($result);
    }

    public function delete_check_admins()
    {
        $result = array();
        $list_del = "";
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        for ($i = 0; $i < count($list_check) - 1; $i++) {
            $del = $this->del_admin($list_check[$i]);
            if (!$del) {
                $list_del = $list_del . " " . $list_check[$i];
            }
        }
        if ($list_del == '') {
            $result['status'] = 1;
            $result['status_value'] = "Xóa thành công";
        } else {
            $result['status'] = 0;
            $result['status_value'] = "Không thể xóa ID: " . $list_del;
        }
        echo json_encode($result);
    }

    // == 2.5 INFO ==
    public function get_admin_info($username)
    {
        $info = new Admin();
        return $info->get_admin_info($username);
    }

    // === TEACHER ===
    // == 3.1 CREATE == 
    public function add_teacher($name, $username, $password, $email, $birthday, $gender)
    {
        $add = new Admin();
        return $add->add_teacher($name, $username, $password, $email, $birthday, $gender);
    }

    public function check_add_teacher()
    {
        $result = array();
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $email = isset($_POST['email']) ? Htmlspecialchars(addslashes($_POST['email'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $gender_id = isset($_POST['gender_id']) ? Htmlspecialchars(addslashes($_POST['gender_id'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (empty($name) || empty($username) || empty($password)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $add = $this->add_teacher($name, $username, $password, $email, $birthday, $gender_id);
            if ($add) {
                $result = json_decode(json_encode($this->get_teacher_info($username)), true);
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! Tài khoản đã tồn tại!";
                $return['status'] = 0;
            }
        }
        echo json_encode($result);
    }

    public function check_add_teacher_via_file()
    {
        $inputFileType = 'Xlsx';
        $result = array();
        $reader = IOFactory::createReader($inputFileType);
        move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        $spreadsheet = $reader->load($_FILES['file']['name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        unlink($_FILES['file']['name']);
        $count = 0;
        $err_list = '';
        for ($i = 4; $i < count($sheetData); $i++) {
            if ($sheetData[$i]['A'] == '')
                continue;
            $stt = $sheetData[$i]['A'];
            $name = $sheetData[$i]['B'];
            $username = $sheetData[$i]['C'];
            $email = $sheetData[$i]['D'];
            $password = md5($sheetData[$i]['E']);
            $birthday = $sheetData[$i]['F'];
            if ($sheetData[$i]['G'] == 'Nam')
                $gender_id = 2;
            else if ($sheetData[$i]['G'] == 'Nữ')
                $gender_id = 3;
            else
                $gender_id = 1;
            $add = $this->add_teacher($name, $username, $password, $email, $birthday, $gender_id);
            if ($add)
                $count++;
            else
                $err_list += $stt . ' ';
        }
        if ($err_list == '') {
            $result['status_value'] = "Thêm thành công " . $count . ' tài khoản!';
            $result['status'] = 1;
        } else {
            $result['status_value'] = "Lỗi! Không thể thêm tài khoản có STT: " . $err_list . ', vui lòng xem lại.';
            $result['status'] = 0;
        }
        echo json_encode($result);
    }

    // == 3.2 READ ==  
    public function get_list_teachers()
    {
        $list_teachers = new Admin();
        echo json_encode($list_teachers->get_list_teachers());
    }

    // == 3.3 UPDATE == 
    public function edit_teacher($id, $password, $name, $gender_id, $birthday)
    {
        $edit = new Admin();
        return $edit->edit_teacher($id, $password, $name, $gender_id, $birthday);
    }

    public function check_edit_teacher()
    {
        $result = array();
        $id = isset($_POST['id']) ? Htmlspecialchars($_POST['id']) : '';
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $gender_id = isset($_POST['gender_id']) ? Htmlspecialchars(addslashes($_POST['gender_id'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (empty($name) || empty($gender_id) || empty($birthday) || empty($id) || empty($password)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $update = $this->edit_teacher($id, $password, $name, $gender_id, $birthday);
            if (!$update) {
                $result['status_value'] = "Tài khoản không tồn tại!";
                $result['status'] = 0;
            } else {
                $result = json_decode(json_encode($this->get_teacher_info($username)), true);
                $result['status_value'] = "Sửa thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
    }

    // == 3.4 DELETE == 
    public function del_teacher($id)
    {
        $del = new Admin();
        return $del->del_teacher($id);
    }

    public function check_del_teacher()
    {
        $result = array();
        $id = isset($_POST['id']) ? Htmlspecialchars($_POST['id']) : '';
        $del = $this->del_teacher($id);
        if ($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['id'] = $id;
        } else {
            $result['status_value'] = "Không thể xóa!";
            $result['status'] = 0;
            $result['id'] = $id;
        }
        echo json_encode($result);
    }

    public function delete_check_teachers()
    {
        $result = array();
        $list_del = "";
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        for ($i = 0; $i < count($list_check) - 1; $i++) {
            $del = $this->del_teacher($list_check[$i]);
            if (!$del) {
                $list_del = $list_del . " " . $list_check[$i];
            }
        }
        if ($list_del == '') {
            $result['status'] = 1;
            $result['status_value'] = "Xóa thành công";
        } else {
            $result['status'] = 0;
            $result['status_value'] = "Không thể xóa ID: " . $list_del;
        }
        echo json_encode($result);
    }

    // == 3.5 INFO == 
    public function get_teacher_info($username)
    {
        $info = new Admin();
        return $info->get_teacher_info($username);
    }

    // === 4. GRADE ===
    // == 4.1 CREATE ==
    public function add_grade($name)
    {
        $add = new Admin();
        return $add->add_grade($name);
    }

    public function check_add_grade()
    {
        $result = array();
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        if (empty($name)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $add = $this->add_grade($name);
            if ($add) {
                $result = json_decode(json_encode($this->get_grade_info($name)), true);
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! Tài khoản đã tồn tại!";
                $return['status'] = 0;
            }
        }
        echo json_encode($result);
    }

    // == 4.2 READ ==
    public function get_list_grades()
    {
        $list_grades = new Admin();
        echo json_encode($list_grades->get_list_grades());
    }

    // == 4.3 UPDATE ==
    public function edit_grade($id, $name)
    {
        $edit = new Admin();
        return $edit->edit_grade($id, $name);
    }

    public function check_edit_grade()
    {
        $result = array();
        $id = isset($_POST['id']) ? Htmlspecialchars($_POST['id']) : '';
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        if (empty($name)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $update = $this->edit_grade($id, $name);
            if (!$update) {
                $result['status_value'] = "Tài khoản không tồn tại!";
                $result['status'] = 0;
            } else {
                $result = json_decode(json_encode($this->get_grade_info($name)), true);
                $result['status_value'] = "Sửa thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
    }

    // == 4.3 DELETE ==
    public function del_grade($id)
    {
        $del = new Admin();
        return $del->del_grade($id);
    }

    public function check_del_grade()
    {
        $result = array();
        $id = isset($_POST['id']) ? Htmlspecialchars($_POST['id']) : '';
        $del = $this->del_grade($id);
        if ($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['id'] = $id;
        } else {
            $result['status_value'] = "Không thể xóa!";
            $result['status'] = 0;
            $result['id'] = $id;
        }
        echo json_encode($result);
    }

    public function delete_check_grades()
    {
        $result = array();
        $list_del = "";
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        for ($i = 0; $i < count($list_check) - 1; $i++) {
            $del = $this->del_grade($list_check[$i]);
            if (!$del) {
                $list_del = $list_del . " " . $list_check[$i];
            }
        }
        if ($list_del == '') {
            $result['status'] = 1;
            $result['status_value'] = "Xóa thành công";
        } else {
            $result['status'] = 0;
            $result['status_value'] = "Không thể xóa ID: " . $list_del;
        }
        echo json_encode($result);
    }

    // == 4.5 INFO ==
    public function get_grade_info($name)
    {
        $info = new Admin();
        return $info->get_grade_info($name);
    }

    // === 5. CLASS ===
    // == 5.1 CREATE ==
    public function add_class($grade_id, $name, $teacher_id)
    {
        $add = new Admin();
        return $add->add_class($grade_id, $name, $teacher_id);
    }

    public function check_add_class()
    {
        $result = array();
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $grade_id = isset($_POST['grade_id']) ? Htmlspecialchars(addslashes($_POST['grade_id'])) : '';
        $teacher_id = isset($_POST['teacher_id']) ? Htmlspecialchars(addslashes($_POST['teacher_id'])) : '';
        if (empty($name) || empty($grade_id) || empty($teacher_id)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $add = $this->add_class($grade_id, $name, $teacher_id);
            if ($add) {
                $result = json_decode(json_encode($this->get_class_info($name)), true);
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! lớp đã tồn tại!";
                $return['status'] = 0;
            }
        }
        echo json_encode($result);
    }

    // == 5.2 READ ==
    public function get_list_classes()
    {
        $list_classes = new Admin();
        echo json_encode($list_classes->get_list_classes());
    }

    // == 5.3 UPDATE ==
    public function edit_class($id, $name, $grade_id, $teacher_id)
    {
        $edit = new Admin();
        $edit->edit_class($id, $name, $grade_id, $teacher_id);
    }

    public function check_edit_class()
    {
        $result = array();
        $id = isset($_POST['id']) ? Htmlspecialchars($_POST['id']) : '';
        $name = isset($_POST['name']) ? Htmlspecialchars($_POST['name']) : '';
        $grade_id = isset($_POST['grade_id']) ? Htmlspecialchars($_POST['grade_id']) : '';
        $teacher_id = isset($_POST['teacher_id']) ? Htmlspecialchars($_POST['teacher_id']) : '';
        if (empty($name) || empty($grade_id) || empty($teacher_id)) {
            $result['status_value'] = "Không được bỏ trống các trưòng nhập";
            $result['status'] = 0;
        } else {
            $this->edit_class($id, $name, $grade_id, $teacher_id);
            $result = json_decode(json_encode($this->get_class_info($name)), true);
            $result['status_value'] = "Sửa thành công!";
            $result['status'] = 1;
        }
        echo json_encode($result);
    }

    // == 5.4 DELETE ==
    public function del_class($id)
    {
        $del = new Admin();
        return $del->del_class($id);
    }

    public function check_del_class()
    {
        $result = array();
        $id = isset($_POST['id']) ? Htmlspecialchars($_POST['id']) : '';
        $del = $this->del_class($id);
        if ($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['id'] = $id;
        } else {
            $result['status_value'] = "Không thể xóa!";
            $result['status'] = 0;
            $result['id'] = $id;
        }
        echo json_encode($result);
    }

    public function delete_check_classes()
    {
        $result = array();
        $list_del = "";
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        for ($i = 0; $i < count($list_check) - 1; $i++) {
            $del = $this->del_class($list_check[$i]);
            if (!$del) {
                $list_del = $list_del . " " . $list_check[$i];
            }
        }
        if ($list_del == '') {
            $result['status'] = 1;
            $result['status_value'] = "Xóa thành công";
        } else {
            $result['status'] = 0;
            $result['status_value'] = "Không thể xóa ID: " . $list_del;
        }
        echo json_encode($result);
    }

    // == 5.5 INFO ==
    public function get_class_info($name)
    {
        $info = new Admin();
        return $info->get_class_info($name);
    }

    // === 6. STUDENT ===
    // == 6.1 CREATE ==
    public function add_student($username, $password, $name, $class_id, $email, $birthday, $gender_id)
    {
        $add_student = new Admin();
        return $add_student->add_student($username, $password, $name, $class_id, $email, $birthday, $gender_id);
    }

    public function check_add_student()
    {
        $result = array();
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $class_id = isset($_POST['class_id']) ? Htmlspecialchars(addslashes($_POST['class_id'])) : '';
        $email = isset($_POST['email']) ? Htmlspecialchars(addslashes($_POST['email'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $gender_id = isset($_POST['gender_id']) ? Htmlspecialchars(addslashes($_POST['gender_id'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (empty($name) || empty($username) || empty($password)) {
            $result['status_value'] = "Không được bỏ trống các trưòng nhập";
            $result['status'] = 0;
        } else {
            $add = $this->add_student($username, $password, $name, $class_id, $email, $birthday, $gender_id);
            if ($add) {
                $result = json_decode(json_encode($this->get_student_info($username)), true);
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! Tài khoản đã tồn tại!";
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }

    function get_class_name($class_id)
    {
        $get_class_name = new Admin();
        return $get_class_name->get_class_name($class_id);
    }

    public function check_add_student_via_file()
    {
        $inputFileType = 'Xlsx';
        $result = array();
        $class_id = isset($_POST['class_id']) ? Htmlspecialchars(addslashes($_POST['class_id'])) : '';
        $reader = IOFactory::createReader($inputFileType);
        move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        $spreadsheet = $reader->load($_FILES['file']['name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        unlink($_FILES['file']['name']);
        $count = 0;
        $err_list = '';
        for ($i = 4; $i < count($sheetData); $i++) {
            if ($sheetData[$i]['A'] == '')
                continue;
            $stt = $sheetData[$i]['A'];
            $name = $sheetData[$i]['B'];
            $username = $sheetData[$i]['C'];
            $email = $sheetData[$i]['D'];
            $password = md5($sheetData[$i]['E']);
            $birthday = $sheetData[$i]['F'];
            if ($sheetData[$i]['G'] == 'Nam')
                $gender_id = 2;
            else if ($sheetData[$i]['G'] == 'Nữ')
                $gender_id = 3;
            else
                $gender_id = 1;
            $add = $this->add_student($username, $password, $name, $class_id, $email, $birthday, $gender_id);
            if ($add)
                $count++;
            else
                $err_list += $stt . ' ';
        }
        if ($err_list == '') {
            foreach ($this->get_class_name($class_id) as $rs) {
                $class_name = $rs->name;
            };

            $result['status_value'] = "Thêm thành công " . $count . ' học sinh vào ' . $class_name;
            $result['status'] = 1;
        } else {
            $result['status_value'] = "Lỗi! Không thể thêm tài khoản có STT: " . $err_list . ', vui lòng xem lại.';
            $result['status'] = 0;
        }
        echo json_encode($result);
    }

    // == 6.2 READ ==
    public function get_list_students()
    {
        $list_students = new Admin();
        echo json_encode($list_students->get_list_students());
    }

    // == 6.3 UPDATE ==
    public function edit_student($id, $birthday, $password, $name, $class_id, $gender_id)
    {
        $edit = new Admin();
        $edit->edit_student($id, $birthday, $password, $name, $class_id, $gender_id);
    }

    public function check_edit_student()
    {
        $result = array();
        $id = isset($_POST['id']) ? Htmlspecialchars($_POST['id']) : '';
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $gender_id = isset($_POST['gender_id']) ? Htmlspecialchars(addslashes($_POST['gender_id'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $class_id = isset($_POST['class_id']) ? Htmlspecialchars(addslashes($_POST['class_id'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (empty($name) || empty($gender_id) || empty($birthday) || empty($id) || empty($password)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $this->edit_student($id, $birthday, $password, $name, $class_id, $gender_id);
            $result = json_decode(json_encode($this->get_student_info($username)), true);
            $result['status_value'] = "Sửa thành công!";
            $result['status'] = 1;
        }
        echo json_encode($result);
    }

    // == 6.4 DELETE ==
    public function del_student($id)
    {
        $del = new Admin();
        return $del->del_student($id);
    }

    public function check_del_student()
    {
        $result = array();
        $id = isset($_POST['id']) ? Htmlspecialchars($_POST['id']) : '';
        $del = $this->del_student($id);
        if ($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['id'] = $id;
        } else {
            $result['status_value'] = "Không thể xóa!";
            $result['status'] = 0;
            $result['id'] = $id;
        }
        echo json_encode($result);
    }

    public function delete_check_students()
    {
        $result = array();
        $list_del = "";
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        for ($i = 0; $i < count($list_check) - 1; $i++) {
            $del = $this->del_student($list_check[$i]);
            if (!$del) {
                $list_del = $list_del . " " . $list_check[$i];
            }
        }
        if ($list_del == '') {
            $result['status'] = 1;
            $result['status_value'] = "Xóa chọn lọc thất bại";
        } else {
            $result['status'] = 0;
            $result['status_value'] = "Không thể xóa ID: " . $list_del;
        }
        echo json_encode($result);
    }

    // == 6.5 INFO ==
    public function get_student_info($username)
    {
        $info = new Admin();
        return $info->get_student_info($username);
    }

    // === 7. SUBJECT ===
    // == 7.1 CREATE ==
    public function add_subject($name)
    {
        $add = new Admin();
        return $add->add_subject($name);
    }

    public function check_add_subject()
    {
        $result = array();
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        if (empty($name)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $add = $this->add_subject($name);
            if ($add) {
                $result = json_decode(json_encode($this->get_subject_info($name)), true);
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! Môn đã tồn tại!";
                $return['status'] = 0;
            }
        }
        echo json_encode($result);
    }

    // == 7.2 READ ==
    public function get_list_subjects()
    {
        $list_grades = new Admin();
        echo json_encode($list_grades->get_list_subjects());
    }

    // == 7.3 UPDATE ==
    public function edit_subject($id, $name)
    {
        $edit = new Admin();
        return $edit->edit_subject($id, $name);
    }

    public function check_edit_subject()
    {
        $result = array();
        $id = isset($_POST['id']) ? Htmlspecialchars($_POST['id']) : '';
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        if (empty($name)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $update = $this->edit_subject($id, $name);
            if (!$update) {
                $result['status_value'] = "Môn không tồn tại!";
                $result['status'] = 0;
            } else {
                $result = json_decode(json_encode($this->get_subject_info($name)), true);
                $result['status_value'] = "Sửa thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
    }

    // == 7.4 DELETE ==
    public function del_subject($id)
    {
        $del = new Admin();
        return $del->del_subject($id);
    }

    public function check_del_subject()
    {
        $result = array();
        $id = isset($_POST['id']) ? Htmlspecialchars($_POST['id']) : '';
        $del = $this->del_subject($id);
        if ($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['id'] = $id;
        } else {
            $result['status_value'] = "Không thể xóa!";
            $result['status'] = 0;
            $result['id'] = $id;
        }
        echo json_encode($result);
    }

    // == 7.5 INFO ==
    public function get_subject_info($name)
    {
        $info = new Admin();
        return $info->get_subject_info($name);
    }

    // === 8. QUESTION ===
    // == 8.1 CREATE ==
    public function add_question($unit, $question_content, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer, $explanation, $grade_id, $subject_id)
    {
        $add_question = new Admin();
        return $add_question->add_question($unit, $question_content, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer, $explanation, $grade_id, $subject_id);
    }

    public function check_add_question()
    {
        $result = array();
        $unit = $_POST['unit'];
        $question_content = $_POST['question_content'];
        $answer_a = $_POST['answer_a'];
        $answer_b = $_POST['answer_b'];
        $answer_c = $_POST['answer_c'];
        $answer_d = $_POST['answer_d'];
        $correct_answer = $_POST['correct_answer'];
        $explanation = $_POST['explanation'];
        $grade_id = $_POST['grade_id'];
        $subject_id = $_POST['subject_id'];

        if (empty($unit) || empty($question_content) || empty($answer_a) || empty($answer_b) || empty($answer_c) || empty($answer_d) || empty($correct_answer) || empty($grade_id) || empty($subject_id)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $add = $this->add_question($unit, $question_content, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer, $explanation, $grade_id, $subject_id);
            if ($add) {
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! Thêm thất bại!";
                $return['status'] = 0;
            }
        }

        echo json_encode($result);
    }

    public function check_add_question_via_file()
    {
        $inputFileType = 'Xlsx';
        $result = array();
        $shuffle = array();
        $grade_id = isset($_POST['grade_id']) ? Htmlspecialchars(addslashes($_POST['grade_id'])) : '';
        $subject_id = isset($_POST['subject_id']) ? Htmlspecialchars(addslashes($_POST['subject_id'])) : '';
        $reader = IOFactory::createReader($inputFileType);
        move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        $spreadsheet = $reader->load($_FILES['file']['name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        unlink($_FILES['file']['name']);
        $count = 0;
        $err_list = '';
        for ($i = 4; $i < count($sheetData); $i++) {
            if ($sheetData[$i]['A'] == '')
                continue;
            $stt = $sheetData[$i]['A'];
            $question_content = $sheetData[$i]['B'];
            $answer_a = $sheetData[$i]['C'];
            $answer_b = $sheetData[$i]['D'];
            $answer_c = $sheetData[$i]['E'];
            $answer_d = $sheetData[$i]['F'];
            $correct_answer = $sheetData[$i]['G'];
            $explanation = $sheetData[$i]['H'];
            $unit = $sheetData[$i]['I'];
            $add = $this->add_question($unit, $question_content, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer, $explanation, $grade_id, $subject_id);
            if ($add)
                $count++;
            else
                $err_list += $stt . ' ';
        }
        if ($err_list == '') {
            $result['status_value'] = "Thêm thành công " . $count . ' câu hỏi!';
            $result['status'] = 1;
        } else {
            $result['status_value'] = "Lỗi! Không thể thêm câu hỏi có STT: " . $err_list . ', vui lòng xem lại.';
            $result['status'] = 0;
        }
        echo json_encode($result);
    }

    // == 8.2 READ ==
    public function get_list_questions()
    {
        $list_questions = new Admin();
        echo json_encode($list_questions->get_list_questions());
    }

    // == 8.3 UPDATE ==
    public function edit_question($id, $unit, $question_content, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer, $explanation, $grade_id, $subject_id)
    {
        $edit = new Admin();
        return $edit->edit_question($id, $unit, $question_content, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer, $explanation, $grade_id, $subject_id);
    }

    public function check_edit_question()
    {
        $result = array();
        $id = $_POST['id'];
        $unit = $_POST['unit'];
        $question_content = $_POST['question_content'];
        $answer_a = $_POST['answer_a'];
        $answer_b = $_POST['answer_b'];
        $answer_c = $_POST['answer_c'];
        $answer_d = $_POST['answer_d'];
        $correct_answer = $_POST['correct_answer'];
        $explanation = $_POST['explanation'];
        $grade_id = $_POST['grade_id'];
        $subject_id = $_POST['subject_id'];
        if (empty($unit) || empty($question_content) || empty($answer_a) || empty($answer_b) || empty($answer_c) || empty($answer_d) || empty($correct_answer) || empty($explanation)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $res = $this->edit_question($id, $unit, $question_content, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer, $explanation, $grade_id, $subject_id);
            if (!$res) {
                $result['status_value'] = "Sửa thất bại!";
                $result['status'] = 0;
            } else {
                $result = json_decode(json_encode($this->get_question_info($id)), true);
                $result['status_value'] = "Sửa thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
    }

    // == 8.4 DELETE ==
    public function del_question($id)
    {
        $del = new Admin();
        $del->del_question($id);
    }

    public function check_del_question()
    {
        $result = array();
        $id = isset($_POST['id']) ? Htmlspecialchars($_POST['id']) : '';
        $del = $this->del_question($id);

        if (!$del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['id'] = $id;
        } else {
            $result['status_value'] = "Không thể xóa!";
            $result['status'] = 0;  
            $result['id'] = $id;
        }
        echo json_encode($result);
    }

    public function delete_check_questions()
    {
        $result = array();
        $list_del = "";
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        for ($i = 0; $i < count($list_check) - 1; $i++) {
            $del = $this->del_question($list_check[$i]);
            if (!$del) {
                $list_del = $list_del . " " . $list_check[$i];
            }
        }
        if ($list_del == '') {
            $result['status'] = 1;
            $result['status_value'] = "Xóa chọn lọc thất bại";
        } else {
            $result['status'] = 0;
            $result['status_value'] = "Đã xóa chọn lọc có mã ID: " . $list_del;
        }
        echo json_encode($result);
    }

    // == 8.5 INFO ==
    public function get_question_info($id)
    {
        $info = new Admin();
        return $info->get_question_info($id);
    }

    // === 9. TEST ===
    // == 9.1 CREATE ==
    public function add_test($test_code, $test_name, $password, $total_questions, $time_to_do, $note, $grade_id, $subject_id)
    {
        $test = new Admin();
        return $test->add_test($test_code, $test_name, $password, $total_questions, $time_to_do, $note, $grade_id, $subject_id);
    }

    public function check_add_test()
    {
        $result = array();
        $test_name = isset($_POST['test_name']) ? Htmlspecialchars(addslashes($_POST['test_name'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        $grade_id = isset($_POST['grade_id']) ? Htmlspecialchars(addslashes($_POST['grade_id'])) : '';
        $subject_id = isset($_POST['subject_id']) ? Htmlspecialchars(addslashes($_POST['subject_id'])) : '';
        $total_questions = isset($_POST['total_questions']) ? Htmlspecialchars(addslashes($_POST['total_questions'])) : '';
        $time_to_do = isset($_POST['time_to_do']) ? Htmlspecialchars(addslashes($_POST['time_to_do'])) : '';
        $note = isset($_POST['note']) ? Htmlspecialchars(addslashes($_POST['note'])) : '';
        $test_code = rand(100000, 999999);

        if (empty($test_name) || empty($time_to_do) || empty($password)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $add = $this->add_test($test_code, $test_name, $password, $total_questions, $time_to_do, $note, $grade_id, $subject_id);

            if ($add) {
                //Tạo bộ câu hỏi cho đề thi
                $model = new Admin();
                $list_unit = $model->get_list_units($grade_id, $subject_id);

                foreach ($list_unit as $unit) {
                    $limit = $_POST[$unit->unit];
                    $list_quest = $model->list_quest_of_unit($grade_id, $subject_id, $unit->unit, $limit);
                    foreach ($list_quest as $quest) {
                        $model->add_quest_to_test($test_code, $quest->id);
                    }
                }

                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Thêm thất bại!";
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }

    // == 9.2 READ ==
    public function get_list_tests()
    {
        $list_tests = new Admin();
        echo json_encode($list_tests->get_list_tests());
    }
    // == 9.3 UPDATE ==

    // == 9.4 DELETE ==


    // == 9.5 INFO ==

    // == 9.6 STATUS ==
    public function toggle_test_status($test_code, $status_id)
    {
        $toggle = new Admin();
        return $toggle->toggle_test_status($test_code, $status_id);
    }

    // == 9.7 EXPORT ==
    public function export_score()
    {
        $test_code = isset($_GET['test_code']) ? htmlspecialchars($_GET['test_code']) : '';

        $model = new Admin();
        $scores = $model->get_test_score($test_code);

        //Create Excel Data
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Danh Sách Điểm Bài Thi: ' . $test_code);
        $sheet->setCellValue('A3', 'STT');
        $sheet->setCellValue('B3', 'Tên Học Sinh');
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
        header('Content-Disposition: attactment;filename="danh-sach-diem-thuoc-de-' . $test_code . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function get_charts_by_class_and_test_code()
    {
        $class_id = $_POST['class_id'];
        $test_code = $_POST['test_code'];

        $result = array();
        $model = new Admin();

        $good_count = $model->get_count_student_by_good($class_id, $test_code);
        $rather_count = $model->get_count_student_by_rather($class_id, $test_code);
        $medium_count = $model->get_count_student_by_medium($class_id, $test_code);
        $least_count = $model->get_count_student_by_least($class_id, $test_code);

        array_push($result, $good_count[0], $rather_count[0], $medium_count[0], $least_count[0]);
        echo json_encode($result);
    }

    public function check_toggle_test_status()
    {
        $result = array();
        $status_id = Htmlspecialchars($_POST['status_id']);
        $test_code = Htmlspecialchars($_POST['test_code']);
        $toggle = $this->toggle_test_status($test_code, $status_id);
        if ($toggle) {
            $result['status_value'] = "Đã thay đổi trạng thái!";
            $result['status'] = 1;
        } else {
            $result['status_value'] = "Không thay đổi trạng thái!";
            $result['status'] = 0;
        }
        echo json_encode($result);
    }

    // === 10. SCORE ===
    // == 10.1 READ ==
    public function test_score()
    {
        $title = 'Trang Xem Điểm Thi';
        $route = new RAdmin();
        $model = new Admin();
        $test_code = htmlspecialchars($_GET['test_code']);
        $route->show_head($title);
        $route->show_navbar($this->info);
        $route->show_test_score($model->get_test_score($test_code));
        $route->show_foot();
    }

    public function test_class()
    {
        $title = 'Trang Duyệt lớp';
        $route = new RAdmin();
        $model = new Admin();
        $test_code = htmlspecialchars($_GET['test_code']);
        $classes = $model->get_list_classes();
        $class_tests = $model->get_class_test($test_code);
        $route->show_head($title);
        $route->show_navbar($this->info);
        $route->show_test_class($test_code, $classes, $class_tests);
        $route->show_foot();
    }

    public function add_test_class($test_code, $class_id)
    {
        $add = new Admin();
        $add->add_test_class($test_code, $class_id);
    }

    public function add_select_test_class()
    {
        $result = array();
        $list_add = "";
        $test_code = $_POST['test_code'];
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        for ($i = 0; $i < count($list_check) - 1; $i++) {
            $add = $this->add_test_class($test_code, $list_check[$i]);
            if (!$add) {
                $list_add = $list_add . " " . $list_check[$i];
            }
        }
        if ($list_add == '') {
            $result['status'] = 0;
            $result['status_value'] = "Thêm thất bại";
        } else {
            $result['status'] = 1;
            $result['status_value'] = "Đã thêm đề vào lớp có ID: " . $list_add;
        }
        echo json_encode($result);
    }

    public function del_test_class($test_code, $class_id)
    {
        $del = new Admin();
        $del->del_test_class($test_code, $class_id);
    }

    public function delete_select_test_class()
    {
        $result = array();
        $list_del = "";
        $test_code = $_POST['test_code'];
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        for ($i = 0; $i < count($list_check) - 1; $i++) {
            $del = $this->del_test_class($test_code, $list_check[$i]);
            if (!$del) {
                $list_del = $list_del . " " . $list_check[$i];
            }
        }
        if ($list_del == '') {
            $result['status'] = 1;
            $result['status_value'] = "Xóa chọn lọc thất bại";
        } else {
            $result['status'] = 0;
            $result['status_value'] = "Đã xóa chọn lọc có mã ID: " . $list_del;
        }
        echo json_encode($result);
    }

    // Common
    public function valid_username_or_email()
    {
        $result = array();
        $valid = new Admin();
        $usr_or_email = isset($_GET['usr_or_email']) ? htmlspecialchars($_GET['usr_or_email']) : '';
        if (empty($usr_or_email)) {
            $result['status'] = 0;
        } else {
            if ($valid->valid_username_or_email($usr_or_email)) {
                $result['status'] = 1;
            } else {
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }

    public function valid_grade_name()
    {
        $result = array();
        $valid = new Admin();
        $grade_name = isset($_GET['grade_name']) ? htmlspecialchars($_GET['grade_name']) : '';
        if (empty($grade_name)) {
            $result['status'] = 0;
        } else {
            if ($valid->valid_grade_name($grade_name)) {
                $result['status'] = 1;
            } else {
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }

    public function valid_subject_name()
    {
        $result = array();
        $valid = new Admin();
        $subject_name = isset($_GET['subject_name']) ? htmlspecialchars($_GET['subject_name']) : '';
        if (empty($subject_name)) {
            $result['status'] = 0;
        } else {
            if ($valid->valid_subject_name($subject_name)) {
                $result['status'] = 1;
            } else {
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }

    public function valid_email_on_profiles()
    {
        $result = array();
        $valid = new Admin();
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

    public function valid_class_name()
    {
        $result = array();
        $valid = new Admin();
        $class_name = isset($_GET['class_name']) ? htmlspecialchars($_GET['class_name']) : '';
        if (empty($class_name)) {
            $result['status'] = 0;
        } else {
            if ($valid->valid_class_name($class_name)) {
                $result['status'] = 1;
            } else {
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }

    public function update_last_login()
    {
        $info = new Admin();
        $info->update_last_login($this->info['id']);
    }

    public function get_profiles()
    {
        $info = new Admin();
        echo json_encode($info->get_admin_info($this->info['username']));
    }

    public function update_profiles($username, $name, $email, $password, $gender, $birthday)
    {
        $info = new Admin();
        return $info->update_profiles($username, $name, $email, $password, $gender, $birthday);
    }

    public function update_avatar($avatar, $username)
    {
        $info = new Admin();
        return $info->update_avatar($avatar, $username);
    }

    public function get_list_genders()
    {
        $list_genders = new Admin();
        echo json_encode($list_genders->get_list_genders());
    }

    public function get_list_statuses()
    {
        $list_statuses = new Admin();
        echo json_encode($list_statuses->get_list_statuses());
    }

    public function get_list_units()
    {
        $grade_id = $_POST['grade_id'];
        $subject_id = $_POST['subject_id'];
        $unit = new Admin();
        echo json_encode($unit->get_list_units($grade_id, $subject_id));
    }

    public function get_list_test_codes()
    {
        $list_test_code = new Admin();
        echo json_encode($list_test_code->get_list_test_codes());
    }

    public function get_dashboard_info()
    {
        $get_total = new Admin();
        $admin = new stdclass();
        $admin->count = $get_total->get_total_admin();
        $admin->name = "Quản Trị Viên";
        $admin->icon = "mdi-account-tie";
        $admin->color = "gradient-45deg-light-blue-cyan";
        $admin->actionlink = "show_admins_panel";

        $teacher = new stdclass();
        $teacher->count = $get_total->get_total_teacher();
        $teacher->name = "Giáo Viên";
        $teacher->icon = "mdi-account-star";
        $teacher->color = "gradient-45deg-red-pink";
        $teacher->actionlink = "show_teachers_panel";

        $student = new stdclass();
        $student->count = $get_total->get_total_student();
        $student->name = "Học Sinh";
        $student->icon = "mdi-account";
        $student->color = "gradient-45deg-amber-amber";
        $student->actionlink = "show_students_panel";

        $grade = new stdclass();
        $grade->count = $get_total->get_total_grade();
        $grade->name = "Khối";
        $grade->icon = "mdi-server";
        $grade->color = "gradient-45deg-green-teal";
        $grade->actionlink = "show_classes_panel";

        $class = new stdclass();
        $class->count = $get_total->get_total_class();
        $class->name = "Lớp";
        $class->icon = "mdi-book-education";
        $class->color = "gradient-45deg-purple-light-blue";
        $class->actionlink = "show_classes_panel";

        $subject = new stdclass();
        $subject->count = $get_total->get_total_subject();
        $subject->name = "Môn Học";
        $subject->icon = "mdi-text-subject";
        $subject->color = "gradient-45deg-orange-amber";
        $subject->actionlink = "show_subjects_panel";

        $question = new stdclass();
        $question->count = $get_total->get_total_question();
        $question->name = "Câu Hỏi";
        $question->icon = "mdi-comment-question";
        $question->color = "gradient-45deg-purple-deep-orange";
        $question->actionlink = "show_questions_panel";

        $test = new stdclass();
        $test->count = $get_total->get_total_test();
        $test->name = "Đề Thi";
        $test->icon = "mdi-clipboard-text";
        $test->color = "gradient-45deg-blue-indigo";
        $test->actionlink = "show_tests_panel";

        $total = array($admin, $teacher, $student, $grade, $class, $subject, $question, $test);
        return $total;
    }

    public function submit_update_profiles()
    {
        $result = array();
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $email = isset($_POST['email']) ? Htmlspecialchars(addslashes($_POST['email'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $gender_id = isset($_POST['gender_id']) ? Htmlspecialchars(addslashes($_POST['gender_id'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (empty($name) || empty($gender_id) || empty($birthday) || empty($password) || empty($email)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $update = $this->update_profiles($username, $name, $email, $password, $gender_id, $birthday);
            if (!$update) {
                $result['status_value'] = "Tài khoản không tồn tại!";
                $result['status'] = 0;
            } else {
                $result = json_decode(json_encode($this->get_admin_info($username)), true);
                $result['status_value'] = "Sửa thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
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

    public function show_about()
    {
        $route = new RAdmin();
        $route->show_head($this->info);
        $route->show_about();
        $route->show_foot();
    }

    public function show_profiles()
    {
        $route = new RAdmin();
        $route->show_head($this->info);
        $route->show_profiles($this->get_admin_info($this->info['username']));
        $route->show_foot();
    }

    public function show_404()
    {
        $route = new RAdmin();
        $route->show_head($this->info);
        $route->show_404();
        $route->show_foot();
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
}
