<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white">
  <div class="container">
  <a class="navbar-brand" href="index.php"><img src="images/logo.png" width="180" alt=""/></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto mr-auto">
      <li class="nav-item <?php if ($active=='index') { echo "active"; } ?>">
        <a class="nav-link" href="index.php">Αρχική <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item dropdown <?php if (($active=='login') || ($active=='register')) { echo "active"; } ?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Λογαριασμός
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <?php  if(isset($_SESSION['admin'])): ?>
                <a class="dropdown-item" href="logout.php">Log out</a>
          <?php  else: ?>
          <a class="dropdown-item" href="login.php">Log in</a>
          <a class="dropdown-item" href="register.php">Register</a>
        <?php  endif; ?>

        </div>
      </li>

    <?php  if(isset($_SESSION['admin']) && $_SESSION['admin']==0): ?>
  	<li class="nav-item dropdown <?php if (($active=='reservation') || ($active=='history')) { echo "active"; } ?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Κρατήσεις
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="reservation.php">Νέα κράτηση</a>
          <a class="dropdown-item" href="history.php">Παλιές κρατήσεις</a>
        </div>
      </li>

    <?php elseif(isset($_SESSION['admin']) && $_SESSION['admin']==1): ?>
      <li class="nav-item dropdown <?php if (($active=='dashboard') || ($active=='management')) { echo "active"; } ?>">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Διαχείριση
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="dashboard.php">Κατάσταση κρατήσεων</a>
            <a class="dropdown-item" href="tab_management.php">Διαχείριση τραπεζιών</a>
            <a class="dropdown-item" href="date_management.php">Διαχείριση ωραρίου</a>
            <a class="dropdown-item" href="admin_reservations.php">Κρατήσεις διαχειριστή</a>
          </div>
        </li>
    <?php  endif; ?>


      <?php if(isset($_SESSION['admin'])): ?>
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="LogoutDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?= $_SESSION['fname']; ?>&nbsp;<?= $_SESSION['lname']; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="LogoutDropdown">
              <a class="dropdown-item" href="logout.php">Log out</a>

            </div>
          </li>
    <?php endif; ?>
    </ul>
  </div>
  </div>
</nav>
