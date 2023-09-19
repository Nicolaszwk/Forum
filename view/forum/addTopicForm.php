<?php

$category = $result['data']['category'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add topic</title>
</head>

<body>
    <h1>Add topic</h1>
    <form action="index.php?ctrl=forum&action=addTopic&id=<?=$category->getId()?>;" method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title">

        <label for="message">Message:</label>
        <input type="text" id="message" name="message">
        
        <input type="submit" name="addTitle" value="Submit">
    </form>

</body>

</html>