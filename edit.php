<?php
$id = $_GET['id'];
include "connection_database.php";
$sqlGet = "SELECT * FROM `news` WHERE id=$id";
$reader = $connection->query($sqlGet);
foreach ($reader as $row) {
    $name = $row['name'];
    $description = $row['description'];
    $imageName = $row['image'];
}
$image = '/images/' . $imageName;
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "connection_database.php";
    $sql = "UPDATE `news` SET `name` = ?, `description` = ?, `image` = ? WHERE `id` = ?";

    if (!empty($_FILES['image']['tmp_name'])) {
        $fileName = uniqid() . '.jpg';
        $fileSavePath = $_SERVER['DOCUMENT_ROOT'] . '/images/' . $fileName;
        move_uploaded_file($_FILES['image']['tmp_name'], $fileSavePath);
        $imageName = $fileName;

        $filePath = $_SERVER['DOCUMENT_ROOT'] . $image;

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    $connection->prepare($sql)->execute([$_POST['name'], $_POST['description'], $imageName, $_GET['id']]);

    header("Location: /news.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <title>Contact</title>
</head>

<body>
<?php
$contacts = "Contacts";
$news = "News";
?>

<?php include "navbar.php"; ?>
<div class="container">
    <div class="container text-color-purple">
        <div class="row">
            <div class="col my-2">
                <h2>Add News</h2>
            </div>
        </div>
        <div class="row">

            <div class="col-8">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input name="name" id="name" type="text" value="<?php echo $name; ?>" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label for="image"><p>Image</p><img id="img_preview" src="<?php echo $image; ?>"
                                                            style="cursor:pointer; width: 200px"/></label>
                        <input name="image" id="image" type="file" accept="image/*" class="form-control d-none"/>

                    </div>
                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="10" cols="45" type="text"
                                  class="form-control"><?php echo $description; ?></textarea
                    </div>
                    <button type="submit" class="btn btn-primary my-3">Edit news</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    window.addEventListener('load', function () {
        const file = document.getElementById('image');
        file.addEventListener("change", function (e) {
            const uploadFile = e.currentTarget.files[0];
            document.getElementById('img_preview').src = URL.createObjectURL((uploadFile));
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#description').summernote({
            tabsize: 2,
            height: 300
        });
    });
</script>
</body>

</html>
