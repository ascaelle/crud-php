<?php
require_once('start-session.php');
require 'connection.php';
if (empty($_SESSION['admin_id'])) {
    header("Location: /login.php");
}

$id = $_GET['id'];
$sql = 'SELECT * FROM contacts  WHERE id =:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id]);
$contact = $statement->fetch(PDO::FETCH_OBJ);

if(isset($_POST['name']) && isset($_POST['email']) && 
isset($_POST['phone']) && isset($_POST['address']) &&
isset($_POST['create_at'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $create_at = $_POST['create_at'];
    $sql = 'UPDATE contacts SET name=:name, email=:email, phone=:phone, address=:address, create_at=:create_at WHERE id=:id'; 
    $statement = $connection->prepare($sql);
    if ($statement->execute([':name' => $name, ':email' => $email, ':phone' => $phone, ':address' => $address, ':create_at' => $create_at, ':id' => $id])) 
    {
        header("Location: /");
    }

}
?>
<?php require 'header.php';?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Update a contact</h2>
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
                    <label for="name">Name</label>
                    <input value="<?= $contact->name; ?>" type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input value="<?= $contact->email; ?>" type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input value="<?= $contact->phone; ?>" type="number" name="phone" id="phone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input value="<?= $contact->address; ?>" type="text" name="address" id="address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="create_at">Create At</label>
                    <input value="<?= $contact->create_at; ?>" type="DATETIME" name="create_at" id="create_at" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Update a contact</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require 'footer.php';?>
