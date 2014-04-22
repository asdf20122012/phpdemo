slice :

<?php 
$input = array("a", "b", "c", "d", "e");
$output = array_slice($input, 0,2);      // returns "a", "b"
$output= array_merge($output,array_slice($input, 2+1));  // returns "d","e"
var_dump($output );
?>
