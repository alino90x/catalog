<?php
 
$db = new mysqli('localhost', 'u1624528_catalog', '****', 'u1624528_catalog');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $category_name = $_POST['category_name'];
    $parent_id = $_POST['parent_id'];

   
    $category_name = $db->real_escape_string($category_name);  
    $sql = "INSERT INTO categories (parent_id, category_name) VALUES ($parent_id, '$category_name')";

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
