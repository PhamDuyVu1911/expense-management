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
    <base href="/expense-management/">
    <link rel="stylesheet" href="./public/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./public/font/font-icon/css/all.css">
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- Data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <?php require_once "./App/views/page/${page}.php" ?>
        </div>
    </div>

    <!--link JS  -->
    <script src="./public/js/main.js"></script>
</body>

</html>