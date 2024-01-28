<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="/public/css/login.css" />
		<title>Document</title>
	</head>
	<body>
		<div class="login">
			<div class="logo">
				<img src="/public/img/logo.svg" />
			</div>
			<form class="login" action="login" method="POST">
				<h1>Login</h1>
				<div>
					 <div class="messages">
                    	<?php
                        	if(isset($messages)){
                            	foreach($messages as $message) {
                                	echo $message;
                            	}
                        	}
                    	?>
                	</div>
					<input name="email" class="email" placeholder="Enter your email" />
					<input
						name="password"	
						class="password"
						type="password"
						placeholder="Enter your password"
					/>
				</div>
				<button type="submit">Login</button>
				<p>Don't have account? <a href="register">Sign up</a></p>
			</form>
		</div>
	</body>
</html>
