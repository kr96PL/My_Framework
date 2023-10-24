<?php 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach($users as $user) { ?>
        <p><?=$user['name']?> | <?=$user['email']?></p>
    <?php } ?>
    <form method="POST" action="">
        <input type="text" name="name" placeholder="name"/>
        <input type="text" name="surname" placeholder="surname"/>
        <input type="email" name="email" placeholder="email"/>
        <input type="password" name="password" placeholder="password"/>
        <button>Submit</button>
    </form>
</body>
</html>