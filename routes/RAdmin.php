<?php


class RAdmin
{
    public function show_head($title)
    {
        require_once './config/config.php';
        include 'resources/views/admin/head_left.php';
    }

    public function show_navbar($info)
    {
        require_once './config/config.php';
        include 'resources/views/shared/navbar.php';
    }

    public function show_foot()
    {
        require_once './config/config.php';
        include 'resources/views/shared/foot.php';
    }

    public function show_admins_panel()
    {
        include 'resources/views/admin/admins_panel.html';
    }

    public function show_dashboard($dashboard)
    {
        include 'resources/views/admin/dashboard.php';
    }

    public function show_teachers_panel()
    {
        include 'resources/views/admin/teachers_panel.html';
    }

    public function show_grades_panel()
    {
        include 'resources/views/admin/grades_panel.html';
    }

    public function show_classes_panel()
    {
        include 'resources/views/admin/classes_panel.html';
    }

    public function show_students_panel()
    {
        include 'resources/views/admin/students_panel.html';
    }

    public function show_questions_panel($questions)
    {
        include 'resources/views/admin/questions_panel.php';
    }

    public function show_subjects_panel()
    {
        include 'resources/views/admin/subjects_panel.html';
    }
    public function show_tests_panel()
    {
        include 'resources/views/admin/tests_panel.html';
    }

    public function show_tests_detail($questions)
    {
        include 'resources/views/admin/tests_detail.php';
    }

    public function show_test_score($scores)
    {
        include 'resources/views/admin/test_score.php';
    }

    public function show_test_class($test_code, $classes, $class_tests)
    {
        include 'resources/views/admin/test_class.php';
    }

    public function show_about()
    {
        require_once './config/config.php';
        include 'resources/views/shared/about.php';
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
