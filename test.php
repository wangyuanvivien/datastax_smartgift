<!DOCTYPE html>

<html lang="en">
<title>Smart Gift Project Test Page</title>
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
<div class="span8 offset2">

<?php
  session_start();?>
 
  <h3>Your events are</h3>
<?php  error_reporting(E_ALL);
  require_once('db.php');
  use phpcassa\UUID;


  $friend_id = $_SESSION['username'];
    $rows = $friends->get($friend_id);
    $friend_list = array();
    foreach($rows as $row=>$row_value) {
        array_push($friend_list, $row);
    }
    $friend_list_trim = array();
    for ($i = 0; $i <count($friend_list); $i++) { 
        array_push($friend_list_trim, substr($friend_list[$i], 15, -3));
    }
    $dateArray = array();
    $dateAssocArray= array();
    $eventAssocArray=array();
    $event_key = array();
    $date_trim_again = array();
    $date_trim = array();
    for ($i = 0; $i<count($friend_list_trim); $i++){
      
      echo '<h4>Your friend '.$friend_list_trim[$i].':</h4>';
      $rowss = $event_by_date->get($friend_list_trim[$i]);
      
      unset($dateArray);
      unset($event_key);
      $dateArray = array();
      $event_key = array();
      foreach($rowss as $keyss=>$valuess)   {
         array_push($dateArray, $keyss);
         array_push($event_key, $valuess);
      }
      unset($date_trim_again);
      unset($date_trim);
      $date_trim_again = array();
      $date_trim = array();
      
      foreach($dateArray as $keys=>$values){
         array_push($date_trim, substr($values, -12));
      }
      foreach($date_trim as $key=>$value){
         array_push($date_trim_again, substr($value, 0, 10));
      }
      
      foreach($event_key as $keys=>$values){
          echo '<br /><u>Date is '.date('Y-m-d',$date_trim_again[$keys]).': Event id:      '. $values."</u>.<br />"."   Gifts are:  ";
          /*********discussion board trial*****/
             

         /************************************/
          $_SESSION['event_id']=$values;
          $rows = $gift_list->get($values);
          $j = 1;
          foreach($rows as $key=>$value){
           //   echo $key.'here ends the key' ;
             $key_trim = substr($key, -127);
             $key_trim_again = substr($key_trim, 0, 36);
             echo '<strong>[Gift'.$j.']</strong> Gift id is '. $key_trim_again.';    ';
             $rowkey = UUID::import($key_trim_again);
             $column_names = array('name', 'price', 'raised');
             $result = $gifts->get($rowkey, $column_slice=null, $column_names=$column_names);
             echo 'Gift name is '.$result['name'].'; Gift price is '.$result['price'].'; Current raised is '.$result['raised'].'.  ';

           //  echo $value.';';
             $j++;
          }
      }
   }
?>
<div id="form-group" style="border:1px dotted grey">
          <form id="add_gift" class="form-inline" action="addGift.php" method="POST">
          <h5>To add a gift to event:</h4>
              
               Gift Name:
              <input type="text" name="gift" />
              
            
               Gift Price:
              <input type="text" name="price" />
              
             
               Copy the event ID here:
              <input type="text" name="event_id" />
             
                            
              <button type="submit" name="submit" class="btn"> Submit</button>
              
         </form>
         <form id="add_money" class="form-inline" action="giftDetail.php" method="POST">
            <h5>To add money to a gift:</h4>

              Copy Gift Id here: <input type="text" name="gift_id" />
            <!--  Enter your email again: <input type="text" name="user_email" />   -->
              Enter the amount: <input type="text" name="amount" />      
              <button type="submit" name="submit2" class="btn">Submit</button>
         </form>
         <form id="disucssion" class="form-inline" action="discussion.php" method="POST">
              <h5>To enter event idea discussion board:</h5>
              Copy Event Id here <input type="text" name="event_discussion_id" />
              <button type="submit4" name="submit4" class="btn">Submit</button>

         </form>
</div>
</div>
</div>
</div>

</body>
</html>


