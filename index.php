<?php
require_once('start-session.php');

if (empty($_SESSION['admin_id'])) {
    header("Location: /login.php");
}

require 'connection.php';
$sql = 'SELECT * FROM contacts WHERE admin_id = :admin_id';
$statement = $connection->prepare($sql);
$statement->execute(['admin_id' => $_SESSION['admin_id']]);
$contacts = $statement->fetchAll(PDO::FETCH_OBJ);

?>
<?php require 'header.php'; ?>
<div class="container">
    <div class="card mt-5">
        <div class="card-hearder">
            <h2>All contacts</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Create_at</th>
                    <th>admin_id</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($contacts as $contact) : ?>
                    <tr>
                        <td><?= $contact->id; ?></td>
                        <td><?= $contact->name; ?></td>
                        <td><?= $contact->email; ?></td>
                        <td><?= $contact->phone; ?></td>
                        <td><?= $contact->address; ?></td>
                        <td><?= $contact->create_at; ?></td>
                        <td><?= $contact->admin_id; ?></td>
                        <td>
                            <a href="edit.php?id=<?= $contact->id ?>" class="btn btn-info">Edit</a>
                            <a onclick="return confirm('Are you sure you want to delete this entru? ')" href="delete.php?id=<?= $contact->id ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>

</div>
<?php require 'footer.php'; ?>