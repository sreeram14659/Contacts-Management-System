<!DOCTYPE html>
<html>
<head>
	<title>Modifying the existing contacts</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		$(document).ready(function()
		{
			$(".delete_address_button").click(function(){
				$(document).on("click",".delete_address_button",function(){
					$(this).parent("#actual_address_field").remove();
					$.ajax({type: 'POST',url: "process_delete.php", data: { Address_id: $(this).val() }, success: function(result)
					{
				        console.log(result);
				    }});
				});
			});
			$(".delete_phone_button").click(function(){
				$(document).on("click",".delete_phone_button",function(){
					$(this).parent("#actual_phone_field").remove();
					$.ajax({type: 'POST',url: "process_delete.php", data: { Phone_id: $(this).val() }, success: function(result)
					{
				        console.log(result);
				    }});
				});
			});
			$(".delete_date_button").click(function(){
				$(document).on("click",".delete_date_button",function(){
					$(this).parent("#actual_date_field").remove();
					$.ajax({type: 'POST',url: "process_delete.php", data: { Date_id: $(this).val() }, success: function(result)
					{
				        console.log(result);
				    }});
				});
			});


			$(".add_addresses_button").click(function()
			{
				$("#actual_addressing_field" ).clone().appendTo( "#address_empty").show();

				$(document).on("click","#address_btn_del",function(){
					$(this).parent("#actual_addressing_field").remove();
				});
			});
			$(".add_phone_button").click(function()
			{
				$("#actual_phoning_field" ).clone().appendTo( "#phone_empty").show();
				$(document).on("click","#phone_btn_adding",function(){
					console.log()
				});
				$(document).on("click","#phone_btn_del",function(){
					$(this).parent("#actual_phoning_field").remove();
				});
				
			});
			$(".add_date_button").click(function()
			{
				console.log("CLICKED");
				$("#actual_dating_field" ).clone().appendTo( "#date_empty").show();
				$(document).on("click","#date_btn_del",function(){
					$(this).parent("#actual_dating_field").remove();
				});
			});
		});
	</script>
	
</head>
<body>
<h1>Modify an existing contact</h1>
	<?php
		session_start();
		$dbb= mysqli_connect('localhost','Sreeram','Sreeram','student_tracker');
		//This module enables the user to Connect to the Database
		if($dbb!=null)
		{
			//Verifying if the contact id is accessible.
			$id_retrieved = $_GET['Contact_id'];
			// echo "Lets See";
			// echo $id_retrieved;
			//Now that we have the unique Contact_id, we can begin to populate the front end part.
			$Query_to_retrieve_contact_info = "SELECT Fname,Mname,Lname FROM contact WHERE Contact_id=$id_retrieved"; 
			$Query_to_retrieve_address_info = "SELECT Address_id,Address_type,Address,City,State,Zip FROM Address WHERE Contact_id=$id_retrieved";
			$Query_to_retrieve_phone_info = "SELECT Phone_id,Phone_type,Area_code,Number FROM phone WHERE Contact_id=$id_retrieved";
			$Query_to_retrieve_date_info = "SELECT Date_id,Date_type,Date FROM date WHERE Contact_id=$id_retrieved";
			$process_contacts=mysqli_query($dbb, $Query_to_retrieve_contact_info);
			if($process_contacts)
			{
				$cd=mysqli_fetch_array($process_contacts);
				$FirstName=$cd['Fname'];
				$MiddleName=$cd['Mname'];
				$LastName=$cd['Lname'];
			}
			//Particular Contact's address details...
			$process_address=mysqli_query($dbb, $Query_to_retrieve_address_info);
			if($process_address)
			{
				$Address_rows=mysqli_num_rows($process_address);
				$fields=mysqli_num_fields($process_address);
				// echo "ROWS = ",$rows;
				// echo "Fields = ",$fields;
				for ($i=0; $i < $Address_rows ; $i++) 
				{ 
					$ce=mysqli_fetch_array($process_address);
					$Address_id[$i]=$ce['Address_id'];
					$AddressType[$i]=$ce['Address_type'];
					$retrieved_address[$i]=$ce['Address'];
					$retrieved_city[$i]=$ce['City'];
					$retrieved_state[$i]=$ce['State'];
					$retrieved_zip[$i]=$ce['Zip'];

				}		
			}
			
			//Particular Contact's Phone details...
			$process_phone=mysqli_query($dbb, $Query_to_retrieve_phone_info);
			if($process_phone)
			{
				$Phone_rows=mysqli_num_rows($process_phone);
				$fields=mysqli_num_fields($process_phone);
				for ($i=0; $i < $Phone_rows ; $i++) 
				{ 
					$cf=mysqli_fetch_array($process_phone);
					$Phone_id[$i] = $cf['Phone_id'];
					$retrieved_phonetype[$i]=$cf['Phone_type'];
					$retrieved_areacode[$i]=$cf['Area_code'];
					$retrieved_number[$i]=$cf['Number'];
				}
			}

			//Particular Contact's Date details...
			$process_dates=mysqli_query($dbb, $Query_to_retrieve_date_info);
			if($process_dates)
			{
				$Date_rows=mysqli_num_rows($process_dates);
				$fields=mysqli_num_fields($process_dates);
				for ($i=0; $i < $Date_rows ; $i++) 
				{ 
					$cg=mysqli_fetch_array($process_dates);
					$Date_id[$i] = $cg['Date_id'];
					$retrieved_datetype[$i]=$cg['Date_type'];
					$retrieved_date[$i]=$cg['Date'];
				}
			}
			//All the queries are processed now...
			//Lets now check the output of the arrays.
			// echo "<br>The entire array now is <br>";
			// echo json_encode($AddressType);
			// echo "<br>";
			// echo json_encode($retrieved_address);
			// echo "<br>";
			// echo json_encode($retrieved_city);
			// echo "<br>";
			// echo json_encode($retrieved_state);
			// echo "<br>";
			// echo json_encode($retrieved_zip);
			// echo "<br>";
			// echo json_encode($retrieved_phonetype);
			// echo "<br>";
			// echo json_encode($retrieved_areacode);
			// echo "<br>";
			// echo json_encode($retrieved_number);
			// echo "<br>";
			// echo json_encode($retrieved_datetype);
			// echo "<br>";
			// echo json_encode($retrieved_date);
			// echo "<br>";
		}		
	?>

	<form method="POST" action="process_testing.php">
			<div id="Contacts_info" class="container">
				<strong><h3>Identity:</h3></strong>
				Full name:	
				<input type="text" name="First" class="form-control" value="<?php echo $FirstName; ?>">
				<br>
				Middle Name:
				<input type="text" name="middle" placeholder="Enter your Middle name" class="form-control" value='<?php echo $MiddleName; ?>'>
				<br>
				Last Name:	
				<input type="text" name="Last" placeholder="Enter your last name" class="form-control" value="<?php echo $LastName; ?>">
			</div>
	</form>
	<form method="POST" action="process_testing.php" name="Address_form">
		<button type="button" onclick="" class='add_addresses_button btn-group btn-lg btn btn-success' value='<?php echo $Address_id[$i]?>' name='add_addresses_entry' id='initiate_adding_address' style='text-align: center;'>Add new Address Field</button>
					
		<br>
			<?php   
				for ($i=0; $i < $Address_rows ; $i++) {
			?>
				<div id="actual_address_field" class="Address_div container">	
					<strong><br><h3>Address <?php echo($i+1)?> </h3></strong><br>
					
					<button type="button" class='delete_address_button btn-group btn-lg btn btn-success' value='<?php echo $Address_id[$i]?>' name='delete_address_entry' id='initiate_address_delete' style='text-align: center;'>Delete This Entry</button>
					<button type="button" onclick="return verify_form('<?=$i?>')" class='modify_address_button btn-group btn-lg btn btn-success' value='<?php echo $Address_id[$i]?>' name='modify_address_entry' id='initiate_address_modify' style='text-align: center;'>Modify This Entry</button>
					
					<br>		
					<input type="hidden" id="Address_id_type<?=$i?>" value='<?php echo $Address_id[$i];?>'  name="address_id_field"> 
					Address Type: <input type="text" name="address_type" class="Address_types form-control" value='<?php echo $AddressType[$i]; ?>' id="Address_Type_input<?=$i?>">
					<br>
					Address: <input type="text" name="address" class="form-control" value='<?php echo $retrieved_address[$i]; ?>' id="Address_input<?=$i?>">
					<br>
					City: <input type="text" name="city" class="form-control" id="City_input<?=$i?>" value='<?php echo $retrieved_city[$i]; ?>'>
					<br>
					State: <input type="text" name="state" class="form-control" id="State_input<?=$i?>" value='<?php echo $retrieved_state[$i];?>'>
					<br>
					Zip: <input type="text" name="zip" class="form-control" id="Zip_input<?=$i?>" value='<?php echo $retrieved_zip[$i];?>'>
					<script>
					function verify_form(id)
					{
						var Address_id_from_form = document.getElementById('Address_id_type'+id).value;
						var Address_type_from_form = document.getElementById('Address_Type_input'+id).value;
						var Address_from_form = document.getElementById('Address_input'+id).value;
						var City_from_form = document.getElementById('City_input'+id).value;
						var State_from_form = document.getElementById('State_input'+id).value;
						var Zip_from_form = document.getElementById('Zip_input'+id).value;
						var entire_form_data = { Address_id_ret: Address_id_from_form, Address_type_modified: Address_type_from_form, Address_modified: Address_from_form, City_modified: City_from_form, State_modified: State_from_form, Zip_modified: Zip_from_form };
						//console.log(entire_form_data);
						var data_in_string_form=JSON.stringify(entire_form_data);
						//console.log(data_in_string_form);
						//var dataString = 'Address_type='+Address_type_from_form+'&Address'
						$(document).on("click",".modify_address_button",function()
						{
							//var $form_data=$('form');
							console.log("Sending");
							$.ajax({type: 'POST',url: "process_delete.php", data: {'entire_address_dataentry': data_in_string_form }, success: function(result)
								{
							        console.log(result);
								}});
						});
					}
					</script>
						
					
				</div>
			<?php
				}//THis should be out of the div. Otherwise it wont print.
			?>
			
	</form>
	<form method="POST" action="process_testing.php">
		<br>
			<div id="address_empty">
			
			</div>
		<br>
	</form>
	<form method="POST" action="process_testing.php" name="Phone_form">
		<button type="button" onclick="" class='add_phone_button btn-group btn-lg btn btn-success' value='<?php echo $Phone_id[$i]?>' name='add_phone_entry' id='initiate_adding_phone' style='text-align: center;'>Add new Phone Field</button>
					
		<br>
			<?php   
				for ($i=0; $i < $Phone_rows ; $i++) {
			?>	
				<div id="actual_phone_field" class="container">
					<strong><br><h3>Phone <?php echo($i+1)?> </h3></strong><br>
					
					<button type="button" value='<?php echo $Phone_id[$i]?>' class='delete_phone_button btn-group btn-lg btn btn-success' name='delete_phone_entry' id='initiate_phone_delete' style='text-align: center;'>Delete This Entry</button>
					<button type="button" onclick="return verify_phone('<?=$i?>')" class='modify_phone_button btn-group btn-lg btn btn-success' value='<?php echo $Phone_id[$i]?>' name='modify_phone_entry' id='initiate_phone_modify' style='text-align: center;'>Modify This Entry</button>
					
					<br>
					<input type="hidden" id="Phone_id_type<?=$i?>" value='<?php echo $Phone_id[$i];?>'  name="address_id_field"> 
					Phone Type:
					<input type='text' name='phone_type[]' id="Phone_Type_input<?=$i?>" value='<?php echo $retrieved_phonetype[$i] ?>' class='form-control'>
					<br>
					Area Code:
					<br>
					<input type='text' name='area_code[]' id="areacode_input<?=$i?>" value='<?php echo $retrieved_areacode[$i] ?>' class='form-control'>
					<br>
					Number:
					<input type='text' name='number[]' id="number_input<?=$i?>" value='<?php echo $retrieved_number[$i]?>' class='form-control'>
					<br>
					<br>
					<script>
						function verify_phone(id)
						{
							var Phone_id_from_form = document.getElementById('Phone_id_type'+id).value;
							var Phone_type_from_form = document.getElementById('Phone_Type_input'+id).value;
							var Areacode_from_form = document.getElementById('areacode_input'+id).value;
							var number_from_form = document.getElementById('number_input'+id).value;
							var entire_phoneform_data = { Phone_id_ret: Phone_id_from_form, Phone_type_modified: Phone_type_from_form, Areacode_modified: Areacode_from_form, Number_modified: number_from_form };
							console.log(entire_phoneform_data);
							var data_in_string_form=JSON.stringify(entire_phoneform_data);
							$(document).on("click",".modify_phone_button",function(){
								$.ajax({type: 'POST',url: "process_delete.php", data: {'entire_phone_dataentry': data_in_string_form }, success: function(result)
								{
							        console.log(result);
							    }});
							});
						}
					</script>
				</div>
			<?php
				}//THis should be out of the div. Otherwise it wont print.
			?>
			
	</form>
	<form method="POST" action="process_testing.php">
		<br>
			<div id="phone_empty">
			
			</div>
		<br>
	</form>
	<form method="POST" action="process_testing.php" name="Date_form">
		<button type="button" onclick="" class='add_date_button btn-group btn-lg btn btn-success' value='<?php echo $Date_id[$i]?>' name='add_date_entry' id='initiate_adding_date' style='text-align: center;'>Add new Date Field</button>
		<br>			
			<?php   
				for ($i=0; $i < $Date_rows ; $i++) {
			?>
				<div id="actual_date_field" class="container">
					<strong><br><h3>Date <?php echo($i+1)?> </h3></strong><br>
					
					<button type="button" value='<?php echo $Date_id[$i]?>' class='delete_date_button btn-group btn-lg btn btn-success' name='delete_date_entry' id='initiate_date_delete' style='text-align: center;'>Delete This Entry</button>
					<button type="button" onclick="return verify_date('<?=$i?>')" class='modify_date_button btn-group btn-lg btn btn-success' value='<?php echo $Date_id[$i]?>' name='modify_date_entry' id='initiate_date_modify' style='text-align: center;'>Modify This Entry</button>
					


					<br>
					<input type="hidden" id="Date_id_type<?=$i?>" value='<?php echo $Date_id[$i];?>'  name="address_id_field"> 
					Date Type:
					<br>
					<input type='text' name='date_type[]' id="datetype_input<?=$i?>" value='<?php echo $retrieved_datetype[$i]?>' class='form-control'>
					<br>
					Date: 
					<br>
					<input type='date' name='actual_date[]' id="daterec_input<?=$i?>" value='<?php echo $retrieved_date[$i]?>' class='form-control'>
					<br>
					<br>
					<script>
						function verify_date(id)
						{
							var Date_id_from_form=document.getElementById('Date_id_type'+id).value;
							var Date_type_from_form = document.getElementById('datetype_input'+id).value;
							var Date_from_form = document.getElementById('daterec_input'+id).value;
							var entire_dateform_data = {Date_id_ret: Date_id_from_form, Date_type_modified: Date_type_from_form, Date_modified: Date_from_form};
							console.log(entire_dateform_data);
							var data_in_string_form=JSON.stringify(entire_dateform_data);
							$(document).on("click",".modify_date_button",function(){
								$.ajax({type: 'POST',url: "process_delete.php", data: {'entire_date_dataentry': data_in_string_form}, success: function(result)
								{
							        console.log(result);
							    }});
							});
						}
					</script>
				</div>
				
			<?php
				}//THis should be out of the div. Otherwise it wont print.
			?>
			
	</form>
	<form method="POST" action="process_testing.php">
		<br>
			<div id="date_empty">
				
			</div>
		<br>	
	</form>
	
	<div id="actual_addressing_field" Style="display:none" class="container">
		<input type="text" name="address_type[]" class="form-control" placeholder="Enter the Address Type">
		<br>
		<input type="text" name="address[]" class="form-control" placeholder="Enter the Address">
		<br>
		<input type="text" name="city[]" class="form-control" placeholder="Enter the City">
		<br>
		<input type="text" name="state[]" class="form-control" placeholder="Enter the State">
		<br>
		<input type="text" name="zip[]" class="form-control" placeholder="Enter the Zip">
		<br>
		<input type="hidden" name="value_id" value='<?php echo $id_retrieved?>'>
		<input class="btn btn-space btn-success" id="address_btn_adding" type="submit" name="address_submit">
		<button class="btn btn-space btn-success" id="address_btn_del" type="button">Delete Address fields</button>
		
	</div>
	<div id="actual_phoning_field" Style="display:none" class="container">
		<input type="text" name="phone_type[]" class="form-control" placeholder="Enter the Phone Type">
		<br>
		<input type="text" name="area_code[]" class="form-control" placeholder="Enter the Area code">
		<br>
		<input type="text" name="number[]" class="form-control" placeholder="Enter the Phone Number">
		<br>
		<input type="hidden" name="value_id" value='<?php echo $id_retrieved?>'>
		<input class="btn btn-space btn-success" id="phone_btn_adding" type="submit" name="phone_submit">
		<button class="btn btn-space btn-success" id="phone_btn_del" type="button">Delete phone fields</button>
		
	</div>
	<div id="actual_dating_field" Style="display:none" class="container">
		<input type="text" name="date_type[]" class="form-control" placeholder="Enter the Date Type">
		<br>
		<input type="date" name="actual_date[]" class="form-control" placeholder="Enter the Date">
		<br>
		<input type="hidden" name="value_id" value='<?php echo $id_retrieved?>'>
		<input class="btn btn-space btn-success" id="date_btn_adding" type="submit" name="date_submit">
		<button class="btn btn-space btn-success" id="date_btn_del" type="button">Delete date fields</button>
		
	</div>
		<a href="search_contacts.php">Back to Search</a>
	
</body>
</html>