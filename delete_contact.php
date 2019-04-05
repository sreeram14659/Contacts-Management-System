<!DOCTYPE html>
<html>
<head>
	<title>DEleting a contact entirely.</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--If you want online version and not offline-->
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
	<style type="text/css">
		body
		{
		  font-family: ubuntu;
		  color: #2c3e50;
		}
		.cust-card
		{
			border: 1px solid black;
			padding: 10px;
			border-radius: 10px;
		}
		.row
		{
			grid-row-gap: 10%;
		}
		.cust-hr
		{
			margin-top: 100px;
			color: black;
			border-top: 1px solid black;
		}
		.cust-btn
		{
			background-color: #2c3e50;
		}
		.word-break {
 			 word-break: break-all;
		}
	</style>
</head>
<body>
	<?php
		session_start();
		$dbb= mysqli_connect('localhost','Sreeram','Sreeram','student_tracker');
		//This module enables the user to Connect to the Database
		if($dbb!=null)
		{
			//Verifying if the contact id is accessible.
			$id_retrieved_for_delete = $_GET['Contact_id'];
			$flag=0;
			$query_to_delete_contact_date="DELETE FROM date WHERE Contact_id='$id_retrieved_for_delete'";
			$res4 = mysqli_query($dbb,$query_to_delete_contact_date);

			$query_to_delete_contact_phone="DELETE FROM phone WHERE Contact_id='$id_retrieved_for_delete'";
			$res3 = mysqli_query($dbb,$query_to_delete_contact_phone);
				
			$query_to_delete_contact_adddress="DELETE FROM address WHERE Contact_id='$id_retrieved_for_delete'";
			$res2 = mysqli_query($dbb,$query_to_delete_contact_adddress);
				
			$query_to_delete_contact="DELETE FROM contact WHERE Contact_id='$id_retrieved_for_delete'";
			$res1 = mysqli_query($dbb,$query_to_delete_contact);
			if($res1)
				$flag=1;
			
			if($flag==1)
			{
				echo "Successfully deleted the contact";
			}
			else{
				echo "Something went wrong in the process.";
			}	
			header('location: search_contacts.php');	
		}	//echo "Id retrieved is : ",$id_retrieved_for_delete;
	?>
		<!-- <form method="POST" action="delete_contact.php">
			<div class="col-lg-3 col-sm-6 col-xs-12 btn">
					<div class="cust-card">
						<p class="word-break">This action will delete this contact and all of its occurances from the Database forever. Do you want to continue?</p>
						<hr class="cust-hr">
						<input type="submit" name="delete_for_sure" class="btn btn-primary btn-lg cust-btn" value="Confrim Delete the Contact">	
					</div>
					<div class="cust-card">
						<p>Nope, I changed my mind.</p>
						<hr class="cust-hr">
						<input type="submit" name="avoid_for_sure" class="btn btn-primary btn-lg cust-btn" value="Go back to search">	
					</div>
			</div>
		 </form>
		if(isset($_POST['avoid_for_sure']))
			{
				header('location: search_contacts.php');
			}

			if(isset($_POST['delete_for_sure']))
			{
				$flag=0;
				$query_to_delete_contact_date="DELETE FROM date WHERE Contact_id='$id_retrieved_for_delete'";
				$res4 = mysqli_query($dbb,$query_to_delete_contact_date);

				$query_to_delete_contact_phone="DELETE FROM phone WHERE Contact_id='$id_retrieved_for_delete'";
				$res3 = mysqli_query($dbb,$query_to_delete_contact_phone);
				
				$query_to_delete_contact_adddress="DELETE FROM address WHERE Contact_id='$id_retrieved_for_delete'";
				$res2 = mysqli_query($dbb,$query_to_delete_contact_adddress);
				
				$query_to_delete_contact="DELETE FROM contact WHERE Contact_id='$id_retrieved_for_delete'";
				$res1 = mysqli_query($dbb,$query_to_delete_contact);
				if($res1)
					$flag=1;
				
				if($flag==1)
				{
					echo "Successfully deleted the contact";
				}	
			}

			
		}
	?> -->
</body>
</html>