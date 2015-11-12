<?php
if(isset($this->data['user'])) {
?>

		<p><strong>欢迎，<?php echo $this->data['user']; ?>！</strong></p>
		<a href="<?php echo $this->data['rootUrl'].'?r=user/logout&retUrl='.$_SERVER['REQUEST_URI']; ?>">登出</a>
		
<?php
} else {
?>

		<form name="login" action="<?php echo $this->data['rootUrl'].'?r=user/login'; ?>" method="POST">
			<strong>用户名:</strong>
			<input type="text" maxLength=32 name="user" value=""></input>
			<strong>密码:</strong>
			<input type="password" maxLength=64 name="password" value=""></input>
			<input type="submit" value="登录"></input>
			<input type="hidden" name="retUrl" value="<?PHP echo $_SERVER['REQUEST_URI']; ?>"></input>
		</form>
		<a href="<?php echo $this->data['rootUrl'].'?r=user/register'; ?>">注册</a>

<?php
}
?>
