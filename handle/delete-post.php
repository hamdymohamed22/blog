<?php
require_once('../inc/connection.php');
// session_start();

extract($_GET);
// chek if the post exists    
$query = "SELECT * FROM `posts` WHERE id = $id";
$result = mysqli_query($conn, $query);
// check if return with data
if (mysqli_num_rows($result) == 1) {
    $post = mysqli_fetch_assoc($result);
    $image = $post['image'];
    // delete the image from the folder befor deleteit from database
    unlink("../uploads/$image");
    //delete the post from he database
    $query = "DELETE FROM posts WHERE id = $id";

    $runQuery = mysqli_query($conn, $query);
    if ($runQuery) {
        // if the post deleted
        $_SESSION['success'] = ['post deleted successfuly'];
        header("location:../index.php");
        exit;
    } else {
        //if the post nt deleted
        $_SESSION['errors'] = ['error while post delete'];
        header("location:../index.php");
        exit;
    }
    header("location:../index.php");
    exit;
}