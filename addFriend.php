<?php require_once('db.php');
use phpcassa\UUID;
use phpcassa\ColumnFamily;
$friend_email = $_POST['friend_email'];
$your_email = $_POST['your_email'];
/***the standard way to insert composite
$friends->insert('mitbbs@gmail.com', array(serialize(array('harvard@gmail.com'))=>'', serialize(array('princeton'))=>''));
 inserting a row with key is "123" and two columns (123, "111") => "1" and (124, "112") => "2"
$composite->insert("123", array(serialize(array(123, "111")) => "1", serialize(array(124, "112")) => "1"));
*/
?>

<form id="addFriend" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
Enter your email:<input type='text' name='your_email' />

Enter your friend email<input type='text' name='friend_email' />
<input type='submit' name='submit3' />
</form>
