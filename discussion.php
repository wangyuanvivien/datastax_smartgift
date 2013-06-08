<?php
  session_start();
  error_reporting(E_ALL);
  require_once('db.php');
  echo $_SESSION['username'];
  
 // require_once('testDiscussion.php');
  use phpcassa\UUID;

    //   $event_id = $_POST['event_discussion_id'];
      // echo $event_id;
      // $event_uuid = UUID::import($event_id);
   //    $event_uuid = $_SESSION['event_uuid'];
if(isset($_POST['submit4'])){
    /* echo 'test if event id again is set';
     if(isset($_SESSION['event_id_again'])){
       echo 'event id again is set!';
     } */
     unset($_SESSION['event_id_again']); 
     $event_id = $_POST['event_discussion_id'];
     $_SESSION['event_id']= $event_id;
       echo 'in isset'.$event_id;

       $event_uuid = UUID::import($event_id);
      echo $event_uuid;
     $rows =  $discussionBoard->get($event_uuid);
     $authors = array();
     $body = array();
      foreach($rows as $key=>$value){
           $key_trim = substr($key, 245);
           $key_trim_again = substr($key_trim,0,-3);
       
           echo $key_trim_again.':'.$value.'<br />';
          
          // array_push($authors, $key);
          // array_push($body, $value);
      }
      
}
            
if(isset($_SESSION['event_id_again'])){
//echo 'event id is sent back again!';
$event_id_again = $_SESSION['event_id_again'];
$event_uuid_again = UUID::import($event_id_again);
     $rowss =  $discussionBoard->get($event_uuid_again);
     $author = array();
     $bodys = array();
      foreach($rowss as $keys=>$values){
           $key_trims = substr($keys, 245);
           $key_trim_agains = substr($key_trims,0,-3);

           echo $key_trim_agains.':'.$values.'<br />';

          // array_push($authors, $key);
          // array_push($body, $value);
      }


}
  
?>


<?php  /*if(isset($_POST['submit5'])){
     echo "in here";
     //echo 'in isset2'.$event_id;

     $comment = $_POST['comment'];
     echo $comment;
     $email = $_POST['email'];
     echo $email;
     echo $event_uuid;
     $time_uuid = UUID::uuid1();

     $discussionBoard->insert($event_uuid, array(serialize(array($time_uuid, $email))=>$comment));
  }*/

?>

     <form id="addComment" class="form-inline" action="testDiscussion.php" method="POST">
        Enter your comment:  <input type="text" name="comment" />
        Enter your email address:<input type="text" name="email" />
        <input type="submit" name="submit5" value="submit" />
     </form>
<?php
//require_once('testDiscussion.php');
?>
