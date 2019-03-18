
	<!--TOPBAR -->
	<div id="topbar">
		<div class="toggle-btn" onclick="toggleSidebar()">
			<span></span>
			<span></span>
			<span></span>
		</div>
		<div class="login-btn align-middle" >
			
			<?php
		// check if users / customer was logged in
		// if user was logged in, show "Edit Profile", "Orders" and "Logout" options
		if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && $_SESSION['access_level']>=$UserLevel){
			echo "	<span class='obj' onclick='toggleAccountPanel()' >
						
						<p>";
						if ($_SESSION['access_level']>=$ModeratorLevel){
							echo"<img class='adminico' src='img/admin.png'>";
						}
						echo $_SESSION['nickname']."</p>
						
						
							<img class='account-panel-btn' href='{$home_url}logout.php' src='img/pil.png' alt='Eng'>
						
					</span>
					
				";
			
		}else{
			
			echo"<span class='obj'><img class='userico' src='img/User_ico.png' alt='Login' data-open='login-form'></span>";
			
		 }
	?>
		</div>
		
	</div>
	<div id="account-panel" class="login-btn">

		<ul>
			<li>Profile</li>
			<li>Settings</li>
			<?php echo"
			<a href='{$home_url}/logout.php'>
				<li>logout</li>
			</a>";
			?>
		</ul>
	</div>
	
	