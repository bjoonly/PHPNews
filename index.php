<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>News</title>
</head>

<body>
<?php
$contacts = "Contacts";
$news = "News";
?>

<?php include "navbar.php"; ?>

<div class="container py-4">
    <div class="row">

        <?php
        include "connection_database.php";
        $reader = $connection->query("SELECT * FROM news");
        foreach ($reader as $row) {
            echo "
            <div class='col-12 my-2  col-md-6'>
              <div class='card mb-3 h-100' style='min-height: 250px' >
            <div class='row  h-100'>
                 <div class='col-5'>
                     <img src='images/{$row['image']}' alt='image'  class='img-fluid rounded-start' style='height: 100%;object-fit: cover' >
                 </div>
           
            
            <div class='col-7 px-1 '>
                <div class='card-body p-2 h-100'>
                <h5 class='card-title'>{$row['name']}</h5>
                 <p class='card-text'>{$row['description']}</p>
                 </div>
            </div>
             </div>           
            </div>
             </div>
            ";
        }
        ?>

    </div>
</div>
<script src='/js/bootstrap.bundle.min.js'></script>
</body>

</html>