<!--<!DOCTYPE html>
<html>
<head>
	<title>Welcome to the Contacts App</title>
	<link rel="stylesheet" type="text/css" href="index_style.css">
</head>
<body>
	<div id="whole_page">
		<div id="Header">
			<h1>Welcome to the Contacts App</h1>
		</div>
		<div id="Navigate_through_app">
			<h2>Operations to perform on the database</h2>
			<ul>
				<li>
					<a href="initl.php">Initialize the database</a>
				</li>
				<li>
					<a href="add_contact.html">Add a new Contact</a>
				</li>
				<li>
					<a href="modify_contact.php">Modify the existing Contact</a>
				</li>
				<li>
					<a href="search_contacts.php">Search for a Contact</a>
				</li>
			</ul>
		</div>
		<div id="Footer">
			<h3>Copyright &copy;Contacts App UTD, 2018</h3>
		</div>
	</div>
</body>
</html>-->
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to the Contacts App</title>

	<!-- <link rel="stylesheet" type="text/css" href="sreeram.css">  Use this for offline version -->

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
		.jumbotron
		{
			background-color: #2c3e50;
			color: white;
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-default">
			
		<div class="container">
			<div class="navbar-header">
				<a href="#" class="navbar-brand">Welcome to the Contacts App</a> <!--Navbar header-->
			</div>
		</div>
	</nav>

	<div class="container">
		<div>
			<h1 class="jumbotron"><i class="fas fa-users"></i> Contacts</h1>

			<div class="row">
				<div class="col-lg-3 col-sm-6 col-xs-12 btn">
					<div class="cust-card">
						
						<h2>Add</h2>
						<p>Add a new contact</p>
						<hr class="cust-hr">
						<button onclick="location.href='add_contact.html'" class="btn btn-primary btn-lg cust-btn"><i class="fas fa-plus-square"></i> Add</button>

					</div>
				</div>


				<div class="col-lg-3 col-sm-6 col-xs-12 btn">
					<div class="cust-card">

						<h2>Modify</h2>
						<p>Modify an existing contact</p>
						<hr class="cust-hr">
						<button onclick="location.href='search_contacts.php'" class="btn btn-primary btn-lg cust-btn"><i class="fas fa-edit"></i> Modify</button>

					</div>
				</div>


				<div class="col-lg-3 col-sm-6 col-xs-12 btn">
					<div class="cust-card">

						<h2>Delete</h2>
						<p>Delete a new contact</p>
						<hr class="cust-hr">
						<button onclick="location.href='search_contacts.php'" class="btn btn-primary btn-lg cust-btn"><i class="fas fa-trash"></i> Delete</button>
					</div>
				</div>


				<div class="col-lg-3 col-sm-6 col-xs-12 btn">
					<div class="cust-card">

						<h2>Search</h2>
						<p>Search for a contact</p>
						<hr class="cust-hr">
						<button onclick="location.href='search_contacts.php'" class="btn btn-primary btn-lg cust-btn"><i class="fas fa-search"></i> Search</button>

					</div>
				</div>	

			</div>
				
		</div>
	
	</div>


</body>
</html>