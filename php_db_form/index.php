<?php
	$servername = "localhost";
	$username = "emily";
	$password = "Mc1Cartney";
	$db = "test_php";

	//creating connection

	$conn = mysqli_connect($servername, $username, $password, $db);

	//checking connection

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

?>

<html>
	<header>
	    <meta charset="utf-8">
	    <meta http-equiv="x-ua-compatible" content="ie=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>PHP Form and Database</title>
	    <link rel="stylesheet" href="css/foundation.css">
	    <link rel="stylesheet" href="css/app.css">
	</header>
	<body>
		<div class="grid-container">
	<?php

	$sql = "SELECT * FROM MyGuests";
	$run = mysqli_query($conn, $sql);

	echo "
		<table>
		  <thead>
		    <tr>
		      <th width='150'>ID</th>
		      <th width='150'>Last Name</th>
		      <th width='150'>First Name</th>
		      <th width='150'>Email</th>
		      <th width='150'>Edit / Delete<th>
		    </tr>
		  </thead>
		  <tbody>
		";
		while($rows = mysqli_fetch_assoc($run) ) {
		  echo "
		    <tr>
		      <td>$rows[id]</td>
		      <td>$rows[lastname]</td>
		      <td>$rows[firstname]</td>
		      <td>$rows[email]</td>
		      <td><button type='button' class='success button' data-open='editModal'>Edit</button>
		      <a href='index.php?del_id=$rows[id]' class='alert button' name='del_id' onclick='return checkDelete()'>Delete</a></td>
		    </tr>";
		}

		echo "
		  </tbody>
		</table>
	";
		
	?>

	</div>
		<div class="grid-container">
			<form method="POST">
			  	<h2>Add new profile to database</h2>
			  	<div class ="grid-x grid-padding-x">
				    <div class="medium-6 cell">
				      <label>First Name
				        <input type="text" placeholder="First Name" name="firstname">
				      </label>
				    </div>
				    <div class="medium-6 cell">
				      <label>Surname
				        <input type="text" placeholder="Surname" name="lastname">
				      </label>
				    </div>
			    </div>
			    <div class="grid-x grid-padding-x">
				    <div class="medium-12 cell">
				      <label>Email
				        <input type="email" placeholder="Email Address" name="email">
				      </label>
				    </div>
			    </div>
			    <div class="grid-x grid-padding-x">
				    <div class="medium-12 cell">
				    	<input type="submit" name="submit_user" class="button  expanded">
				    </div>
			    </div>
			</form>
		</div>

		<?php
			if ( isset($_POST['edit_id']) ){
				$sql = "SELECT * FROM users WHERE id = '$_GET[edit_id]'";
				$run = mysqli_query($conn, $sql);
				while( $rows = mysqli_fetch_assoc($run) ) {
					$edit_id = $_POST['id'];
					$userfirst = $rows['firstname'];
					$usersecond = $rows['secondname'];
					$email = $rows['email'];	
				}
			}
		?>

		<div class="reveal" id="editModal" data-reveal>
			<form method='POST'>
			  	<h2 id='modalTitle'>Edit Profile</h2>
			  	<div class='grid-x grid-padding-x'>
				    <div class='medium-6 cell'>
				      <label>First Name
				        <input type='text' name='e_firstname' value='<?php echo "$userfirst"; ?>'>
				      </label>
				    </div>
				    <div class='medium-6 cell'>
				      <label>Surname
				        <input type='text' name='e_lastname' value="<?php echo $usersecond; ?>">
				      </label>
				    </div>
			    </div>
			  <div class="grid-x grid-padding-x">
			    <div class='medium-12 cell'>
			      <label>Email
			        <input type='email' name='e_email' value="<?php echo $email; ?>">
			      </label>
			    </div>
			  </div>
			  <div class='grid-x grid-padding-x'>
			    <div class='medium-12 cell'>
			    	<input type='hidden' name='edit_user_id' value='<?php echo $_GET['edit_id']?>'>
			    	<input type='submit' name='edit_user' class='button expanded'>
			    </div>
			   </div>
			    <button class="close-button" data-close aria-label="Close modal" type="button">
			    	<span aria-hidden="true">&times;</span>
			    </button>
			</form>
		</div>
	</body>

	<script language="JavaScript" type="text/javascript">
	function checkDelete(){
	    return confirm('Are you sure? This will permanently delete the record from the database.');
	}
	</script>
	<script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</html>

	<?php
		if( isset($_POST['submit_user']) ){

			$firstname = mysqli_real_escape_string($conn,strip_tags($_POST['firstname']));
			$lastname = mysqli_real_escape_string($conn,strip_tags($_POST['lastname']));
			$email = mysqli_real_escape_string($conn,strip_tags($_POST['email']));


			$ins_sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES ('$firstname', '$lastname', '$email')";
			if(mysqli_query($conn, $ins_sql));

			echo "<meta http-equiv='refresh' content='0'>";
		}

		if( isset($_GET['del_id']) ){
			$del_sql = "DELETE FROM MyGuests WHERE id = '$_GET[del_id]'";

			if(mysqli_query($conn, $del_sql));

			}
	?>

	<?php
		if( isset($_POST['edit_user']) ){

			$edit_user = mysqli_real_escape_string($conn, strip_tags($_POST['edit_user']));
			$e_firstname = mysqli_real_escape_string($conn,strip_tags($_POST['e_firstname']));
			$e_lastname = mysqli_real_escape_string($conn,strip_tags($_POST['e_lastname']));
			$e_email = mysqli_real_escape_string($conn,strip_tags($_POST['e_email']));
			$edit_id = $_POST['edit_user_id'];
			$edit_sql = "UPDATE users SET firstname = '$e_firstname', lastname = '$e_lastname', email = '$e_email' WHERE id = '$edit_id' ";
			if(mysqli_query($conn, $edit_sql));

			echo "<meta http-equiv='refresh' content='0'>";
		}
	?>
