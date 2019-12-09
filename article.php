<?php

require 'includes/database.php'; 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

	$sql = "SELECT *
					FROM article
					WHERE id = " . $_GET['id'];

	//send query to the database
	$results = mysqli_query($conn,$sql);

	//would return false on error
	if ($results === false) {
		echo mysqli_error($conn);
	} else {
		// $articles = mysqli_fetch_all($results, MYSQLI_ASSOC); //returns an array with results
			$article = mysqli_fetch_assoc($results); //fetch a single line
	}

} else {
	$article = null;
}

?>

<?php require 'includes/header.php'; ?>

			<?php if ($article === null): ?>
				<p>Article not found.</p>
			<?php else: ?>

						<article>
							<h2><?= $article['title']; ?></h2>
							<p><?= $article['content']; ?></p>
						</article>

			<?php endif; ?>

<?php require 'includes/footer.php'; ?>
