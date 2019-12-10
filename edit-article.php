<?php

require 'includes/database.php';  
require 'includes/article-get-id.php';
require 'includes/url.php';

$conn = getDB();

if (isset($_GET['id'])) {

	$article = getArticle($conn, $_GET['id']);

	if ($article) {
		$id = $article['id'];
		$title = $article['title'];
		$content = $article['content'];
		$published_at = $article['published_at'];
	} else {
		die('article not found');
	}

} else {
	die('id not supplied, article not found');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { //submiting the form

    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];

    $errors = validateArticle($title,$content,$published_at);

    if (empty($errors)) {

        $sql = "UPDATE article SET title = ?, content = ?, published_at = ? WHERE id = ?";
 
        $stmt = mysqli_prepare($conn,$sql);

        //would return false on error
        if ($stmt === false) {

            echo mysqli_error($conn);

        } else {

            if ($published_at == '') {
                $published_at = null;
            }

            mysqli_stmt_bind_param($stmt, "sssi", $title, $content,$published_at,$id); //s is for string, we have 3 strings

            if (mysqli_stmt_execute($stmt)) { //inserting into sql
               
				redirect("/udemy/article.php?id=$id");

            } else {
                echo mysqli_stmt_error($stmt);
            } 

        }

	}
}

?>

<?php require 'includes/header.php'; ?>

<h2>Edit article</h2>

<?php require 'includes/article-form.php'; ?>

<?php require 'includes/footer.php' ?>