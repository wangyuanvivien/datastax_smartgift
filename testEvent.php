
<?
/****test 2nd index****/
require_once('db.php');

use phpcassa\SystemManager;
use phpcassa\Index\IndexExpression;
use phpcassa\Index\IndexClause;

$index_exp = new IndexExpression('user_email', 'katie@gmail.com');
$index_clause = new IndexClause(array($index_exp));
$rows = $events->get_indexed_slices($index_clause);

foreach($rows as $key => $columns) {
    // Do stuff with $key and $columns
    Print_r($columns);
    Print_r($key);
}




?>
