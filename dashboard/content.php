<?php
if ($_GET['page'] == 'home') {
    include '1_home.php';
} elseif ($_GET['page'] == 'customize') {
    include '2_customize.php';
} elseif ($_GET['page'] == 'budget') {
    include '3_budget.php';
} elseif ($_GET['page'] == 'settings') {
    include '4_settings.php';
} elseif ($_GET['page'] == 'info') {
    include '5_info.php';
} else {
    include '404.php';
}
