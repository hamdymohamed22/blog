<?php require_once('inc/header.php'); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/navbar.php'); ?>

<?php if (isset($_SESSION['user_id'])) { ?>

    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="d-flex justify-content-between border-bottom mb-5">
                    <?php
                    if (isset($_GET['id'])) {

                        $id = $_GET['id'];
                        $query = "SELECT * FROM `posts` WHERE id = $id";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) == 1) {
                            $post = mysqli_fetch_assoc($result); ?>
                            <div>

                                <h3><?php echo $post['title']; ?></h3>
                            </div>
                            <div>
                                <a href="index.php" class="text-decoration-none"> <?php echo $message['Back'] ?></a>
                            </div>
                </div>
                <div>
                    <?php echo $post['body']; ?>
                </div>
                <div>
                    <img src="uploads/<?php echo $post['image']; ?>" alt="" srcset="" width="300px">
                </div>
        <?php
                        } else {
                            echo "<h3>post not found</h3>";
                        }
                    } else {
                        header("location:index.php");
                        exit;
                    }
        ?>
            </div>
        </div>
    </div>

<?php } else {
    header("location:login.php");
    exit;
} ?>
<?php require('inc/footer.php'); ?>