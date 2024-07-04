<?php 
    require("script.php");
    
    if(isset($_SESSION['user'])){
        header("Location: home.php");
        exit();
    }
?>

<!DOCTYPE html>

<html>

    <head>

        <title>
            PUP
        </title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Rhabi Mendoza">

        <link rel="stylesheet" href="index.css">

        <link rel="icon" type="image/x-icon" href="res/logo.png">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">

        <?php
            if($error != null){
                ?> <style>.error{display:block}</style><?php
            }

            if($success != null){
                ?> <style>.success{display:block}</style><?php
            }
        ?>

    </head>

    <body>

        <nav>

            <div class="error">
                <?php echo $error?>
            </div>

            <div class="success">
                <?php echo $success?>
            </div>

        </nav>
        
        <main>

            <div class="main-div">

                <div class="forms-div">

                    <form class="login-form" action="" method="post">

                        <div class="form-head">
                            <img src="res/logo.png">
                            <h6>Polytechnic University of the Philippines</h6>
                        </div>  

                        <div class="form-title">
                            <h1>Log in to your account to continue</h1>
                            <p>Don't have an account?</p>
                            <a href="#" class="toggle"><b>Register here</b></a>
                        </div>

                        <div>
                            <div class="input-div">
                                <input type="email" required autocomplete="off" class="input-box" name="log-email">
                                <label>Email</label>
                            </div>
                            <div class="input-div">
                                <input type="password" required minlength="8" autocomplete="off" class="input-box" name="log-pword">
                                <label>Password</label>
                            </div>
                        </div>

                        <input type="submit" value="LOGIN" class="form-btn" name="log-btn">

                    </form>

                    <form class="register-form" action="" method="post" enctype="multipart/form-data" id="regi-form">

                        <div class="form-head">
                            <img src="res/logo.png">
                            <h6>Polytechnic University of the Philippines</h6>    
                        </div>  
             
                        <div class="form-title">
                            <h1>Register to get started</h1>
                            <p>Already have an account?</p>
                            <a href="#" class="toggle"><b>Log in here</b></a>
                        </div>

                        <div class="main-register">

                            <div class="reg-first"> 
                                <div class="input-div">
                                    <input type="text" autocomplete="off" class="input-box" name="reg-name">
                                    <label>Full Name*</label>
                                </div>
                                <div class="input-div">
                                    <p>Birthday*</p>
                                    <input type="date" name="reg-date">
                                </div>
                                <div class="input-div">
                                    <p>Gender*</p>
                                    <input type="radio" value="Female" name="reg-gen">
                                        <span>Female</span>
                                    <input type="radio" value="Male" name="reg-gen">
                                        <span>Male</span>
                                    <input type="radio" value="Prefer not to say" name="reg-gen">
                                    <span>Prefer not to say</span>        
                                </div>
                                <div class="input-div">
                                    <p>Profile Picture*</p>
                                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="reg-prof">
                                </div>
                                <div class="input-div">
                                    <input type="button" value="NEXT" class="form-btn" onclick="showSecond()">
                                </div>
                            </div>
                      
                            <div class="reg-second hidden">
                                <div class="input-div">
                                    <p>Address*</p>
                                    <select id="regionSelect" onchange="updateProvinceOptions()" name="reg-regi">
                                        <option>Select Region</option>
                                    </select>
                                    <select id="provinceSelect" name="reg-prov">
                                        <option>Select Province</option>
                                    </select>
                                </div>
                                <div class="input-div">
                                    <input type="text" autocomplete="off" class="input-box" name="reg-email">
                                    <label>Email*</label>
                                </div>
                                <div class="input-div">
                                    <input type="password" autocomplete="off" class="input-box" name="reg-pword">
                                    <label>Password*</label>
                                </div>
                                <div class="input-div">
                                    <input type="password" autocomplete="off" class="input-box" name="reg-cpword">
                                    <label>Confirm Password*</label>
                                </div>
                                <div class="input-div">
                                    <input type="button" value="BACK" class="form-btn" onclick="showFirst()">
                                    <input type="submit" value="REGISTER" class="form-btn" name="regi-btn">
                                </div>
                            </div>

                        </div>
                    
                    </form>

                </div>

                <div class="cover-div">
                    <img src="res/pup.jpg" class="image">
                </div>
             
            </div>

        </main>
     
        <script src="all.js"></script>

    </body>

</html>