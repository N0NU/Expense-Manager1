<?php
$link = mysqli_connect("localhost", "root", "1234", "exp_mngr");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$ent = mysqli_real_escape_string($link, $_REQUEST['ent']);
$food = mysqli_real_escape_string($link, $_REQUEST['food']);
$veh = mysqli_real_escape_string($link, $_REQUEST['veh']);
$gro = mysqli_real_escape_string($link, $_REQUEST['gro']);
$date=  date('Y/m/d');
$sql = "INSERT INTO expense (Date, Entertainment, Food, Vehicle, Grocery) VALUES ('$date', '$ent', '$food', '$veh', '$gro')";
if(mysqli_query($link, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
}
mysqli_close($link);
?>
<html>
    <head><title>Add Expense</title>
        <link rel="stylesheet" type="text/css" href="addexp.css">
        <link href='https://fonts.googleapis.com/css?family=Mako' rel='stylesheet'>
    </head>
    <body>
        
        <div class="container">
            
            <h2>You can add your daily expenditure on entertainment, grocery, food and vehicle here.</h2><br>
            <h3>Enter the amount you spent today into the respective field</h3><br>
            <form method="POST" name="form1">
            <label>
                Entertainment </label> <br>
                <input type="number" name="ent" class="field"><br>
               
            <label>
                Food</label><br>
                <input type="number" name="food" class="field"><br>
            
            <label>
                Vehicle</label><br>
                <input type="number" name="veh" class="field"><br>
                <label>
                Grocery</label><br>
                <input type="number" name="gro" class="field"><br>
                <input type="submit" name="sub" class="btn">
            </form>
        </div>
    </body>
</html>