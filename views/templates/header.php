<!DOCTYPE html>
<html lang="en">

<head>
    <!-- metas -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- title -->
    <title><?= isset($title) ? $title . ' | ' : '' ?> <?= APP_NAME ?></title>
    <!-- link style sheet -->
    <link rel="stylesheet" href="//<?= APP_URL ?>/css/style.css">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/a3078cd2a7.js" crossorigin="anonymous"></script>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-2">
            <a href="<?= (VHOST ? '//' : '') . APP_URL ?>" class="navbar-brand"><?= APP_NAME ?></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarButtons" aria-controls="navbarButtons" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarButtons">
                <ul class="navbar-nav w-100">

                    <?php if (isset($_SESSION['username'])) { ?>
                        <a href="#" class="nav-link"><?= $_SESSION['username'] ?></a>
                        <a href="board" class="nav-link">Board</a>
                    <?php } ?>

                    <!-- Auth button -->
                    <ul class="navbar-nav ms-lg-auto">
                        <?php if (!isset($_SESSION['userid'])) { ?>

                        <a href="login" class="nav-link">Login</a>
                        <a href="register" class="nav-link">Register</a>
                        
                        <?php } else { ?>

                        <a href="logout" class="nav-link">Logout</a>

                        <?php } ?>
                    </ul>

                </ul>
            </div>
        </nav>
    </header>