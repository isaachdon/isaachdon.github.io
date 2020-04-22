<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//define parameters
$host="localhost";
$login="phpuser";
$password="phpuser";
$database="freshfabrix";

// connect to the mysql sever
$conn=@new mysqli($host,$login,$password,$database);

//handle connection errors
if ($conn->connect_errno){
    $errno=$conn->connect_errno;
    $errmsg=$conn->connect_error;
    die("Connection to database failed:($errno)$errmsg.");
}
