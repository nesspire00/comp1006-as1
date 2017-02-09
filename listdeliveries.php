<!DOCTYPE html>
<html lang="en">

<head>
    <title>List Deliveries</title>
    <meta charset="utf-8" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <style>
        h2 {
            padding: 20px;
        }
    </style>
</head>

<body>

    <!-- Navigation -->

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="https://github.com/nesspire00/comp1006-as1">COMP1006 - Assignment 1</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php">Add a New Recepient</a></li>
                <li class="active"><a href="listdeliveries.php">List Deliveries</a></li>
            </ul>
        </div>
    </nav>

    <h2>Current scheduled deliveries: </h2>

    <?php
        //TYPE:host=HOST;dbname=NAME', 'USERNAME', 'PASSWORD'
        $conn = new PDO('mysql:host=sql.computerstudi.es;dbname=gc200348171', 'gc200348171', 'PASSWORD GOES HERE');
        
        $sql = "SELECT * FROM postalService ORDER BY idNum DESC";
        $cmd = $conn->prepare($sql);
        $cmd->execute();
        $recepients = $cmd->fetchAll();
    
    
        //Build table header
        echo '<table class="table table-striped table-hover"><tr><th>#</th><th>Name</th><th>Email</th><th>Adress</th><th>Service Type</tr>';
    
        //Fill table with data
        foreach ($recepients as $person){
            echo '<tr><td>' . $person['idNum'] . '</td><td>' . $person['fName'] . " " . $person['lName'] . '</td><td>' . $person['email'] . '</td><td>' . $person['adress'] . ", " . $person['city'] . ", " . $person['province'] . " " . $person['postCode'] .'</td><td>' . $person['type'] . '</td></tr>';
        }
        echo '</table>';
    
        // Kill connection
        $conn = null;
    ?>



        <!-- Latest   jQuery -->
        <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>