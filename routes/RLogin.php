<?php

class RLogin
{
    public function show_login()
    {
        require_once './config/config.php';
        include 'resources/views/login.php';
    }
}
