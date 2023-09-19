<!DOCTYPE html>
<html>

<head>
    <title>Add Category</title>
</head>

<body>
    <h1>Add Category</h1>
    <form action="index.php?ctrl=forum&action=addCategory" method="POST">
        <label for="name">Category name:</label>
        <input type="text" id="name" name="name">
        
        <input type="submit" name="addCategory" value="Submit">
    </form>

</body>

</html>