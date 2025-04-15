<!DOCTYPE html>  
<html>  
<head>  
<style>  
.error {color: #FF0001;}  
</style>  
</head>  
<body>    

<?php  
$nameErr = $emailErr = $mobilenoErr = $genderErr = $websiteErr = $agreeErr = "";  
$name = $email = $mobileno = $gender = $website = $agree = "";  


//empty string
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    if (empty($_POST["name"])) {  
        $nameErr = "Name is required";  
    } else {  
        $name = input_data($_POST["name"]);  


//validate string
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {  
            $nameErr = "Only alphabets and white space are allowed";  
        }  
    }  


//validate email
    if (empty($_POST["email"])) {  
        $emailErr = "Email is required";  
    } else {  
        $email = input_data($_POST["email"]);  
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
            $emailErr = "Invalid email format";  
        }  
     }  


//validate numbers
    if (empty($_POST["mobileno"])) {  
        $mobilenoErr = "Mobile no is required";  
    } else {  
        $mobileno = input_data($_POST["mobileno"]); 

//input length 
        if (!preg_match ("/^[0-9]*$/", $mobileno)) {  
            $mobilenoErr = "Only numeric value is allowed.";  
        }  
        if (strlen($mobileno) != 10) {  
            $mobilenoErr = "Mobile no must contain 10 digits.";  
        }  
    }  


//validate url
    if (empty($_POST["website"])) {  
        $website = "";  
    } else {  
        $website = input_data($_POST["website"]);  
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=_|!:,.;]*[-a-z0-9+&@#\/%=_|]/i", $website)) {  
            $websiteErr = "Invalid URL";  
        }      
    }  

//gender
    if (empty($_POST["gender"])) {  
        $genderErr = "Gender is required";  
    } else {  
        $gender = input_data($_POST["gender"]);  
    }  


//terms and conditions
    if (!isset($_POST['agree'])) {  
        $agreeErr = "Accept terms of services before submit.";  
    } else {  
        $agree = input_data($_POST["agree"]);  
    }  
}  

function input_data($data) {  
    $data = trim($data);  
    $data = stripslashes($data);  
    $data = htmlspecialchars($data);  
    return $data;  
}  
?>  

<h2>Registration Form</h2>  
<span class="error">* required field </span>  
<br><br>  
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >    
    Name:   
    <input type="text" name="name" required>  
    <span class="error">* <?php echo $nameErr; ?> </span>  
    <br><br>  
    E-mail:   
    <input type="email" name="email" required>  
    <span class="error">* <?php echo $emailErr; ?> </span>  
    <br><br>  
    Mobile No:   
    <input type="text" name="mobileno" required>  
    <span class="error">* <?php echo $mobilenoErr; ?> </span>  
    <br><br>  
    Website:   
    <input type="url" name="website">  
    <span class="error"><?php echo $websiteErr; ?> </span>  
    <br><br>  
    Gender:  
    <input type="radio" name="gender" value="male" required> Male  
    <input type="radio" name="gender" value="female" required> Female  
    <input type="radio" name="gender" value="other" required> Other  
    <span class="error">* <?php echo $genderErr; ?> </span>  
    <br><br>  
    Agree to Terms of Service:  
    <input type="checkbox" name="agree" required>  
    <span class="error">* <?php echo $agreeErr; ?> </span>  
    <br><br>                            
    <input type="submit" name="submit" value="Submit">   
    <br><br>                             
</form>  

<?php  
    if(isset($_POST['submit'])) {  
        if($nameErr == "" && $emailErr == "" && $mobilenoErr == "" && $genderErr == "" && $websiteErr == "" && $agreeErr == "") {  
            echo "<h3 style='color: #FF0001'> <b>You have successfully registered.</b> </h3>"; 
            echo "<h2>Your Input:</h2>";  
            echo "Name: " .$name;  
            echo "<br>";  
            echo "Email: " .$email;  
            echo "<br>";  
            echo "Mobile No: " .$mobileno;  
            echo "<br>";  
            echo "Website: " .$website;  
            echo "<br>";  
            echo "Gender: " .$gender;  
        } else {  
            echo "<h3> <b>You didn't fill up the form correctly.</b> </h3>";  
        }  
    }  
?>  

</body>  
</html>