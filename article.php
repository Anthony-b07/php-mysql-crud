<?php

use App\Classes\Data;
use App\Classes\User;

session_start();

require_once 'vendor/autoload.php';
$username = $_SESSION['username'];
$id = $_SESSION['id'];
$article = new Data();

// print_r($result);
$title = $_POST['title'];
$overview = $_POST['overview'];
$content = $_POST['content'];
$date = $_POST['date'];

if (!empty($title) && !empty($overview) && !empty($content) && !empty($date)) {

  $article->insertData($title, $overview, $content, $date, $id);
}



$result = $article->getData();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="article.css">
  <title>Document</title>
</head>

<body>
  <h1>Welcome <?php echo $username ?></h1>
  <table>
    <thead>
      <tr>
        <th>Title</th>
        <th>Overview</th>
        <th>Content</th>
        <th>Date</th>
      </tr>
    </thead>

    <tr>
      <?php foreach ($result as $ref) {
        $articleId = $ref['id'];
        $title = $ref['title'];
        $overview = $ref['overview'];
        $content = $ref['content'];
        $date = $ref['date'];

        if (isset($_POST['delete'])) {
          $article->deleteData($articleId);
        }
        if (isset($_POST['export'])) {
          $article->exportProductDatabase($result);
        }
      ?>

        <form action="article.php" method="post">

          <td><?php echo $title; ?></td>
          <td><?php echo $overview; ?></td>
          <td><?php echo $content; ?></td>
          <td><?php echo $date; ?></td>
          <td><button type="submit" value="Edit" name="edit"><a href="edit.php?articleId=<?php echo $articleId; ?>">Edit</button></td>
          <!-- <td><input type="submit" value="Edit" name="edit"></td> -->
          <td><input type="submit" value="Delete" name="delete"></td>
          <td><input type="submit" value="Export" name="export"></td>

        </form>
    </tr>
  <?php
      }
  ?>
  </tr>

  </table>

  <button style="width: 10%; margin:5em 40em; height:2em"><a href="./addArticle.php">Add New Article</a></button>
</body>

</html>