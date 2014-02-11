<?php


	
function db_connect()
{
$connection=mysql_connect("localhost", "oriobird", "Jesuis14$!");

if(!$connection)
{
	return false;
	}
	if(!mysql_select_db('oriobird_hi'))
	{
		return false;
	}
	
	return $connection;
}
	
	
function update()
{
	db_connect();
	exec("python ../cgi-bin/ex1.py", $output);
	$pieces = explode(",", $output[0]);
	$old_date_timestamp = strtotime($pieces[0]);
	$pieces[0] = date('n/j/Y g:i', $old_date_timestamp);
	$query = sprintf('INSERT INTO `weather` (`Time`, `Record`, `AWS`, `AWD`, `SIG`, `Gust`, `AvgAT`, `MaxAT`, `MinAT`, `AvgRH`, `AvgBP`, `TotRN_5`, `DailyRN`, `Batt`) VALUES("%s",%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)',
	$pieces[0],$pieces[1],$pieces[2],$pieces[3],$pieces[4],$pieces[5],$pieces[6],$pieces[7],$pieces[8],$pieces[9],$pieces[10],$pieces[11],$pieces[12],$pieces[13]);
	
	//echo $query;
	$result =mysql_query($query);
}



function get_data()
{
	db_connect();
	$query = 'SELECT * FROM weather WHERE Record = ( SELECT MAX( Record ) FROM weather)';
		$result = mysql_query($query);
		
		$number_of_posts = mysql_num_rows($result);
		
		if($number_of_posts == 0)
		{
			return false;
		}
		
		$result = result_to_array($result);
	
		return $result;
}

function result_to_array($result)
	{
		$result_array = array();
		for($i = 0; $row = mysql_fetch_array($result);$i++)
		{
			$result_array[$i] = $row;
		}
		
		return $result_array;
	}
	
	
function select_data($param)
	{
	db_connect();
	$posts = get_data();
	$i = 0;
		switch ($param) {
		case "Time":
			$i = 0;
			break;
		case "Record":
			$i = 1;
			break;
		case "AWS":
			$i = 2;
			break;
		case "AWD":
			$i = 3;
			break;
		case "SIG":
			$i = 4;
			break;
		case "Gust":
			$i = 5;
			break;
		case "AvgAT":
			$i = 6;
			break;
		case "MaxAT":
			$i = 7;
			break;
		case "MinAT":
			$i = 8;
			break;
		case "AvgAH":
			$i = 9;
			break;
		case "AvgBP":
			$i = 10;
			break;
		case "TotRN_5":
			$i = 11;
			break;
		case "DailyRN":
			$i = 12;
			break;
		case "Batt":
			$i = 13;
			break;
		}

	echo $posts[0][$i] ;
}



	$param = "AWS";
	select_data($param);
	
	
?>
