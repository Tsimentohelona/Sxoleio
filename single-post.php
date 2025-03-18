<?php 
include("header.php");

//if(isset($_GET['post_id'])){
//echo "404";
//}else{
//$post_id = $_GET['post_id'];
$stmt = $conn->prepare("SELECT * FROM article WHERE post_id = :post_id");
$stmt = $conn->prepare("SELECT posts.*, users.onoma AS author_onoma FROM article  JOIN users ON article.author_id = users.user_id WHERE article.post_id = :post_id");
//$stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
//$stmt->execute;
$posts = $stmt->fetch(PDO::FETCH_ASSOC);

//if($article){
//echo "404";
//}else{

//$author_id = $post['author_id'];
$stmt = $conn->prepare("SELECT onoma FROM users WHERE user_id = :author_id");
//$stmt->bindValue(':author_id', $author_id, PDO::PARAM_INT);
//$stmt->execute();
$author = $stmt->fetch(PDO::FETCH_ASSOC);


?>


<head>
    <title>Blog Post</title>
    <style>
    </style>
</head>
<body>
    <div class="container">
        <div class="post-header">
            <h1><?= htmlspecialchars($post['title'] ?? "Psomi") ?></h1>
            <div class="author-date">
                <span><?= htmlspecialchars($post['onoma'] ?? "Giorgos") ?></span> 
                <span><?= htmlspecialchars($post['time'] ?? "2025-3-11") ?></span>
            </div>
        </div>
        
        <img src="<?= htmlspecialchars($post['iimgurl'] ?? 'uploads/default.jpg') ?>" width = 400>
        
        <div class="post-content">
            <p> <?= htmlspecialchars($post['keimeno'] ?? "maresei to psomi") ?> </p>
        </div>
    </div>



<?php
//}
//}
include("comments.php");
include("footer.php");
