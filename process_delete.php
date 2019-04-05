<!DOCTYPE html>
<html>
<head>
	<title>AJAX CALL TO THIS PAGE.</title>
</head>
<body>
	<?php 
		$dbb= mysqli_connect('localhost','Sreeram','Sreeram','student_tracker');
		if(isset($_POST['Address_id']))
		{
			$retrieved_from_ajax = $_POST['Address_id'];
			echo "Came to Delete Address";
			echo($retrieved_from_ajax);
			$Query_to_delete_entry="DELETE FROM address WHERE Address_id=$retrieved_from_ajax";
			$processed_results = mysqli_query($dbb,$Query_to_delete_entry);
			if($processed_results)
			{
				echo "Success";
			}
			else
			{
				echo "Try again";
			}	
		}

		if(isset($_POST['Phone_id']))
		{
			$retrieved_from_ajax = $_POST['Phone_id'];
			echo "Came to Delete Phone";
			echo($retrieved_from_ajax);
			$Query_to_delete_entry="DELETE FROM phone WHERE Phone_id=$retrieved_from_ajax";
			$processed_results = mysqli_query($dbb,$Query_to_delete_entry);
			if($processed_results)
			{
				echo "Success";
			}
			else
			{
				echo "Try again";
			}
		}

		if(isset($_POST['Date_id']))
		{
			$retrieved_from_ajax = $_POST['Date_id'];
			echo "Came to Delete Date";
			echo($retrieved_from_ajax);
			$Query_to_delete_entry="DELETE FROM date WHERE Date_id=$retrieved_from_ajax";
			$processed_results = mysqli_query($dbb,$Query_to_delete_entry);
			if($processed_results)
			{
				echo "Success";
			}
			else
			{
				echo "Try again";
			}
		}
		echo "waas here";
		if(isset($_POST['entire_address_dataentry']))
		{
			$retrieved_from_ajax = $_POST['entire_address_dataentry'];
			$Address_table = json_decode($retrieved_from_ajax,true);
			$Address_id_to_mark = $Address_table["Address_id_ret"];
			$new_address_type = $Address_table["Address_type_modified"];
			$new_address = $Address_table["Address_modified"];
			$new_city = $Address_table["City_modified"];
			$new_state = $Address_table["State_modified"];
			$new_zip = $Address_table["Zip_modified"];
			$Query_to_update_aentry="UPDATE address SET Address_type='$new_address_type',Address='$new_address',City='$new_city',State='$new_state',Zip='$new_zip' WHERE Address_id=$Address_id_to_mark";
			$processed_results = mysqli_query($dbb,$Query_to_update_aentry);
			if($processed_results)
			{
				echo "Success";
			}
			else
			{
				echo "Try again";
			}	
		}

		if(isset($_POST['entire_phone_dataentry']))
		{
			$retrieved_from_ajax = $_POST['entire_phone_dataentry'];
			$Phone_table = json_decode($retrieved_from_ajax,true);
			print_r($Phone_table);
			$Phone_id_to_mark = $Phone_table["Phone_id_ret"];
			$new_phone_type = $Phone_table["Phone_type_modified"]; 
			$new_areacode = $Phone_table["Areacode_modified"];
			$new_number = $Phone_table["Number_modified"];
			$Query_to_update_pentry="UPDATE phone SET Phone_type='$new_phone_type',Area_code='$new_areacode',Number='$new_number' WHERE Phone_id=$Phone_id_to_mark";
			$processed_results = mysqli_query($dbb,$Query_to_update_pentry);
			if($processed_results)
			{
				echo "Success";
			}
			else
			{
				echo "Try again";
			}
		}

		if(isset($_POST['entire_date_dataentry']))
		{
			$retrieved_from_ajax = $_POST['entire_date_dataentry'];
			$Date_table = json_decode($retrieved_from_ajax,true);
			print_r($Date_table);
			$Date_id_to_mark = $Date_table["Date_id_ret"];
			$new_date_type = $Date_table["Date_type_modified"];
			$new_date = $Date_table["Date_modified"];
			echo "please work";
			$Query_to_update_entry="UPDATE date SET Date_type='$new_date_type',Date='$new_date'  WHERE Date_id=$Date_id_to_mark[$i]";
			$processed_results = mysqli_query($dbb,$Query_to_update_entry);
			if($processed_results)
			{
				echo "Success";
			}
			else
			{
				echo "Try again";
			}
		}	
	?>
</body>
</html>
