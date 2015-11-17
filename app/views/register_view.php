<?php
if(!isset($this->data['user'])) {
?>

		<form name="f" action="<?php echo $this->data['rootUrl'].'?r=user/register'; ?>" method="POST">
			<strong>用户名:     </strong>
			<input type="text" name="register_name" value=""></input></br>
			<strong>密码:         </strong>
			<input type="password" name="register_password" value=""></input></br>
			<strong>确认密码: </strong>
			<input type="password" name="register_password_again" value=""></input></br>
			<input type="submit" value="注册"></input></br>
			<input type="hidden" name="retUrl" value="<?PHP echo $_SERVER['REQUEST_URI']; ?>"></input>
		</form>
		<script>
			$(function(){
				document.f.register_name.focus();
			});
		</script>

<?php
}
?>
