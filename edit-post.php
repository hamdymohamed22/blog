<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/header.php'); ?>
<?php require_once('inc/navbar.php'); ?>

<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
                    <h3><?php echo $message['Edit Post'] ?></h3>
                </div>
                <div>
                    <a href="index.php" class="text-decoration-none"><?php echo $message['Back'] ?></a>
                </div>
            </div>

            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $query = "SELECT * FROM `posts` WHERE id = $id";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) == 1) {
                    $post = mysqli_fetch_assoc($result); ?>
                    <form method="POST" action="handle/update-post.php" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="title" class="form-label"><?php echo $message['title'] ?></label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $post['title']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="body" class="form-label"><?php echo $message['Body'] ?></label>
                            <textarea class="form-control" id="body" name="body" rows="5"><?php echo $post['body']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label"><?php echo $message['image'] ?></label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                        <div class="mb-3">
                            <img class="w-100 " src="uploads/<?php echo $post['image']; ?>" alt="">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                        <button type="submit" class="btn btn-primary" name="submit"><?php echo $message['Submit'] ?></button>
                    </form>

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

<?php require('inc/footer.php'); ?>