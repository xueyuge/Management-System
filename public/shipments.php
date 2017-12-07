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
		
		$new_user = array(
			"address" => $_POST['address'],
			"tracking"  => $_POST['trackings'],
			"shipping_status"     =>'0'
		);
		if(empty($_POST['address']) || empty($_POST['address']) ||  empty($_POST['trackings'])){
			$statement=0;
			echo '<script>alert("address or tracking  is  empty!");</script>';
		}else{
			$id=$_POST['shipment_id'];
			if(empty($id)){
				$sql = sprintf(
						"INSERT INTO %s (%s) values (%s)",
						"shipments",
						implode(", ", array_keys($new_user)),
						":" . implode(", :", array_keys($new_user))
				);
				$statement = $connection->prepare($sql);
				if($statement->execute($new_user)){
					echo '<script>alert("add success!");location.href="shipmentslist.php"</script>';
				}
			}else{
				$sql="update shipments set address='".$_POST['address']."',tracking='". $_POST['trackings']."'  where  shipment_id=".$id;
				if($connection->exec($sql)>0){
					echo '<script>alert("edit success!");location.href="shipmentslist.php"</script>';
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
			$sql='delete from shipments where shipment_id='.$id;
			$result=$connection->exec($sql); 
			if($result>0){
				echo '<script>alert("del success!");location.href="shipmentslist.php"</script>';
			}
		}else if($types=='edit'){
			$sqlt='select * from shipments where shipment_id='.$id;
			$res=$connection->query($sqlt); 
			  if(count($res)==1){
			  	foreach($res as $row){
			  	?>
				  <form method="post">
				    <input type="hidden" name="shipment_id" id="shipment_id" value="<?php echo $row['shipment_id']; ?>">
					<label for="firstname">address</label>
					<input type="text" name="address" id="address" value="<?php echo $row['address']; ?>">
					<label for="lastname">tracking</label>
					<input type="text" name="trackings" id="trackings" value="<?php echo $row['tracking']; ?>">
					 
					<input type="submit" name="submit" value="Submit">
				   </form> 

			<?php }}}else {?>

				   <form method="post">
				    <input type="hidden" name="shipment_id" id="shipment_id" />
					<label for="firstname">address</label>
					<input type="text" name="address" id="address" >
					<label for="firstname">tracking</label>
					<input type="text" name="trackings" id="trackings">
					<input type="submit" name="submit" value="Submit">
				   </form> 

<?php }}else{?>
				   <form method="post">
				    <input type="hidden" name="shipment_id" id="shipment_id" />
					<label for="firstname">address</label>
					<input type="text" name="address" id="address" >
					<label for="firstname">tracking</label>
					<input type="text" name="trackings" id="trackings">
					<input type="submit" name="submit" value="Submit">
				   </form> 
<?php }?>
     
<?php require "templates/footer.php"; ?>