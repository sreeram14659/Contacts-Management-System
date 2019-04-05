<?php
	session_start();
	$err=array();
	$dbb= mysqli_connect('localhost','Sreeram','Sreeram','student_tracker');
	$flagg=1;
	//This module enables the user to Connect to the Database
	if($dbb!=null)
	{
		if(isset($_POST['submit']))
		{
			print_r($_POST);
			echo "Something";
			$address_iterations=max(count($_POST['address_type']),count($_POST['address']),count($_POST['state']),count($_POST['zip']));
			$phone_iterations=max(count($_POST['phone_type']),count($_POST['area_code']),count($_POST['number']));
			$date_iterations=max(count($_POST['date_type']),count($_POST['actual_date']));
			echo($address_iterations);
			echo($phone_iterations);
			echo($date_iterations);
			echo "From here";
			$FirstName = $_POST['First'];
			$MiddleName = $_POST['middle'];
			$LastName=$_POST['Last'];
			echo $LastName;
			
			if(empty($FirstName) || empty($LastName))
			{
				echo "Entered";
				header('location: add_contact.html');
			}
			else
			{
				$Contacts_que= "INSERT INTO contact (Fname, Mname, Lname) VALUES ('$FirstName' ,'$MiddleName', '$LastName')";
				mysqli_query($dbb,$Contacts_que);
				$retrieve_id="SELECT Contact_id FROM contact WHERE Fname='$FirstName' AND Lname='$LastName'";
				$result=mysqli_query($dbb,$retrieve_id);
				if($result)
				{
					$cd=mysqli_fetch_array($result);
					$id_c=$cd['Contact_id'];	
				}
					
				//Adding Addresses now...
				for ($i=0; $i < $address_iterations; $i++) 
				{
					 
					$address_type = $_POST['address_type'][$i];
					$address = $_POST['address'][$i];
					echo $address;
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

				//Adding phone fields now...
				for ($j=0; $j < $phone_iterations; $j++) 
				{ 
					$phone_type = $_POST['phone_type'][$j];
					$area_code = $_POST['area_code'][$j];
					$number = $_POST['number'][$j];
					if($phone_type || $area_code || $number)
					{
						$Phone_que= "INSERT INTO phone (Contact_id,Phone_type, Area_code, Number) VALUES ('$id_c','$phone_type' ,'$area_code','$number')";
						mysqli_query($dbb,$Phone_que);	
					}	
				}

				//Adding Date fields now...
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
			}
		}
		header('location:index.php');
	}

?>