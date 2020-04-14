<?php

$str = file_get_contents('5.txt');
$preg='/<div .*?data-code="(.*?)".*?>/is';
 preg_match_all($preg,$str,$array2); 
for($i=0;$i<count($array2[1]);$i++)

{

  echo $array2[1][$i]."<br />";
  
  $filename="feng.txt";
   //写入垃圾箱  
   $handle=fopen($filename,"a+");
  
   $str=fwrite($handle,$array2[1][$i]."\n");
   
   fclose($handle);  
}


?>