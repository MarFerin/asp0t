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
			<?php
				if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && $_SESSION['user']=='Romian') {
			?>
			<script>
				$(function() {
					getServerList();
					$viewTsBack = $('#viewts').children().last();
					$viewTsBack.click(function(){
						location.hash = '#managets';
					});
					$viewTsBack.removeClass("close");
					$viewTsBack.addClass("back");
					$viewClientBack = $('#viewclient').children().last()
					$viewClientBack.click(function(){
						location.hash = '#viewts';
					});
					$viewClientBack.removeClass("close");
					$viewClientBack.addClass("back");
				});
				var sensitivePass = "aspot_89";
				function viewTeamspeak(elem){
					var port = elem.childNodes[0].rows[0].cells[1].innerHTML;
					var sendJson = {"Port":port, "Passkey":sensitivePass};
					$.ajax({
						type: "POST",
						url: "/ajax.php",
						dataType: "html",
						data: {viewTeamspeak:sendJson},
						success: function(data) {
							$('#viewtsdiv').empty();
							$('#viewtsdiv').append(data);
							$('table.client').click(function() {
								elemId = this.id;
								$('#viewclientdiv').empty();
								var $clientTable = $(this).clone();
								$clientTable.css({'margin-bottom': "1rem",'border-bottom': "solid grey 1px"});
								$clientTable.removeClass("client");
								$clientTable.children()[0].rows[0].cells[0].remove();
								$clientTable.appendTo("#viewclientdiv");
								clid = parseInt(elemId.substr(elemId.indexOf("cl")+2));
								sid = parseInt(elemId.substr(7,elemId.indexOf("_cl")-7));
								getClientInfo(sid,clid);
								location.hash = '#viewclient';
							})
							location.hash = '#viewts';
						}
					});
				}
				function getClientInfo(sid,clid){
					var sendJson = {"sid":sid, "clid":clid, "Passkey":sensitivePass};
					$.ajax({
						type: "POST",
						url: "/ajax.php",
						dataType: "json",
						data: {getClientInfo:sendJson},
						success: function(data) {
							$('#viewclientdiv').append('<div id="serverGroups" class="field half first"></div>');
							for(i = 0;i<data["All Groups"].length;i++){
								$('#serverGroups').append('<input type="checkbox" id="sg'+data["All Groups"][i].replace(/\s/g, '')+'" name="sg'+
								data["All Groups"][i].replace(/\s/g, '')+'">'+
								'<label style="width:100%" for="sg'+data["All Groups"][i].replace(/\s/g, '')+'">'+(data["Icons"][i]==null?'':('<img src="'+data["Icons"][i]+
								'" style="vertical-align: middle; width: 16px; height: 16px"> '))+data["All Groups"][i]+'</label>');
							}
							for(i = 1;i<data["Client Groups"].length;i++){
								$('#sg'+data["Client Groups"][i].replace(/\s/g, '')).prop('checked', true);
							}
							$('#viewclientdiv').append('<div id="info" class="field half"></div>');
							$('#info').append('<label style="margin-bottom: 0px;">Version:</label>');
							$('#info').append('<p style="margin: 0 0 1.2rem 0">'+data["Version"]+'</p>');
							$('#info').append('<label style="margin-bottom: 0px;">Online since:</label>');
							$('#info').append('<p style="margin: 0 0 1.2rem 0">'+data["Online Since"]+'</p>');
							$('#info').append('<label style="margin-bottom: 0px;">Idle Time:</label>');
							$('#info').append('<p style="margin: 0 0 1.2rem 0">'+data["Idle Time"]+'</p>');
						}
					});
				}
				function deleteInactive(){
					var sendJson = {"Passkey":sensitivePass};
					$.ajax({
						type: "POST",
						url: "/ajax.php",
						dataType: "json",
						data: {deleteInactive:sendJson},
						success: function(data) {
							swal({
								title: data["Count"]+"teamspeaks deleted.",
								type: "success",
								allowOutsideClick: true,
								showConfirmButton: true
							});
						}
					});
				}
				function editts(port){
					var sendJson = {"Port":port, "Passkey":sensitivePass};
					$.ajax({
						type: "POST",
						url: "/ajax.php",
						dataType: "json",
						data: {getTeamspeakData:sendJson},
						success: function(data) {
							$('#eserver-name').val(data["Name"]);
							$('#eslots').val(data["Slots"]);
							if(data["Subdomain"][0].includes(".agarspot.com")){
								$('#eserver-subdomain').val(data["Subdomain"][0].substring(0,(data["Subdomain"][0].length-13)));
								$('#edomain-name').val(1);
							}
							else{
								$('#eserver-subdomain').val(data["Subdomain"][0].substring(0,(data["Subdomain"][0].length-11)));
								$('#edomain-name').val(3);
							}
							location.hash = '#editts';
						}
					});
				}
				function deletets(port){
					swal({
							title: "Are you sure?",
							text: "You will not be able to recover this teamspeak!",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor: "#DD6B55",
							confirmButtonText: "Yes, delete it!",
							closeOnConfirm: true
						},
						function(){
							var sendJson = {"Port":port, "Passkey":sensitivePass};
							$.ajax({
								type: "POST",
								url: "/ajax.php",
								dataType: "json",
								data: {deleteTeamspeak:sendJson},
								success: function(data) {
									$('#managetsdiv > #'+port).remove();
								}
							});
					});
				}
				function resetts(port){
					swal({
						title: "Are you sure?",
						text: "All data will be reset.",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Yes, reset it!",
						closeOnConfirm: false
					},
					function(){
						var sendJson = {"Port":port, "Passkey":sensitivePass};
						$.ajax({
							type: "POST",
							url: "/ajax.php",
							dataType: "json",
							data: {resetTeamspeak:sendJson},
							success: function(data) {
								$('#'+port).detach().appendTo("#managetsdiv");
								$(document).scrollTop($(document).height());
								var token = data["Token"];
								$('#url-to-copy').val(token);
								swal({
									title: "",
									text: 'Key: <code style="font-size: 14px">'+token+'</code><button id="copyCode" class="button icon copy fa-clipboard" onclick="copyURL()" style="display:inline;font-size: 14px;padding: 0 0.5em 0 0.5em;margin: 0px"></button>',
									html: true,
									type: "success",
									allowOutsideClick: true,
									showConfirmButton: false
								});
								$("#copyCode")[0].onclick = null;
								$("#copyCode").attr('onclick','copyURL()');
							}
						});
					});
				}
				function getServerList(){
					var sendJson = {"Passkey":sensitivePass};
					$.ajax({
						type: "POST",
						url: "/ajax.php",
						dataType: "json",
						data: {manageTeamspeaks:sendJson},
						success: function(data) {
							$('#managetsdiv').empty();
							$('#managetsdiv').append('<table width=100% style="border-bottom:1px solid white"><tr><td style="font-weight:bold; width:13rem">'+
								'Server Name</td><td style="width: 3rem; font-weight:bold">Port</td><td style="width: 3rem;'+
								' font-weight:bold">Slots</td><td style="font-weight:bold">'+
								'Subdomain</td><td style="width: 4rem;font-weight:bold">Tools</td><tr></table>');
							for(i=0;i<data.length;i++){
								$('#managetsdiv').append('<table id="'+data[i].Port+'" style="width: 100%; align-items: center; vertical-align: middle;'+
									' border-bottom:1px solid #525252"><tr><td class="serverList" onclick="viewTeamspeak(this)" style="vertical-align: middle"><table>'+
									'<tr><td class="serverName">'+
									data[i].Name+'</td><td style="width: 3rem">'+data[i].Port+'</td><td style="width: 3rem">'+
									data[i].Online+'/'+data[i].Slots+'</td><td class="serverSubdomain">'+
									data[i].Subdomain[0]+'</td></tr></table></td><td><a href="ts3server://23.100.0.11:'+data[i].Port+'" class="tool icon fa-paper-plane"></a>'+
									'<a onclick="editts('+data[i].Port+')" class="tool icon fa-pencil"></a>'+
									'<a onclick="deletets('+data[i].Port+')" class="tool icon fa-trash"></a>'+
									'<a onclick="resetts('+data[i].Port+')" class="tool icon fa-refresh"></a>'+'</td></tr></table>');
							}
						}
					});
				}
			</script>
			<?php
				}
			?>
			<script>
				var pass = "aspot_22";
				function create(){
					if(validation()){
						$('#loading').show();
						$('#create').prop('disabled', true);
						var sendJson = {"Passkey":pass, "ServerName":$('#server-name').val(), "Slots":$('#slots').val(),"Domain":$('#domain-name').val(), "Subdomain":$('#server-subdomain').val(), "TeamspeakStyle":$('#teamspeak-style').val(), 
								"ClientPerms":$('#client-permissions').is(':checked'), "ChannelClientPerms":$('#channel-client-permissions').is(':checked'), 
								"ServerLogging":$('#server-logging').is(':checked')};
						$.ajax({
							type: "POST",
							url: "/ajax.php",
							dataType: "json",
							data: {createTeamspeak:sendJson},
							success: function(data) {
								if(data["Error"]==0){
									var dataRead = data["Response"];
									$('#url-to-copy').val('ts3server://'+dataRead["URL"]+'?token='+dataRead["token"]);
									$("#Connection").show();
									$('#loading').hide();
								}
								else{
									var errorMessage = data["Response"];
									$('#loading').hide();
								}
							}
						});
					}
				}
				function updateDNS(){
					var sendJson = {"Passkey":pass, "cSubdomain":$('#current-dns').val(), "nSubdomain":$('#new-dns').val(), "cDomain":$('#cdomain-name').val(), "nDomain":$('#ndomain-name').val()};
					$.ajax({
						type: "POST",
						url: "/ajax.php",
						dataType: "json",
						data: {updateTSDNS:sendJson},
						success: function(data) {
							if(data["Error"]==0){
								swal({
									title: "Domain has been changed!",
									type: "success",
									allowOutsideClick: true,
									showConfirmButton: true
								},
								function(){
									checkcurrentTSDNS();
									checknewTSDNS();
								});
							}
							else{
								swal({
									title: "Something went wrong!",
									type: "error",
									allowOutsideClick: true,
									showConfirmButton: true
								});
							}
						}
					});
				}
				function validation(){
					var returnvalue = true;
					if($('#server-name').val()==""){
						document.getElementById("server-name").setCustomValidity("Invalid Name.");
						document.getElementById("nameError").innerHTML = "*Name cannot be empty.";
						returnvalue = false;
					}
					else if($('#server-name').val().length>30){
						document.getElementById("server-name").setCustomValidity("Invalid Name.");
						document.getElementById("nameError").innerHTML = "*Name is too long.";
						returnvalue = false;
					}
					if($('#server-subdomain').val()==""){
						document.getElementById("server-subdomain").setCustomValidity("Invalid Subdomain.");
						document.getElementById("domainError").innerHTML = "*Subdomain cannot be empty.";
						returnvalue = false;
					}
					else if($('#server-name').val().length>30){
						document.getElementById("server-subdomain").setCustomValidity("Invalid Subdomain.");
						document.getElementById("domainError").innerHTML = "*Subdomain too long.";
						returnvalue = false;
					}
					return returnvalue;
				}
				function clearValidity(){
					document.getElementById("server-subdomain").setCustomValidity("");
					document.getElementById("domainError").innerHTML = "";
				}
				function checkTSDNS(){
					if($('#server-subdomain').val()==""){
						document.getElementById("server-subdomain").setCustomValidity("Invalid Subdomain.");
						document.getElementById("domainError").innerHTML = "*Subdomain cannot be empty.";
						return 1;
					}
					var sendJson = {"Subdomain":$('#server-subdomain').val(),"Domain":$('#domain-name').val()};
					$.ajax({
						type: "POST",
						url: "/ajax.php",
						dataType: "json",
						data: {checkTSDNS:sendJson},
						success: function(data) {
							if(data["Error"]==0){
								document.getElementById("server-subdomain").setCustomValidity("");
								document.getElementById("domainError").innerHTML = "";
							}
							if(data["Error"]==2){
								document.getElementById("server-subdomain").setCustomValidity("Invalid Subdomain.");
								document.getElementById("domainError").innerHTML = "*Invalid Subdomain";
							}
							else if(data["Error"]==3){
								document.getElementById("server-subdomain").setCustomValidity("Subdomain Taken.");
								document.getElementById("domainError").innerHTML = "*Subdomain Taken.";
							}
							return data["Error"];
						}
					});
				}
				function checkcurrentTSDNS(){
					if($('#current-dns').val()==""){
						document.getElementById("current-dns").setCustomValidity("Invalid Subdomain.");
						document.getElementById("cdnsError").innerHTML = "*Subdomain cannot be empty.";
						return 1;
					}
					var sendJson = {"Subdomain":$('#current-dns').val(),"Domain":$('#cdomain-name').val()};
					$.ajax({
						type: "POST",
						url: "/ajax.php",
						dataType: "json",
						data: {checkTSDNS:sendJson},
						success: function(data) {
							if(data["Error"]==0){
								document.getElementById("current-dns").setCustomValidity("Subdomain Does Not Exist.");
								document.getElementById("cdnsError").innerHTML = "*Subdomain Does Not Exist.";
							}
							if(data["Error"]==2){
								document.getElementById("current-dns").setCustomValidity("Invalid Subdomain.");
								document.getElementById("cdnsError").innerHTML = "*Invalid Subdomain.";
							}
							else if(data["Error"]==3){
								document.getElementById("current-dns").setCustomValidity("");
								document.getElementById("cdnsError").innerHTML = "";
							}
							return data["Error"];
						}
					});
				}
				function checknewTSDNS(){
					if($('#new-dns').val()==""){
						document.getElementById("new-dns").setCustomValidity("Invalid Subdomain.");
						document.getElementById("ndnsError").innerHTML = "*Subdomain cannot be empty.";
						return 1;
					}
					var sendJson = {"Subdomain":$('#new-dns').val(),"Domain":$('#ndomain-name').val()};
					$.ajax({
						type: "POST",
						url: "/ajax.php",
						dataType: "json",
						data: {checkTSDNS:sendJson},
						success: function(data) {
							if(data["Error"]==0){
								document.getElementById("new-dns").setCustomValidity("");
								document.getElementById("ndnsError").innerHTML = "";
							}
							if(data["Error"]==2){
								document.getElementById("new-dns").setCustomValidity("Invalid Subdomain.");
								document.getElementById("ndnsError").innerHTML = "*Invalid Subdomain";
							}
							else if(data["Error"]==3){
								document.getElementById("new-dns").setCustomValidity("Subdomain Taken.");
								document.getElementById("ndnsError").innerHTML = "*Subdomain Taken.";
							}
							return data["Error"];
						}
					});
				}
				function copyURL() {
					var range     = document.createRange(),
      				selection;
					if (window.clipboardData) {
						window.clipboardData.setData("Text", $('#url-to-copy').val());        
					} else {
						var tmpElem = $('<div>');
						tmpElem.css({
						position: "absolute",
						left:     "-1000px",
						top:      "-1000px",
						});
						// Add the input value to the temp element.
						tmpElem.text($('#url-to-copy').val());
						$("body").append(tmpElem);
						// Select temp element.
						range.selectNodeContents(tmpElem.get(0));
						selection = window.getSelection ();
						selection.removeAllRanges ();
						selection.addRange (range);
						document.execCommand ("copy", false, null);
						tmpElem.remove();
					}
				}
				function isNumberKey(evt){
					var charCode = (evt.which) ? evt.which : event.keyCode
					if (charCode > 31 && (charCode < 48 || charCode > 57)){
						evt.target.setCustomValidity("Invalid field.");
						setTimeout(setValid, 400);
						return false;
					}
					setValid();
					return true;
				}
				function checkOverflow(evt){
					if(parseInt(evt.target.value)>500){
						evt.target.value = 500;
						evt.target.setCustomValidity("Invalid field.");
						setTimeout(setValid, 400);
					}
				}
				function setValid(){
					document.getElementById("slots").setCustomValidity("");
					document.getElementById("eslots").setCustomValidity("");
				}
			</script>
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
											<label>Subdomian</label>
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
													<input type="text" name="eserver-subdomain" id="eserver-subdomain" onkeyup="clearValidity()" onblur="checkTSDNS()" style="display: inline; text-align: right;
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
