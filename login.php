 <?php require('db_connect.php');

    session_start();


		if (isset($_REQUEST['login'])):
      session_unset();
      session_destroy();

			$email = stripslashes($_REQUEST['email']); // removes backslashes
			$email = mysqli_real_escape_string($conn,$email); //escapes special characters in a string
			$password = md5($_REQUEST['password']);


			$sql = $conn->query("SELECT id, fname, lname, email, admin FROM users WHERE email='$email' AND password='$password'");
			if ($sql->num_rows > 0):

				while($row_login = $sql->fetch_assoc()):

					session_start();
					$_SESSION['fname'] = $row_login['fname'];
			        $_SESSION['lname'] = $row_login['lname'];
			        $_SESSION['email'] = $row_login['email'];
			        $_SESSION['admin'] = $row_login['admin'];
      				$_SESSION['id'] = $row_login['id'];

              if ($row_login['admin']==0):
			        header("location: reservation.php");
              elseif ($row_login['admin']==1):
              header("location: dashboard.php");
              endif;

				endwhile;



			else:
				$fail = "To email ή/και το password που δώσατε δεν είναι ορθά. Δοκιμάστε ξανά.";

			endif;


		endif;
?>

<!doctype html>
<html>
<?php include('header.php'); ?>

<body>

<?php include ('navigation.php'); ?>

<section id="login" class="main">

	<div class="container pt-5 pb-5">

					<form name="logform" id="logform" action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="d-block mr-auto ml-auto log-form">

						<?php if(isset($_SESSION['message'])): ?>
						<div class="alert alert-success p-2 mt-2" role="alert">
							<?= $_SESSION['message'];
							session_unset();
      						session_destroy();
						?></div>
						<?php endif; ?>


						<?php if(isset($fail)): ?>
						<div class="alert alert-danger p-2 mt-2" role="alert"><?= $fail; ?></div>
						<?php endif; ?>

				<div class="form-group">

    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>

  </div>

  <div class="form-group">

    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
  </div>


  <button type="submit" id="login" name="login" class="submit-btn btn btn-dark d-block mr-auto ml-auto">Υποβολή</button>


</form>


</div>

	</section>

<?php include('footer.php') ?>
</body>
</html>
