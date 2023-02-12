<?php
require_once 'connection.php';
if (isset($_POST['upload'])) {
    $id = intval($_GET['id']);

    $file_name = $_FILES['file']['name'];
    $file_temp = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];

    $location = "upload image/profile-" . $_GET['id'];

    if ($file_size < 52488000000) {
        if (move_uploaded_file($file_temp, $location)) {
            /* try{
                    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE contacts SET image='$location' WHERE id='id'";
                    $connection->execute($sql);
                }catch(PDOException $e){
                    echo $e->getMessage();
                }*/

            //header('location:index.php');
            $sql = "UPDATE contacts SET image=:location WHERE id=:id";
            $statement = $connection->prepare($sql);
            if ($statement->execute([
                ':location' => $location,
                ':id' => $_GET['id']
            ])) {
                header('location:index.php');
            }
        }
    } else {
        echo "<script>alert('File size is too large to upload');</script>";
    }
}
?>
<html>

<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    $id = intval($_GET['id']);
    $sql = 'SELECT * FROM contacts  WHERE id =:id';
    $statement = $connection->prepare($sql);
    $statement->execute([':id' => $id]);
    $contact = $statement->fetch(PDO::FETCH_OBJ);
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Profile Upload</h3>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Upload here</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                    <button type="submit" name="upload" class="btn btn-danger">Upload</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>