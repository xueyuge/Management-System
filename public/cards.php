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
			"cc_num" => $_POST['cc_num'],
			"bank_name"  => $_POST['bank_name'],
			"billing_address_id"     => $_POST['billing_address_id'],
			"credit_card_user_id"     => $_POST['credit_card_user_id'],
		);
		if(empty($_POST['cc_num']) || empty($_POST['bank_name']) ||  empty($_POST['billing_address_id']) ||  empty($_POST['credit_card_user_id'])){
			$statement=0;
			echo '<script>alert("cc_num or wage or bank_name or billing_address or credit_card_user  is  empty!");</script>';
		}else{
			$id=$_POST['credit_card_id'];
			if(empty($id)){
				$sql = sprintf(
						"INSERT INTO %s (%s) values (%s)",
						"creditcards",
						implode(", ", array_keys($plants)),
						":" . implode(", :", array_keys($plants))
				);
				$statement = $connection->prepare($sql);
				if($statement->execute($plants)){
					echo '<script>alert("add success!");location.href="cardslist.php"</script>';
				}
			}else{
	            $sql="update creditcards set cc_num='".$_POST['cc_num']."',bank_name='". $_POST['bank_name']."',billing_address_id='". $_POST['billing_address_id']."',credit_card_user_id='". $_POST['credit_card_user_id']."'   where  credit_card_id=".$id;
				if($connection->exec($sql)>0){
					echo '<script>alert("edit success!");location.href="cardslist.php"</script>';
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
$connection = new PDO($dsn, $username, $password, $options);
$addresssql='select * from address';
$address=$connection->query($addresssql);
$customsql='select * from customers';
$custom=$connection->query($customsql);
 if(!empty($_GET['type'])){
    $types=$_GET['type'];
	$id=$_GET['id'];
      
		if($types=='del')
		{
			$sql='delete from creditcards where credit_card_id='.$id;
			$result=$connection->exec($sql); 
			if($result>0){
				echo '<script>alert("del success!");location.href="cardslist.php"</script>';
			}
		}else if($types=='edit'){
			$sqlt='select * from creditcards where credit_card_id='.$id;
			$res=$connection->query($sqlt); 
			  if(count($res)==1){
			  	foreach($res as $row){
			  	?>
				  <form method="post">
					<label for="firstname">cc_num</label>
					<input type="hidden" name="credit_card_id" id="credit_card_id" value="<?php echo $row['credit_card_id']; ?>">
					<input type="text" name="cc_num" id="cc_num" value="<?php echo $row['cc_num']; ?>">
					
					<label for="lastname">bank_name</label>
					<input type="text" name="bank_name" id="bank_name" value="<?php echo $row['bank_name']; ?>">
					<label for="email">billing_address</label>
					<select name="billing_address_id" id="billing_address_id">
					   <?php  foreach($address as $mm){
					     if($mm['address_id']==$row['billing_address_id']){?>
					       <option value="<?php echo $mm['address_id']; ?>" selected="selected"><?php echo $mm['state'].'/'.$mm['city'].'/'.$mm['street'].'/'.$mm['street_num']; ?></option>
					   <?php }else{?>
					       <option value="<?php echo $mm['address_id']; ?>"><?php echo $mm['state'].'/'.$mm['city'].'/'.$mm['street'].'/'.$mm['street_num']; ?></option>
					   <?php }}?>
					</select>
					<label for="firstname">credit_card_user</label>
					<select name="credit_card_user_id" id="credit_card_user_id">
					   <?php  foreach($custom as $nn){
					   	if($nn['client_id']==$row['credit_card_user_id']){?>
					     <option value="<?php echo $nn['client_id']; ?>" selected="selected"><?php echo $nn['customer_name']; ?></option>
					   <?php }else{?>
					   <option value="<?php echo $nn['client_id']; ?>"><?php echo $nn['customer_name']; ?></option>
					   <?php }}?>
					</select>
					 
					<input type="submit" name="submit" value="Submit">
				   </form> 

			<?php }}}else {?>

				   <form method="post">
				    <input type="hidden" name="credit_card_id" id="credit_card_id" >
					<label for="firstname">cc_num</label>
					<input type="text" name="cc_num" id="cc_num" >
					<label for="firstname">bank_name</label>
					<input type="text" name="bank_name" id="bank_name">
					<label for="email">billing_address</label>
					<select name="billing_address_id" id="billing_address_id">
					   <?php  foreach($address as $mm){
					     if($mm['address_id']==$row['billing_address_id']){?>
					       <option value="<?php echo $mm['address_id']; ?>" selected="selected"><?php echo $mm['state'].'/'.$mm['city'].'/'.$mm['street'].'/'.$mm['street_num']; ?></option>
					   <?php }else{?>
					       <option value="<?php echo $mm['address_id']; ?>"><?php echo $mm['state'].'/'.$mm['city'].'/'.$mm['street'].'/'.$mm['street_num']; ?></option>
					   <?php }}?>
					</select>
					<label for="firstname">credit_card_user</label>
					<select name="credit_card_user_id" id="credit_card_user_id">
					   <?php  foreach($custom as $nn){
					   	if($nn['client_id']==$row['credit_card_user_id']){?>
					     <option value="<?php echo $nn['client_id']; ?>" selected="selected"><?php echo $nn['customer_name']; ?></option>
					   <?php }else{?>
					   <option value="<?php echo $nn['client_id']; ?>"><?php echo $nn['customer_name']; ?></option>
					   <?php }}?>
					</select>
					<input type="submit" name="submit" value="Submit">
				   </form> 

<?php }}else{?>
				    <form method="post">
				    <input type="hidden" name="credit_card_id" id="credit_card_id" >
					<label for="firstname">cc_num</label>
					<input type="text" name="cc_num" id="cc_num" >
					<label for="firstname">bank_name</label>
					<input type="text" name="bank_name" id="bank_name">
					<label for="email">billing_address</label>
					<select name="billing_address_id" id="billing_address_id">
					   <?php  foreach($address as $mm){
					     if($mm['address_id']==$row['billing_address_id']){?>
					       <option value="<?php echo $mm['address_id']; ?>" selected="selected"><?php echo $mm['state'].'/'.$mm['city'].'/'.$mm['street'].'/'.$mm['street_num']; ?></option>
					   <?php }else{?>
					       <option value="<?php echo $mm['address_id']; ?>"><?php echo $mm['state'].'/'.$mm['city'].'/'.$mm['street'].'/'.$mm['street_num']; ?></option>
					   <?php }}?>
					</select>
					<label for="firstname">credit_card_user</label>
					<select name="credit_card_user_id" id="credit_card_user_id">
					   <?php  foreach($custom as $nn){
					   	if($nn['client_id']==$row['credit_card_user_id']){?>
					     <option value="<?php echo $nn['client_id']; ?>" selected="selected"><?php echo $nn['customer_name']; ?></option>
					   <?php }else{?>
					   <option value="<?php echo $nn['client_id']; ?>"><?php echo $nn['customer_name']; ?></option>
					   <?php }}?>
					</select>
					<input type="submit" name="submit" value="Submit">
				   </form> 
<?php }?>
     
<?php require "templates/footer.php"; ?>