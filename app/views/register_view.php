<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>Test</title>
	</head>
	<body onload=document.f.register_name.focus()>
		<form name="f" action="<?php echo $this->data['rootUrl'].'?r=user/register'; ?>" method="POST">
			<strong>用户名:     </strong>
			<input type="text" maxLength=32 name="register_name" value=""></input></br>
			<strong>密码:         </strong>
			<input type="password" maxLength=64 name="register_password" value=""></input></br>
			<strong>确认密码: </strong>
			<input type="password" maxLength=64 name="register_password_again" value=""></input></br>
			<input type="submit" value="注册"></input></br>
		</form>
	</body>
</html>
