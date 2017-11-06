<?php
	require 'index.php';
<html>
	<header>
		<title>PHP Edit</title>
		<link rel='stylesheet' href='https://cdn.jsdelivr.net/foundation/6.2.4/foundation.min.css'>
	</header>
	<body>
	<div class="reveal" id="exampleModal1" data-reveal>
		<form method='POST'>
		  <div class='row'>
		  	<h2 id='modalTitle'>Edit Profile</h2>
		    <div class='medium-6 columns'>
		      <label>First Name
		        <input type='text' placeholder='First Name' name='firstname'>
		      </label>
		    </div>
		    <div class='medium-6 columns'>
		      <label>Surname
		        <input type='text' placeholder='Surname' name='lastname'>
		      </label>
		    </div>
		    <div class='medium-12 columns'>
		      <label>Email
		        <input type='email' placeholder='Email Address' name='email'>
		      </label>
		    </div>
		    <div class='medium-12 columns'>
		    	<input type='submit' name='submit_user' class=
		    	'btn btn-danger'>
		    </div>
		    <button class="close-button" data-close aria-label="Close modal" type="button">
		  </div>
		</form>
	</div>
	</body>

?>

	<script src="https://cdn.jsdelivr.net/foundation/6.2.4/foundation.min.js"></script>
</html>