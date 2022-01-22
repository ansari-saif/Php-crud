<?php
include 'connection.php';
if (isset($_POST["id"])) {
    update($conn, $_POST, 'news',$_POST["id"]);
} else {
    insert($conn, $_POST, 'news');
}
echo "
<script>alert('data save');
location.href = '/';</script>
";
