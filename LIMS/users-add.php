<?php
//Start the session
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');
    $_SESSION['table'] = 'users';
    $user =$_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIMS-Dashboard</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/login.css"> -->
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <!-- <script src="https://use.fontawesome.com/0c7a3095b5.js"></script> -->
</head>
<body>
    <div id="dashboardMainContainer">
        <?php include('partials/app-sidebar.php') ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include('partials/app-topnav.php') ?>    
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <div id="userAddFormContainer">  
                        <form action="database/add.php" method="POST" class="appForm">
                            <div class="appFormInputContainer">
                                <label for="first_name">First Name</label>
                                <input type="text" class="appFormInput" id="first_name" name="first_name" />
                            </div>
                            <div class="appFormInputContainer">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="appFormInput" id="last_name" name="last_name" />
                            </div>
                            <div class="appFormInputContainer">
                                <label for="email">Email</label>
                                <input type="text" class="appFormInput" id="email" name="email" />
                            </div>
                            <div class="appFormInputContainer">
                                <label for="password">Password</label>
                                <input type="password" class="appFormInput" id="password" name="password" />
                            </div>
                            
                            <button type="submit" class="appBtn"><i class="fa fa-plus"></i>Add User</button>
                        </form>
                        <?php 
                            if(isset($_SESSION['response'])) { 
                            $response_message = $_SESSION['response']['message'];
                            $is_success = $_SESSION['response']['success'];

                        ?>
                            <div class="responseMessage">
                                <p class="responseMessage <?= $is_success ? 'responseMessage__success' : 'responseMessage__error' ?>">
                                    <?= $response_message ?>
                                </p>
                            </div>
                        <?php unset($_SESSION['response']); }  ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="js/script.js"></script>
</body>
</html>