<!DOCTYPE html>
<html>
<head>
	<title>Welcome to the search engine</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--If you want online version and not offline-->
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="sreeram.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
</head>
<body>
	<!-- This page is to enable the admin to search for a contact in the database using any of the attribute pertaining to the contact.-->
	<h1>Enter the Contact's Details: </h1>
	<nav class="navbar navbar-default">
			
		<div class="container">
			<div class="navbar-header">
				<a href="#" class="navbar-brand">Search for a Contact</a> <!--Navbar header-->
			</div>
		</div>
	</nav>

	<div class="container">
		<div>
			<form method="POST" action="search_contacts.php">
				<div class="form-group">
			    	<input type="text" id="search_contacts" class="form-control" placeholder="Search for a Contact" name="Lookup">
				</div>
				<div class="cust-class-1">
					<button class="btn-group btn-lg btn btn-success" name="start_searching" id="initiate_search" style="text-align: center;"><i class="fas fa-search"></i> Search</button>
				</div>
			</form>
			<div>

				<?php
					session_start();
					$err=array();
					$dbb= mysqli_connect('localhost','Sreeram','Sreeram','student_tracker');
					$flagg=1;
					//This module enables the user to Connect to the Database
					if($dbb!=null)
					{
						if(isset($_POST['start_searching']))
						{
							echo "<table class='table'><th>First Name</th> <th> Middle Name</th> <th> Last Name</th>";
								
							$Entered_string = $_POST['Lookup'];
							if(empty($Entered_string))
							{
								echo "Please Enter a string to search";
							}
							else
							{
								$s = explode(" ", $Entered_string);//This is an Array
								$size_is = count($s);
								for ($i=0; $i < $size_is; $i++) 
								{ 
									$query = "Select distinct c.Contact_id,c.Fname,c.Mname,c.Lname from contact c
									left outer join address a on c.Contact_id = a.Contact_id
									left outer join phone p on c.Contact_id = p.Contact_id
									left outer join date d on c.Contact_id = d.Contact_id
									where
									Fname like '%$s[$i]%' or
									Mname like '%$s[$i]%' or
									Lname like '%$s[$i]%' or
									Address_type like '%$s[$i]%' or
									Address like '%$s[$i]%' or
									City like '%$s[$i]%' or
									State like '%$s[$i]%' or
									Zip like '%$s[$i]%' or
									Number like '%$s[$i]%' or
									Phone_type like '%$s[$i]%' or
									Area_code like '%$s[$i]%' or
									Date like '%$s[$i]%' or
									Date_type like '%$s[$i]%'"; 
										
									$result = mysqli_query($dbb,$query);
									$number_of_rows=mysqli_num_rows($result);
									//echo $number_of_rows;
									for ($k=0; $k < $number_of_rows ; $k++) 
									{ 
										$process_this = mysqli_fetch_array($result);
										$id_to_verify = $process_this['Contact_id'];
										$FirstName = $process_this['Fname'];
										$MiddleName = Empty($process_this['Mname'])?" ":$process_this['Mname'];
										$LastName = $process_this['Lname'];
										if(empty($FirstName) && empty(($MiddleName)) && empty($LastName))			
										{
											//We dont have to print if there is no information that has been retrieved from the database.
										}
										else
										{
											echo "<tr><td>",$FirstName,"</td> <td> ",$MiddleName,"</td> <td>",$LastName,"</td>";
											echo '<td><a href="modify_contact.php?Contact_id=',$id_to_verify,'">Modify</a></td>';
											echo '<td><a href="modify_contact.php?Contact_id=',$id_to_verify,'">Delete an Entry</a></td>';
											echo '<td><a href="delete_contact.php?Contact_id=',$id_to_verify,'">Delete a Contact</a></td>';
											//echo "<td><a href='modify_contact.php?Contact_id='",$id_to_verify,"''>Modify</a>";
											echo "</tr>";	
										}	
									}
								}
								echo ("</table>");
							}
						}
					}	
				?>
			</div>
		</div>

	</div>

	<!--<div class="row" id="Full_page">
    	<div class="col-xs-4 border border-primary" id="Side_page_content">
    		<form method="POST" action="search_contacts.php" style="padding: 20px;">
				<input type="text" id="search_contacts" placeholder="Search for a Contact" name="Lookup">
				<input type="submit" name="start_searching" value="Submit" id="initiate_search">
			</form>
			<div id="display_results">
				<li></li>
			</div>
    	</div>
    	<div class="col-xs-6" id="Details_of_contacts_display">
    		<h1>The rest of the page.</h1>
    	</div>	

	</div>-->
</body>

</html>