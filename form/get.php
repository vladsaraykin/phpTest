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
mail("vlad.saraykin@mail.ru", "Тест", "Отправитель:($sex) $name \nСообщение: $msg");
