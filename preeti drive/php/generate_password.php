<?php
//rand() generates random no btw 1 to 10
//strlen for length
//echo rand(0,83);
//echo $pattern[3];
$pattern = "GA0A!b1|cBdN@efg2hC1H3'jkDa1P40mM%n^JVo\Q5pRE_<q=)SIK9rs6&tT*uUF ,L-(vZ/7w-Wx+8yX>zY";

$length = strlen($pattern)-1;
$password = [];
for($i=0;$i<8;$i++)
{
	$index = rand(0,$length);
	$password[] = $pattern[$index];
}

echo implode($password);
//implode for eraze gap b/w letter
//print_r($password);
?>