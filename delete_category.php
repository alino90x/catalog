<?php
 
$db = new mysqli('localhost', 'u1624528_catalog', '*****', 'u1624528_catalog');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
 
    $category_id = $db->real_escape_string($category_id);  

    $sql = "DELETE FROM categories WHERE category_id = $category_id";

    if ($db->query($sql) === TRUE) {
        
        $db->close();
        header('Location: index.php');
        exit();
    } else {
        
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}

$db->close();
?>
