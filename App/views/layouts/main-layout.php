<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        echo $title = isset($pageName) ? $pageName : 'Document';
        ?>
    </title>
    <!-- Base href -->
    <base href="/expense-management/">
    <!-- font text -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <!-- font icon -->
    <link rel="stylesheet" href="./public/font/font-icon/css/all.css">
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- Data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <!-- Ck editor -->
    <script type="text/javascript" src="./public/library/ckeditor5/ckeditor.js"></script>
    <!-- main css -->
    <link rel="stylesheet" href="./public/css/main.css">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <!-- Header -->
            <?php require_once './App/views/partials/header.php' ?>


            <!-- main -->
            <main class="main">
                <!-- sideBar -->
                <?php require_once './App/views/partials/sidebar.php' ?>
                <!-- main__content -->
                <div class="content" style="<?php echo $func->handlePaddingContent(); ?>">
                    <!-- breadcrumbs -->
                    <?php require_once './App/views/partials/pageLink.php' ?>
                    <!-- notification -->
                    <?php require_once './App/views/partials/notificationAction.php' ?>
                    <!-- Page -->
                    <?php require_once "./App/views/page/${page}.php" ?>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <!--link JS  -->
    <script src="./public/js/main.js"></script>
    <script src="./public/js/notification.js"></script>
</body>

</html>