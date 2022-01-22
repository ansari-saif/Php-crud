<?php
include 'connection.php';
if (isset($_GET["id"])) {
    $dataSingle = getData($conn,"news",$_GET["id"]);
    $heading = $dataSingle['heading'];
    $author = $dataSingle['author'];
    $category = $dataSingle['category'];
    $location = $dataSingle['location'];
    $description = $dataSingle['description'];
    $elm = '<input type="hidden" name="id" value="'.$_GET["id"].'">';
}else{
    $heading = null;
    $author = null;
    $category = null;
    $location = null;
    $description = null;
    $elm = null;
}
if (isset($_GET["did"])) {
    delete($conn,"news",$_GET["did"]);
}
if (isset($_GET["aid"])) {
    $sql = "UPDATE news SET active = ".$_GET["active"];
     mysqli_query($conn, $sql);
}
$data = getData($conn, "news");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>news || Admin</title>
    <style>
        table {
            border: 1px solid black;

        }

        tr,
        td {
            padding: 20px;
        }

        input,
        button[type="submit"] {
            display: block;
            padding: 10px;
            margin: 10px;
        }
    </style>
</head>

<body>
    <div id="app">
        <center>
            <form action="/save-news.php" method="post">
                <?= $elm ?>
                <input type="text" name="heading" value="<?= $heading ?>" placeholder="heading">
                <input type="text" name="author" value="<?= $author ?>" placeholder="author">
                <input type="text" name="category" value="<?= $category ?>" placeholder="category">
                <input type="text" name="location" value="<?= $location ?>" placeholder="location">
                <textarea name="description" placeholder="description" cols="30" rows="10"><?= $description ?></textarea>
                <button type="submit">Add</button>
            </form>
            <table border="1">
                <tr>
                    <th>Sr</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Active</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Date</th>
                </tr>
                <?php foreach ($data as $k => $v) : ?>
                    <tr>
                        <td><?= $k+1 ?></td>
                        <td><?= $v['heading'] ?></td>
                        <td><?= $v['author'] ?></td>
                        <td><?= $v['category'] ?></td>
                        <td><a href="?aid=<?= $v['id'] ?>&active=<?= $v['active'] ? 0:1?>"><button><?= $v['active']?"✔":"X" ?></button></a></td>
                        <td><a href="?id=<?= $v['id'] ?>"><button>E</button></a></td>
                        <td><a href="?did=<?= $v['id'] ?>"><button>D</button></a></td>
                        <td><?= date("d-m-Y",strtotime($v['created_at'])) ?></td>

                    </tr>
                <?php endforeach; ?>
            </table>
        </center>
    </div>
</body>

</html>