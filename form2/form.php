<?php
include_once 'config.php';
header('Content-Type: text/html; charset=utf-8');

$user_name = $_POST['user_name'];
checkValue($user_name, 'name');

$user_email = $_POST['user_email'];
checkValue($user_email, 'user_email');

$msg = $_POST['msg'];
checkValue($msg, 'msg');

$subject = $_POST['subject'];
checkValue($subject, 'subject');

$start_date_time = $_POST['datetime'];
checkValue($start_date_time, 'datetime');

$finish_date_time = date('Y/m/d H:i:s', time());

//if(mail($user_email, "Вам пришло письмо с сайта $url",
//    "Имя поситителя: $user_name
//            \n Предмет: $subject
//            \n Сообщение: $msg
//            \n Время начала заполнения анкеты: $start_date_time
//            \n Время отправки соощения на сервере: $finish_date_time")){
//    echo 'Письмо отправлено';
//}
// Cоздание подключения к базе данных
$dsn = "mysql:host=$host;dbname=$db_name;";
$pdo = new PDO($dsn, $username, $password, $opt);

$stmt_insert = $pdo->prepare('INSERT INTO messages (user_name, user_email, subject, msg, start_date_time, finish_date_time) VALUES  (?, ?, ?, ?, ?, ?)');
$stmt_insert->execute(array($user_name, $user_email, $subject, $msg, $start_date_time,$finish_date_time));

$query_select = $pdo->query('SELECT * FROM `messages`')->fetchAll(PDO::FETCH_UNIQUE);
foreach ($query_select as $row){
    echo $row['id'] . $row['user_name'] .' '. $row['user_email'] .' '. $row['subject'] .' '. $row['msg'] .' '. $row['start_date_time'] .' | '. $row['finish_date_time'] . "<br/>";
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
