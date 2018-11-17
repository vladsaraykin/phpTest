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
$valuesOfPollStr = getElementOfArrStr($resultOfPoll);


mail("vlad.saraykin@mail.ru", "Вам пришло письмо с сайта $sender",
   "Имя поситителя:($sex) $name \n$valuesOfPollStr Отзыв: $msg \n hidden: $hidden");

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
        $translatedArr = getRussianResultOfPoll($arr);
        $result = "Клиенту понравилось: \n";
        foreach ($translatedArr as $item){
            $result = $result."- $item\n";
        }
        return $result;
    }else{
        return "Клиент не выбрал ни один из предложенных вариантов\n";
    }
}

function getRussianResultOfPoll($resultOfPoll){
    $arr = [];
    foreach ($resultOfPoll as $item){
        $arr[] = getRussianValue($item);
    }
    return $arr;
}
