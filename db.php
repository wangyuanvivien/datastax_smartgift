<?php
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
    $events = new ColumnFamily($pool, 'events');
    $event_by_date = new ColumnFamily($pool, 'event_by_date');
    $gift_list = new ColumnFamily($pool, 'gift_list');
    $gifts = new ColumnFamily($pool, 'gifts');
    $contributers = new ColumnFamily($pool, 'contributers');
    $users = new ColumnFamily($pool, 'users');
    $friends = new ColumnFamily($pool, 'friends');
    $buyers = new ColumnFamily($pool, 'buyers');
    $message = new ColumnFamily($pool, 'message');
    $discussionBoard = new ColumnFamily($pool, 'discussionBoard');    
?>   
