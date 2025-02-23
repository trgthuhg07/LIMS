<?php
//Start the session
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');
    $_SESSION['table'] = 'users';
    $user =$_SESSION['user'];
    $users = include('database/show-users.php');
    
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/css/bootstrap-dialog.min.css" integrity="sha512-PvZCtvQ6xGBLWHcXnyHD67NTP+a+bNrToMsIdX/NUqhw+npjLDhlMZ/PhSHZN4s9NdmuumcxKHQqbHlGVqc8ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="dashboardMainContainer">
        <?php include('partials/app-sidebar.php') ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include('partials/app-topnav.php') ?>    
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <div class="row">
                        <div class="column column-5">
                            <h1 class="section_header"><i class="fa fa-plus"></i> Create User</h1>
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
                        <div class="column column-7">
                            <h1 class="section_header"><i class="fa fa-list"></i> List of Users</h1>
                            <div class="section_content">
                                <div class="users">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Created At</th>
                                                <th>Update At</th>
                                                <th>Action</th>
                                            <tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($users as $index =>$user) { ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td class="firstName"><?= $user['first_name'] ?></td>
                                                    <td class="lastName"><?= $user['last_name'] ?></td>
                                                    <td class="email"><?= $user['email'] ?></td>
                                                    <td><?= date('M d,Y 0 h:i:s A', strtotime($user['created_at'])) ?></td>
                                                    <td><?= date('M d,Y 0 h:i:s A', strtotime($user['updated_at'])) ?></td>
                                                    <td>
                                                        <a href="" class="updateUser" data-userid="<?= $user['id'] ?>"><i class="fa fa-pencil"></i> Edit</a>
                                                        <a href="" class="deleteUser" data-userid="<?= $user['id'] ?>" 
                                                        data-fname="<?= $user['first_name'] ?>" 
                                                        data-lname="<?= $user['last_name'] ?>"><i class="fa fa-trash"></i> Delete</a>
                                                    </td>
                                                </tr>
                                            <?php } ?> 
                                        </tbody>  
                                    </table>
                                    <p class="userCount"><?= count($users) ?> Users</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="js/script.js"></script>
<script src="js/jquery/iquery-3.7.1.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/js/bootstrap-dialog.js" integrity="sha512-AZ+KX5NScHcQKWBfRXlCtb+ckjKYLO1i10faHLPXtGacz34rhXU8KM4t77XXG/Oy9961AeLqB/5o0KTJfy2WiA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function script(){

        this.initialize = function(){
            this.registerEvents();
        },

        this.registerEvents = function(){
            document.addEventListener('click', function(e){
                targetElement = e.target;
                classList = targetElement.classList;



                if(classList.contains('deleteUser')){
                    e.preventDefault();
                    userId = targetElement.dataset.userid;
                    fname = targetElement.dataset.fname;
                    lname = targetElement.dataset.lname;
                    fullName = fname + ' ' + lname;

                    BootstrapDialog.confirm({
                        type: BootstrapDialog.TYPE_DANGER,
                        message: 'Bạn chắc chắn muốn xóa '+ fullName +'?',
                        callback: function(isDelete){
                            $.ajax({
                                method: 'POST',
                                data:{
                                    user_id: userId,
                                    f_name: fname,
                                    l_name: lname
                                },
                                url: 'database/delete-user.php',
                                dataType: 'json',
                                success: function(data){
                                    if(data.success){
                                        BootstrapDialog.alert({
                                            type: BootstrapDialog.TYPE_SUCCESS,
                                            message: data.message,
                                            callback: function(){
                                                location.reload();
                                            }
                                        });
                                    }
                                    else 
                                        BootstrapDialog.alert({
                                            type: BootstrapDialog.TYPE_SUCCESS,
                                            message: data.message,
                                        });
                                }
                            });  
                        }
                    });
                }
                if(classList.contains('updateUser')){
                    e.preventDefault();

                    firstName = targetElement.closest('tr').querySelector('td.firstName');
                    lastName = targetElement.closest('tr').querySelector('td.lastName');
                    email = targetElement.closest('tr').querySelector('td.email');

                    BootstrapDialog.confirm({
                        title: 'Cập nhật thông tin' + firstName + ' ' + lastName ,
                        message: '<form>\
                        <div class="form-group">\
                            <label for="firstName">Tên:</label>\
                            <input type=text" class="form-control" id="firstName" value="' + firstName +'">\
                        </div>\
                        <div class="form-group">\
                            <label for="lastName">Họ:</label>\
                            <input type="text" class="form-control" id="lastName" value="' + lastName +'">\
                        </div>\
                        <div class="form-group">\
                            <label for="email">Email:</label>\
                            <input type=email" class="form-control" id="emailUpdate" value="' + email +'">\
                        </div>\
                        </form>',
                        callback: function(isUpdate){

                            if(isUpdate){
                                $.ajax({
                                    method: 'POST',
                                    data:{
                                        userId: userId,
                                        f_name: document.getElementById('firstName').value,
                                        l_name: document.getElementById('lastName').value,
                                        email: document.getElementById('emailUpdate').value
                                    },
                                    url: 'database/update-user.php',
                                    dataType: 'json',
                                    success: function(data){
                                        if(data.success){
                                            BootstrapDialog.alert({
                                                type: BootstrapDialog.TYPE_SUCCESS,
                                                message: data.message,
                                                callback: function(){
                                                    location.reload();
                                                }
                                            });
                                        }
                                        else 
                                            BootstrapDialog.alert({
                                                type: BootstrapDialog.TYPE_SUCCESS,
                                                message: data.message,
                                            });
                                    }
                                });
                            }   
                        }
                    })
                }
            });
        }
    }

    var script = new script;
    script.initialize();
</script>
</body>
</html>