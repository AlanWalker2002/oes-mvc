<?php

class RStudent
{
    public function show_head()
    {
        require_once './config/config.php';
        include 'resources/views/student/head_left.php';
    }

    public function list_test($info, $tests, $scores, $count_test, $get_all_test, $subjects, $grades, $statuses)
    {
        require_once './config/config.php';
        include 'resources/views/student/list_test.php';
    }

    public function list_test_filter($info, $tests, $scores, $count_test, $get_all_test, $subject_id, $grade_id, $status_id, $subjects, $grades, $statuses)
    {
        require_once './config/config.php';
        include 'resources/views/student/list_test_filter.php';
    }

    public function show_dashboard($info)
    {
        include 'resources/views/student/dashboard.php';
    }

    public function show_exam($test, $min, $sec)
    {
        include 'resources/views/student/exam.php';
    }

    public function show_result($score, $result)
    {
        include 'resources/views/student/result.php';
    }

    public function show_about()
    {
        require_once './config/config.php';
        include 'resources/views/shared/about.php';
    }

    public function show_foot()
    {
        require_once './config/config.php';
        include 'resources/views/shared/foot.php';
    }

    public function show_foot_st()
    {
        require_once './config/config.php';
        include 'resources/views/shared/foot_st.php';
    }

    public function show_foot_exam()
    {
        require_once './config/config.php';
        include 'resources/views/shared/foot_exam.php';
    }

    public function custom_theme()
    {
        include 'resources/views/shared/custom_theme.php';
    }

    public function show_profiles($profile)
    {
        include 'resources/views/shared/profiles.php';
    }
    
    public function show_404()
    {
        include 'resources/views/shared/404.html';
    }
}
