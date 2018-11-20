<?


?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" language="javascript">
            function GetDateTime() {
                var currentdate = new Date();
                document.getElementById('date').value=currentdate.getFullYear() + "/"
                    + (currentdate.getMonth()+1)  + "/"
                    + currentdate.getDate() + " "
                    + currentdate.getHours() + ":"
                    + currentdate.getMinutes() + ":"
                    + currentdate.getSeconds();
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
        <textarea name="msg" cols="30" rows="10" required placeholder="Отзыв"></textarea><br>
        <input type="submit">
    </form>
    </body>
</html>