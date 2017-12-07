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
			"customer_name" => $_POST['customer_name'],
			"registration_date"  => date('Y-m-d H:i:s'),
			"sex"     => $_POST['sex'],
			"favorite_plant"       => $_POST['favorite_plant'],
			"shipping_address"  =>intval($_POST['shipping_address']),
		);
		if(empty($_POST['customer_name']) || empty($_POST['sex']) ||  empty($_POST['favorite_plant']) ||  empty($_POST['shipping_address'])){
			$statement=0;
			echo '<script>alert("customer_name or sex or favorite_plant or stock is shipping_address !");</script>';
		}else{
			$id=$_POST['client_id'];
			if(empty($id)){
				$sql = sprintf(
						"INSERT INTO %s (%s) values (%s)",
						"customers",
						implode(", ", array_keys($plants)),
						":" . implode(", :", array_keys($plants))
				);
				$statement = $connection->prepare($sql);
				if($statement->execute($plants)){
					echo '<script>alert("add success!");location.href="customerlist.php"</script>';
				}
			}else{
	            $sql="update customers set customer_name='".$_POST['customer_name']."',sex='". $_POST['sex']."',favorite_plant='". $_POST['favorite_plant']."',shipping_address='". $_POST['shipping_address']."'  where  client_id=".$id;
				if($connection->exec($sql)>0){
					echo '<script>alert("edit success!");location.href="customerlist.php"</script>';
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
			$sql='delete from customers where client_id='.$id;
			$result=$connection->exec($sql); 
			if($result>0){
				echo '<script>alert("del success!");location.href="customerlist.php"</script>';
			}
		}else if($types=='edit'){
			$sqlt='select * from customers where client_id='.$id;
			$res=$connection->query($sqlt); 
			  if(count($res)==1){
			  	foreach($res as $row){
			  	?>
				  <form method="post">
					<label for="firstname">customer_name</label>
					<input type="hidden" name="client_id" id="client_id" value="<?php echo $row['client_id']; ?>">
					<input type="text" name="customer_name" id="customer_name" value="<?php echo $row['customer_name']; ?>">
					<label for="firstname">sex</label>
					<input type="text" name="sex" id="sex" value="<?php echo $row['sex']; ?>">
					<label for="lastname">favorite_plant</label>
					<input type="text" name="favorite_plant" id="favorite_plant" value="<?php echo $row['favorite_plant']; ?>">
					<label for="email">shipping_address</label>
					<input type="text" name="shipping_address" id="shipping_address" value="<?php echo $row['shipping_address']; ?>">
					<input type="submit" name="submit" value="Submit">
				   </form> 

			<?php }}}else {?>

				   <form method="post">
				   <input type="hidden" name="client_id" id="client_id" >
					<label for="firstname">customer_name</label>
					<input type="text" name="customer_name" id="customer_name" >
					<label for="firstname">sex</label>
					<input type="text" name="sex" id="sex">
					<label for="lastname">favorite_plant</label>
					<input type="text" name="favorite_plant" id="favorite_plant">
					<label for="email">shipping_address</label>
					<input type="text" name="shipping_address" id="shipping_address">
					<input type="submit" name="submit" value="Submit">
				   </form> 

<?php }}else{?>
				    <form method="post">
				    <input type="hidden" name="client_id" id="client_id" >
					<label for="firstname">customer_name</label>
					<input type="text" name="customer_name" id="customer_name" >
					<label for="firstname">sex</label>
					<input type="text" name="sex" id="sex">
					<label for="lastname">favorite_plant</label>
					<input type="text" name="favorite_plant" id="favorite_plant">
					<label for="email">shipping_address</label>
					<input type="text" name="shipping_address" id="shipping_address">
					<input type="submit" name="submit" value="Submit">
				   </form> 
<?php }?>
     
<?php require "templates/footer.php"; ?>