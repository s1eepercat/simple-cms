<?php

require 'includes/database.php';

$conn = getDB();

$sql = "SELECT *
				FROM article
				ORDER BY published_at";

//send query to the database
$results = mysqli_query($conn,$sql);

//would return false on error
if ($results === false) {
	echo mysqli_error($conn);
} else {
	$articles = mysqli_fetch_all($results, MYSQLI_ASSOC); //returns an array with results
}

?>

<?php require 'includes/header.php'; ?>

<a href = "new-article.php">New article</a>

			<?php if (empty($articles)): ?>
				<p>No articles found.</p>
			<?php else: ?>

			<ul>
				<?php foreach ($articles as $article): ?>
					<li>
						<article>
							<h2><a href="article.php?id=<?=$article['id'];?>"> <?= htmlspecialchars($article['title']);?> </a></h2>
							<p><?= htmlspecialchars($article['content']); ?></p>
						</article>
					</li>
				<?php endforeach; ?>
			</ul>

			<?php endif; ?>

<?php require 'includes/footer.php'; ?>