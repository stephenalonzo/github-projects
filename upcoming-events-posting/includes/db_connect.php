<?php
$db_host = "localhost";               // Database Host
$db_user = "opdW";                    // Database User
$db_pass = "B62XPdHClHukD7Q0";        // Database Password
$db_name = "opd";                     // Database Name
try
{
    $conn=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    $e->getMessage();
}

?>