<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<title>hash helper</title>
</head>
<body>
<?php
if($_POST["pw"]) {
	require_once "../model/admin.php";
	$model = new adminModel(NULL, NULL);

	$pw = $_POST["pw"];
	$hash = $model->hash($pw);
?>
Hashed = "<?php echo $hash; ?>"<br>
<?php } ?>
<form action="hash.php" method="post">
Password : <input type="text" name="pw"><br>
<input type="submit" value="Hash">
</form>
</body>
</html>