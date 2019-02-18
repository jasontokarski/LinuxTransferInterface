<?php
	session_start();
	include 'func.php';
	$validID = array("STEAM_0:1:20076328");
	$validUser = 0;
	$success = 0;
	$filename = "";

	if(!isset($_SESSION["steam_id"])){
		require "login.php";
	}
	
	if(isset($_SESSION["steam_id"])) {
		foreach($validID as $ID) {
			if($_SESSION["steam_id"] == $ID) {
				$validUser = 1;
			}
		}
	}

	if (!$validUser && isset($_SESSION["steam_id"])) {
	session_destroy();
		echo "You do not have permission to use this page!";
		exit();
	}

	if($validUser) {
	echo '<html>
		<body>
		    <form action="index.php" method="post">
			<p>Name of HTML file to transfer: <input type="text" name="fileName" /></p>
			<p><input type="submit" name="transferHTML"/></p>
		    </form>
		</body>
	    </html>';

	echo '<html>
		<body>
		    <form action="index.php" method="post">
			<p>Name of PHP file to transfer: <input type="text" name="fileName" /></p>
			<p><input type="submit" name="transferPHP"/></p>
		    </form>
		</body>
	    </html>';

	if(isset($_POST["transferHTML"])) 
	{
	    if(!extensionExists($_POST['fileName'])) 
	    {
		$filename = $_POST['fileName'] . ".html";
	    } 
	    else 
	    {
		$filename = $_POST['fileName'];
	    }

	    transferFile($filename);
	}

	if(isset($_POST["transferPHP"])) 
	{
	    if(!extensionExists($_POST['fileName'])) 
	    {
		$filename = $_POST['fileName'] . ".php";
	    } 
	    else 
	    {
		$filename = $_POST['fileName'];
	    }

	    transferFile($filename);
	}

	echo '<html>
	    <body>
		<form action="logout.php" method="post">
		    <p><input type="submit" name="logout" value="Logout" /></p>
		</form>
	    </body>
	</html>';
	}
?>
