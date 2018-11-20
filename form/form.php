<?php
/**
 * Created by PhpStorm.
 * User: vlada
 * Date: 13.11.2018
 * Time: 16:11
 */
include_once "config.php";
header('Content-Type: text/html; charset=utf-8');

$name = $_POST['name'];
checkValue($name, 'name');

$msg = $_POST['msg'];
checkValue($msg, 'msg');

$sex = $_POST['sex'];
checkValue($sex, 'sex');
$sex = getRussianValue($sex, 'sex');

$date_of_start_poll = $_POST['datetime'];
checkValue($date_of_start_poll, 'datetime');
$date_of_save_db = date('Y/m/d H:i:s', time());

$responses_of_poll = $_POST['resultPoll'];
checkValue($responses_of_poll, 'resultPoll');
$responses_of_poll_str = getElementsOfArrStr($responses_of_poll, 'resultPoll');
$responses_db = getElementsOfArrDb($responses_of_poll, 'resultPoll');

//if(mail($e_mail, "Вам пришло письмо с сайта $url",
//    "Имя поситителя:($sex) $name \n$responses_of_poll_str Отзыв: $msg
//            \n Время начала заполнения анкеты: $date_of_start_poll
//            \n Время отправки соощения на сервере: $date_of_save_db")){
//    echo 'Письмо отправлено';
//}
// Cоздание подключения к базе данных
$link = mysqli_connect($db_host, $db_user, $db_password, $db_base) or die('Ошибка' . mysqli_error($link));

//Записываем в БД
$query_insert = 'INSERT INTO messages (name, sex, responses, message, date_of_start_poll, date_of_save_db) VALUES ("' . $name . '", "'
    . $sex . '", "'
    . $responses_db . '", "'
    . $msg . '", "'
    . $date_of_start_poll .'", "'
    . $date_of_save_db
    . '")';
echo $query_insert . '<br/>';
mysqli_query($link, $query_insert) or die('Ошибка' . mysqli_error($link));

///Вывод из БД
$query_select = 'SELECT * FROM messages';
$result = mysqli_query($link, $query_select) or die('Ошибка' . mysqli_error($link));
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo $row["id"] . ' ' . $row["name"] . ' ' . $row["message"] . ' ' . $row["date"] . ' <br />';
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
    if ($type == 'resultPoll')
    switch ($arg) {
        case 'service':
            return 'обслуживание';
        case 'staff':
            return 'персонал';
        case 'price':
            return 'цена';
        case 'program':
            return 'программа';
        case 'atmosphere':
            return 'обстановка';
        default:
            return "$arg - не определенно значение в словаре. 
            \nНапишите в службу поддержки help.develop@landing.ru. Вам ответят в течение часа";
    }
}

function getElementsOfArrStr($arr, $type)
{
    if (sizeof($arr) != 0) {
        $translatedArr = getRussianResultOfPoll($arr, $type);
        $result = "Клиенту понравилось: \n";
        foreach ($translatedArr as $item) {
            $result = $result . "- $item\n";
        }
        return $result;
    } else {
        return "Клиент не выбрал ни один из предложенных вариантов\n";
    }
}

function getRussianResultOfPoll($resultOfPoll, $type)
{
    $arr = [];
    foreach ($resultOfPoll as $item) {
        $arr[] = getRussianValue($item, $type);
    }
    return $arr;
}

function getElementsOfArrDb($responses_of_poll, $type)
{
    if(isset($responses_of_poll))
    {
    $result = '';
    foreach ($responses_of_poll as $item){
       $result = getRussianValue($item , $type) . ';';
    }
    echo $result;
    return $result;
    }
}

function checkValue($value, $type)
{
    if(!isset($value)){
        echo "Вы не заполнили поле типа $type";
        }
}
