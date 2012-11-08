<input type="button" value="Reload Page" onClick="document.location.reload(true)">
HI Menno,after each attempt click here ,to reload .
<br>
Currently 5 categories only (wanted to stick to the table).
<br>
After we discuss the question I asked you earlier on the phone.

<form action="strange.php" method="post">
	STF: <input type="text" name="stf" /> input stf
	<br>
	HCP: <input type="text" name="hcp" /> between 0 and 35.9 for now
	<br>
	Holes: <input type="text" name="holes" value="9"> choose 9 or 18.don't type anything else
	
<input type="submit" />
</form>

<?php
	if(isset($_POST["stf"])){
		echo 'stf'.$_POST["stf"]; 
		echo'<br>';
		echo 'hcp'.$_POST["hcp"]; 
		echo'<br>';
		echo 'holes'.$_POST["holes"]; 
		echo'<br>';
		
		$var=calculate_final_handicap($_POST["stf"],$_POST["hcp"],$_POST["holes"]);
		print '<br> </br>the final result is: '.$var;
	}

//stf ,current_hcp,number of holes


	//$var=calculate_final_handicap(31,19.4,9);
	 

	function calculate_final_handicap($stf,$current_hcp,$number_of_holes) { 

	//takes the data,depending on the current hcp
	$data=get_details_from_hcp($current_hcp);

	//checks if it is 9 or 18 holes and depending on that,takes the
	//appropriate value from the $data array
	if($number_of_holes == 18)
		$lower_buffer_boundary=$data['hcp_buffer_18_lower'];
	else
		$lower_buffer_boundary=$data['hcp_buffer_9_lower'];
	
	//print_r($current_hcp);
	echo'<br>';
	echo 'ITERATION (for debugging purposes, you are interested in the final result,go below) <br> current STF is:'.$stf.'<br>';
	echo 'lower boundary is:'.$lower_buffer_boundary.'<br>';
	echo 'current_hcp is:'.$current_hcp;
	echo'<br>';
	//print_r($data);
	
		
	//compare stf with 36 .stf is points,the more you have the better
	//if stf is bigger, it will decrease current
	if($stf>$data['hcp_buffer_9_18_upper']){
		//decrease handicap .good
		//should DECREASE stf points by one
		$current_hcp=$current_hcp-$data['hcp_decrease_rate'];
		return calculate_final_handicap($stf-1,$current_hcp,$number_of_holes);
	}
	//the lower buffer boundary is defined earlier
	elseif($stf<$lower_buffer_boundary){
		//increase handicap.bad
		//should INCREASE stf points by one
		$current_hcp=$current_hcp+$data['hcp_increase_rate'];
		return calculate_final_handicap($stf+1,$current_hcp,$number_of_holes);		
	}
	//to change 
	elseif(($stf>=$lower_buffer_boundary) || ($stf<=$data['hcp_buffer_9_18_upper'])){
		return $current_hcp;
	}
	
	
}


//keep in mind hcp decrease is actually good
function get_details_from_hcp($hcp){
	$array=array();
	if($hcp >= 0 && $hcp <= 4.4){
		$array['category']=1;
		$array['hcp_decrease_rate']=0.1;
		$array['hcp_buffer_18_lower']=35;
		$array['hcp_buffer_9_lower']=35;//to be changed later
		$array['hcp_buffer_9_18_upper']=36;
		$array['hcp_increase_rate']=0.1;
	}
	if($hcp >= 4.5 && $hcp <= 11.4){
		$array['category']=2;
		$array['hcp_decrease_rate']=0.2;
		$array['hcp_buffer_18_lower']=34;
		$array['hcp_buffer_9_lower']=34;//to be changed later
		$array['hcp_buffer_9_18_upper']=36;
		$array['hcp_increase_rate']=0.1;
	}
	if($hcp >= 11.5 && $hcp <= 18.4){
		$array['category']=3;
		$array['hcp_decrease_rate']=0.3;
		$array['hcp_buffer_18_lower']=33;
		$array['hcp_buffer_9_lower']=35;
		$array['hcp_buffer_9_18_upper']=36;
		$array['hcp_increase_rate']=0.1;
	}
	if($hcp >= 18.5 && $hcp <= 26.4){
		$array['category']=4;
		$array['hcp_decrease_rate']=0.4;
		$array['hcp_buffer_18_lower']=32;
		$array['hcp_buffer_9_lower']=34;
		$array['hcp_buffer_9_18_upper']=36;
		$array['hcp_increase_rate']=0.1;
	}
	if($hcp >= 26.5 && $hcp <= 36.0){
		$array['category']=5;
		$array['hcp_decrease_rate']=0.5;
		$array['hcp_buffer_18_lower']=31;
		$array['hcp_buffer_9_lower']=33;
		$array['hcp_buffer_9_18_upper']=36;
		$array['hcp_increase_rate']=0.2;
	}
	return $array;
}

?>


