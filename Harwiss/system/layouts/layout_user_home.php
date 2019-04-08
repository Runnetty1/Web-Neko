
<!-- Main User page -->
	
<div id="user-home" class="">
	<div class="header-left">
		<div class="user-contact-info">
			<span><img class="icon" src="img/icons8-marker-52.png" alt="ico"><p>Skogfaret 3b, 0382 Oslo</p></span>
			<span><img class="icon" src="img/mail-icon.png" alt="ico"><p>Mats1992@gmail.com</p></span>
			<span><img class="icon" src="img/icons8-phone-52.png" alt="ico"><p>+47 977 61 888</p></span>

		</div>
		<div class="user-contact-social">
			<span><img class="icon" src="img/social/facebook.png" alt="ico"><p>/harwiss</p></span>
			<span><img class="icon" src="img/social/linked-in.png" alt="ico"><p>/mats-harwiss</p></span>
		</div>
	</div>
	<div class="header-right">
		
			<img class="profile-img" src="users/mats/img/profile.png" alt="profile image">
		
	</div>
	<div class="header-menu">
	
		<div class="header-menu-btn" onclick="viewdata('<?php echo $_GET['user']?>','about')">
			<p>About</p>
		</div>
		<div class="header-menu-btn" onclick="viewdata('<?php echo $_GET['user']?>','education')">
			<p>Education</p>
		</div>
		<div class="header-menu-btn" onclick="viewdata('<?php echo $_GET['user']?>','work')">
			<p>Work Experience</p>
		</div>
		<div class="header-menu-btn">
			<p>Portfolio</p>
		</div>
	</div>
	
</div>
<div id="profile-data">
	<?php
	if( $_GET["view"] == "about" ) {
		//header("Location: $home_url/user_home?user=".$_GET["user"]."&view=about");
		include_once "system/layouts/layout_profile_about.php";
	}
	if( $_GET["view"] == "education" ) {
		//header("Location: $home_url/user_home?user=".$_GET["user"]."&view=about");
		include_once "system/layouts/layout_profile_education.php";
	}
	if( $_GET["view"] == "work" ) {
		//header("Location: $home_url/user_home?user=".$_GET["user"]."&view=about");
		include_once "system/layouts/layout_profile_work.php";
	}
	?>
	
</div>