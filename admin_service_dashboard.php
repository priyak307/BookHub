<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin Dashboard</title>
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
    max-width: 1200px; /* Adjust the maximum width of the container */
    margin: 0 auto;
    padding-top: 20px;
    }
    </style>
    <body>

    <?php
   include("data_class.php");

   $msg="";

   if(!empty($_REQUEST['msg'])){
    $msg=$_REQUEST['msg'];
   }

if($msg=="done"){
    echo "<div class='alert alert-success' role='alert'>Sucssefully Done</div>";
}
elseif($msg=="fail"){
    echo "<div class='alert alert-danger' role='alert'>Fail</div>";
}

    ?>



        <div class="container">
        <div class="innerdiv">
            <div class="row"><img class="imglogo" src="images/logo_img.png"/></div>
            <div class="leftinnerdiv">
                <Button class="greenbtn" onclick="openpart('addbook')" >ADD BOOK</Button>
                <Button class="greenbtn" onclick="openpart('bookreport')" > BOOK RECORD</Button>
                <Button class="greenbtn" onclick="openpart('bookrequestapprove')"> BOOK REQUESTS</Button>
                <Button class="greenbtn" onclick="openpart('addperson')"> ADD PERSON</Button>
                <Button class="greenbtn" onclick="openpart('studentrecord')"> PERSON RECORD</Button>
                <Button class="greenbtn"  onclick="openpart('issuebook')"> ISSUE BOOK</Button>
                <Button class="greenbtn" onclick="openpart('issuebookreport')"> ISSUE REPORT</Button>
                <a href="index.php"><Button class="greenbtn" > LOGOUT</Button></a>
            </div>

            <div class="rightinnerdiv">   
            <div id="bookrequestapprove" class="innerright portion" style="display:none">
            <Button class="greenbtn" >BOOK REQUEST APPROVE</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->requestbookdata();
            $recordset=$u->requestbookdata();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Person Name</th><th>person type</th><th>Book name</th><th>Days </th><th>Approve</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
              "<td>$row[1]</td>";
              "<td>$row[2]</td>";

                $table.="<td>$row[3]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td>$row[5]</td>";
                $table.="<td>$row[6]</td>";
                $table.="<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'>Approved</a></td>";
                $table.="</tr>";
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>

            <div class="rightinnerdiv">   
    <div id="addbook" class="innerright portion" style="<?php if(!empty($_REQUEST['viewid'])){ echo 'display:none'; } else { echo ''; } ?>">
    <Button class="greenbtn" >ADD NEW BOOK</Button>
        <form action="addbookserver_page.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="bookname">Book Name:</label>
                <input type="text" class="form-control" id="bookname" name="bookname"/>
            </div>
            <div class="form-group">
                <label for="bookdetail">Detail:</label>
                <input type="text" class="form-control" id="bookdetail" name="bookdetail"/>
            </div>
            <div class="form-group">
                <label for="bookaudor">Author:</label>
                <input type="text" class="form-control" id="bookaudor" name="bookaudor"/>
            </div>
            <div class="form-group">
                <label for="bookpub">Publication:</label>
                <input type="text" class="form-control" id="bookpub" name="bookpub"/>
            </div>
            <div class="form-group">
                <label>Branch:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="branchOther" name="branch" value="other"/>
                    <label class="form-check-label" for="branchOther">Other</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="branchCSE" name="branch" value="CSE"/>
                    <label class="form-check-label" for="branchCSE">CSE</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="branchECE" name="branch" value="ECE"/>
                    <label class="form-check-label" for="branchECE">ECE</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="branchMEC" name="branch" value="MEC"/>
                    <label class="form-check-label" for="branchMEC">MEC</label>
                </div>
            </div>
            <div class="form-group">
                <label for="bookprice">Price:</label>
                <input type="number" class="form-control" id="bookprice" name="bookprice"/>
            </div>
            <div class="form-group">
                <label for="bookquantity">Quantity:</label>
                <input type="number" class="form-control" id="bookquantity" name="bookquantity"/>
            </div>
            <div class="form-group">
                <label for="bookphoto">Book Photo:</label>
                <input type="file" class="form-control-file" id="bookphoto" name="bookphoto"/>
            </div>
            <button type="submit" class="btn btn-primary">SUBMIT</button>
        </form>
    </div>
</div>


<div class="rightinnerdiv">   
    <div id="addperson" class="innerright portion" style="display:none">
    <Button class="greenbtn" >ADD PERSON</Button>
        <form action="addpersonserver_page.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="addname">Name:</label>
                <input type="text" class="form-control" id="addname" name="addname"/>
            </div>
            <div class="form-group">
                <label for="addpass">Password:</label>
                <input type="password" class="form-control" id="addpass" name="addpass"/>
            </div>
            <div class="form-group">
                <label for="addemail">Email:</label>
                <input type="email" class="form-control" id="addemail" name="addemail"/>
            </div>
            <div class="form-group">
                <label for="type">Choose type:</label>
                <select class="form-control" id="type" name="type">
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">SUBMIT</button>
        </form>
    </div>
</div>


            <div class="rightinnerdiv">   
            <div id="studentrecord" class="innerright portion" style="display:none">
            <Button class="greenbtn" >PERSON RECORD</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->userdata();
            $recordset=$u->userdata();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'> Name</th><th>Email</th><th>Type</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[1]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[4]</td>";
                $table.="</tr>";
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>

            <div class="rightinnerdiv">   
            <div id="issuebookreport" class="innerright portion" style="display:none">
            <Button class="greenbtn" >Issue Book Record</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->issuereport();
            $recordset=$u->issuereport();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Issue Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></th><th>Issue Type</th></tr>";

            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[3]</td>";
                $table.="<td>$row[6]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td>$row[8]</td>";
                $table.="<td>$row[4]</td>";
                $table.="</tr>";
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>


            <div class="rightinnerdiv">   
    <div id="issuebook" class="innerright portion" style="display:none">
    <Button class="greenbtn" >ISSUE BOOK</Button>
        <form action="issuebook_server.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="book">Choose Book:</label>
                <select class="form-control" name="book">
                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->getbookissue();
                    $recordset = $u->getbookissue();
                    foreach($recordset as $row) {
                        echo "<option value='". $row[2] ."'>" .$row[2] ."</option>";
                    }            
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="userselect">Select Student:</label>
                <select class="form-control" name="userselect">
                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->userdata();
                    $recordset = $u->userdata();
                    foreach($recordset as $row) {
                        $id = $row[0];
                        echo "<option value='". $row[1] ."'>" .$row[1] ."</option>";
                    }            
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label>Days:</label>
                <input type="number" class="form-control" name="days"/>
            </div>

            <button type="submit" class="btn btn-primary">SUBMIT</button>
        </form>
    </div>
</div>

<div class="rightinnerdiv">   
    <div id="bookdetail" class="innerright portion" style="<?php if(!empty($_REQUEST['viewid'])){ $viewid=$_REQUEST['viewid'];} else {echo "display:none"; }?>">
    <Button class="greenbtn" >BOOK DETAIL</Button>
        <br>
        <?php
        $u=new data;
        $u->setconnection();
        $u->getbookdetail($viewid);
        $recordset=$u->getbookdetail($viewid);
        foreach($recordset as $row){
            $bookid= $row[0];
            $bookimg= $row[1];
            $bookname= $row[2];
            $bookdetail= $row[3];
            $bookauthour= $row[4];
            $bookpub= $row[5];
            $branch= $row[6];
            $bookprice= $row[7];
            $bookquantity= $row[8];
            $bookava= $row[9];
            $bookrent= $row[10];
        }            
        ?>
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                <img width='200px' height='250px' style='border:1px solid #333333; margin-bottom: 20px; data-placement=top;' src="uploads/<?php echo $bookimg ?>"/>
                </div>
                <div class="col-md-6 book-detail" style="background-color: #fed8b1; padding: 10px; border-radius:10px; display: flex; flex-direction: column">
                    <p style="color:black"><b>Book Name:</b> <span class="float-right"><?php echo $bookname ?></span></p>
                    <p style="color:black"><b>Book Detail:</b> <span class="float-right"><?php echo $bookdetail ?></span></p>
                    <p style="color:black"><b>Book Author:</b> <span class="float-right"><?php echo $bookauthour ?></span></p>
                    <p style="color:black"><b>Book Publisher:</b> <span class="float-right"><?php echo $bookpub ?></span></p>
                    <p style="color:black"><b>Book Branch:</b> <span class="float-right"><?php echo $branch ?></span></p>
                    <p style="color:black"><b>Book Price:</b> <span class="float-right"><?php echo $bookprice ?></span></p>
                    <p style="color:black"><b>Book Available:</b> <span class="float-right"><?php echo $bookava ?></span></p>
                    <p style="color:black"><b>Book Rent:</b> <span class="float-right"><?php echo $bookrent ?></span></p>
                </div>
            </div>
        </div>
    </div>
</div>

            <div class="rightinnerdiv">   
            <div id="bookreport" class="innerright portion" style="display:none">
            <Button class="greenbtn" >BOOK RECORD</Button>
            <?php
            $u=new data;
            $u->setconnection();
            $u->getbook();
            $recordset=$u->getbook();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Book Name</th><th>Price</th><th>Qnt</th><th>Available</th><th>Rent</th></th><th>View</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td>$row[8]</td>";
                $table.="<td>$row[9]</td>";
                $table.="<td>$row[10]</td>";
                $table.="<td><a href='admin_service_dashboard.php?viewid=$row[0]'><button type='button' class='btn btn-primary'>View BOOK</button></a></td>";
                $table.="</tr>";
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