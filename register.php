<?php require('db_connect.php');
    session_start();
    // If form submitted, insert values into the database.
   if (isset($_REQUEST['registration'])):

        if($_REQUEST['password']!=$_REQUEST['confirm']):


   $error_conf="Οι κωδικοί που δώσατε είναι ανόμοιοι. Επαναλάβατε τη διαδικασία εγγραφής.";


        else:


			$email = stripslashes($_REQUEST['email']);
			$email = mysqli_real_escape_string($conn,$email);

			// check if e-mail address is well-formed
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)):
				$error_email = "To email που δώσατε δεν είναι έγκυρο.";
			else:
				// check if email already exists in the database

				$query = $conn->query("SELECT * FROM users WHERE email='$email'");

				if ($query->num_rows > 0):
          $_SESSION['message'] = "Είστε ήδη εγγεγραμμένος χρήστης. Μπορείτε να πραγματοποιήσετε είσοδο.";
					header("location: login.php");
				else:

					$lname = stripslashes($_REQUEST['lname']); // removes backslashes
					$lname = mysqli_real_escape_string($conn,$lname); //escapes special characters in a string

					$fname = stripslashes($_REQUEST['fname']); // removes backslashes
					$fname = mysqli_real_escape_string($conn,$fname); //escapes special characters in a string

					$password = stripslashes($_REQUEST['password']);
					$password = mysqli_real_escape_string($conn,$password);
					$password = md5($password);

					$mobile = stripslashes($_REQUEST['mobile']);
					$mobile = mysqli_real_escape_string($conn,$mobile);

					$admin = $_REQUEST['admin'];
                if($admin=='user'):
                  $admin=0;
                  	$insert = $conn->query("INSERT INTO users (id, fname, lname, email, password, mobile, admin, created_at) VALUES (NULL, '$fname', '$lname', '$email', '$password', '$mobile', $admin, now())");

                		if($insert===TRUE):

                  			$_SESSION['message'] = "Η εγγραφή σας πραγματοποιήθηκε με επιτυχία. Μπορείτε να πραγματοποιήσετε είσοδο.";
                  					header("location: login.php");

                		elseif($insert===FALSE):

                  	 		$fail = "Η εγγραφή σας απέτυχε. Παρακαλώ, ξαναπροσπαθήστε.";

                		endif;


                elseif($admin=='admin'):
                  $admin=1;
                    if ((isset($_REQUEST['adminpass'])) && $_REQUEST['adminpass']!=""):
                        $adminpass = stripslashes($_REQUEST['adminpass']);
                        $adminpass = mysqli_real_escape_string($conn,$adminpass);
                            if ($adminpass!="52QXI8pr@!"):
                              $error_adminpass = "Ο κωδικός διαχειριστή που δώσατε είναι λανθασμένος. Παρακαλώ, δώστε τον ορθό κωδικό.";
                            else:
                                $insert = $conn->query("INSERT INTO users (id, fname, lname, email, password, mobile, admin, created_at) VALUES (NULL, '$fname', '$lname', '$email', '$password', '$mobile', $admin, now())");

                                    if($insert===TRUE):

                                        $_SESSION['message'] = "Η εγγραφή σας πραγματοποιήθηκε με επιτυχία. Μπορείτε να πραγματοποιήσετε είσοδο.";
                                        header("location: login.php");

                                    elseif($insert===FALSE):

                                        $fail = "Η εγγραφή σας απέτυχε. Παρακαλώ, ξαναπροσπαθήστε.";

                                    endif; // if($insert===TRUE):


                            endif;
                    endif;
                endif;
  


				endif; // if ($query->num_rows > 0):


			endif; // if (!filter_var($email, FILTER_VALIDATE_EMAIL)):


		endif; // if($_REQUEST['password']!=$_REQUEST['confirm']):

	endif; // if(isset($_REQUEST['registration'])):
?>

<!doctype html>
<html>
<?php include('header.php'); ?>

<body>

<?php include ('navigation.php'); ?>

<section id="register" class="main">

	<div class="container pt-5 pb-5">

				<form name="regform" id="regform" action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="d-block mr-auto ml-auto reg-form">
  <div class="form-group">

    <input type="text" class="form-control" id="fname" name="fname" placeholder="Όνομα" required>

  </div>

	 <div class="form-group">
    <input type="text" class="form-control" id="lname" name="lname" placeholder="Επώνυμο" required>

  </div>

				<div class="form-group">
    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>

  </div>

  <div class="form-group">
    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
	  <?php if(isset($error_conf)): ?>
	   <div class="alert alert-danger p-2 mt-2" role="alert"><?= $error_conf; ?></div>
	  <?php endif; ?>
  </div>

			<div class="form-group">
    <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Επιβεβαίωση password" required>
  </div>

  <div class="form-group">
    <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Κινητό">
  </div>

<div class="form-group">

	<select class="form-control" name="admin" required onchange="yesnoCheck()">
		<option value="" selected disabled>Κατηγορία χρήστη</option>
		<option value="user">Χρήστης</option>
		<option id="adminchk" value="admin">Διαχειριστής</option>
	</select>
	  </div>

	<div class="form-group">
    <input type="password" class="form-control" id="adminpass" name="adminpass" placeholder="Κωδικός διαχειριστή" style="display: none" required>
		<?php if(isset($error_adminpass)): ?>
		<div class="alert alert-danger p-2 mt-2" role="alert"><?= $error_adminpass; ?></div>
		<?php endif; ?>
  </div>

  <button type="submit" name="registration" id="registration" class="submit-btn btn btn-dark d-block mr-auto ml-auto">Υποβολή</button>



  <?php if (isset($fail)): ?>
  <div class="alert alert-danger p-2 mt-2" role="alert"><?= $fail; ?></div>
  <?php endif; ?>


</form>




</div>

	</section>


<?php include('footer.php') ?>
</body>
</html>
