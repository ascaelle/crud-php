<?php
require_once('start-session.php');

require_once ('connection.php');

if (isset($_POST['login'])) {
	if ($_POST['email'] != "" || $_POST['password'] != "") {
		$email = $_POST['email'];
		$password = sha1($_POST['password']);
		$sql = "SELECT * FROM `admin` WHERE `email`=? AND `password`=? ";
		$query = $connection->prepare($sql);
		$query->execute(array($email, $password));
		$row = $query->rowCount();
		$fetch = $query->fetch();
		if ($row > 0) {
			$_SESSION['admin_id'] = $fetch['Id'];
			header("location: index.php");
		} else {
			echo "<script>alert('Invalid email or password')</script>";
		}
	} else {
		echo "
				<script>alert('Please complete the required field!')</script>
				<script>window.location = 'index.php'</script>
			";
	}
}
?>
<form method="post">
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" autocomplete="off" value="" name="email" id="email" class="form-control">
	</div>
	<div class="form-group">
		<label for="name">Password</label>
		<input type="password" autocomplete="off" value="" name="password" id="password" class="form-control">
	</div>
	<div class="form-group">
		<button type="submit" name="login" class="btn btn-info">Login</button>
	</div>
</form>
<a class="nav-link" href="addAdmin.php">Create an account</a>