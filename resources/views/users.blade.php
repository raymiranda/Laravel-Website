<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $emailErr = $addressErr = "";
$cityErr = $stateErr = $zipErr = $addressErr = "";
$companyFieldErr = "";
    
$firstName = $lastName = $email = $city = "";
$state = $zip = $address1 = $address2 = "";
$companyName = $companyAddress = $companyCity = "";
$companyState = $companyZip = $companyNumber = "";
$phonePart1 = $phonePart2 = $phonePart3 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["firstName"])) {
        $nameErr = "First name is required";
    } else {
        $firstName = test_input($_POST["firstName"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
            $nameErr = "Only letters and white space allowed"; 
        }
    }
    
    if (empty($_POST["lastName"])) {
        $nameErr = "Last name is required";
    } else {
        $lastName = test_input($_POST["lastName"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
            $nameErr = "Only letters and white space allowed"; 
        }
    }
    
    if (empty($_POST["address1"])) {
        $addressErr = "Address is required";
    } else {
        $address1 = $_POST["address1"];
    }
    
    //Not required and will default to empty string
    $address2 = $_POST["address2"];
  
    if (empty($_POST["city"])) {
        $cityErr = "Address is required";
    } else {
        $city = $_POST["city"];
    }
    
    if (empty($_POST["state"])) {
        $stateErr = "Address is required";
    } else {
        $state = test_input($_POST["state"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
            $stateErr = "Only letters and white space allowed"; 
        }
    }

    if (empty($_POST["zip"])) {
        $zipErr = "Address is required";
    } else {
        $zip = $_POST["zip"];
    }
    
    if (empty($_POST["companyName"])) {
        $companyFieldErr = "All company info required!";
    } else {
        $companyName = $_POST["companyName"];
    }
  
    if (empty($_POST["companyAddress"])) {
        $companyFieldErr = "All company info required!";
    } else {
        $companyAddress = $_POST["companyAddress"];
    }
    
    if (empty($_POST["companyCity"])) {
        $companyFieldErr = "All company info required!";
    } else {
        $companyCity = $_POST["companyCity"];
    }

    if (empty($_POST["companyState"])) {
        $companyFieldErr = "All company info required!";
    } else {
        $companystate = $_POST["companyState"];
    }
  
    if (empty($_POST["companyZip"])) {
        $companyFieldErr = "All company info required!";
    } else {
        $companyNumber = $_POST["companyZip"];
    }
    
    if (empty($_POST["phonePart1"])||empty($_POST["phonePart2"])||empty($_POST["phonePart3"])) {
    $companyFieldErr = "All company info required!";
    } else {
        $companyNumber = $_POST["phonePart1"]+$_POST["phonePart2"]+$_POST["phonePart3"];
    }
  
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format"; 
        }
    }
    
    //Start of File upload section
    $target_dir = 'C:\wamp64\www\intern-project\resources';
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an pdf - " . $check["mime"] . ".";
            $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
    }
    /*****Assume that pdf may need to be updated...******
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    */
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "pdf") {
        echo "Sorry, only .pdf files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    
    
    //****Google Captcha***
    require_once('recaptchalib.php');
    $privatekey = "6LeQGSAUAAAAALp-IATqIZG1EfU8R88LqNEIHken";
    $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

    if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
         "(reCAPTCHA said: " . $resp->error . ")");
    } else { // successful verification
        //***Build json object***
        $jsonObject->firstName = $firstName; 
        $jsonObject->lastName = $lastName;
        $jsonObject->email = $email;
        $jsonObject->city = $city;
        $jsonObject->state = $state; 
        $jsonObject->zip = $zip; 
        $jsonObject->address1 = $address1; 
        $jsonObject->address2 = $address2; 
        $jsonObject->companyName = $companyName; 
        $jsonObject->companyAddress = $companyAddress; 
        $jsonObject->companyCity = $companyCity; 
        $jsonObject->companyState= $companyState; 
        $jsonObject->company = $companyZip; 
        $jsonObject->company = $companyNumber;
        //***Create json file of the data***
        File::put('C:\wamp64\www\intern-project\resources'+$companyName+'.json',$jsonObject);
        File::put('C:\wamp64\www\intern-project\resources'+$companyName+'.pdf',$target_file);

        //Redirect user
        header("Location: localhost:8000/"); /* Redirect browser */
        exit();
    }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<h2>User Information:</h2>
<p><span class="error">* required field.</span></p>
<form action="form_handler.php" method="GET">  
    First Name: <input type="text" name="firstName" value="<?php echo $firstName;?>">
    <span class="error">* <?php echo $firstName;?></span><br>
    Last Name: <input type="text" name="lastName" value="<?php echo $lastName;?>">
    <span class="error">* <?php echo $lastName;?></span><br>
    E-mail: <input type="text" name="email" value="<?php echo $email;?>"size=30>
    <span class="error">* <?php echo $email;?></span><br>
    Address1: <input type="text" name="address1" value="<?php echo $address1;?>" size=30>
    <span class="error">* <?php echo $address1;?></span><br>
    Address2: <input type="text" name="address2" value="<?php echo $address2;?>"size=30><br>
    City: <input type="text" name="city" value="<?php echo $city;?>">
    <span class="error">* <?php echo $city;?></span><br>
    State: <input type="text" name="state" value="<?php echo $state;?>">
    <span class="error">* <?php echo $state;?></span><br>
    Zip: <input type="text" name="zip" value="<?php echo $zip;?>" size=5 maxlength="5">
    <span class="error">* <?php echo $zip;?></span><br>
    Company Name: <input type="text" name="companyName" value="<?php echo $companyName;?>">
    <span class="error">* <?php echo $companyName;?></span><br>
    Company Address: <input type="text" name="companyAddress" value="<?php echo $companyAddress;?>" size=30>
    <span class="error">* <?php echo $companyAddress;?></span><br>
    Company City: <input type="text" name="companyCity" value="<?php echo $companyCity;?>">
    <span class="error">* <?php echo $companyCity;?></span><br>
    Company State: <input type="text" name="companyState" value="<?php echo $companyState;?>">
    <span class="error">* <?php echo $companyState;?></span><br>
    Company Zip: <input type="text" name="companyZip" value="<?php echo $companyZip;?>" size=5 maxlength="5">
    <span class="error">* <?php echo $companyZip;?></span><br>
    
    Company Phone Number: ( <input type="text" name="phonePart1" value="<?php echo $phonePart1;?>" size=1 maxlength="3">
    ) <input type="text" name="phonePart2" value="<?php echo $phonePart2;?>"size=1 maxlength="3">
    - <input type="text" name="phonePart3" value="<?php echo $phonePart3;?>"size=1 maxlength="4">
    <span class="error">* <?php echo $companyNumber;?></span><br>
    Select PDF to upload:<input type="file" name="fileToUpload" id="fileToUpload" value = "<?php echo $phonePart3;?>"><br>
    <?php
          require_once('C:\wamp64\www\intern-project\resources\views\recaptchalib.php');
          $publickey = "6LeQGSAUAAAAAIavQX0R6JnW7aTlEZSgYAHUnVhK";
          echo recaptcha_get_html($publickey);
    ?>
  <input type="submit" name="submit" value="Register">  
</form>
</body>
</html>