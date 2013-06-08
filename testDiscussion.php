<?php 
   session_start();
   require_once('db.php');
   use phpcassa\UUID;
   echo $_SESSION['username'];

   if(isset($_SESSION['event_id'])){
     echo 'session event id is alive'.$_SESSION['event_id'];
   }
  // $event_id = '9c32e4b9-85ea-4c4c-b70e-ddbee74f6037';
   $event_id = $_SESSION['event_id'];
   echo gettype($event_id);
    $event_uuid= UUID::import($event_id);
   // echo $_SESSION['event_uuid'];
   $time_uuid = UUID::uuid1();
      echo "in here";
     $comment = $_POST['comment'];
     $email = $_POST['email'];
    echo $comment.$email;
  // $time_uuid2 = UUID::uuid1();
 $discussionBoard->insert($event_uuid, array(serialize(array($time_uuid, $email))=>$comment));
// $discussionBoard->insert($event_uuid, array(serialize(array($time_uuid))=>'why sushi'));
  //  $discussionBoard->insert($event_uuid,array($time_uuid=>'no scarf'));
//    echo '<a href=ec2-54-215-135-219.us-west-1.compute.amazonaws.com/discussion.php> click</a> ';

  $_SESSION['event_id_again'] = $event_id;
?>
<a href="discussion.php">back</a>
