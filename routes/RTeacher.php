<?php

class RTeacher
{
    public function show_head()
    {
        require_once './config/config.php';
        include 'resources/views/teacher/head_left.php';
    }

    public function show_navbar($info)
    {
        require_once './config/config.php';
        include 'resources/views/shared/navbar.php';
    }

    public function show_dashboard()
    {
        include 'resources/views/teacher/dashboard.html';
    }

    public function show_class_detail()
    {
        include 'resources/views/teacher/class_detail.html';
    }

    public function show_list_test($tests)
    {
        include 'resources/views/teacher/list_test.php';
    }
    public function show_test_score($scores)
    {
        include 'resources/views/teacher/test_score.php';
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
    public function show_profiles($profile)
    {
        include 'resources/views/shared/profiles.php';
    }
    public function show_404()
    {
        include 'resources/views/shared/404.html';
    }
}
