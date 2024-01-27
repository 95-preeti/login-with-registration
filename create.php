<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"/>
</head>
<body>
    <div class="container my-5">
        <h1>list of student</h1>
        <a class="btn btn-primary" href="/login/create.php" rol="button">New student</a>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username ="root";
                $password ="";
                $database ="login";

                //Create connection
                $connection = new mysqli($servername,$username,$password,$database);

                //Check connection
                if ($connection->connect_error) {
                    die("connection failed: " .$connection->connect_error);
                }

                // read all row from database table
                $sql ="SELECT * FROM idstudent";
                $result =$connection->query($sql);

                if (!$result) {
                    die("Invaild query:" .$connection->error);
                }

                //read data of each row
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/login/edit.php?id=$row[id]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/login/delete.php?id=$row[id]'>Delete</a>
                    </td>
                </tr>
                    ";
                }
                ?>

              
               
            </tbody>
        </table>
    </div>   
</body>
</html>