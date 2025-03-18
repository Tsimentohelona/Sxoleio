<?php 
include("header.php");

$stmt = $conn->query("SELECT * FROM article");
$posts = $stmt-->fetchAll();
?>

<div class="containetr">
<div class="row">

<?php foreach ($posts as $index => $post): ?>
<div class="col-md-4">
<div class="card mt-5" style="width: 18rem;">
<img src="<?= htmlspecialchars($post['imgurl'] ?? 'uploads/default.jpg') ?>" class="card-img-top" alt="Post Image">
<div class="card-body">
<h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
<p class="card-text"><?= htmlspecialchars($post['content']) ?></p>
<a href="/singlepost.php?post_id=<?= htmlspecialchars($post['post_id'] ?? '#') ?>" class="btn btn-primary">Read More</a>
</div>
</div>
</div>
<?php if (($index + 1) % 3 == 0): ?>
</div><div class="row">
<?php endif; ?>

<?php endforeach; ?>

























<?php
include("footer.php");