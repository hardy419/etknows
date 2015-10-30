<?PHP include $Hardy_config['view_dir'].'header_view.php'; ?>
		<form name="f" action="<?php echo $this->data['rootUrl'].'?r=user/register'; ?>" method="POST">
			<strong>用户名:     </strong>
			<input type="text" maxLength=32 name="register_name" value=""></input></br>
			<strong>密码:         </strong>
			<input type="password" maxLength=64 name="register_password" value=""></input></br>
			<strong>确认密码: </strong>
			<input type="password" maxLength=64 name="register_password_again" value=""></input></br>
			<input type="submit" value="注册"></input></br>
		</form>
		<script>
			$(function(){
				document.f.register_name.focus();
			});
		</script>
<?PHP include $Hardy_config['view_dir'].'footer_view.php'; ?>
