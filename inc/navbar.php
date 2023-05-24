<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <?php echo $message['Blog'] ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="inc/change-lang.php?lang=en">English</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="inc/change-lang.php?lang=ar">عربي</a>
                </li>
                <?php
                require_once 'connection.php';
                if (isset($_SESSION['user_id'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="handle/logout.php"><?php echo $message['Logout'] ?></a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><?php echo $message['Login'] ?></a>
                    </li>
                <?php }; ?>
            </ul>
        </div>
    </div>
</nav>