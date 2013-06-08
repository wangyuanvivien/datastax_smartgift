<?php
  session_start();
  echo $_SESSION['username'].' events are <br />';
  error_reporting(E_ALL);
  require_once('db.php');
  use phpcassa\UUID;
  
  $my_id = $_SESSION['username'];
/***************************************/
  $rows = $event_by_date->get($my_id);
        $dateArray = array();
      $event_key = array();
      foreach($rows as $keyss=>$valuess)   {
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
          echo '<br /> event id is :      '. $values.".<br />   Gifts are  ";
          $_SESSION['event_id']=$values;
          $rows = $gift_list->get($values);
          $j = 1;
          foreach($rows as $key=>$value){
           //   echo $key.'here ends the key' ;
             $key_trim = substr($key, -127);
             $key_trim_again = substr($key_trim, 0, 36);
             echo 'gift'.$j.'  '. $key_trim_again.'    ';
             $rowkey = UUID::import($key_trim_again);
             $column_names = array('name', 'price','raised');
             $result = $gifts->get($rowkey, $column_slice=null, $column_names=$column_names);
             Print_r($result);
             
             $j++;
          }
     }
/**********************/
    echo "<br />The events I sponsored<br />";
    $rowsss = $buyers->get($my_id);
   
    foreach ($rowsss as $keysss=>$valuesss){
       $key_trim = substr($keysss, -127);
       $key_trim_again = substr($key_trim, 0, 36);
       
       echo 'gift id is '. $key_trim_again.'  ';
       
       $gift_id = UUID::import($key_trim_again);
       
       $column_names = array('name', 'event');
       $results = $gifts->get($gift_id, $column_slice=null, $column_names=$column_names);
       echo $results['name'].' event is';   
       echo $results['event'].'<br />';
       echo gettype($results['event']);
       $event_detail = $events->get($results['event']);
        Print_r($event_detail);
       /*
       $event_id = $results['event'];    
       $event_uiid = UUID::import($event_id);

       
       $column_name = array('date', 'user_name');
       $event_detail = $events->get($event_uuid, $column_slice=null, $column_name=$column_name);
       echo $event_detail['date'].'  '.$event_detail['user_name'];*/
       echo $valuesss.'<br />';
    }
/***************************/   
    

?>
