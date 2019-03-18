<!--LOGINFORM -->
<div class="reveal" id="login-form" data-reveal>
  <p class="headtext">Login</p>
	<form action="login.php" method="post">
		<p class="left">Username:</p>
		<input class="left" type="text" name="username" value=""><br>
		<p class="left">Password:</p>
		<input class="left" type="password" name="password" value=""><br>
		<input class="left" type="submit" value="Submit">
		<input class="left" type="checkbox" id="remember_me" name="_remember_me" checked />
		<label class="left" for="remember_me"><a>Remember me.</a><br></label>
	</form>
  <button class="close-button" data-close aria-label="Close modal" type="button">
	<span aria-hidden="true">&times;</span>
  </button>
</div>
