<?php

session_start();

$userloginid = $_SESSION["userid"] = $_GET['userlogid'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<style>
body {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
    background-image: url('images/background_img.jpg');
}
.container {
    width: 80%;
    margin: 0 auto;
    padding-top: 20px;
}
.innerdiv {
    text-align: center;
    margin: 0 auto;
}
.logo-row {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}
.leftinnerdiv {
    float: left;
    width: 25%;
    padding-right: 10px;
    box-sizing: border-box;
}
.rightinnerdiv {
    float: right;
    width: 75%;
    padding-left: 10px;
    box-sizing: border-box;
}
.innerright {
    background-color: rgb(105, 221, 105);
    padding: 20px;
    border-radius: 10px;
    text-align: left;
}
.greenbtn {
    background-color: rgb(16, 170, 16);
    color: white;
    width: 100%;
    height: 40px;
    margin-top: 8px;
    border: none;
    border-radius: 5px;
    font-size: large;
}
.greenbtn, a {
    text-decoration: none;
    color: white;
}
th {
    background-color: orange;
    color: black;
    padding: 8px;
    border: 1px solid #ddd;
}
td {
    background-color: #fed8b1;
    color: black;
    padding: 8px;
    border: 1px solid #ddd;
}
td, a {
    color: black;
}
.imglogo {
    max-width: 100%;
    height: auto;
    display: block;
    margin-bottom: 20px;
    border-radius: 15px;
}
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding-top: 20px;
}
</style>
<body>

<?php
include("data_class.php");
?>
<div class="container">
    <div class="innerdiv">
        <div class="row"><img class="imglogo" src="images/logo_img.png"/></div>
        <div class="leftinnerdiv">
            <Button class="greenbtn" onclick="openpart('myaccount')"> MY ACCOUNT</Button>
            <Button class="greenbtn" onclick="openpart('requestbook')"> REQUEST BOOK</Button>
            <Button class="greenbtn" onclick="openpart('issuereport')"> ISSUE RECORD</Button>
            <a href="index.php"><Button class="greenbtn"> LOGOUT</Button></a>
        </div>

        <div class="rightinnerdiv">   
            <div id="myaccount" class="innerright portion" style="<?php if(!empty($_REQUEST['returnid'])){ echo 'display:none'; } else { echo ''; } ?>">
                <Button class="greenbtn">MY ACCOUNT</Button>

                <?php
                $u = new data;
                $u->setconnection();
                $u->userdetail($userloginid);
                $recordset = $u->userdetail($userloginid);
                foreach($recordset as $row) {
                    $id = $row[0];
                    $name = $row[1];
                    $email = $row[2];
                    $pass = $row[3];
                    $type = $row[4];
                }               
                ?>
                <div style="background-color: orange; width: 50%; height: 50%; padding: 10px; margin: auto; display: flex; flex-direction: column;">
    <p style="color:black"><b>Person Name:</b> <span class="float-right"><?php echo $name ?></span></p>
    <p style="color:black"><b>Person Email:</b> <span class="float-right"><?php echo $email ?></span></p>
    <p style="color:black"><b>Account Type:</b> <span class="float-right"><?php echo $type ?></span></p>
</div>

            </div>
        </div>

        <div class="rightinnerdiv">   
            <div id="issuereport" class="innerright portion" style="display:none">
                <Button class="greenbtn">ISSUE RECORD</Button>

                <?php
                $u = new data;
                $u->setconnection();
                $u->getissuebook($userloginid);
                $recordset = $u->getissuebook($userloginid);

                $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='border: 1px solid #ddd; padding: 8px;'>Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th><th>Return</th></tr>";

                foreach($recordset as $row){
                    $table.="<tr>";
                   "<td>$row[0]</td>";
                    $table.="<td>$row[2]</td>";
                    $table.="<td>$row[3]</td>";
                    $table.="<td>$row[6]</td>";
                    $table.="<td>$row[7]</td>";
                    $table.="<td>$row[8]</td>";
                    $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'><button type='button' class='btn btn-primary'>Return</button></a></td>";
                    $table.="</tr>";
                }
                $table .= "</table>";

                echo $table;
                ?>
            </div>
        </div>

        <div class="rightinnerdiv">   
            <div id="requestbook" class="innerright portion" style="<?php  if(!empty($_REQUEST['returnid'])){ $returnid=$_REQUEST['returnid'];echo "display:none";} else {echo "display:none"; }?>">
            <Button class="greenbtn" >Request Book</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->getbookissue();
            $recordset=$u->getbookissue();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr>
            <th>Image</th><th>Book Name</th><th>Book Authour</th><th>branch</th><th>price</th></th><th>Request Book</th></tr>";

            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
               $table.="<td><img src='uploads/$row[1]' width='100px' height='100px' style='border:1px solid #333333;'></td>";
               $table.="<td>$row[2]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td>$row[6]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td><a href='requestbook.php?bookid=$row[0]&userid=$userloginid'><button type='button' class='btn btn-primary'>Request Book</button></a></td>";
           
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;


                ?>

            </div>
            </div>
    </div>
</div>

<script>
function openpart(portion) {
    var i;
    var x = document.getElementsByClassName("portion");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
    }
    document.getElementById(portion).style.display = "block";  
}
</script>
</body>
</html>