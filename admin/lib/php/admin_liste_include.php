<?php

    if(file_exists('admin/lib/php/DBConnectPgSql.php')){
        include('admin/lib/php/DBConnectPgSql.php');
        include('admin/lib/php/autoload.php');
    }
    else if (file_exists('lib/php/DBConnectPgSql.php')){
        include('lib/php/DBConnectPgSql.php');
        include('lib/php/autoload.php');
    }  
    else if (file_exists('DBConnectPgSql.php')){
    include('DBConnectPgSql.php');
    include('autoload.php');}