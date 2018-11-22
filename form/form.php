<?php
/**
 * Created by PhpStorm.
 * User: vlada
 * Date: 13.11.2018
 * Time: 16:11
 */
include_once "config.php";
header('Content-Type: text/html; charset=utf-8');

$password = $_POST['password'];
if ($password == md5('qwerty12345')){
    echo 'Пароли совпадают!';
}
$name = $_POST['name'];
checkValue($name, 'name');

$msg = $_POST['msg'];
checkValue($msg, 'msg');

$sex = $_POST['sex'];
checkValue($sex, 'sex');
$sex = getRussianValue($sex, 'sex');

$responses_of_poll = $_POST['resultPoll'];
checkValue($responses_of_poll, 'resultPoll');
$responses_of_poll_str = getElementsOfArrStr($responses_of_poll, 'resultPoll');
$responses_db = getElementsOfArrDb($responses_of_poll, 'resultPoll');

$date_of_start_poll = $_POST['datetime'];
checkValue($date_of_start_poll, 'datetime');
$date_of_start_poll = new DateTime(date('Y/m/d H:i:s', $date_of_start_poll));

$date_of_save_db =  microtime(time());
$date_of_save_db = new DateTime(date('Y/m/d H:i:s', $date_of_save_db));

$difference_date = $date_of_start_poll->diff($date_of_save_db);

//if(mail($e_mail, "Вам пришло письмо с сайта $url",
//    "Имя поситителя:($sex) $name \n$responses_of_poll_str Отзыв: $msg
//            \n Время начала заполнения анкеты: $date_of_start_poll
//            \n Время отправки соощения на сервере: $date_of_save_db")){
//    echo 'Письмо отправлено';
//}
// Cоздание подключения к базе данных
$link = mysqli_connect($db_host, $db_user, $db_password, $db_base) or die('Ошибка' . mysqli_error($link));

//Записываем в БД
$query_insert = 'INSERT INTO messages (name, sex, responses, message, date_of_start_poll, date_of_save_db, difference_date) VALUES ("' . $name . '", "'
    . $sex . '", "'
    . $responses_db . '", "'
    . $msg . '", "'
    . $date_of_start_poll->format('Y/m/d H:i:s') . '", "'
    . $date_of_save_db->format('Y/m/d H:i:s'). '", "'
    . $difference_date->format('%H:%I:%S')
    . '")';
//echo $query_insert . '<br/>';
mysqli_query($link, $query_insert) or die('Ошибка' . mysqli_error($link));

///Вывод из БД
$query_select = 'SELECT * FROM messages';
$result = mysqli_query($link, $query_select) or die('Ошибка' . mysqli_error($link));
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
//    echo $row["id"] . ' ' . $row["name"] . ' ' . $row["sex"] . ' ' . $row["responses"] . ' ' . $row["message"] . ' ' . $row["date_of_save_db"] . ' <br />';
}
mysqli_free_result($result);

// Закрыть подключения к базе данных
mysqli_close($link);

function getRussianValue($arg, $type)
{
    if ($type == 'sex') {
        switch ($arg) {
            case 'male':
                return 'Мужчина';
            case 'female':
                return 'Женщина';
            default:
                return "$arg - не определенно значение в словаре. 
                \nНапишите в службу поддержки help.develop@landing.ru. Вам ответят в течение часа";
        }
    }
    if ($type == 'resultPoll') {
        if (sizeof($arg) != 0) {
            $russian_values = [];
            foreach ($arg as $item) {
                switch ($item) {
                    case 'service':
                        $russian_values[] = 'обслуживание';
                        break;
                    case 'staff':
                        $russian_values[] = 'персонал';
                        break;
                    case 'price':
                        $russian_values[] = 'цена';
                        break;
                    case 'program':
                        $russian_values[] = 'программа';
                        break;
                    case 'atmosphere':
                        $russian_values[] = 'обстановка';
                        break;
                    default:
                        return "$item - не определенно значение в словаре. 
            \nНапишите в службу поддержки help.develop@landing.ru. Вам ответят в течение часа";
                }
            }
            return $russian_values;
        } else {
            return "Клиент не выбрал ни один из предложенных вариантов\n";
        }

    }
}

function getElementsOfArrStr($arr, $type)
{
    if (sizeof($arr) != 0) {
        $translatedArr = getRussianValue($arr, $type);
        $result = "Клиенту понравилось: \n";
        foreach ($translatedArr as $item) {
            $result = $result . "- $item\n";
        }
        return $result;
    }
}

function getElementsOfArrDb($responses_of_poll, $type)
{
    if (isset($responses_of_poll)) {
        $result = '';
        $responses_translated = getRussianValue($responses_of_poll, $type);
        foreach ($responses_translated as $item) {
            $result = $result . $item . ';';
        }
        return $result;
    }
}

function checkValue($value, $type)
{
    if (!isset($value)) {
        echo "Вы не заполнили поле типа $type";
    }
    if (strpos($type, 'name') ) {
    if(strlen($value) <= 2 || preg_match('/[0-9]/u', $value))
        echo $value . ' некорректное значение!';
    }
}
