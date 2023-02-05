<?php
require_once('start-session.php');
require 'connection.php';
$message = '';
if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $sql = 'INSERT INTO admin(email, password) 
                        VALUES(:email, :password)';
    $statement = $connection->prepare($sql);
    if(  $statement->execute([
        ':email' => $email,
        ':password' => $password
    ])){
        $message = 'Connection succed';
    }
}
?>
<?php require 'header.php';?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Registration</h2>
        </div>
        <div class="card-body">
            <?php
            if(!empty($message)): ?>
            <div class="alert alert-success">
                <?= $message; ?>
            </div>
            <?php endif; ?>
            <form method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">New account</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require 'footer.php';?>
