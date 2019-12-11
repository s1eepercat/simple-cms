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

$sql = "DELETE FROM article WHERE id = ?";
 
        $stmt = mysqli_prepare($conn,$sql);

        //would return false on error
        if ($stmt === false) {

            echo mysqli_error($conn);

        } else {

            mysqli_stmt_bind_param($stmt, "i", $id); //i is for integer

            if (mysqli_stmt_execute($stmt)) { //inserting into sql
               
				redirect("/udemy/index.php");

            } else {
                echo mysqli_stmt_error($stmt);
            } 

        }