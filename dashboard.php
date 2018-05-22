<?php require('db_connect.php');

    session_start();

if(isset($_POST['all_reservations'])):

$resStatus = $conn->query("SELECT users.id AS userid, fname, lname, admin, reservations.id AS resid, table_id, reserved_for, people FROM users INNER JOIN reservations ON users.id=reserved_by INNER JOIN tables ON tables.id=table_id WHERE reserved_by=users.id ORDER BY reserved_for");



  if($resStatus->num_rows > 0):

      while($row_status = $resStatus->fetch_assoc()):
        $res_id[] = $row_status['resid'];
        $res_fname[] = $row_status['fname'];
        $res_lname[] = $row_status['lname'];
        $res_admin[] = $row_status['admin'];
        $res_table[] = $row_status['table_id'];
        $res_date[] = $row_status['reserved_for'];
        $res_people[] = $row_status['people'];
      //  $reservations = TRUE;
      endwhile;

  else:

  $none = "Δεν υπάρχουν κρατήσεις.";

  endif;

endif;




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

    else:
  $resStatus = $conn->query("SELECT users.id AS userid, fname, lname, admin, reservations.id AS resid, table_id, reserved_for, people FROM users INNER JOIN reservations ON users.id=reserved_by INNER JOIN tables ON tables.id=table_id WHERE reserved_by=users.id AND reserved_for='$date' ORDER BY reserved_for");

  if($resStatus->num_rows > 0):

      while($row_status = $resStatus->fetch_assoc()):
        $res_id[] = $row_status['resid'];
        $res_fname[] = $row_status['fname'];
        $res_lname[] = $row_status['lname'];
        $res_admin[] = $row_status['admin'];
        $res_table[] = $row_status['table_id'];
        $res_date[] = $row_status['reserved_for'];
        $res_people[] = $row_status['people'];
      //  $reservations = TRUE;
      endwhile;

  else:

  $none = "Δεν υπάρχουν κρατήσεις.";

  endif;







    endif;






endif;


    ?>


<!doctype html>
<html>
<?php include('header.php'); ?>

<body>

<?php include ('navigation.php'); ?>

<section id="dashboard" class="main">



<div class="container pt-2 pb-5">

<h4 class="text-center pb-3">ΚΑΤΑΣΤΑΣΗ ΚΡΑΤΗΣΕΩΝ</h4>



      <form id="dateform" name="dateform" action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="col-md-6 offset-md-3 pt-2 pb-3">

    <div class="form-group">
    <label for="res_date">Αναζήτηση κρατήσεων βάσει ημερομηνίας</label>
    <input type="date" name="res_date" class="form-control" id="res_date" min="<?= date("Y-m-d"); ?>" required>

    </div>


    <button type="submit" id="submit_date" name="submit_date" class="form-control submit-btn btn btn-info d-block mr-auto ml-auto">Αναζήτηση βάσει ημερομηνίας</button>
    </form>

    <form id="allresults" name="allresults" action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="col-md-6 offset-md-3 mt-3 mb-5">
  <button type="submit" id="all_reservations" name="all_reservations" class="form-control submit-btn btn btn-warning d-block mr-auto ml-auto">Όλες οι κρατήσεις</button>
  </form>


<?php if(isset($_POST['all_reservations'])):


     if(isset($none)): ?>

                <div class="col-md-6 offset-md-3 alert alert-danger p-2 mt-2 text-center" role="alert">
                      <?= $none;      ?>

                </div>

      <?php else: ?>

<table class="table table-striped text-center">
<thead class="thead-dark">
<tr>

<th scope="col">ΚΩΔΙΚΟΣ ΚΡΑΤΗΣΗΣ</th>
<th scope="col" class="text-left">ΟΝΟΜΑ</th>
<th scope="col" class="text-left">ΕΠΩΝΥΜΟ</th>
<th scope="col">ΗΜΕΡΟΜΗΝΙΑ ΚΡΑΤΗΣΗΣ</th>
<th scope="col">ΑΡΙΘΜΟΣ ΤΡΑΠΕΖΙΟΥ</th>
<th scope="col">ΑΡΙΘΜΟΣ ΑΤΟΜΩΝ</th>
</tr>
</thead>
<tbody>

<?php for($i=0; $i<sizeof($res_id); $i++): ?>

<tr <?php if($res_admin[$i]==1): echo "class='text-muted'"; endif; ?>>
<td><?= $res_id[$i]; ?></td>
<td class="text-left"><?= $res_fname[$i]; ?></td>
<td class="text-left"><?= $res_lname[$i]; ?></td>
<td><?= $res_date[$i]; ?></td>
<td><?= $res_table[$i]; ?></td>
<td><?= $res_people[$i]; ?></td>
</tr>

<?php endfor;  ?>

</tbody>

</table>

<?php
endif;
endif; ?>






<?php if(isset($_POST['submit_date'])):

    if(isset($err_day)): ?>

    <div class="col-md-6 offset-md-3 alert alert-danger p-2 mt-2 text-center" role="alert">
          <?= $err_day;      ?>

    </div>

  <?php   elseif(isset($none)): ?>

                <div class="col-md-6 offset-md-3 alert alert-danger p-2 mt-2 text-center" role="alert">
                      <?= $none;      ?>

                </div>

      <?php else: ?>

<table class="table table-striped text-center">
<thead class="thead-dark">
<tr>

<th scope="col">ΚΩΔΙΚΟΣ ΚΡΑΤΗΣΗΣ</th>
<th scope="col" class="text-left">ΟΝΟΜΑ</th>
<th scope="col" class="text-left">ΕΠΩΝΥΜΟ</th>
<th scope="col">ΗΜΕΡΟΜΗΝΙΑ ΚΡΑΤΗΣΗΣ</th>
<th scope="col">ΑΡΙΘΜΟΣ ΤΡΑΠΕΖΙΟΥ</th>
<th scope="col">ΑΡΙΘΜΟΣ ΑΤΟΜΩΝ</th>
</tr>
</thead>
<tbody>

<?php for($i=0; $i<sizeof($res_id); $i++): ?>

<tr <?php if($res_admin[$i]==1): echo "class='text-muted'"; endif; ?>>
<td><?= $res_id[$i]; ?></td>
<td class="text-left"><?= $res_fname[$i]; ?></td>
<td class="text-left"><?= $res_lname[$i]; ?></td>
<td><?= $res_date[$i]; ?></td>
<td><?= $res_table[$i]; ?></td>
<td><?= $res_people[$i]; ?></td>
</tr>

<?php endfor;  ?>

</tbody>

</table>

<?php
endif;
endif; ?>

</div>




<?php include('footer.php') ?>
</body>
</html>
