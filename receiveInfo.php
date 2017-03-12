<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Processing input...</title>
    <meta charset="utf-8" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <style>
        h2 {
            padding: 20px;
            color: green;
        }
        
        p {
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <!-- Nav -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">COMP1006 - Lab 3 (Assignment 1)</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php">Add a New Recepient</a></li>
                <li><a href="listdeliveries.php">List Deliveries</a></li>
            </ul>
        </div>
    </nav>

    <?php
        try{
            //Gathering the variables
            $fName = $_POST['fName'];
            $lName = $_POST['lName'];
            $email = $_POST['email'];
            $adress = $_POST['adress'];
            $city = $_POST['city'];
            $province = $_POST['province'];
            $postCode = $_POST['postCode'];
            $type = $_POST['type'];

            $ok = true;

            //VALIDATE BEGIN (Mostly check if empty)

            if(empty($fName)){
                $ok = false;
                echo '<p>You must include your first name! </p>';
            }
            if(empty($lName)){
                $ok = false;
                echo '<p>You must include your last name! </p>';
            }
    
            //Email is not nessesary for this form, changing the empty string to be "N/A" without triggering the error state
            if(empty($email)){
                $email = 'N/A';
            }

            if(empty($adress)){
                $ok = false;
                echo '<p>You must include the street adress! </p>';
            }

            if(empty($city)){
                $ok = false;
                echo '<p>You must include the city name! </p>';
            }

            if(empty($province)){
                $ok = false;
                echo '<p>There was an issue with the province dropdown list! </p>';
            }
    
            //Province cannot have more than 2 characters, this enforces that
            if(strlen($province) > 2){
                $ok = false;
                echo '<p>Province value is more than 2 chars long! </p>';
            }

            if(empty($postCode)){
                $ok = false;
                echo '<p>You must include the postal code! </p>';
            }
            
            //Same with postal code, no more than 6 characters, making sure that doesnt happen
            if(strlen($postCode) > 6){
                $ok = false;
                echo '<p>Postal Code value is more than 6 chars long! </p>';
            }

            if(empty($type)){
                $ok = false;
                echo '<p>There was an issue with the type dropdown list! </p>';
            }

            //When everything is ok: 
            if($ok){

            //connect to db
            require_once ('db.php');

            $sql = "INSERT INTO postalService (fName, lName, email, adress, city, province, postCode, type) VALUES (:fName, :lName, :email, :adress, :city, :province, :postCode, :type);";

            $cmd = $conn->prepare($sql);
            $cmd -> bindParam(':fName', $fName, PDO::PARAM_STR, 50);
            $cmd -> bindParam(':lName', $lName, PDO::PARAM_STR, 50);
            $cmd -> bindParam(':email', $email, PDO::PARAM_STR, 50);
            $cmd -> bindParam(':adress', $adress, PDO::PARAM_STR, 100);
            $cmd -> bindParam(':city', $city, PDO::PARAM_STR, 50);
            $cmd -> bindParam(':province', $province, PDO::PARAM_STR, 2);
            $cmd -> bindParam(':postCode', $postCode, PDO::PARAM_STR, 6);
            $cmd -> bindParam(':type', $type, PDO::PARAM_STR, 20);


            $cmd->execute();
            
            //The success message
            echo '<h2>The Record has been successfully added!</h4>
                        <p>No errors were encountered!</p>';

            //Kill connection variable
            $conn = null;
            } else{
                //The 'you failed' message
                echo '<h2 style="color: red;">The record was not added! </h4>
                        <p>Please recheck your inputs!</p>';
            }
        }
        //catch the error, send me an email and redirect user to the error page
        catch(exception $e){
            mail('nesspire00@gmail.com', 'Error on the website', $e);
            header('location:error.php');
        }
    ?>


        <!-- Latest   jQuery -->
        <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>
<?php ob_flush(); ?>