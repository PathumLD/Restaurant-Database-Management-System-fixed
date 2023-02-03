<?php
	require('db.php');
	session_start();
    // If form submitted, insert values into the database.
    if (isset($_POST['email']) && isset($_POST['password'])){
		
		$email = $_POST['email'];
		$password = $_POST['password'];
		
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `customer` WHERE email=? and password=?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $email, md5($password));
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = mysqli_num_rows($result);
        if($rows==1){
			$_SESSION['email'] = $email;
			header("Location: index.php"); // Redirect user to index.php
            }else{
				echo "<div class='form'><h3>Username/password is incorrect.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
				}
    }else{
?>
<div data-aos="fade-down" class="container" id="container">
        <div class="form-container sign-in-container">
            <form method="post" action="" name="login">
                <h1 style="padding-bottom: 20px">Sign in</h1>
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required/>
                <a href="#">Forgot your password?</a>
                <span style="padding-top: 10px"><button>Login</button></span>
                <p>Not registered yet? <a href='registration.php' style="color:#FF0000;font-weight:bold;">Register Here</a></p>
            </form>
        </div>
</div>

    <div class="landing"> <!---background-->
        <div class="opac">
        </div>
    </div>

    <footer>
        <p>
            Created with <i class="fa fa-heart"></i> by
            <a target="_blank" href="index.html">Foodilite</a>
        </p>
    </footer>
    <script src="./js/main.js"></script>

<?php } ?>
