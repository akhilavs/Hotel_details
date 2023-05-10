<?php
    require 'connection.php'; 

    if(isset($_POST['delete_btn'])){
        $d_id=$_POST['delete_btn'];
        try{
            $sql='DELETE FROM hotels WHERE id=:d_id';
            $statement=$connection->prepare($sql);
            $data=[':d_id'=>$d_id];
            $sql_execute=$statement->execute($data);
            if($sql_execute){
                echo"<script>alert('Deleted Successfully!')</script>";
                header('location:index.php');
            }
            else{
                echo"<script>alert('Not Deleted!')</script>";
                header('location:index.php');
            }

        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }
?>
<?php
    require 'header.php';
?>

<?php
    require 'footer.php';
?>