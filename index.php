<?php
include_once './config.php';

$current_page = filter_input(INPUT_GET, 'page');
$filter = filter_input(INPUT_GET, 'filter');

if (!$current_page) {
    $current_page = 0;
}

$offset = $current_page * amount;

if ($current_page > 1) {
    $previous = $current_page - 1;
} else {
    $previous = 0;
}
$next = $current_page + 1;

$con = connectDatabase();

$filter = mysqli_escape_string($con, $filter);

$query = "SELECT messages.*, users.name FROM messages LEFT JOIN users ON messages.author_id = users.id WHERE message LIKE '%$filter%' ORDER BY created DESC LIMIT $offset, " . amount;

$results = mysqli_query($con, $query);

$noRecords = mysqli_num_rows($results);

if ($noRecords == 0 && $current_page > 0) {
    header("Location: index.php?page=$previous&filter=$filter");
    exit();
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Used Shop</title>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <nav class="navbar bg-light">
  <div class="container-fluid">
    <form class="d-flex" role="search" action="index.php" method="get">
        <input class="form-control me-2" name="filter" type="search" placeholder="Search" aria-label="Search" value="<?= $filter ?>">
      <button class="btn btn-primary btn-sm" type="submit">Search</button>
    </form>
      <ul class="nav justify-content-end">
          <li class="nav-item">
                <a class="nav-link" href="addMessageForm.php"><button class="btn btn-primary btn-sm">Upload new Item</button></a>
                </li>
                 <li class="nav-item">
            <?php if (isLogged()): ?>
                Hello  <?= $_SESSION["userName"] ?> <br>
                <a class="nav-link" href="logout.php">Logout</a>
            <?php else: ?>
                </li>
                <br>
                <li class="nav-item">
                <a class="nav-link" href="registerForm.php">Register</a>
                </li>
                <br>
                <li class="nav-item">
                <a class="nav-link" href="loginForm.php">Login</a>
                </li>
                <br>
            <?php endif; ?>
                 </li>
            </ul>
  </div>
</nav>
        <br>
        <?php
        while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)):
            $names = getImagesForMessage($row['id']);
            ?>
        <div>
                <img class="avatar" src="serveAvatar.php?id=<?= $row['author_id'] ?>">
            </div>
            <h3> <?= h($row['name']) ?><br>   <?= h($row['created']) ?></h3>

            <h1><?= h($row['title']) ?> </h1>
            <?php foreach ($names as $imageName): ?>
                <img src="serveImage.php?id=<?= $row['id'] ?>&name=<?= $imageName ?>">
            <?php endforeach; ?>
            <br>
            <div> Description:<br> <?= nl2br(h($row['message'])) ?></div>
            <br>
            <div> Price: <?= nl2br(h($row['price'])) ?></div>
            <br>
            <div> Contact:<br> <?= nl2br(h($row['contact'])) ?></div>
            <br>
            <?php if (isCurrentUserOwnerOfMessageOrAdmin($row['id'])): ?>
                <a href = "delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')"><button class="btn btn-primary btn-sm">Delete</button></a>
                <a href = "editForm.php?id=<?= $row['id'] ?>"><button class="btn btn-primary btn-sm">Edit</button></a>
            <?php endif; ?>
            <hr>
            <br>
        <?php endwhile; ?>

        <a href="index.php?page=<?= $previous ?>&filter=<?= $filter ?>">Previous</a>
        <a href="index.php?page=<?= $next ?>&filter=<?= $filter ?>">Next</a>
    </body>
</html>
