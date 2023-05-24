<?php
require_once('../inc/connection.php');
// session_start();

if (isset($_POST['submit'])) {
    extract($_POST);

    //catch data
    $title = trim(htmlspecialchars($title));
    $body = trim(htmlspecialchars($body));

    // validate form inputs
    $errors_array = [];
    //title validate
    if (strlen($title) < 3) {
        $errors_array[] = "title should be more than 3 char";
    } elseif (is_numeric($title)) {
        $errors_array[] = "title should be string";
    }elseif (empty($title)) {
        $errors_array[] = "title is require";
    }
    //body validate
    if (strlen($body) < 6) {
        $errors_array[] = "body should be more than 6 char";
    } elseif (is_numeric($body)) {
        $errors_array[] = "body should be string";
    } elseif (empty($body)) {
        $errors_array[] = "body is require";
    }
    //image validate

    if (! empty($_FILES["image"]['name'])) {
        $image = $_FILES["image"];
        $image_name = $image["name"];
        $tmp_name = $image["tmp_name"];
        $error = $image["error"];
        $image_size = $image["size"] / (1024 * 1024); // mb
        $extn =  strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $extn_arr = ["png", "jpg",  "jpeg", "gif"];

        if ($image_size > 1.5) {
            $errors_array[] = "image max size is 1.5 MGb";
        } elseif ($error !== 0) {
            $errors_array[] = "file is not valid";
        } elseif (!in_array($extn, $extn_arr)) {
            $errors_array[] = "image type is not valid";
        } else {
            $image_name = uniqid() . $extn;
        }
    }else{
        $image_name = "";
    }

    if (empty($errors_array)) {

        $query = "INSERT INTO posts(`title`, `image`, `body`, `user_id`) 
        VALUES ('$title','$image_name','$body',1)";

        $runQuery = mysqli_query($conn, $query);
        if ($runQuery) {
            $_SESSION['success'] = ['uploaded successfully'];
            if (!empty($_FILES["image"]['name'])) {
                move_uploaded_file($tmp_name, "../uploads/$image_name");
            }
            header("location:../create-post.php");
            exit;
        }else{
            $_SESSION['errors'] = ['error (failed to upload )'];
        }
        
    } else {
        $_SESSION['errors'] = $errors_array;
        $_SESSION['title'] = $title;
        $_SESSION['body'] = $body;
        header("location:../create-post.php");
        exit;
    }

}else{
    header("location:../create-post.php");
    exit;
}