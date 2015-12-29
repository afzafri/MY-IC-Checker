<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>IC Checker v2</title>
<link rel="stylesheet" type="text/css" href="table.css">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<center>
<form action="index.php" method="get" class="login">
<h1>IC Checker v2</h1>
<h3>Identify state,gender,date of birth and age of the IC's holder</h3>
<input type="text" name="ic" class="login-input" placeholder="Input IC Here (without - )" value="<?php echo (isset($_GET["ic"]) ? $_GET["ic"] : null) ?>"/>
<input type="submit" class="login-submit">


<?php

if(isset($_GET['ic']))
{
	
	$ic = (isset($_GET['ic']) ? $_GET['ic'] : null);

	//substr() function used to get only some part of a string
	$kod = substr($ic,6,2);
	$jantina = "";
	
	//to find gender
	if((substr($ic, 11, 1))%2 == 0)
	{
		$jantina = "Female";
	}
	else
	{
		$jantina = "Male";
	}
	
	//to find dob
	$yy = substr($ic,0,2);
	$mm = substr($ic,2,2);
	$dd = substr($ic,4,2);
	$year = $yy >= 00 && $yy <= 30 ? "20" . $yy : "19" . $yy;
	$dob = $dd . "-" . $mm . "-" . $year;
	
	//to find age
	$curyear = date('Y');
	$age = $curyear - $year;
	
	//state array
	//multidimensional array
	$kodnegeri = array
						(
							array("Johor","01","21","22","23","24") ,
							array("Kedah", "02","25","26","27") ,
							array("Kelantan","03","28","29") ,
							array("Melaka","04","30") ,
							array("Negeri Sembilan","05","31","59") ,
							array("Pahang","06","32","33") ,
							array("Pulau Pinang","07","34","35") ,
							array("Perak","08","36","37","38","39") ,
							array("Perlis", "09", "40"),
							array("Selangor","10","41","42","43","44") ,
							array("Terengganu","11","45","46") ,
							array("Sabah","12","47","48","49") ,
							array("Sarawak","13","50","51","52","53") ,
							array("Wilayah Persekutuan (Kuala Lumpur)","14","54","55","56","57") ,
							array("Wilayah Persekutuan (Labuan)","15","58") ,
							array("Wilayah Persekutuan (Putrajaya)","16") ,
							array("Negeri Tidak Diketahui","82") 
						);


	$size = count($kodnegeri);

	$i = 0;
	$j = 0;
	
	//looping to display all info and find state
	if(strlen($ic) == 12)
	{
		for($i=0; $i<$size; $i++)
		{
			$sizes = count($kodnegeri[$i]);
			
			for($j=0; $j<$sizes; $j++)
			{
				if($kod == $kodnegeri[$i][$j])
				{
					echo "
					<style>
					table, th, td 
					{
						border: 1px solid black;
						border-collapse: collapse;
					}
					th, td 
					{
						padding: 15px;
					}
					</style>
					
					<table class='responstable'>
					<tr>
					<th> State : </th>
					<td> " . $kodnegeri[$i][0] . " </td>
					</tr>
					<tr>
					<th> Gender : </th>
					<td> $jantina </td>
					</tr>
					<tr>
					<th> Date of Birth : </th>
					<td> $dob </td>
					</tr>
					<tr>
					<th> Age : </th>
					<td> $age </td>
					</tr>
					</table> ";
					
				}
			}
			
			
		}
	}
	else
	{
		echo "Please enter a valid IC.";
	}
	
}




?>

</form>
</center>
</body>
</html>