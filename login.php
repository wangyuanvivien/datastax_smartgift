<!DOCTYPE html>

<html lang="en">
<title>Smart Gift Project Login Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/bootstrap.css" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/style.css" />
<script type="text/javascript" src ='js/bootstrap.js'></script>
<script type="text/javascript" src ='js/bootstrap.min.js'></script>

<body>
<div class="container-fluid home-page">
<div class="row-fluid">
<div class="span6 offset3">

<?php
session_start();
//require('db.php');
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
    $pool = new ConnectionPool("Keyspace");
    $servers = array("localhost:9160");
    $pool = new ConnectionPool("smartgift", $servers);
    $users = new ColumnFamily($pool, 'users');
    $username = $_POST["username"];
    $event_by_date = new ColumnFamily($pool, 'event_by_date');
    $events = new ColumnFamily($pool, 'events');
    $gift_list = new ColumnFamily($pool, 'gift_list');
    $gifts = new ColumnFamily($pool, 'gifts');
    $contributers = new ColumnFamily($pool, 'contributers');
    $friends = new ColumnFamily($pool, 'friends');
    $buyers = new ColumnFamily($pool, 'buyers');
    $message = new ColumnFamily($pool, 'message');
    $discussionBoard = new ColumnFamily($pool, 'discussionBoard');




//if(isset($_POST['submit'])){
//    echo $username;
    $username = $_POST['username'];
    $password = $_POST["pw"];
    echo $password;
    echo $username;
  
   $rows =  $users->get($username);
    if (count($rows)==0){
       echo "wrong user name";
    }
    else if(count($rows)==2){
       $pwd = $rows['password'];
       if($password ==$pwd){

          $_SESSION['username'] = $username;
     ?>
     
 
          <a href='<?php echo "test.php?".session_id() ?>' class="btn btn-large btn-primary">see friends events</a>
     
  <!--        <a href='<?php echo "myDetail.php?".session_id() ?>' class="btn btn-large btn-primary">see my events</a>-->
<h4>Show my events:</h4>

     <?php
          
  $rowss = $event_by_date->get($username);
      $dateArray = array();
      $event_key = array();
      foreach($rowss as $keyss=>$valuess)   {
         array_push($dateArray, $keyss);
         array_push($event_key, $valuess);
      }
      $date_trim_again = array();
      $date_trim = array();

      foreach($dateArray as $keys=>$values){
         array_push($date_trim, substr($values, -12));
      }
      foreach($date_trim as $key=>$value){
         array_push($date_trim_again, substr($value, 0, 10));
      }

      foreach($event_key as $keys=>$values){
          echo '<br />'.date('Y-m-d',$date_trim_again[$keys]).':';
          echo '<br /> Event id is:      '. $values.".<br />   Gifts are: <br /> ";
          $_SESSION['event_id']=$values;
          $rows = $gift_list->get($values);
          $j = 1;
          foreach($rows as $key=>$value){
           //   echo $key.'here ends the key' ;
             $key_trim = substr($key, -127);
             $key_trim_again = substr($key_trim, 0, 36);
             echo '[Gift'.$j.']  '. $key_trim_again.'    ';
             $rowkey = UUID::import($key_trim_again);
             $column_names = array('name', 'price','raised');
             $result = $gifts->get($rowkey, $column_slice=null, $column_names=$column_names);
             echo 'The gift name is '.$result['name'].'.  The price is '. $result['price'].'.  Currently raised amount is '.$result['raised'].'<br />';

             $j++;
          }
     }
/**********************/
?>
   <h4>Events I contributed:</h4><br />
<?php
    $rowsss = $buyers->get($username);

    foreach ($rowsss as $keysss=>$valuesss){
       $key_trim = substr($keysss, -127);
       $key_trim_again = substr($key_trim, 0, 36);

       echo 'Gift id is '. $key_trim_again.'.  ';

       $gift_id = UUID::import($key_trim_again);

       $column_names = array('name', 'event');
       $results = $gifts->get($gift_id, $column_slice=null, $column_names=$column_names);
       echo 'Gift name is '.$results['name'].'. The gift is for event: ';
       echo $results['event'].'. ';
       
       $event_detail = $events->get($results['event']);
       echo ' Event detail: date '.date('Y-m-d',$event_detail['date']).' ; for user '. $event_detail['user_name'].'.';
       /*
       $event_id = $results['event'];    
       $event_uiid = UUID::import($event_id);

       
       $column_name = array('date', 'user_name');
       $event_detail = $events->get($event_uuid, $column_slice=null, $column_name=$column_name);
       echo $event_detail['date'].'  '.$event_detail['user_name'];*/
       echo 'The amount I contribute is '.$valuesss.'.<br />';
    }
/***************************/ 

       }
       else {
          echo "wrong password!";
          echo "<a href=index.php >go back to try again</a>";

       }
    }

/*
echo "show my event";
$rowss = $event_by_date->get($username);
echo 'user name is '.$username;


      $dateArray = array();
      $event_key = array();
      foreach($rowss as $keyss=>$valuess)   {
         array_push($dateArray, $keyss);
         array_push($event_key, $valuess);
      }
     
      $date_trim_again = array();
      $date_trim = array();

      foreach($dateArray as $keys=>$values){
         array_push($date_trim, substr($values, -12));
      }
      foreach($date_trim as $key=>$value){
         array_push($date_trim_again, substr($value, 0, 10));
      }

      foreach($event_key as $keys=>$values){
          echo date('Y-m-d',$date_trim_again[$keys]).':';
          echo 'event id is :      '. $values.".   Gifts are  ";
          $_SESSION['event_id']=$values;
          $rows = $gift_list->get($values);
          $j = 1;
          foreach($rows as $key=>$value){
           //   echo $key.'here ends the key' ;
             $key_trim = substr($key, -127);
             $key_trim_again = substr($key_trim, 0, 36);
             echo 'gift'.$j.'  '. $key_trim_again.'    ';
             $rowkey = UUID::import($key_trim_again);
             $column_names = array('name', 'price');
             $result = $gifts->get($rowkey, $column_slice=null, $column_names=$column_names);
             Print_r($result);
             echo $value.';';
             $j++;
          }
      }

*/

?>
</div>
</div>
</div>

</body>
</html>

