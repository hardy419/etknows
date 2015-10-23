<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>Test</title>
	</head>
	<body onload=document.f.content.focus()>
		
<?php
if(isset($this->data['user'])) {
?>

		<p><strong>欢迎，<?php echo $this->data['user']; ?>！</strong></p>
		<a href="<?php echo $this->data['rootUrl'].'?r=user/logout'; ?>">登出</a>
		
<?php
} else {
?>

		<form name="login" action="<?php echo $this->data['rootUrl'].'?r=user/login'; ?>" method="POST">
			<strong>用户名:</strong>
			<input type="text" maxLength=32 name="user" value=""></input>
			<strong>密码:</strong>
			<input type="password" maxLength=64 name="password" value=""></input>
			<input type="submit" value="登录"></input>
		</form>
		<a href="<?php echo $this->data['rootUrl'].'?r=user/register'; ?>">注册</a>

<?php
}
?>

<?php

foreach($this->data['data'] as $idx=>$dat) {
	if (0 == $idx) {
		$subject = '&nbsp;<b>'.$dat['subject'].'</b>';
	}
	else {
		$subject = '';
	}
	echo "<hr/><br/>";
	echo $dat['user'].":$subject<br/><br/>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;".$dat['content']."<br/>";
	echo "<div align=right>".$dat['addtime']."</div>";
	echo "<br/><hr/><br/>";
}

?>
		
		<form name="f" action="<?php echo $this->data['rootUrl']; ?>" method="POST">
			<input type="text" name="subject" placeholder="标题"><br/><br/>
			<textarea name="content" rows="4" cols="60" placeholder="内容"></textarea><br/><br/>
			<input type="submit" value="提交"></input><br/>
		</form>
	</body>
</html>
