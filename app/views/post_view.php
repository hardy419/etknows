<?PHP include $Hardy_config['view_dir'].'header_view.php'; ?>

<?PHP include $Hardy_config['view_dir'].'login_view.php'; ?>
<?PHP include $Hardy_config['view_dir'].'register_view.php'; ?>

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
	if (!empty($dat['file_audio'])) echo '<audio controls="controls"><source src="'.$dat['file_audio'].'" />浏览器不支持audio标签</audio><br/>';
	if (!empty($dat['file_pic'])) echo '<img src="'.$dat['file_pic'].'" /><br/>';
	echo "&nbsp;&nbsp;&nbsp;&nbsp;".$dat['content']."<br/>";
	echo "<div align=right>".$dat['addtime']."</div>";
	echo "<br/><hr/><br/>";
}

?>
		
		<form id="form-post" name="f" action="<?php echo $this->data['rootUrl']; ?>" method="POST" enctype="multipart/form-data">
<?php
if(isset($this->data['user'])) {
?>
   <span>上传音频</span>
   <input id="fileupload-audio" type="file" name="file-audio"><br/>
   <span>上传曲谱</span>
   <input id="fileupload-pic" type="file" name="file-pic"><br/>
   <span class="bar"></span><span class="percent"></span ><br/>
<?php
}
?>
			<input type="text" name="subject" placeholder="标题"><br/><br/>
			<textarea name="content" rows="4" cols="60" placeholder="内容"></textarea><br/><br/>
			<input type="button" onclick="submit_form();" value="提交"></input><br/>
		</form>

<script src="public/js/jquery.form.js"></script>
<script>
  function submit_form(){
    $("#form-post").ajaxSubmit({
      url: '<?php echo $this->data['rootUrl'].'?r=post/post'; ?>',
        //dataType:  'json',
        beforeSend: function() {
          $(".percent").html("上传中...");
        },
        uploadProgress: function(event, position, total, percentComplete) {
          $(".percent").html("上传中... ("+percentComplete+"%)");
        },
        success: function(data) {
          alert(data);
          location.reload();
        },
        error:function(xhr){
          alert('提交失败');
        }
    });
  }
</script>

<?PHP include $Hardy_config['view_dir'].'footer_view.php'; ?>
