		<form name="search" action="<?php echo $this->data['rootUrl'].'?r=post/index'; ?>" method="POST">
			<strong>关键字:</strong>
			<input type="text" maxLength=64 name="keyword" value=""></input>
			<input type="submit" value="搜索"></input>
		</form>
