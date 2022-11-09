<?php

include_once './config/database.php';

class Login extends Database
{
    public function get_username($username)
    {
        $sql = "SELECT username, name FROM students WHERE username = '$username' OR email = '$username'
        UNION
        SELECT username, name FROM teachers WHERE username = '$username' OR email = '$username'
        UNION
        SELECT username, name FROM admins WHERE username = '$username' OR email = '$username'";
        $this->set_query($sql);
        return $this->load_row();
    }

    public function get_password($username)
    {
        $sql = "SELECT permission_id,password FROM students WHERE username = '$username' OR email = '$username'
        UNION
        SELECT permission_id,password FROM teachers WHERE username = '$username' OR email = '$username'
        UNION
        SELECT permission_id,password FROM admins WHERE username = '$username' OR email = '$username'";
        $this->set_query($sql);
        return $this->load_row();
    }

    public function reset_password($username)
    {
        $sql = "SELECT name,email,password,permission_id FROM students WHERE username = '$username' OR email = '$username'
        UNION
        SELECT name,email,password,permission_id FROM teachers WHERE username = '$username' OR email = '$username'
        UNION
        SELECT name,email,password,permission_id FROM admins WHERE username = '$username' OR email = '$username'";
        $this->set_query($sql);
        $get = $this->load_row();
        if ($get) {
            $password = rand(10000000, 99999999);
            $get->password = $password;
            if ($get->permission_id == 1) {
                $get->permission_id = 'admins';
            }
            if ($get->permission_id == 2) {
                $get->permission_id = 'teachers';
            }
            if ($get->permission_id == 3) {
                $get->permission_id = 'students';
            }
            return $get;
        } else {
            return false;
        }
    }

    public function update_new_password($password, $permission_id, $username)
    {
        $sql = "UPDATE $permission_id SET password = '$password' WHERE username = '$username' OR email = '$username'";
        $this->set_query($sql);
        $this->load_row();
    }
}
