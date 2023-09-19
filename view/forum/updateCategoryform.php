<!DOCTYPE html>
<html>

<?php
$category = $result['data']['category'];
?>

<head>
    <title>Update Category</title>
</head>

<body>
    <h1>Update Category</h1>
    <form action="index.php?ctrl=forum&action=updateCategory&id=<?=$category->getId()?>" method="POST">
        <label for="newName">New category name:</label>
        <input type="text" id="newName" name="newName">
        
        <input type="submit" name="updateCategory" value="Submit">
    </form>

</body>

</html>