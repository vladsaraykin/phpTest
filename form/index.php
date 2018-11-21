<?


?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" language="javascript">
            function GetDateTime() {
                var currentdate = new Date().getTime() / 1000;
                document.getElementById('date').value=currentdate;
            }
        </script>
    </head>
    <body>
    <form action="form.php" method="POST" accept-charset="UTF-8">
        <input type="text" name="name" required placeholder="Введите Ваше имя" onclick="GetDateTime()"/><br>
        <span>Ваш пол:</span><br>
        <input type="radio" name="sex" value="male"/>Мужчина<br>
        <input type="radio" name="sex" value="female"/>Женщина<br>
        <span>Что Вам понравилось?</span><br/>
        <input type="checkbox" name="resultPoll[]" value="service"/>Обслуживание<br>
        <input type="checkbox" name="resultPoll[]" value="staff"/>Персонал<br>
        <input type="checkbox" name="resultPoll[]" value="price"/>Цены<br>
        <input type="checkbox" name="resultPoll[]" value="program"/>Программа<br>
        <input type="checkbox" name="resultPoll[]" value="atmosphere"/>Обстановка<br>
        <input type="hidden" id="date" name="datetime">
        <input type="hidden" name="password" value="85064efb60a9601805dcea56ec5402f7">
        <textarea name="msg" cols="30" rows="10" required placeholder="Отзыв"></textarea><br>
        <input type="submit">
    </form>
    </body>
</html>