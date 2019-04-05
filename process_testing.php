<!DOCTYPE html>
<html>
<head>
	<title>Testing purposes only</title>
</head>
<body>
	<?php

		session_start();
		$dbb= mysqli_connect('localhost','Sreeram','Sreeram','student_tracker');
		if($dbb)
		{
			if(isset($_POST['address_submit']))
			{
				$address_iterations=max(count($_POST['address_type']),count($_POST['address']),count($_POST['state']),count($_POST['zip']));

				//echo($address_iterations);
				$id_c = $_POST['value_id'];
				//echo "VALUE RECEEIVED IS ",$id_c;
			
				// echo "came here";
				// echo "checking for values";
				// $addtype=$_POST['address'];
				//print_r($_POST);
				for ($i=0; $i < $address_iterations; $i++) 
				{
						 
					$address_type = $_POST['address_type'][$i];
					$address = $_POST['address'][$i];
					//echo $address;
					$city=$_POST['city'][$i];
					$state = $_POST['state'][$i];
					$zip = $_POST['zip'][$i];
					echo $address_type;
					if($address_type|| $address|| $state|| $zip)
					{
						echo $address;
						$Addresses_que= "INSERT INTO address (Contact_id,Address_type, Address, City,State,Zip) VALUES ('$id_c','$address_type' ,'$address','$city','$state','$zip')";
						mysqli_query($dbb,$Addresses_que);	
					}	
				}
				header("Location: {$_SERVER['HTTP_REFERER']}");
					
					//Adding Date fields now...
					
				// echo $addtype[0],"   ";
				// echo $addtype[1];
			}
			if(isset($_POST['phone_submit']))
			{
				$phone_iterations=max(count($_POST['phone_type']),count($_POST['area_code']),count($_POST['number']));
				//echo($phone_iterations);
				$id_c = $_POST['value_id'];
				echo "VALUE RECEEIVED IS ",$id_c;
			
				//$addtype=$_POST['address'];
				print_r($_POST);
				//Adding phone fields now...
				for ($j=0; $j < $phone_iterations; $j++) 
				{ 
					$phone_type = $_POST['phone_type'][$j];
					echo $phone_type;
					$area_code = $_POST['area_code'][$j];
					echo $area_code;
					$number = $_POST['number'][$j];
					echo $number;
					if($phone_type || $area_code || $number)
					{
						$Phone_que= "INSERT INTO phone (Contact_id,Phone_type, Area_code, Number) VALUES ('$id_c','$phone_type' ,'$area_code','$number')";
						mysqli_query($dbb,$Phone_que);	
					}	
				}
				header("Location: {$_SERVER['HTTP_REFERER']}");
				//echo "javascript:history.go(-1)
				//header("Location: {$_SERVER['HTTP_REFERER']}");
				// echo $addtype[0],"   ";
				// echo $addtype[1];
			}
			if(isset($_POST['date_submit']))
			{
				$date_iterations=max(count($_POST['date_type']),count($_POST['actual_date']));
				// echo($date_iterations);
				$id_c = $_POST['value_id'];
				// echo "VALUE RECEEIVED IS ",$id_c;
			
				// print_r($_POST);
				for ($k=0; $k < $date_iterations; $k++) 
				{
					$date_type = $_POST['date_type'][$k];
					$actual_date = $_POST['actual_date'][$k];	
					if($date_type || $actual_date)
					{
						$date_que= "INSERT INTO date (Contact_id,Date_type, Date) VALUES ('$id_c','$date_type' ,'$actual_date')";
						mysqli_query($dbb,$date_que);	
					}	
				}
				header("Location: {$_SERVER['HTTP_REFERER']}");
				
			}	
		}	
		
	?>		
</body>
</html>