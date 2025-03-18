<?php 
include("header.php");

if (!isset($_SESSION['userId'])) {

?>

	<div class="alert alert-primary" role="alert">
        Sindetheite gia na deite afti tin selida
        <a href="/login.php" class="btn btn-outline-success">Σύνδεση</a>
    </div>

<?php

}else{

	if (isset($_POST['profileUpdBtn'])) {
		$title = $_POST['title'];
		$keimeno = $_POST['keimeno'];
		$time = $_POST['time'];
		
		$author_id = $_SESSION['userId'];

		//$sql = "UPDATE users SET email='$email', onoma = '$firstName', eponimo='$lastName', rolos='$rolos' WHERE user_id = userIdForUpdate";

		$stmt = $conn->prepare("UPDATE users SET email=:email, onoma=:onoma, eponimo=:eponimo, rolos=:rolos WHERE user_id=:userid");

		$stmt->bindParam(':title', $title, PDO::PARAM_STR);
		$stmt->bindParam(':keimeno', $keimeno, PDO::PARAM_STR);
		$stmt->bindParam(':time', $time, PDO::PARAM_STR);
		//$stmt->bindParam(':rolos', $rolos, PDO::PARAM_STR);
		$stmt->bindParam(':userid', $userIdForUpdate, PDO::PARAM_STR);

		if($stmt->execute()){
			echo "Enimerwthike";
		}else{
			echo "sfalma";
		}
	}
}


$target_dir = "uploads/";
$target_file = $target_dir . $_FILES;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



$check = getimagesize($_FILES);
if($ckeck !== false) {
echo "File is an image - " .$check["mime"] . ".";
$uploadOk = 1;
} else {
echo "File is not an image.";
$uploadOk = 0;
}

if (file_exists($target_file)) {
echo "Sorry, file already exists.";
$uploadOk = 0;
}

if ($_FILES["postImg"]["size"] > 500000) {
echo "Sorry, your file is too large.";
$uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
$uploadOk = 0;
}



$sql = "INSERT INFO posts (author_id, title, content, imgurl, publish_at) VALUES (author_id,'$title','$content',$target_file','$date')";

if($conn->exec($sql)){
if ($uploadOk == 0) {
echo "Sorry, your file was not uploaded.";

} else {
if (move_uploaded_file($_FILES["postImg"]["tmp_name"], $target_file)) {
echo "The file ". htmlspecialchars($_FILES["postImg"]["name"]). " has been uploaded.";
} else {
echo "Sorry, there was an error uploading your file.";
} 
}
}

?>

<div class="alert-primary" role="alert">
Effrafikate epitixos!




<div class="container">
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/for-data">
	  <div class="mb-3">
	    <label for="exampleInputKeimeno1" class="form-label">Title</label>
	    <input type="text" class="form-control" id="exampleInputTitle1" aria-describedby="titleHelp" name="title" value="">
	  </div>
	   <div class="mb-3">
	    <label for="exampleInputKeimeno" class="form-label">Keimeno</label>
	    <input type="text" class="form-control" id="exampleInputKeimeno" name="Keimeno" value="">
	  </div>
	   <div class="mb-3">
	    <label for="exampleInputDate" class="form-label">Date</label>
	    <input type="date" class="form-control" id="exampleInputDate" name="Date" value="">
	   <div class="mb-3">
	    <label for="exampleInputFile" class="form-label">Date</label>
	    <input type="file" class="form-control" id="exampleInputFile" name="File" value="">
	  </div>
	  <input type="Post" name="BlogPostBtn" class="btn btn-primary" value="Post">
	</form>
</div>


<?php 



include("footer.php");