<?php

class post_model extends Hardy_mysql_handler
{
    function __construct()
    {
        global $Hardy_config;
        parent::__construct($Hardy_config['host'], $Hardy_config['user'], $Hardy_config['password'], $Hardy_config['schema']);
    }
    function __destruct()
    {
        parent::__destruct();
    }
    
    public function new_post($subject, $file_pic, $file_audio, $content, $username, $uid)
    {
        $subject = mysql_real_escape_string($subject);
        $content = mysql_real_escape_string($content);
        $username = mysql_real_escape_string($username);
        $uid = mysql_real_escape_string($uid);
        $this->query ("INSERT INTO etk_post (subject, content, file_pic, file_audio, addtime, user, user_id) VALUES('$subject', '$content', '$file_pic', '$file_audio', '".date("Y-m-d H:i:s")."', '$username', $uid)");
    }
    public function get_posts($keyword)
    {
        if (null !== $keyword) {
            $keyword = mysql_real_escape_string ($keyword);
            $q = "SELECT * FROM etk_post WHERE (status=0 OR status=1) AND (subject LIKE '%{$keyword}%' OR content LIKE '%{$keyword}%')";
        }
        else {
            $q = "SELECT * FROM etk_post WHERE status=0 OR status=1";
        }
        return $this->query ($q);
    }
    public function get_post_by_id($post_id)
    {
        $post_id = mysql_real_escape_string($post_id);
        $q = "SELECT * FROM etk_post WHERE id={$post_id}";
        $results = $this->query ($q);
        return $results[0];
    }
    
    public function new_comment($pid, $cid, $subject, $file_pic, $file_audio, $content, $username, $uid)
    {
        $pid = mysql_real_escape_string($pid);
        $cid = mysql_real_escape_string($cid);
        $subject = mysql_real_escape_string($subject);
        $content = mysql_real_escape_string($content);
        $username = mysql_real_escape_string($username);
        $uid = mysql_real_escape_string($uid);
        $this->query ("INSERT INTO etk_comment (post_id, comment_id, subject, content, file_pic, file_audio, addtime, user, user_id) VALUES($pid, $cid, '$subject', '$content', '$file_pic', '$file_audio', '".date("Y-m-d H:i:s")."', '$username', $uid)");
    }
    public function get_comments($post_id)
    {
        $post_id = mysql_real_escape_string($post_id);
        $q = "SELECT * FROM etk_comment WHERE (status=0 OR status=1) AND post_id={$post_id}";
        return $this->query ($q);
    }
}

?>