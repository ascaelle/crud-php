<?php
require_once('start-session.php');
require 'connection.php';
if (empty($_SESSION['admin_id'])) {
    header("Location: /login.php");
}
$message = '';
if (
    isset($_POST['name']) && isset($_POST['email']) &&
    isset($_POST['phone']) && isset($_POST['address'])
) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $create_at = new DateTime();


    $sql = 'INSERT INTO contacts(name, email, phone, address, create_at, admin_id) 
                        VALUES(:name, :email, :phone, :address, :create_at, :admin_id)';
    $statement = $connection->prepare($sql);
    if ($statement->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':address' => $address,
        ':admin_id' => $_SESSION['admin_id'],
        ':create_at' => $create_at->format('Y-m-d H:i:s'),
    ])) {
        $message = 'Data inserted successfully';
    }
}
?>
<?php require 'header.php'; ?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Add a contact</h2>
        </div>
        <div class="card-body">
            <?php
            if (!empty($message)) : ?>
                <div class="alert alert-success">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
        
            <form method="post" action="" enctype="multipart/form-data" class="mb-3">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" required class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Add a contact</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require 'footer.php'; ?>