<?php
if ($_GET['page'] == 'login') {
    include 'login.php';
} elseif ($_GET['page'] == 'register') {
    include 'register.php';
} elseif ($_GET['page'] == 'reset') {
    include 'reset.php';
} else {
    include 'login.php';
}
