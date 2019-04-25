<?php

function get_onlineip() { 
$ch = curl_init('http://2019.ip138.com/ic.asp'); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
$a = curl_exec($ch); 
preg_match('/\[(.*)\]/', $a, $ip); 
return $ip[1]; 
} 

$id=1;
$user_id = "hxk";
$IP = get_onlineip();
$Address = "广东省惠州市 电信";
$Update_Time = date("Y-m-d H:i:s");

function my_db(){
$servername = "mysql:dbname=hxk_sjzz;host=db4free.net";
$username = "hxk1996";
$password = "hxk20190331";
$db = new PDO($servername, $username, $password);
return $db;
}

$db = my_db();
$stm = $db->prepare("update ServerIP set IP=:IP,Address=:Address,Update_Time=:Update_Time  where id=:id and user_id=:user_id");
$stm->bindParam(":id",$id,PDO::PARAM_STR);
$stm->bindParam(":user_id",$user_id,PDO::PARAM_STR);
$stm->bindParam(":IP",$IP,PDO::PARAM_STR);
$stm->bindParam(":Address",$Address,PDO::PARAM_STR);
$stm->bindParam(":Update_Time",$Update_Time,PDO::PARAM_STR);
$stm->execute();
echo "\n更新记录成功";

/* $db = my_db();
$stm = $db->prepare("insert into ServerIP (user_id,IP,Address,Update_Time)  values(:user_id,:IP,:Address,:Update_Time)");
$stm->bindParam(":user_id",$user_id,PDO::PARAM_STR);
$stm->bindParam(":IP",$IP,PDO::PARAM_STR);
$stm->bindParam(":Address",$Address,PDO::PARAM_STR);
$stm->bindParam(":Update_Time",$Update_Time,PDO::PARAM_STR);
$stm->execute();
$result = $stm->fetch(PDO::FETCH_ASSOC);
echo "新记录插入成功"; */
$db = null;


?>



