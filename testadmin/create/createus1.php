<?php
    require'../adminheader.php';
    require'../includes/auth_check.php';
?>

<main>

    <div class="row">

      <div class="column-33">
      </div>

      <div class="column-33">
        <div class="contactcard" style="margin:50px; width:400px">
                    <div class="cardcontainer" style="text-align:center">

                        <h1 style="color:#00dddd"><b>Do You Wish To Create This User?</b></h1>



                            <form action="../includes/create.inc.php" method="post">

                              <?php

                                if (isset($_POST['createus-submit'])) {

                                  require'../includes/dbh.inc.php';

                                  $fname = $_POST['fname'];
                                  $sname = $_POST['sname'];
                                  $email = $_POST['email'];
                                  $phone = $_POST['phone'];
                                  $bodyshop = $_POST['bodyshop'];
                                  $pwd = $_POST['pwd'];

                                  if(empty($fname) || empty($sname) || empty($email) || empty($phone) || empty($bodyshop) || empty($pwd)){
                                    header("Location: ../create/createus.php?error=emptyfields");
                                    exit();
                                  }

                                  else{

                                    $sql = "SELECT * FROM customer WHERE bodyshopId=".$bodyshop.";";
                                    $result = mysqli_query($conn, $sql);
                                    $resultCheck = mysqli_num_rows($result);

                                        if ($resultCheck > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {

                                            $bodyshop = $row['bodyshop'];
                                            $id = $row['bodyshopId'];


                                  echo '
                                <label style="color:#00dddd">First Name</label><br>
                                <a><input type="text" name="fname" value="'.$fname.'"readonly/></a>
                                    <br>
                                <label style="color:#00dddd">Second Name</label><br>
                                <a><input type="text" name="sname" value="'.$sname.'"readonly/></a>
                                    <br>
                                <label style="color:#00dddd">Email</label><br>
                                <a><input type="text" name="email" value="'.$email.'"readonly/></a>
                                    <br>
                                <label style="color:#00dddd">Phone</label><br>
                                <a><input type="text" name="phone" value="'.$phone.'"readonly/></a>
                                    <br>
                                <label style="color:#00dddd">Bodyshop</label><br>
                                <a><input type="text" name="bodyshop" value="'.$bodyshop.'"readonly/></a>
                                    <br>
                                <label style="color:#00dddd">Bodyshop ID</label><br>
                                <a><input type="text" name="idbs" value="'.$id.'"readonly/></a>
                                    <br>
                                <label style="color:#00dddd">Password</label><br>
                                <a><input type="text" name="pwd" value="'.$pwd.'"readonly/></a>

                                        <br><br>
                                <button class="btn5 vda" type="submit" name="createus1-submit" style="width:25%">Register</button>';
                              }
                            }
                        }
                              }
                              ?>

                            </form>
                          </div>

                    </div>
                </div>
    <br><br><br>

    <div class="column-33">
    </div>

        </div>


</main>
