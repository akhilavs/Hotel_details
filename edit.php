<?php
    require 'connection.php'; 


    $id=$_GET['id'];
    $sql='SELECT * FROM hotels WHERE id=:id';
    $statement=$connection->prepare($sql);
    $statement->execute([':id'=>$id]);
    $update_hotel=$statement->fetch(PDO::FETCH_OBJ);

    if(isset($_POST['name'])&&($_POST['place'])&& isset($_POST['date'])&& isset($_POST['price'])){
       
        $name=$_POST['name'];
        $place=$_POST['place'];
        $date=$_POST['date'];
        $price=$_POST['price'];
        $sql = 'UPDATE hotels SET name=:name, place=:place,date=:date,price=:price WHERE id=:id';

        $statement=$connection->prepare($sql);
        
        if($statement->execute([':name'=>$name,':place'=>$place,':date'=>$date,':price'=>$price, ':id'=>$id])){
                header('location:index.php');
            }
        }

?>

<?php
    require 'header.php';
?>
<h2>Edit & Update</h2>
<div class="container">
<form action=""  method="POST">
    <div class="w-25">
        <input type="text" name="id" value="<?= $update_hotel->id; ?>"  class="form-control mt-3" placeholder="id">
    </div>
    <div class="w-25">
        <input type="text" name="name" value="<?= $update_hotel->name; ?>" class="form-control mt-3" placeholder="name">
    </div>
    <div class="w-25">
        <input type="text" name="place" value="<?= $update_hotel->place; ?>" class="form-control mt-3" placeholder="Place">
    </div>
    <div class="w-25">
        <input type="text" name="date"  value="<?= $update_hotel->date; ?>" class="form-control mt-3" placeholder="Date">
    </div>
    <div class="w-25">
        <input type="text" name="price"  value="<?= $update_hotel->price; ?>" class="form-control mt-3" placeholder="Pricw">
    </div>
    <div>
        <input type="submit" value="submit" class="btn btn-primary mt-3">
        
    </div>
    
</form>
</div>


<?php
    require 'footer.php';
?>