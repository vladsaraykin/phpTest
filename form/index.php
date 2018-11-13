<?

?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
    <form action="get.php" method="POST" accept-charset="UTF-8">
        <input type="text" name="name" placeholder="Введите Ваше имя"/><br>
        <textarea name="msg" id="" cols="30" rows="10" placeholder="Сообщение"></textarea><br>
        <span>Ваш пол:</span><br>
        <input type="radio" id="man" name="sex" value="male"/>
        <label for="man">Мужчина</label><br>
        <input type="radio" id="women" name="sex" value="female"/>
        <label for="women">Женщина</label><br>
        <span></span>
        <input type="checkbox" name="checkbox"/><br>
        <input type="submit">
    </form>
    </body>
</html>
