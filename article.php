<?php

require 'includes/database.php';  
require 'includes/article-get-id.php';

$conn = getDB();

if (isset($_GET['id'])) {

	$article = getArticle($conn, $_GET['id']);

} else {
	$article = null;
}

?>

<?php require 'includes/header.php'; ?>

			<?php if ($article === null): ?>
				<p>Article not found.</p>
			<?php else: ?>

						<article>
							<h2><?= htmlspecialchars($article['title']); ?></h2>
							<p><?= htmlspecialchars($article['content']); ?></p>
						</article>

						<a href="edit-article.php?id= <?= $article['id']; ?> ">Edit</a>
						<a href="delete-article.php?id= <?= $article['id']; ?> ">Delete</a>

						<a href="index.php">Back</a>

			<?php endif; ?>

<?php require 'includes/footer.php'; ?>
