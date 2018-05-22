<?php require('db_connect.php');

    session_start();

if(isset($_POST['submit_table'])):


$date_sess = $_SESSION['date'];
$person = $_SESSION['id'];
$fullname1 = stripslashes($_POST['fullname']);
$fullname = mysqli_real_escape_string($conn,$fullname1);
$email1 = stripslashes($_POST['email']);
$email = mysqli_real_escape_string($conn,$email1);
$mobile1 = stripslashes($_POST['mobile']);
$mobile = mysqli_real_escape_string($conn,$mobile1);
$comments1 = stripslashes($_POST['comments']);
$comments = mysqli_real_escape_string($conn,$comments1);


foreach ($_POST['table'] as $tab1):
$tab = (int)$tab1;
$admin_res1 = $conn->query("INSERT INTO reservations (id, table_id, reserved_by, reserved_for, reserved_at) VALUES (NULL, $tab, $person, '$date_sess', now())");
$admin_res2 = $conn->query("INSERT INTO admin_reservations (id, reservation_id, customer_name, customer_email, customer_mobile, comments) VALUES (NULL, LAST_INSERT_ID(), '$fullname', '$email', '$mobile', '$comments')");
endforeach;

if($admin_res1===TRUE && $admin_res2===TRUE):
        $success = "Η κράτηση τραπεζιού από τον διαχειριστή πραγματοποιήθηκε με επιτυχία.";
      else:

        $fail = "Η κράτηση τραπεζιού από τον διαχειριστή απέτυχε.";
      endif;

endif;
?>


<!doctype html>
<html>
<?php include('header.php'); ?>

<body>

<?php include('navigation.php'); ?>

<section id="reservation" class="main">

  <div class="container pt-2 pb-5">

<h4 class="text-center pb-3">ΚΡΑΤΗΣΕΙΣ ΔΙΑΧΕΙΡΙΣΤΗ</h4>

          <form id="dateform" name="dateform" action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="d-block mr-auto ml-auto res-form">


  <div class="form-group">
    <label for="date">Ημερομηνία</label>
    <input type="date" name="res_date" class="form-control" id="res_date" min="<?= date("Y-m-d"); ?>" required>

  </div>


  <button type="submit" id="submit_date" name="submit_date" class="submit-btn btn btn-dark d-block mr-auto ml-auto">Υποβολή</button>
</form>


<?php
if(isset($_POST['submit_date'])):

  $date = $_POST['res_date'];

$nameOfDay = date('D', strtotime($date));

  switch ($nameOfDay) {
    case 'Mon':
      $d = 1;
      break;
    case 'Tue':
      $d = 2;
      break;
    case 'Wed':
      $d = 3;
      break;
    case 'Thu':
      $d = 4;
      break;
    case 'Fri':
      $d = 5;
      break;
    case 'Sat':
      $d = 6;
      break;
    default:
      $d = 7;
      break;
  }

  $_SESSION['date'] = $date;


  $day_chk = $conn->query("SELECT days.id FROM days INNER JOIN hours ON days.id=hours.day_id WHERE day_id=$d");

    if ($day_chk->num_rows < 1):

      $err_day = "Την Ημερομηνία που επιλέξατε το εστιατόριο είναι κλειστό.";

    endif;

endif;

  ?>



<div class="col-md-8 offset-md-2 mt-4 text-center">
       <?php   if(isset($err_day)): ?>

              <div class="alert alert-danger p-2 mt-2" role="alert">
                    <?= $err_day;      ?>

              </div>

    <?php endif; ?>
</div>




<?php if(isset($_POST['submit_date']) && !isset($err_day)): ?>
<div class="row mt-5">

<form id="reservation-form" name="reservation-form" action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="col-md-8 offset-md-2 res-form">
<div class="row text-center">

<?php

    $tables = $conn->query("SELECT id, people FROM tables WHERE id NOT IN (SELECT table_id FROM reservations WHERE reserved_for='$date')");

        if($tables->num_rows > 0):

          while ($row_tables = $tables->fetch_assoc()): ?>

          <div class="col-md-4 col-sm-4 col-xs-6 tables form-group mb-5">
                <label class="btn btn-outline-success"><span class="tit">No <?= $row_tables['id']; ?></span>
                  <span class="d-block people">Άτομα <?= $row_tables['people']; ?></span>
                  <input type="checkbox" name="table[]" autocomplete="off" value="<?= $row_tables['id']; ?>">
                  <span class="glyphicon glyphicon-ok d-block"></span>
                </label>
            </div>

    <?php      endwhile;

        else:

          $all = $conn->query("SELECT id, people FROM tables");
              if($all->num_rows > 0):
                  while($row_all = $all->fetch_assoc()): ?>

                  <div class="col-md-4 col-sm-4 col-xs-6 tables form-group mb-5">
                        <label class="btn btn-outline-success"><span class="tit">No <?= $row_all['id']; ?></span>
                          <span class="d-block people">Άτομα <?= $row_all['people']; ?></span>
                          <input type="checkbox" name="table[]" autocomplete="off" value="<?= $row_all['id']; ?>">
                          <span class="glyphicon glyphicon-ok d-block"></span>
                        </label>

                    </div>

        <?php          endwhile;
              endif;

        endif;


?>

<div class="col-md-10 offset-md-1">
  <div class="form-group">
    <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Όνομα πελάτη" required>
  </div>
  <div class="form-group">
    <input type="email" id="email" name="email" class="form-control" placeholder="Email πελάτη">
  </div>
  <div class="form-group">
    <input type="tel" id="mobile" name="mobile" class="form-control" placeholder="Κινητό πελάτη" required>
  </div>
  <div class="form-group">
    <textarea id="comments" name="comments" class="form-control" placeholder="Σχόλια"></textarea>
  </div>

  <button type="submit" id="submit_table" name="submit_table" class="submit-btn btn btn-dark d-block mr-auto ml-auto">Κράτηση</button>

</div>



</div>
</form>


</div>

<?php endif; ?>



<div class="col-md-8 offset-md-2 mt-4 text-center">

<?php if(isset($success)): ?>

            <div class="alert alert-success p-2 mt-2" role="alert">
              <?= $success;          ?>

              </div>
            <?php endif; ?>

<?php if(isset($fail)): ?>

            <div class="alert alert-danger p-2 mt-2" role="alert">
              <?= $fail;          ?>

              </div>
            <?php endif; ?>
</div>


</div>


  </section>


<?php include('footer.php') ?>
</body>
</html>
