<?php

<?php
$str = 'abcdefghijklmnopqrstuvwx';
$j = 0;
$time = microtime(true);
function reverse($str='') {  
	$len = strlen($str);  
	$mid = floor($len/2);	
	for ($i=0; $i<$mid; $i++) {  
		$temp = $str[$i];  
		$str[$i] = $str[$len-$i-1];  
		$str[$len-$i-1] = $temp;  
	}  
	return $str;  
} 

function reverse01($str='') {  
$result = '';
$len =  strlen($str);
for ($i=1; $i<=$len; $i++) {  
$result .= substr($str, -$i, 1);  
}  
return $result;  
}  
function reverse02($str='') {  
static $result = '';  
/* 用堆栈来理解递归调用 */  
if (strlen($str) > 0) {  
reverse(substr($str, 1));  
$result .= substr($str, 0, 1);//此句必须放在上一语句之后  
}  
return $result;  
}  

$a = 'abc';
while($j < 1000000){
   reverse02($a);
   $j++;
}
echo reverse($a),"<br/>";
echo microtime(true) - $time;
echo "<br/>";