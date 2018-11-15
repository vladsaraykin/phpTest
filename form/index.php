<?

?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
    <form action="post.php" method="POST" accept-charset="UTF-8">
        <input type="text" name="name" placeholder="Введите Ваше имя"/><br>
        <span>Ваш пол:</span><br>
        <input type="radio" name="sex" value="male"/>Мужчина<br>
        <input type="radio" name="sex" value="female"/>Женщина<br>
        <span>Что Вам понравилось?</span><br/>
        <input type="checkbox" name="resultPoll[]" value="service"/>Обслуживание<br>
        <input type="checkbox" name="resultPoll[]" value="staff"/>Персонал<br>
        <input type="checkbox" name="resultPoll[]" value="price"/>Цены<br>
        <input type="checkbox" name="resultPoll[]" value="program"/>Программа<br>
        <input type="checkbox" name="resultPoll[]" value="atmosphere"/>Обстановка<br>
        <input type="hidden" name="hidden">
        <textarea name="msg" id="" cols="30" rows="10" placeholder="Ваш вариант"></textarea><br>
        <input type="submit">
    </form>
    </body>
</html>
