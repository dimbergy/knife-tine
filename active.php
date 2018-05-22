<?php
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = $components[2];
$comp = explode('.', $page);
$active = $comp[0];

switch($active) {

	case 'index' : $title = 'Αρχική';
		break;
	case 'login' : $title = 'Log In';
		break;
	case 'register' : $title = 'Register';
		break;
	case 'reservation' : $title = 'Νέα κράτηση';
		break;
	case 'dashboard' : $title = 'Κατάσταση κρατήσεων';
			break;
	case 'management' : $title = 'Διαχείριση κρατήσεων';
				break;
	default : $title = 'Παλιές κρατήσεις';

}

?>
