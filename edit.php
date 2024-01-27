<?php
$servername = "localhost";
$username ="root";
$password ="";
$database ="login";

//Create connection
$connection = new mysqli($servername,$username,$password,$database);



$id="";
$name="";
$email="";
$phone="";

$errormessage="";
$sucessmessage="";

if ($_SERVER['REQUEST_METHOD']== 'GET') {
    //get method: show the data of the student

    if (!isset($_GET["id"])) {
        header("location: /login/index.php");
        exit;
    }

    $id =$_GET["id"];

    //read the row of the selected student from database table
    $sql ="SELECT * FROM  idstudent WHERE id=$id";
    $result =$connection->query($sql);
    $row =$result->fetch_assoc();

    if (!$row){
        header("location: /login/index.php");
        exit;
    }

        $name = $row["name"];
        $email = $row["email"];
        $phone = $row["phone"];
    
}
else{
    //post method: Update the data of the student
    $id=$_POST["id"];
    $name =$_POST["name"];
    $email =$_POST["email"];
    $phone =$_POST["phone"];

    do{
        if ( empty($name) || empty($email) || empty($phone)  ){
            $errormessage ="All the fields are required" ;
            break; 

    }

    $sql ="UPDATE idstudent". 
           "SET name ='$name',email='$email',phone='$phone'".  
           "WHERE id =$id";

           $result =$connection->query($sql);

           if (!$result){
            $errormessage="invaild query:". $connection->error;
            break;
           }

           $successmessage="student update correctly";

           header("location: /login/index.php");
           exit;
    
}while(true);

}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"> </script>
</head>
<body>
    <div class="container my-5">
        <h1>New student</h1>

         <?php
         if (!empty($errormessage)) {
             echo "
             <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                 <strong>$errormessage</strong>
                 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                 </div>
             ";

         }
         ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control"name="name"value="<?php echo $name;?>">
                </div>
        </div>
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control"name="email"value="<?php echo $email;?>">
                </div>
        </div>
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control"name="phone"value="<?php echo $phone;?>">
                </div>
        </div>


        <?php
        if (!empty($successmessage)){
            echo "
            <div class='row mb-3'>
              <div class='offset-sm-3 col-sm-6'>
             <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                 <strong>$successmessage</strong>
                 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                 </div>
                 </div>
                 </div>
             ";
        }
        ?>
        <div class="row mb-3">
             <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">submit</button>
             </div>
             <div class="col-sm-3 d-grid">
                 <a class="btn btn-outline-primary" href="/login/index.php" role="button">cancel</a>
             </div>
        </div>
    </form>
    </div>
</body>
</html>