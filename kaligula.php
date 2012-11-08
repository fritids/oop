<?php

$var1="kali,gula";

print($var1);

$var1 = str_replace(",", ".", $var1);
echo'<br>';
print($var1);






















/*

print factorial(5oo);

function factorial($number) {

    $result = 1;

    while ($number > 0) {

        print "result = $result, number = $number\n";
		print "<br>";
        $result *= $number;

        $number--;

        }

    return $result;

}


$start=microtime(true);
$counter=0; 
for((int)$a=0;$a<10;$a++){
	
	for((int)$b=0;$b<10;$b++){
	
	
		for($c=0;$c<10;$c++){
			if(($a<>$b) && ($a<>$c) && ($b<>$c)){
				echo $a.' '.$b.' '.$c;
				echo"<BR>";
				(int)$counter++;
			}
		}
	}
}
echo "COUNTER IS: ". $counter;
echo"<BR>";
$end=microtime(true);
echo round(($end-$start)*1000,3);
//0.01495099067688
//0.0022828578948975
//0.0015699863433838

*/
?>

