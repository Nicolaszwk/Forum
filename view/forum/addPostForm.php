<?php

$topic = $result['data']['topic'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add post</title>
</head>

<body>
    <h1>Add post</h1>
    <form action="index.php?ctrl=forum&action=addPost&id=<?=$topic->getId()?>;" method="POST">
        <label for="message">Message:</label>
        <input type="text" id="message" name="message">
        
        <input type="submit" name="addMessage" value="Submit">
    </form>

</body>

</html>