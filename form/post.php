<?php
/**
 * Created by PhpStorm.
 * User: vlada
 * Date: 13.11.2018
 * Time: 16:11
 */

$name = $_POST['name'];
$msg = $_POST['msg'];
$sex = $_POST['sex'];
$resultOfPoll = $_POST['resultPoll'];
$sender = $_SERVER['SERVER_NAME'];
$sex = getRussianValue($sex);
$hidden = $_POST['hidden'];
$resultOfPollRus = getRussianResultOfPoll($resultOfPoll);
$valuesOfPollStr = getElementOfArrStr($resultOfPollRus);


mail("vlad.saraykin@mail.ru", "Вам пришло письмо с сайта $sender",
   "Отзыв поситителя:($sex) $name \n$valuesOfPollStr Сообщение: $msg \n hidden: $hidden");

function getRussianValue($arg){
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
        case 'male':
            return 'Мужчина';
        case 'female':
            return 'Женщина';
    }
    return 'Undefined value';
}

function getElementOfArrStr($arr){
    if (sizeof($arr) != 0){
        $result = "Клиенту понравилось: \n";
        foreach ($arr as $item){
            $result = $result."\t $item\n";
        }
        return $result;
    }else{
        return "Клиент не выбрал ни один предложенный вариант\n";
    }
}

function getRussianResultOfPoll($resultOfPoll){
    $arr = [];
    foreach ($resultOfPoll as $item){
        $arr[] = getRussianValue($item);
    }
    return $arr;
}
