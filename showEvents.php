<?php
session_start();
require('db.php');

require('lib/autoload.php');
    use phpcassa\ColumnFamily;
    use phpcassa\ColumnSlice;
    use phpcassa\Connection\ConnectionPool;
    use phpcassa\Index\IndexExpression;
    use phpcassa\Index\IndexClause;
    use cassandra\Compression;
    use phpcassa\SystemManager;
    use phpcassa\UUID;
    use cassandra\ConsistencyLevel;
   // print_r(get_declared_classes());
    $pool = new ConnectionPool("Keyspace");
    $servers = array("localhost:9160");
    $pool = new ConnectionPool("smartgift", $servers);
    $users = new ColumnFamily($pool, 'users');

    $friends  = new ColumnFamily($pool, 'friends');

  // $serializedArray = $_REQUEST["serializedArray"]; 
  // $unserializedArray = unserialize(stripslashes($serializedArray));  
    $friend_id = 'vivien@gmail.com';
    $rows = $friends->get($friend_id);
    $friend_list = array();
    foreach($rows as $row=>$row_value) {
        array_push($friend_list, $row);
       // echo "key = " . $row;
    }
    $friend_list_trim = array();
   for ($i = 0; $i <count($friend_list); $i++) {
        array_push($friend_list_trim, substr($friend_list[$i], 15, -3));
  // $_SESSION['info'] = $friend_list_trim;

  // Print_r($_SESSION['info']) ;

   }

for ($i = 0; $i<count($friend_list_trim); $i++){
    $rowss = $event_by_date->get($friend_list_trim[$i]);
   foreach($rowss as $keyss=>$valuess)   {
           echo $keyss.'  '. $valuess.' ';
   }

}
?>
