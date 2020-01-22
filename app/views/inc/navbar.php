<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- stylesheet -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700|Permanent+Marker&display=swap" rel="stylesheet">
    <!-- icons -->
    <script src="https://kit.fontawesome.com/3b4174c44f.js"></script>
    <title><?php echo SITENAME; ?></title>
</head>
<!--<body>-->
<?php //if(isset($_GET['submission'])): ?>
<!--    <div class='flash-message'>-->
<!--        <p><i class="fas fa-check-circle"></i> You have successfully made an appointment.</p>-->
<!--    </div>-->
<?php //endif; ?>
<?php //if(isset($_GET['update'])): ?>
<!--    <div class='flash-message'>-->
<!--        <p><i class="fas fa-check-circle"></i> You have successfully updated an appointment.</p>-->
<!--    </div>-->
<?php //endif; ?>
<nav>
    <div class="container">
        <div>
            <a href="/"><i class="fas fa-car"></i> Car Workshop</a>
        </div>


        <?php if(isset($_SESSION['admin_name'])): ?>
            <div class="dropdown">
                <button class="dropbtn"><i class="fas fa-user-secret"></i> <?php echo $_SESSION['admin_name']; ?> </button>
                <div class="dropdown-content">
                    <a href="/admin/dashboard">Dashboard</a>
                    <a href="/admin/logout">Logout</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

</nav>
<!--    -->
