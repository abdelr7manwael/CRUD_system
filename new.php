<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "crud";
$conn = mysqli_connect($host, $user, $password, $dbname);
$name = "";
$salary = "";
#================================================================
#Insert

if (isset($_POST['submit'])) {
    $name = $_POST['userName'];
    $salary = $_POST['salary'];
    $insert = "INSERT INTO user VALUES(NULL,'$name',$salary)";
    $i = mysqli_query($conn, $insert);
}

#================================================
#Select

$select = "SELECT * FROM user";
$s = mysqli_query($conn, $select);
#=====================================

#delete

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = "DELETE FROM user WHERE id=$id";
    $d = mysqli_query($conn, $delete);
    header("location: new.php");
}
#=====================================================
#updae OR Edit 
$name = "";
$salary = "";
$update=true;
if (isset($_GET['edit'])) {
    $update=false;
    $id = $_GET['edit'];
    $edit_select = "SELECT * FROM user WHERE id = $id ";
    $ss = mysqli_query($conn, $edit_select);
    foreach ($ss as $row){
    $name = $row['name'];
    $salary = $row['salary'];
    }
    if(isset($_POST['up'])){
        $name = $_POST['userName'];
        $salary = $_POST['salary'];
       
        $update ="UPDATE user SET name= '$name' , salary = $salary where id=$id ";
        $u = mysqli_query($conn , $update);
        header("location: new.php");
    }
}


?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
</head>

<body>


    <div class="card container col-2 m-50 mx-auto">
        <div class="card-body">
            <h1 class="my-5 text-xl-center">CRUD System</h1>

        </div>
    </div>

    <div class="card col-6 w-50 mt-5 mx-auto">
        <div class="card-body ">
            <form method="POST" >

                <div class="form-group">
                    <label for="">user name</label>
                    <input value="<?php echo $name ?>" type="text" name="userName" class="form-control">

                </div>

                <div class="form-group">
                    <label for="">salary</label>
                    <input value="<?php echo $salary ?>" type="text" name="salary" class="form-control">
                </div>
                <?php if(isset($_GET['edit'])):?>
                    <button name="up" class="w-25 mx-auto btn btn-primary" >update</button>
                    <?php endif; ?>
                    <?php if($update):?>
                    <button name="submit" class="w-25 mx-auto btn btn-primary" >submit</button>
                    <?php endif; ?>
                    




            </form>
        </div>
    </div>

    <div class="container col-6 mt-3 text-ceter">
        <div class="card">
            <div class="card-body">
                <table class="table table-dark">

                    <tr>

                        <th>id</th>
                        <th>name</th>
                        <th>Salary</th>
                        <th colspan="2" class="text-center">Action</th>
                    </tr>

                    <tr>
                        <?php foreach ($s as $data) { ?>
                            <td><?php echo $data['id'] ?></td>
                            <td><?php echo $data['name'] ?></td>
                            <td><?php echo $data['salary'] ?></td>
                            <td> <a href="new.php?delete=<?php echo $data['id'] ?>" class="btn btn-danger">DELETE</a></td>
                            <td> <a href="new.php?edit=<?php echo $data['id'] ?>" class="btn btn-info">EDIT</a></td>

                    </tr>
                <?php } ?>

                </table>
            </div>
        </div>
    </div>