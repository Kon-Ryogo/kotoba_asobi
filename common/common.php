<?php

function sanitize($before)
{
    foreach($before as $key=>$value)
    {
        $after[$key]=htmlspecialchars($value,ENT_QUOTES,'UTF-8');
    }
    return $after;
}

function mondaidb()
{
    $dsn='mysql:dbname=mondai;host=localhost;charset=utf8';
    $user='root';
    $password='';

    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    return $dbh;
}

?>