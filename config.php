<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "reminder";
session_start();

define("URL_ROOT","https://".$_SERVER["HTTP_HOST"]."/reminder/");
$conn = new mysqli($db_server, $db_user, $db_pass,$db_name);

function delete($table, $cond){
    global $conn;
    $st = "DELETE FROM ".$table." ";
    $st .= $cond;
    if($conn->query($st) == true)
        return true;
    else 
        return false;
}
function insert($table, $var){
    global $conn;
    $st = "INSERT INTO ".$table." (".implode(",",array_keys($var)).") VALUES ('".implode("','",array_values($var))."')";
    if($conn->query($st) == true)
        return true;
    else 
        return false;
}
function getVal($sql){
    global $conn;
    $res = $conn->query($sql);
    if($res->num_rows  >0){
        $row = $res->fetch_assoc();
        $keys = array_keys($row);
        return $row[$keys[0]];
    }
    else return NULL;
}
function update($table,$data,$cond){
    global $conn;
    $st ="UPDATE ".$table." SET ";
    $i=0;
    foreach($data as $key=>$value){
        if($i == count($data)-1)
            $st .= "".$key." = '".$value."' ";
        else
            $st .= "".$key." = '".$value."',";
        $i++;

    }
    $st .= $cond;
    if($conn->query($st) == true)
        return true;
    else 
        return false;
}
?>