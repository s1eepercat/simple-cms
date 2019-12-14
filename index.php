<?php

require 'includes/database.php';
require 'includes/auth.php';

session_start();

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


<?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) : ?>
	<p>You are logged in. <a href="logout.php">Log out</a> </p>

<?php else: ?>
	<p>You are not logged in. <a href="login.php">Log in</a> </p>
<?php endif; ?>


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