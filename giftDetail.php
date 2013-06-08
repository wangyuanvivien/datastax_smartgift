<?php
   session_start();
   require_once('db.php');
   use phpcassa\UUID;

      $gift_id = $_POST['gift_id'];
      echo $gift_id;
      $user_email = $_SESSION['username'];
      echo $user_email;
      $amount = $_POST['amount'];
      

//      $user_email = 'vivien@gmail.com';
//      $gift_id = '3e00c6b7-b3cc-4e79-9a18-5551b08a8a71';
      $gift_uuid = UUID::import($gift_id);
  //    $amount = '20.22';
      $buyers->insert($user_email, array(serialize(array($gift_uuid))=>$amount));
      $contributers->insert($gift_uuid, array(serialize(array($user_email))=>$amount));
      $column_names = array('price', 'raised');
      $row = $gifts->get($gift_uuid, $column_slice=null, $column_names=$column_names);
      echo $row['price']."AND".$row['raised'].'<br .>';
      $raised_new = $row['raised']+$amount;
      echo 'raised new is '. $raised_new;
      $gifts->insert($gift_uuid, array('raised'=>$raised_new));
      
      $row_new = $gifts->get($gift_uuid, $column_slice=null, $column_names=$column_names);
      echo 'new raised is '.$row_new['raised'];
      echo '<br />the money has been added to the gift.';
       
  








?>
