<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */

require "../config.php";
require "../common.php";
if (isset($_POST['submit']))
{
	try 
	{
		$connection = new PDO($dsn, $username, $password, $options);
		$plants = array(
			"plants_name" => $_POST['plants_name'],
			"price"  => $_POST['price'],
			"category"     => $_POST['category'],
			"color"       => $_POST['color'],
			"size"  =>intval($_POST['size']),
			"min_ph"  => intval($_POST['min_ph']),
			"max_ph"  =>intval($_POST['max_ph']),
			"stock"  =>intval($_POST['stock'])
		);
		if(empty($_POST['plants_name']) || empty($_POST['price']) ||  empty($_POST['category']) ||  empty($_POST['stock'])){
			$statement=0;
			echo '<script>alert("plants_name or price or category or stock is empty !");</script>';
		}else{
			$id=$_POST['product_id'];
			if(empty($id)){
				$sql = sprintf(
						"INSERT INTO %s (%s) values (%s)",
						"plants",
						implode(", ", array_keys($plants)),
						":" . implode(", :", array_keys($plants))
				);
				$statement = $connection->prepare($sql);
				if($statement->execute($plants)){
					echo '<script>alert("add success!");location.href="plantslist.php"</script>';
				}
			}else{
	            $sql="update plants set plants_name='".$_POST['plants_name']."',price='". $_POST['price']."',category='". $_POST['category']."',color='". $_POST['color']."',size='". $_POST['size']."',min_ph='". $_POST['min_ph']."',max_ph='".  $_POST['max_ph']."',stock='". $_POST['stock']."'  where  product_id=".$id;
				if($connection->exec($sql)>0){
					echo '<script>alert("edit success!");location.href="plantslist.php"</script>';
				}
			}
		}
	}
	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
	
}
?>
<?php require "templates/header.php"; ?>
<?php 
 if(!empty($_GET['type'])){
    $types=$_GET['type'];
	$id=$_GET['id'];
        $connection = new PDO($dsn, $username, $password, $options);
		if($types=='del')
		{
			$sql='delete from plants where product_id='.$id;
			$result=$connection->exec($sql); 
			if($result>0){
				echo '<script>alert("del success!");location.href="plantslist.php"</script>';
			}
		}else if($types=='edit'){
			$sqlt='select * from plants where product_id='.$id;
			$res=$connection->query($sqlt); 
			  if(count($res)==1){
			  	foreach($res as $row){
			  	?>
				  <form method="post">
					<label for="firstname">plants_name</label>
					<input type="hidden" name="product_id" id="product_id" value="<?php echo $row['product_id']; ?>">
					<input type="text" name="plants_name" id="plants_name" value="<?php echo $row['plants_name']; ?>">
					<label for="lastname">price</label>
					<input type="text" name="price" id="price" value="<?php echo $row['price']; ?>">
					<label for="email">category</label>
					<input type="text" name="category" id="category" value="<?php echo $row['category']; ?>">
					<label for="age">color</label>
					<input type="text" name="color" id="color"  value="<?php echo $row['color']; ?>">
					<label for="location">size</label>
					<input type="text" name="size" id="size" value="<?php echo $row['size']; ?>">
					<label for="location">min_ph</label>
					<input type="text" name="min_ph" id="min_ph"  value="<?php echo $row['min_ph']; ?>">
					<label for="location">max_ph</label>
					<input type="text" name="max_ph" id="max_ph"  value="<?php echo $row['max_ph']; ?>">
					<label for="location">stock</label>
					<input type="text" name="stock" id="stock"   value="<?php echo $row['stock']; ?>">
					<input type="submit" name="submit" value="Submit">
				   </form> 

			<?php }}}else {?>

				   <form method="post">
					<label for="firstname">plants_name</label>
					<input type="hidden" name="product_id" id="product_id" >
					<input type="text" name="plants_name" id="plants_name">
					<label for="lastname">price</label>
					<input type="text" name="price" id="price">
					<label for="email">category</label>
					<input type="text" name="category" id="category">
					<label for="age">color</label>
					<input type="text" name="color" id="color">
					<label for="location">size</label>
					<input type="text" name="size" id="size">
					<label for="location">min_ph</label>
					<input type="text" name="min_ph" id="min_ph">
					<label for="location">max_ph</label>
					<input type="text" name="max_ph" id="max_ph">
					<label for="location">stock</label>
					<input type="text" name="stock" id="stock">
					<input type="submit" name="submit" value="Submit">
				   </form> 

<?php }}else{?>
   
				   <form method="post">
					<label for="firstname">plants_name</label>
					<input type="hidden" name="product_id" id="product_id" >
					<input type="text" name="plants_name" id="plants_name">
					<label for="lastname">price</label>
					<input type="text" name="price" id="price">
					<label for="email">category</label>
					<input type="text" name="category" id="category">
					<label for="age">color</label>
					<input type="text" name="color" id="color">
					<label for="location">size</label>
					<input type="text" name="size" id="size">
					<label for="location">min_ph</label>
					<input type="text" name="min_ph" id="min_ph">
					<label for="location">max_ph</label>
					<input type="text" name="max_ph" id="max_ph">
					<label for="location">stock</label>
					<input type="text" name="stock" id="stock">
					<input type="submit" name="submit" value="Submit">
				   </form> 
<?php }?>
     
<?php require "templates/footer.php"; ?>