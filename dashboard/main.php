<?php
include '../_header.php';
?>
<div class="container" style="padding-left: 0px; padding-right: 0px;">
    <?php

    if (empty($_GET['page'])) {
        $_GET['page'] = "home";
    } else {
        include "content.php";
    }
    ?>

</div>

<footer class="footer fixed-bottom bg-light">
    <div class="row">
        <div class="col text-center">
            <a href="main.php?page=home" class="nav-link <?php echo ($_GET['page'] == 'home') ? 'active' : ''; ?>" id="home-link" style="color: <?php echo $user['theme']; ?>;">
                <i class="fa-solid fa-house"></i>
            </a>
        </div>
        <div class="col text-center">
            <a href="main.php?page=customize" class="nav-link <?php echo ($_GET['page'] == 'customize') ? 'active' : ''; ?>" id="user-link" style="color: <?php echo $user['theme']; ?>;">
                <i class="fa-solid fa-money-check-dollar"></i>
            </a>
        </div>
        <div class="col text-center">
            <a href="main.php?page=budget" class="nav-link <?php echo ($_GET['page'] == 'budget') ? 'active' : ''; ?>" id="settings-link" style="color: <?php echo $user['theme']; ?>;">
                <i class="fa-solid fa-hammer"></i>
            </a>
        </div>
        <div class="col text-center">
            <a href="main.php?page=settings" class="nav-link <?php echo ($_GET['page'] == 'settings') ? 'active' : ''; ?>" id="mail-link" style="color: <?php echo $user['theme']; ?>;">
                <i class="fa-solid fa-gear"></i>
            </a>
        </div>
        <div class="col text-center">
            <a href="main.php?page=info" class="nav-link <?php echo ($_GET['page'] == 'info') ? 'active' : ''; ?>" id="mail-link" style="color: <?php echo $user['theme']; ?>;">
                <i class="fa-solid fa-circle-info"></i>
            </a>
        </div>
        <div class="col text-center">
            <a class="nav-link" id="logout-link" style="color: <?php echo $user['theme']; ?>;"><i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </div>
</footer>

<?php
include '../_footer.php';
?>