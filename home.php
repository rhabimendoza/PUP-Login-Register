<?php 
    require("script.php");

    if(!isset($_SESSION['user'])){
        header("Location: index.php");
        exit();
    }
    
    $user = $_SESSION['user'];    
?>

<!DOCTYPE html>

<html>

    <head>

        <title>
            PUP
        </title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Rhabi Mendoza">

        <link rel="stylesheet" href="home.css">

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

        <section>

            <div class="info-page-div">

                <h2>Welcome back, <?php echo htmlspecialchars($user['name']);?>!</h2>
            
                <form class="update-form">
        
                    <div class="update-profile">
                        <img src="data:<?php echo $user['type']; ?>;base64,<?php echo base64_encode($user['image']);?>">
                        <p><a href="logout.php">LOGOUT</a></p>
                    </div>

                    <div class="update-input">
                        
                        <div class="input-div">
                            <p>Email</p>
                            <input type="email" readonly class="input-box" value="<?php echo htmlspecialchars($user['email']);?>">
                        </div>

                        <div class="input-div">
                            <p>Full Name</p>
                            <input type="text" readonly class="input-box" value="<?php echo htmlspecialchars($user['name']);?>">
                        </div>

                        <div class="input-div">
                            <p>Birthday</p>
                            <input type="date" readonly value="<?php echo htmlspecialchars($user['birthday']);?>">
                        </div>

                        <div class="input-div">
                            <p>Gender</p>
                            <input type="radio" disabled <?php if($user['gender'] == "Female") echo "checked";?>>
                            <span>Female</span>
                            <input type="radio" disabled <?php if($user['gender'] == "Male") echo "checked";?>>
                            <span>Male</span>
                            <input type="radio" disabled <?php if($user['gender'] == "Prefer not to say") echo "checked";?>>
                            <span>Prefer not to say</span>  
                        </div>

                        <div class="input-div">
                            <p>Address</p>
                            <p>Region</p>
                            <select id="regionSelect" disabled>
                                <option><?php echo htmlspecialchars($user['region']);?></option>
                            </select>
                            <p>Province</p>
                            <select id="provinceSelect" disabled>
                                <option><?php echo htmlspecialchars($user['province']);?></option>
                            </select>
                        </div>

                        <div class="input-div">
                            <p>Password</p>
                            <input type="text" readonly class="input-box" value="<?php echo htmlspecialchars($user['pword']);?>">
                        </div>
                        
                    </div>

                </form>

            </div>

        </section>

    </body>

</html>