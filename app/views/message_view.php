<?PHP include $Hardy_config['view_dir'].'header_view.php'; ?>

<?php
echo "<p><strong>".$this->data['message']."</strong></p>";
echo "<a href=\"".$this->data['retUrl']."\" name=\"return\">点此返回...</a>";
?>

<?PHP include $Hardy_config['view_dir'].'footer_view.php'; ?>
