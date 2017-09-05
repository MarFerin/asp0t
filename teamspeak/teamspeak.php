<?php
    // Start the session
    ob_start();
    session_start();

    // Check to see if actually logged in. If not, redirect to login page
    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
        header("Location: index.php");
    }
?>
<html>
	<head>
		<title>Agarspot</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="http://agarspot.com/assets/css/main.css" />
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<link rel="icon" type="image/x-icon" href="/favicon.ico" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="http://agarspot.com/assets/css/noscript.css" /></noscript>
		<link rel="stylesheet" type="text/css" href="http://agarspot.com/dist/sweetalert.css"/>
		<script src="http://agarspot.com/dist/sweetalert.min.js"></script>
		<script src="http://agarspot.com/assets/js/jquery.min.js"></script>
		<script src="http://agarspot.com/assets/js/skel.min.js"></script>
		<script src="http://agarspot.com/assets/js/util.js"></script>
		<script src="http://agarspot.com/assets/js/main.js"></script>
		<script src="http://agarspot.com/teamspeak/public.js"></script>
		<?php
			if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && $_SESSION['user']=='Romian') {
		?>
		<script src="http://agarspot.com/teamspeak/private.js"></script>
		<?php
			}
		?>
		<style type="text/css">
			#username {
				margin-bottom: 10px;
			}
			.group {
				text-align: center;
			}
			.denied {
				width: 30em;
				position: absolute;
				left: 0;
				right: 0;
				margin: auto;
				top: 32%;
			}
		</style>
		<input type="text" id="url-to-copy" value="" style="display: none"/>
	</head>
	<body>
		<!-- Wrapper -->
			<div id="wrapper">
				<nav style="top: 10px;right: 10px;position: absolute;">
					<form method="post" action="logout.php">
						<input type="submit" value="Logout">
					</form>
				</nav>
				<!-- Header -->
					<header id="header">
						<div class="logo">
							<span class="icon fa-server"></span>
						</div>
						<div class="content">
							<div class="inner">
								<h1>Agarspot</h1>
								<p>A fully free teamspeak hosting solution.<br>
								Talk to us at <a href="ts3server://ts.agarspot.com">ts.agarspot.com</a>!</p>
							</div>
						</div>
						<nav>
							<ul>
								<li><a href="#dns">Change Subdomain</a></li>
								<?php
									if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && $_SESSION['user']=='Romian') {
								?>
								<li><a href="#managets" onclick="getServerList()">Manage Teamspeaks</a></li>
								<?php
									}
								?>
								<li><a href="#teamspeak">Create Teamspeak</a></li>
								<?php
									if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && $_SESSION['user']=='Romian') {
								?>
								<li><a href="#tools">Tools</a></li>
								<?php
									}
								?>
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<div id="main">

							<!-- TSDNS -->
								<article id="dns">
									<h2 class="major">Update TSDNS</h2>
									<label>Current Subdomain</label>
									<div style="margin-bottom:0px">
										<input type="text" name="current-dns" id="current-dns" value="" placeholder="" onkeyup="clearValidity()" onblur="checkcurrentTSDNS()" style="display: inline; text-align: right;
												width: 20%; padding-right:5px;"/>
										<div class="sselect-wrapper" style="width:40%;display:inline">
											<select name="cdomain-name" id="cdomain-name" style="width:40%;display:inline;padding:5px">
												<option value="1">.agarspot.com</option>
												<!--<option value="2">.tshub.io</option>-->
												<option value="3">.ogarhub.io</option>
											</select>
										</div>
										<p id="cdnsError" class="errormessage"></p>
									</div>
									<label>New Subdomain</label>
									<div style="margin-bottom:0px">
										<input type="text" name="new-dns" id="new-dns" value="" placeholder="" onkeyup="clearValidity()" onblur="checknewTSDNS()" style="display: inline; text-align: right;
												width: 20%; padding-right:5px;"/>
										<div class="sselect-wrapper" style="width:40%;display:inline">
											<select name="ndomain-name" id="ndomain-name" style="width:40%;display:inline;padding:5px">
												<option value="1">.agarspot.com</option>
												<!--<option value="2">.tshub.io</option>-->
												<option value="3">.ogarhub.io</option>
											</select>
										</div>
										<p id="ndnsError" class="errormessage"></p>
									</div>
									<button id="updatedns" onclick="updateDNS()" style="margin-right:1rem;margin-top:1rem">Update DNS</button>
								</article>

							<!-- Account -->
								<article id="account">
									<h2 class="major">My Account</h2>
									<form method="post" action="#">
										<div class="field half first" style="margin-bottom:0px">
											<label for="username">Username</label>
											<input type="text" name="username" id="username" value="" placeholder="Enter Username"/>
											<p id="usernameError" class="errormessage"></p>
										</div>
										<div class="field half" style="margin-bottom:0px">
											<label for="password">Password</label>
											<input type="password" name="password" id="password" placeholder="Enter Password"/>
											<p id="passwordError" class="errormessage"></p>
										</div>
									</form>
									<button id="login" class="special" style="margin-right:12px">Login</button>
									<button id="createAccount" onclick="create()">Create Account</button>
								</article>

							<!-- Manage -->
								<article id="managets">
									<h2 class="major">Manage a Teamspeak</h2>
									<div id="managetsdiv"></div>
								</article>
							<!-- View Teamspeak -->
								<article id="viewts">
									<h2 class="major">View Teamspeak</h2>
									<div id="viewtsdiv"></div>
								</article>
							<!-- View Client -->
								<article id="viewclient">
									<h2 class="major">Client</h2>
									<div id="viewclientdiv"></div>
								</article>
							<!--Create Teamspeak -->
								<article id="teamspeak">
									<h2 class="major">Teamspeak</h2>

									<section>
										<h3>Create your own teamspeak</h3>
										<form>
											<div class="field half first" style="margin-bottom:0px">
												<label for="server-name">Server Name</label>
												<input type="text" name="server-name" id="server-name" value="" placeholder="My Teamspeak Name" />
												<p id="nameError" class="errormessage"></p>
											</div>
											<div class="field half" style="margin-bottom:0px">
												<label for="slots">Slots</label>
												<input type="text" name="slots" id="slots" placeholder="Max 500" value="200" onkeyup="checkOverflow(event)" onkeypress="return isNumberKey(event)"/>
												<p id="slotsError" class="errormessage"></p>
											</div>
											<label>Subdomain</label>
											<div style="margin-bottom:0px">
												<input type="text" name="server-subdomain" id="server-subdomain" value="" placeholder="example" onkeyup="clearValidity()" onblur="checkTSDNS()" style="display: inline; text-align: right;
														width: 20%; padding-right:5px;"/>
												<div class="sselect-wrapper" style="width:40%;display:inline">
													<select name="domain-name" id="domain-name" style="width:40%;display:inline;padding:5px">
														<option value="1">.agarspot.com</option>
														<option value="3">.ogarhub.io</option>
													</select>
												</div>
												<p id="domainError" class="errormessage"></p>
											</div>
											<label>Select your teamspeak style</label>
											<div class="select-wrapper">
												<select name="teamspeak-style" id="teamspeak-style">
													<option value="1">Clan</option>
													<option value="3">Blank Teamspeak</option>
												</select>
											</div>
											<br>
											<label>Advanced Permissions</label>
											<input type="checkbox" id="client-permissions" name="client-permissions">
											<label for="client-permissions">Enable Client Permissions</label>
											<input type="checkbox" id="channel-client-permissions" name="channel-client-permissions">
											<label for="channel-client-permissions">Enable Channel-Client Permissions</label>
										</form>
										<button id="create" onclick="create()" style="margin-right:1rem">Create Server</button>
										<div id="loading" class="bubbles-wrapper" style="display: none">
											<div class="bubbles" id="b1"></div>
											<div class="bubbles" id="b2"></div>
											<div class="bubbles" id="b3"></div>
											<div class="bubbles" id="b4"></div>
											<div class="bubbles" id="b5"></div>
										</div>
										<button class="button icon fa-clipboard" id="Connection" onclick="copyURL()" style="display: none;margin-right:1rem"></button>
										
										
									</section>
								</article>  

							<!-- EditTs -->
								<article id="editts">
										<h2 class="major">Teamspeak</h2>

										<div id="editteamspeak">
											<h3>Edit your teamspeak</h3>
											<form>
												<div class="field half first" style="margin-bottom:0px">
													<label for="eserver-name">Server Name</label>
													<input type="text" name="eserver-name" id="eserver-name"/>
													<p id="enameError" class="errormessage"></p>
												</div>
												<div class="field half" style="margin-bottom:0px">
													<label for="eslots">Slots</label>
													<input type="text" name="eslots" id="eslots" onkeyup="checkOverflow(event)" onkeypress="return isNumberKey(event)"/>
													<p id="eslotsError" class="errormessage"></p>
												</div>
												<label>Subdomian</label>
												<div style="margin-bottom:0px">
													<input type="text" name="eserver-subdomain" id="eserver-subdomain" onkeyup="eclearValidity()" onblur="echeckTSDNS()" style="display: inline; text-align: right;
															width: 20%; padding-right:5px;"/>
													<div class="sselect-wrapper" style="width:40%;display:inline">
														<select name="edomain-name" id="edomain-name" style="width:40%;display:inline;padding:5px">
															<option value="1">.agarspot.com</option>
															<option value="3">.ogarhub.io</option>
														</select>
													</div>
													<p id="edomainError" class="errormessage"></p>
												</div>
												<label>Advanced Permissions</label>
												<input type="checkbox" id="eclient-permissions" name="eclient-permissions">
												<label for="eclient-permissions">Enable Client Permissions</label>
												<input type="checkbox" id="echannel-client-permissions" name="echannel-client-permissions">
												<label for="echannel-client-permissions">Enable Channel-Client Permissions</label>
											</form>
											<button id="edit">Apply</button>
										</div>
									</article>  
					
					
					
							<!-- Tools -->
								<article id="tools">
									<h2 class="major">Tools</h2>
									<button onclick="deleteInactive()">Delete Inactive</button>
									<button onclick="runAjaxQuery()">Run Query</button>
								</article>
					</div>

				<!-- Footer -->
					<footer id="footer">
						<p class="copyright">&copy; Agarspot.</p>
					</footer>

			</div>

		<!-- BG -->
			<div id="bg" class="firstPage"></div>

		<!-- Scripts -->
			

	</body>
</html>
