<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <title>Дерево категорий</title>
    <link rel="stylesheet" href="./style.css">

</head>

<body>
   <center><h1>Дерево категорий - МИФ-ПИБ-41</h1></center>
    
    <div id="category-menu">
        <ul>
            <?php
                
                $db = new mysqli('localhost', 'u1624528_catalog', 'Club1920', 'u1624528_catalog');
                
                if ($db->connect_error) {
                    die("Connection failed: " . $db->connect_error);
                }
                
                function displayCategories($parent_id, $db) {
                    $sql = "SELECT * FROM categories WHERE parent_id = $parent_id";
                    $result = $db->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<li class="category-item">';
                            echo $row['category_name'];
                            echo ' <button onclick="deleteCategory(' . $row['category_id'] . ')">Удалить</button>';
                            echo '</li>';
                            
                         
                            echo '<ul>';
                            displayCategories($row['category_id'], $db);
                            echo '</ul>';
                        }
                    }
                }
                
                displayCategories(0, $db);
                
                $db->close();
            ?>
        </ul>
    </div>
    
    <div class="category-item" id="category-form">
        <h2>Добавить узел</h2>
        <form action="add_category.php" method="POST">
            <label for="category_name">Название узла:</label>
            <input type="text" id="category_name" name="category_name" required>
            
            <label for="parent_id">Родительская категория:</label>
            <select id="parent_id" name="parent_id">
                <option value="0">Выберите место добавления узла</option>
                
                <?php
                    
                    $db = new mysqli('localhost', 'u1624528_catalog', 'Club1920', 'u1624528_catalog');
            
                    if ($db->connect_error) {
                        die("Connection failed: " . $db->connect_error);
                    }
                    
                    $sql = "SELECT * FROM categories";
                    $result = $db->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
                        }
                    }
                    
                    $db->close();
                ?>
            </select>
            
            <button type="submit">Добавить</button>
        </form>
    </div>
    
    <script>
        function deleteCategory(categoryId) {
            if (confirm("Вы уверены, что хотите удалить эту категорию?")) {
                window.location.href = "delete_category.php?id=" + categoryId;
            }
        }
    </script>
</body>
</html>
