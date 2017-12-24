<?php
	session_start();
	if(isset($_SESSION['username'])){
		header("Location: home.php");
	}
	include("head/header.php");
?>
		<center id="body">
				<form method="post" class="form" id="log_in">
					<h2 class="selected">Log In</h2><h2> | </h2><h2 class="un_selected" onclick="si()">Sign Up</h2><br>
					<input type="email" placeholder="Email" class="txt" id="email_log" required="required"><br>
					<input type="password" placeholder="Password" class="txt" id="pass_log" required="required"><br>
					<b id="error"></b><br>
					<input type="submit" value="Submit" class="submit">
				</form>
				<form method="post" class="form" id="sign_up">
					<h2 class="un_selected" onclick="li()">Log In</h2><h2> | </h2><h2 class="selected">Sign Up</h2><br>
					<input type="text" placeholder="Username*" class="txt" required="required" id="username"><br>
					<input type="email" placeholder="Email*" class="txt" required="required" id="email_sign"><br>
					<input type="password" placeholder="Password*" class="txt" required="required" id="pass_sign"><br>
					<b id="make"></b><br>
					<input type="submit" value="Submit" class="submit">
				</form>
		</center>
		<footer></footer>
	</body>
</html>