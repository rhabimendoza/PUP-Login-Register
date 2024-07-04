<?php

    session_start();

    $error = null;
    $success = null;

    $conn = mysqli_connect('localhost', 'root', '', 'pup');

    function encrypt($input) {
        $salt = "aB$2pQ@9!z";
        $output = '';
        
        $alphabet_lower = range('a', 'z');
        $shifted_alphabet_lower = array_merge(array_slice($alphabet_lower, -3), array_slice($alphabet_lower, 0, -3));
        
        $alphabet_upper = range('A', 'Z');
        $shifted_alphabet_upper = array_merge(array_slice($alphabet_upper, -3), array_slice($alphabet_upper, 0, -3));
        
        foreach (str_split($input) as $char) {
            if (ctype_lower($char)) {
                $index = array_search($char, $alphabet_lower);
                $output .= $shifted_alphabet_lower[$index];
            } elseif (ctype_upper($char)) {
                $index = array_search($char, $alphabet_upper);
                $output .= $shifted_alphabet_upper[$index];
            } else {
                $output .= $char;
            }
        }

        $output .= $salt;
        
        return $output;
    }    
    
    function decrypt($input) {
        $salt = "aB$2pQ@9!z"; 
        $output = '';
        
        $input = str_replace($salt, '', $input);
        
        $alphabet_lower = range('a', 'z');
        $shifted_alphabet_lower = array_merge(array_slice($alphabet_lower, -3), array_slice($alphabet_lower, 0, -3));
        
        $alphabet_upper = range('A', 'Z');
        $shifted_alphabet_upper = array_merge(array_slice($alphabet_upper, -3), array_slice($alphabet_upper, 0, -3));
        
        foreach (str_split($input) as $char) {
            if (ctype_lower($char)) {
                $index = array_search($char, $shifted_alphabet_lower);
                $output .= $alphabet_lower[$index];
            } elseif (ctype_upper($char)) {
                $index = array_search($char, $shifted_alphabet_upper);
                $output .= $alphabet_upper[$index];
            } else {
                $output .= $char;
            }
        }
        
        return $output;
    }
    
    
    if(isset($_POST['regi-btn'])){
        $name = trim($_POST['reg-name']);
        $birthday = trim($_POST['reg-date']);
        $gender = trim($_POST['reg-gen']);
        $region = trim($_POST['reg-regi']);
        $province = trim($_POST['reg-prov']);
        $email = trim($_POST['reg-email']);
        $pword = trim($_POST['reg-pword']);
        
        $encrypted_email = encrypt($email);
        $encrypted_pword = encrypt($pword);
        
        $check_query = "SELECT * FROM users WHERE email = '$encrypted_email'";
        $result = mysqli_query($conn, $check_query);
        
        if(mysqli_num_rows($result) > 0){
            $error = "Email already used.";
        } else {
            $image = $_FILES['reg-prof']['tmp_name'];
            $imgType = $_FILES['reg-prof']['type'];
            $imgContent = addslashes(file_get_contents($image));
    
            $query = "INSERT INTO users (email, name, pword, birthday, gender, region, province, type, image) 
                      VALUES ('$encrypted_email', '$name', '$encrypted_pword', '$birthday', '$gender', '$region', '$province', '$imgType', '$imgContent')";
            
            if(mysqli_query($conn, $query)){
                $success = "Account successfully created.";
            } else {
                $error = "Error: " . mysqli_error($conn);
            }
        }
    }
    
    if(isset($_POST['log-btn'])){
        $email = trim($_POST['log-email']);
        $pword = trim($_POST['log-pword']);
        
        $query = "SELECT * FROM users";
        $result = mysqli_query($conn, $query);
    
        $user_found = false;
        while($user = mysqli_fetch_assoc($result)) {
            $decrypted_email = decrypt($user['email']);
            $decrypted_pword = decrypt($user['pword']);
            
            if($decrypted_email == $email && $decrypted_pword == $pword) {
                $user_found = true;
            
                $_SESSION['user'] = [
                  
                    'email' => $email,
                    'name' => $user['name'],
                    'birthday' => $user['birthday'],
                    'gender' => $user['gender'],
                    'region' => $user['region'],
                    'province' => $user['province'],
                    'image' => $user['image'],
                    'type' => $user['type'],
                    'pword' => $pword
                ];
                
                header("Location: home.php");
                exit();
            }
        }
    
        if (!$user_found) {
            $error = "Invalid email or password.";
        }
    }
    
?>