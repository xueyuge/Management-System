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
			"street" => $_POST['street'],
			"street_num"  => $_POST['street_num'],
			"city"     => $_POST['city'],
			"state"     => $_POST['state'],
			"zip_code"       => $_POST['zip_code']
		);
		if(empty($_POST['street']) || empty($_POST['street_num']) ||  empty($_POST['city']) ||empty($_POST['state']) ||  empty($_POST['zip_code'])){
			$statement=0;
			echo '<script>alert("street or street_num or city or state or zip_code  is  empty!");</script>';
		}else{
			$id=$_POST['address_id'];
			if(empty($id)){
				$sql = sprintf(
						"INSERT INTO %s (%s) values (%s)",
						"address",
						implode(", ", array_keys($plants)),
						":" . implode(", :", array_keys($plants))
				);
				$statement = $connection->prepare($sql);
				if($statement->execute($plants)){
					echo '<script>alert("add success!");location.href="addresslist.php"</script>';
				}
			}else{
	            $sql="update address set street='".$_POST['street']."',street_num='". $_POST['street_num']."',city='". $_POST['city']."',state='". $_POST['state']."',zip_code='". $_POST['zip_code']."'   where  address_id=".$id;
				if($connection->exec($sql)>0){
					echo '<script>alert("edit success!");location.href="addresslist.php"</script>';
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
			$sql='delete from address where address_id='.$id;
			$result=$connection->exec($sql); 
			if($result>0){
				echo '<script>alert("del success!");location.href="addresslist.php"</script>';
			}
		}else if($types=='edit'){
			$sqlt='select * from address where address_id='.$id;
			$res=$connection->query($sqlt); 
			  if(count($res)==1){
			  	foreach($res as $row){
			  	?>
				  <form method="post">
					<label for="firstname">street</label>
					<input type="hidden" name="address_id" id="address_id" value="<?php echo $row['address_id']; ?>">
					<input type="text" name="street" id="street" value="<?php echo $row['street']; ?>">
					
					<label for="lastname">street_num</label>
					<input type="text" name="street_num" id="street_num" value="<?php echo $row['street_num']; ?>">
					<label for="email">city</label>
					<input type="text" name="city" id="city" value="<?php echo $row['city']; ?>">
					<label for="firstname">state</label>
					<input type="text" name="state" id="state" value="<?php echo $row['state']; ?>">
					<label for="firstname">zip_code</label>
					<input type="text" name="zip_code" id="zip_code" value="<?php echo $row['zip_code']; ?>">
					<input type="submit" name="submit" value="Submit">
				   </form> 

			<?php }}}else {?>

				   <form method="post">
				    <input type="hidden" name="address_id" id="address_id" >
					<label for="firstname">street</label>
					<input type="text" name="street" id="street" >
					<label for="firstname">street_num</label>
					<input type="text" name="street_num" id="street_num">
					<label for="lastname">city</label>
					<input type="text" name="city" id="city">
					<label for="email">state</label>
					<input type="text" name="state" id="state">
					<label for="email">zip_code</label>
					<input type="text" name="zip_code" id="zip_code">
					<input type="submit" name="submit" value="Submit">
				   </form> 

<?php }}else{?>
				    <form method="post">
				    <input type="hidden" name="address_id" id="address_id" >
					<label for="firstname">street</label>
					<input type="text" name="street" id="street" >
					<label for="firstname">street_num</label>
					<input type="text" name="street_num" id="street_num">
					<label for="lastname">city</label>
					<input type="text" name="city" id="city">
					<label for="email">state</label>
					<input type="text" name="state" id="state">
					<label for="email">zip_code</label>
					<input type="text" name="zip_code" id="zip_code">
					<input type="submit" name="submit" value="Submit">
				   </form> 
<?php }?>
     
<?php require "templates/footer.php"; ?>