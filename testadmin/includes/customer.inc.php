<?php

function createDir() {

  require'dbh.inc.php';

  $idBodyshop = $_GET['bsid'];

  $sql = "SELECT * FROM customer WHERE bodyshopId=".$idBodyshop.";";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);

  if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

      $custBsid = $row['bodyshopId'];
      $custBs = $row['bodyshop'];

      if (!file_exists('../../member/clients/'.$custBsid.'_'.$custBs)) {
          echo '<option value="parent">Parent Directory</option>';
      }

      if (!file_exists('../../member/clients/'.$custBsid.'_'.$custBs.'/'.$custBsid.'_safety')) {
          echo '<option value="safety">Health & Safety</option>';
      }

      if (!file_exists('../../member/clients/'.$custBsid.'_'.$custBs.'/'.$custBsid.'_jobdesc')) {
          echo '<option value="jobdesc">Job Description</option>';
      }

      }
    }
  }

function jobDesc(){
  require'dbh.inc.php';

  $idBodyshop = $_GET['bsid'];

  $sql = "SELECT * FROM customer WHERE bodyshopId=".$idBodyshop.";";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);

  if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

      $custBsid = $row['bodyshopId'];
      $custBs = $row['bodyshop'];

      if (file_exists('../../member/clients/'.$custBsid.'_'.$custBs.'/'.$custBsid.'_jobdesc')) {

        $uploads = scandir('../../member/clients/'.$custBsid.'_'.$custBs.'/'.$custBsid.'_jobdesc');
        $forbiddenChars = array(".", "_");

        foreach($uploads as $uploads){
         $firstChar = substr($uploads, 0, 1);
         if(in_array($firstChar, $forbiddenChars)){
          continue;
         }

            echo '<br><a href="../../member/clients/'.$custBsid.'_'.$custBs.'/'.$custBsid.'_jobdesc/'.$uploads.'"><button class="btn88 cl8">'.substr($uploads, 0).'</button></a><br/><br/>';
        }
      }

      }
    }
}

function custDet() {

    $bsid = $_GET['bsid'];
    $bs = $_GET['bs'];

    echo $bsid.'_'.$bs;

}

require'dbh.inc.php';
if (isset($_GET['bsid'])) {

    $idBodyshop = $_GET['bsid'];

    $sql = "SELECT * FROM customer WHERE bodyshopId=".$idBodyshop.";";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
      while ($row = mysqli_fetch_assoc($result)) {

        $custBsid = $row['bodyshopId'];
        $custBs = $row['bodyshop'];
        $custSt = $row['street'];
        $custTn = $row['town'];
        $custCo = $row['county'];
        $custPc = $row['postcode'];
        $custPh = $row['phone'];

        }
      }
    }

if (isset($_POST['upload-submit'])) {

  $bsid = $_GET['bsid'];
  $bs = $_GET['bs'];


  $target_dir = "../../member/clients/".$bsid."_".$bs."/".$bsid."_jobdesc/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["file"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" && $imageFileType != "pdf") {
    echo "Sorry, only PDF, JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
      echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
      header('Location: ../admin.php?success=uploadsuccess');
    }
    else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

}
