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
		//$rolos = $_POST['rolos'];
		$userIdForUpdate = $_SESSION['userId'];

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






	$userId = $_SESSION['userId'];
	$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = :userId");

    $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<div class="container">
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
	  </div>
	  <input type="Post" name="BlogPostBtn" class="btn btn-primary" value="Post">
	</form>
</div>


<?php 

}

include("footer.php");