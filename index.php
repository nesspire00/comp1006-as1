<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add new User</title>
    <meta charset="utf-8" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <style>
        form {
            padding: 20px;
        }
        
        h2 {
            padding: 20px;
        }
    </style>
</head>

<body>
    <!--Navigation-->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="https://github.com/nesspire00/comp1006-as1">COMP1006 - Assignment 1</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Add a New Recepient</a></li>
                <li><a href="listdeliveries.php">List Deliveries</a></li>
            </ul>
        </div>
    </nav>

    <h2>Add a New Package Delivery Recepient: </h2>

    <form action="receiveInfo.php" method="POST" class="form-vertical">
        <fieldset>

            <label class="control-label" for="fName">Name: *</label>
            <input class="form-control" type="text" name="fName" id="fName" required />
            <br />

            <label class="control-label" for="lName">Last Name: *</label>
            <input class="form-control" type="text" name="lName" id="lName" />
            <br />

            <label class="control-label" for="email">Email: </label>
            <input class="form-control" type="text" name="email" id="email" />
            <br />

        </fieldset>
        <fieldset>
            <label class="control-label" for="adress">Adress: *</label>
            <input class="form-control" type="text" name="adress" id="adress" required />
            <br />

            <label class="control-label" for="city">City: *</label>
            <input class="form-control" type="text" name="city" id="city" required />
            <br />


            <label class="control-label" for="province">Province: *</label>

            <!--DROPDOWN for provinces, from sepate table-->
            <select class="form-control" name="province" id="province">


                <?php
                //Connect to DB
                $conn = new PDO('mysql:host=sql.computerstudi.es;dbname=gc200348171', 'gc200348171', 'PASSWORD GOES HERE');

                $sql = "SELECT * FROM provinces";
                $cmd = $conn->prepare($sql);
                $cmd->execute();
                $provinces = $cmd->fetchAll();
            
                //Loop over provinces
                foreach ($provinces as $province){
                echo '<option value="'.$province['provinceAbbr'].'">'.$province['provinceAbbr'].'</option>';
            }
            //Kill connection
            $conn = null;
            ?>


            </select>
            <br />

            <label class="control-label" for="postCode">Postal Code: *</label>
            <input class="form-control" type="text" name="postCode" id="postCode" required />
            <br />
        </fieldset>

        <label class="control-label" for="type">Type of Service: *</label>
        <!--DROPDOWN for serice type (populated by separate table of values) -->
        <select class="form-control" name="type" id="type">

            <?php
            //Connect to DB
            $conn = new PDO('mysql:host=sql.computerstudi.es;dbname=gc200348171', 'gc200348171', 'PASSWORD GOES HERE');
	
            $sql = "SELECT * FROM postType";
            $cmd = $conn->prepare($sql);
            $cmd->execute();
            $types = $cmd->fetchAll();
            
            //Loop over options
            foreach ($types as $type){
                echo '<option value="'.$type['type'].'">'.$type['type'].'</option>';
            }
            //Kill connection
            $conn = null;
            ?>

        </select>
        <br />

        <button class="btn btn-success">Submit!</button>
        </div>
        </fieldset>
    </form>

    <!-- Latest   jQuery -->
    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>