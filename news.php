<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>Contact</title>
</head>

<body>
<?php
$news = "News";
$contacts = "Contacts";
?>
<?php include "model_delete.php";?>
<?php include "navbar.php"; ?>

<div class="container py-4">
    <div class="row ">
        <div class="col-6 d-flex align-items-center">
            <h1 class=" mb-0">News</h1>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-center">
            <a href="/create.php" class="btn btn-success ">Create news</a>
        </div>

    </div>

    <table class="table my-4">
        <thead class="thead-dark ">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col" width="150px">Image</th>
            <th scope="col" width="15%"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        include "connection_database.php";
        $reader = $connection->query("SELECT * FROM news");
        foreach ($reader as $row) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>
                    <img src='images/<?php echo $row['image']; ?>' alt='image' width='150px'/>
                </td>
                <td>
                    <div class='row'>
                        <div class='col-lg-6 col-12 mb-2 mb-lg-0 px-1'>
                            <a href='edit.php?<?php echo "id=$row[id]"; ?>' class='w-100 btn btn-warning'>Edit</a>
                        </div>
                        <div class='col-lg-6 col-12 mb-2 mb-lg-0 px-1'>
                            <a href="" data-image="<?php echo $row['image']; ?>" data-id="<?php echo $row['id']; ?>"
                               class='w-100 btn btn-danger btnDelete'>Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/axios.min.js"></script>
<script>
    const myModal=new bootstrap.Modal(document.getElementById('myModal'),{});
    window.addEventListener('load', function () {
        let list = document.querySelectorAll(".btnDelete");
        let removeId=0;
        let removeImage="";
        for (let i = 0; i < list.length; i++) {
            list[i].addEventListener("click", function (e) {
                e.preventDefault();
                removeId = e.currentTarget.dataset.id;
                removeImage = e.currentTarget.dataset.image;
                myModal.show();

            });
        }
            document.querySelector("#btnDeleteNews").addEventListener("click",function(){
                const formData = new FormData();
                formData.append("id", removeId);
                formData.append("image", removeImage);
                axios.post("/delete.php", formData)
                    .then(response => {
                        console.log("responce", response.data);
                        document.location.reload();
                    });

            });
            });

</script>
</body>
</html>