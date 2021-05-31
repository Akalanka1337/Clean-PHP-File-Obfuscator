<html>
<h2>PHP File Obfuscator</h2>
<form method="post" action="build.php" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" value="Generate" name="submit">
</form>
<p>Only Pure PHP Files Supporting at This Time</p>
</html>


<?php
require 'plugin/Obfuscator.php';

if(!empty($_FILES['file']['tmp_name']) && file_exists($_FILES['file']['tmp_name']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
$file_name =  $_FILES["file"]["name"];
$sData = file_get_contents($_FILES["file"]["tmp_name"]);
$sData = str_replace(array('<?php', '<?', '?>'), '', $sData); // We strip the open/close PHP tags
$sObfusationData = new Obfuscator($sData, 'Class/Code NAME');
file_put_contents('obfuscated_'. $file_name, '<?php ' . "\r\n" . $sObfusationData);
echo '<b>Obfuscated File Generated Successfully!</b>';
}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
echo '<b>Faild To Create!</b>';
}

