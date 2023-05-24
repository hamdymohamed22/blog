<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/header.php'); ?>
<?php require_once('inc/navbar.php'); ?>


<?php if (isset($_SESSION['user_id'])) {

    if (isset($_GET['page'])) {
        $page = round($_GET['page']);
    } else {
        $page = 1;
    }

    $limit = 2;
    $offset = ($page - 1) * $limit;

    $query = "SELECT COUNT(id) as total FROM `posts`";
    $runQuery = mysqli_query($conn, $query);
    if (mysqli_num_rows($runQuery) == 1) {

        $postsNumber = mysqli_fetch_assoc($runQuery);
        $total = $postsNumber['total'];
    } else {
        echo "<div  class='alert alert-info' role='alert'>no posts</div>";
    }
    $numOfPages = ceil($total / $limit);

    if ($page > $numOfPages || $page < 1) {
        header("location:$_SERVER[PHP_SELF]?page=1");
        exit;
    }
?>

    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="d-flex justify-content-between border-bottom mb-5">
                    <div>
                        <h3><?php echo $message['All Posts'] ?> </h3>
                    </div>
                    <div>
                        <a href="create-post.php" class="btn btn-sm btn-success"><?php echo $message['Add new post'] ?></a>
                    </div>
                </div>
                <?php require_once 'inc/alert.php' ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><?php echo $message['title'] ?></th>
                            <th scope="col"><?php echo $message['Published At'] ?></th>
                            <th scope="col"><?php echo $message['Actions'] ?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $id =  $_SESSION['user_id'];
                        $query = "SELECT * FROM `posts` WHERE user_id = '$id' limit $limit offset $offset";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            foreach ($posts as  $post) { ?>
                                <tr>
                                    <td><?php echo $post['title'] ?></td>
                                    <td><?php echo $post['created_at'] ?></td>
                                    <td>
                                        <a href="show-post.php?id=<?php echo $post['id'] ?>" class="btn btn-sm btn-primary"><?php echo $message['Show'] ?></a>
                                        <a href="edit-post.php?id=<?php echo $post['id'] ?>" class="btn btn-sm btn-secondary"><?php echo $message['Edit'] ?></a>
                                        <a href="handle/delete-post.php?id=<?php echo $post['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('do you really want to delete post?')"><?php echo $message['Delete'] ?></a>
                                    </td>
                                </tr>
                        <?php }
                        } else {
                            echo "<div  class='alert alert-info' role='alert'>no posts</div>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container d-flex justify-content-center mt-5">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item <?php if ($page == 1) echo 'disabled'; ?>">
                    <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?page=" . $page - 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">
                        <?php echo $page ?> of <?php echo $numOfPages ?>
                    </a></li>
                <li class="page-item <?php if ($page == $numOfPages) echo 'disabled'; ?>">
                    <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?page=" . $page + 1 ?>" aria-label=" Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>










<?php } else {
    header("location:login.php");
    exit;
} ?>
<?php require('inc/footer.php'); ?>