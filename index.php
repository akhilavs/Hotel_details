<?php
    require 'connection.php';            
?>
<?php
    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $place=$_POST['place'];
        $date=$_POST['date'];
        $price=$_POST['price'];
        $pic=$_FILES['image']['name'];
        $temp=$_FILES ['image']['tmp_name'];
        $target="upload/".basename($pic);
        $sql='INSERT INTO hotels(name,place,date,price,image) VALUES(:name,:place,:date,:price,:image)';
            $statement=$connection->prepare($sql);
            if($statement->execute([':name'=>$name,':place'=>$place,':date'=>$date,':price'=>$price,':image'=>$pic])){
                $move_pic= move_uploaded_file($temp,$target);
            echo '<script>alert("Successfully Submitted")</script>';
        }
        }

    $sql='SELECT * from hotels';
    $statement=$connection->prepare($sql);
    $statement->execute();
    $hotel_details=$statement->fetchAll(PDO::FETCH_OBJ);
?>

<?php
    if(isset($_POST['search'])){
    $search=$_POST['search_date'];
    $sql='SELECT * from hotels WHERE date=:search' ;
    $statement=$connection->prepare($sql);
    $statement->execute([':search'=>$search]);
    $search_details=$statement->fetchAll(PDO::FETCH_OBJ);
    if(!$search_details){
        echo '<script>alert("No Hotel Available ")</script>';
    }
    }
?>
<?php
    require 'header.php';        
?>

<h2 class="text-center">Search here!</h2>
<div class="container form-control w-25 p-3 bg-info">
<form action="" method="post">    
    <div>
        <input type="date" name="search_date" class="mt-3" placeholder="Search date">
    </div>    
    <div>
        <input type="submit" name="search" class="btn btn-primary mt-3"/> 
    </div>    
</form>
</div>

<h2 class="text-center">Hotels Available </h2>
<div class="container">
    <table class="table" >
        <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Name</th>
                <th class="text-center">Place</th>
                <th class="text-center"> Date</th>               
                <th class="text-center">Price</th>
                <th class="text-center">Picture</th>                
            </tr>
        </thead>
        <tbody>
            <?php if(isset($_POST['search'])){ foreach($search_details as $search): ?>
            <tr>                
                <td><?=$search->id; ?> </td>
                <td><?=$search->name; ?> </td>
                <td><?=$search->place; ?> </td>
                <td><?=$search->date; ?> </td>
                <td><?=$search->price; ?> </td>
                <td class="text-center"><img class="w-25" src="upload/<?=$search->image; ?>" alt=""> </td>
            </tr>                
            <?php endforeach;} ?>           
        </tbody>       
    </table>
</div>
</div>

<h2 class="text-center">Hotel Details</h2>
<div class="container">
    <table class="table text-center" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Place</th>
                <th> Date</th>               
                <th>Price</th>
                <th class=>Picture</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($hotel_details as $details): ?>
            <tr>                
                <td><?=$details->id; ?> </td>
                <td><?=$details->name; ?> </td>
                <td><?=$details->place; ?> </td>
                <td><?=$details->date; ?> </td>
                <td><?=$details->price; ?> </td>
                <td class="text-center"><img class="w-25" src="upload/<?=$details->image; ?>" alt=""> </td>  
                <td> <a href="edit.php?id=<?=$details->id; ?>" class="btn btn-success" target="_blank">Edit</a></td>              
                <td>                     
                    <form action="code.php" method="post">
                        <button type="submit" name="delete_btn" onclick="return confirm('Are you sure?')" value="<?=$details->id;?>" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>                
            <?php endforeach ?>           
        </tbody>       
    </table>
</div>

<div>
<h2 class="text-center"> Insert Hotel Details</h2>
<div class="container form-control w-25 p-3 bg-info">
<form action="" method="post" enctype="multipart/form-data">
    <div>
        <input type="text" name="name" id="name" class=" mt-3" placeholder="Name">
    </div>
    <div>
        <input type="text" name="place" id="place" class=" mt-3" placeholder="place" >
    </div>
    <div>
        <input type="date" name="date" id="date" class="mt-3" placeholder="date">
    </div>
    <div>
        <input type="text" name="price" id="price" class="mt-3" placeholder="price">
    </div>
    <div>
        <input type="file" name="image" id="image" class="mt-3" placeholder="image">
    </div>
    <div>
        <input type="submit" name="submit" class="btn btn-primary mt-3"/>
    </div>
</form>
</div>

<?php
    require 'footer.php';        
?>