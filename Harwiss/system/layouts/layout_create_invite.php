<!--LOGINFORM -->
<div id="widget" class="panel">
	
		<h1 class="headtext">Create a Invite</h1>
		
			<form class="panel" action="system/config/generate_invitecode.php" method="post">
				
				<label for="email">Email:</label>
				<input class="" type="text" name="email" value="" placeholder="E-mail"><br>
				
				<label for="serial">Serial:</label>
				<input id="serial" type="text" value=""  disabled placeholder="serial"><br>
				<input id="serialh" type="hidden" name="serial" value="" ><br>
				
				<p class="submit" onclick="generateSerial()">Generate Serial Number</p>
				
				<input class="submit" type="submit" value="Send Invite">
				
			</form>
		
</div>
