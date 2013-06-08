<?php
session_start();
require_once('db.php');
use phpcassa\UUID;

if(isset($_SESSION['username'])){
echo 'session is alive'.$_SESSION['username'];
}


$rowkey = UUID::uuid1();

   $name = $_POST['gift'];
   $price = $_POST['price'];
   $event = $_POST['event_id'];
   echo $name.' '.$price.'  '.$event;
   $event_uuid_copy = UUID::import($event);
$gifts->insert($rowkey, array('name'=>$name, 'price'=>$price, 'event'=>$event_uuid_copy));
$gift_list->insert($event_uuid_copy, array(serialize(array($rowkey))=>$price));
   echo "Sucessfully inserted! Click back on browser to get back."
?>

