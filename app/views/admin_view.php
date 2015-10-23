<html>
	<head><title>用户管理</title></head>
	<body>

<?php

	foreach($data['users'] as $user)
	if($user['username'] != $data['admin'])
	{
		echo "<p>";
		echo $user['username']."&nbsp;&nbsp;<a href=\"".$data['rootUrl']."?op=admin&delete=".$user['username']."\">删除</a>";
		echo "</p>";
	}

?>

	</body>
</html>
