<?php

class user_model extends Hardy_mysql_handler
{
    public $errors = array();
    
    function __construct()
    {
        global $Hardy_config;
        parent::__construct($Hardy_config['host'], $Hardy_config['user'], $Hardy_config['password'], $Hardy_config['schema']);
        $this->errors['user_already_exists'] = "用户名已存在！";
        $this->errors['login_error'] = "登录失败！可能有下面原因：<br/>1. 用户名不存在。<br/>2. 密码错误。<br/>3. 用户类型不正确。";
        $this->errors['passwords_not_match'] = "两次输入密码不一致！";
        $this->errors['password_not_correct'] = "密码错误！";
        $this->errors['not_activated'] = "对不起，您的帐号未激活！<br/>请联系管理员激活您的帐号。";
    }
    function __destruct()
    {
        parent::__destruct();
    }
    
    public function check_existence ($user)
    {
        $user = mysql_real_escape_string ($user);
        $res = $this->query ("SELECT id,username FROM etk_user WHERE username='$user' LIMIT 1");
        if (isset($res[0])) {
            return true;
        }
        return false;
    }
    public function register ($new_user, $password, $password2, $type, $contact, $qq, $tel, $email)
    {
        global $Hardy_config;
        $new_user = mysql_real_escape_string ($new_user);
        $password = mysql_real_escape_string ($password);
        $password2 = mysql_real_escape_string ($password2);
        $type = mysql_real_escape_string ($type);
        $contact = mysql_real_escape_string ($contact);
        $qq = mysql_real_escape_string ($qq);
        $tel = mysql_real_escape_string ($tel);
        $email = mysql_real_escape_string ($email);
        if ($this->check_existence ($new_user)) {
            return $this->errors['user_already_exists'];
        }
        
        $hashed_pwd = hash("sha512", $password);
        $hashed_pwd2 = hash("sha512", $password2);
        
        if ($hashed_pwd != $hashed_pwd2) {
            return $this->errors['passwords_not_match'];
        }
        
        date_default_timezone_set ('PRC');
        $datetime = date("Y-m-d H:i:s");
        
        $this->query ("INSERT INTO etk_user (username, password, addtime, type, contact, qq, tel, email) VALUES('$new_user', '$hashed_pwd', '$datetime', '$type', '$contact', '$qq', '$tel', '$email')");
        
        return null;
    }

    public function update_user_info ($uid, $type, $contact, $qq, $tel, $email)
    {
        $uid = mysql_real_escape_string ($uid);
        $type = mysql_real_escape_string ($type);
        $contact = mysql_real_escape_string ($contact);
        $qq = mysql_real_escape_string ($qq);
        $tel = mysql_real_escape_string ($tel);
        $email = mysql_real_escape_string ($email);
        $this->query ("UPDATE etk_user SET type='$type', contact='$contact', qq='$qq', tel='$tel', email='$email' WHERE id='$uid'");
    }
    public function update_password ($uid, $old_password, $new_password)
    {
        $uid = mysql_real_escape_string ($uid);
        $old_password = mysql_real_escape_string ($old_password);
        $new_password = mysql_real_escape_string ($new_password);
        $hashed_oldpwd = hash("sha512", $old_password);
        $user_info = $this->get_user ($uid);
        if ($user_info["password"] != $hashed_oldpwd) {
            return $this->errors['password_not_correct'];
        }
        $hashed_newpwd = hash("sha512", $new_password);
        $this->query ("UPDATE etk_user SET password='$hashed_newpwd' WHERE id='$uid'");
        return null;
    }

    public function get_user ($uid)
    {
        $uid = mysql_real_escape_string ($uid);
        $res = $this->query ("SELECT * FROM etk_user WHERE id='$uid' LIMIT 1");
        if (isset($res[0])) {
            return $res[0];
        }
        return null;
    }
    public function get_user_by_name ($username)
    {
        $username = mysql_real_escape_string ($username);
        $res = $this->query ("SELECT * FROM etk_user WHERE username='$username' LIMIT 1");
        if (isset($res[0])) {
            return $res[0];
        }
        return null;
    }
    public function get_user_type ($uid)
    {
        $uid = mysql_real_escape_string ($uid);
        $user_info = $this->get_user ($uid);
        if (null != $user_info) {
            return $user_info['type'];
        }
        return null;
    }
    public function login ($user, $password)
    {
        $user = mysql_real_escape_string ($user);
        $password = mysql_real_escape_string ($password);
        $user_info = $this->get_user_by_name($user);
        if (null == $user_info || hash("sha512", $password) != $user_info['password']) {
            return $this->errors['login_error'];
        }
        elseif (0 == $user_info['status']) {
            return $this->errors['not_activated'];
        }
        return $user_info;
    }
    
    public function update_session ($uid, $session_id, $cur_datetime)
    {
        $uid = mysql_real_escape_string ($uid);
        $session_id = mysql_real_escape_string ($session_id);
        $cur_datetime = mysql_real_escape_string ($cur_datetime);
        // login info : datetime & location
        // Copy current login info as last login & Record current login info & Update session id
        $this->query ("UPDATE etk_user SET last_login_datetime=cur_login_datetime, cur_login_datetime='$cur_datetime', cur_login_location='深圳市', sid='$session_id' WHERE id='$uid'");
    }
    public function check_session ($uid, $session_id)
    {
        $uid = mysql_real_escape_string ($uid);
        $session_id = mysql_real_escape_string ($session_id);
        $user_info = $this->get_user($uid);
        if (null != $user_info) {
            if ($user_info['sid'] === $session_id) {
                return true;
            }
        }
        return false;
    }
}

?>