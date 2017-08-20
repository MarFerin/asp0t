<?php
	include 'loginData.php';
    // Start the session
    session_start();

    // Defines username and password. Retrieve however you like,
	

    // Error message
    $error = "";

    // Checks to see if the user is already logged in. If so, refirect to correct page.
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
        $error = "success";
        header('Location: teamspeak.php');
    }
        
    // Checks to see if the username and password have been entered.
    // If so and are equal to the username and password defined above, log them in.
    if (isset($_POST['username']) && isset($_POST['password'])) {
		if($accounts[$_POST['username']]==''){
			$_SESSION['loggedIn'] = false;
            $error = "Invalid username and password!";
		} elseif ($accounts[$_POST['username']] == $_POST['password']) {
            $_SESSION['loggedIn'] = true;
			$_SESSION['user'] = $_POST['username'];
            header('Location: teamspeak.php');
        } else {
            $_SESSION['loggedIn'] = false;
            $error = "Invalid username and password!";
        }
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
			</style>
	</head>
	<body>
		
		<!-- Wrapper -->
			<div id="wrapper">
				<form id="login-form" class="login-form" name="form1" method="post">
					<input type="hidden" name="is_login" value="1">
					<div id="form-content">
						<div class="group">
							<label for="username">USERNAME</label>
							<div><input id="username" name="username" class="form-control required" type="username" placeholder="Username"></div>
						</div>
						<div class="group">
							<label for="name">Password</label>
							<div><input id="password" name="password" class="form-control required" type="password" placeholder="Password"></div>
						</div>
						<?php if($error) { ?>
							<em>
								<label class="err" for="password" generated="true" style="display: block;"><?php echo $error ?></label>
							</em>
						<?php } ?>
						<div class="group submit">
							<label class="empty"></label>
							<div><input name="submit" type="submit" value="Submit"/></div>
						</div>
					</div>
				</form>

				<!-- Footer -->
					<footer id="footer">
						<p class="copyright">&copy; Agarspot.</p>
					</footer>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			

	</body>
</html>
