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
			"employee_name" => $_POST['employee_name'],
			"role"  => $_POST['role'],
			"ssn"     => $_POST['ssn'],
			"wage"     => $_POST['wage'],
		);
		if(empty($_POST['employee_name']) || empty($_POST['wage']) ||  empty($_POST['role'])){
			$statement=0;
			echo '<script>alert("employee_name or wage or role  is  empty!");</script>';
		}else{
			$id=$_POST['employee_id'];
			if(empty($id)){
				$sql = sprintf(
						"INSERT INTO %s (%s) values (%s)",
						"employees",
						implode(", ", array_keys($plants)),
						":" . implode(", :", array_keys($plants))
				);
				$statement = $connection->prepare($sql);
				if($statement->execute($plants)){
					echo '<script>alert("add success!");location.href="employlist.php"</script>';
				}
			}else{
	            $sql="update employees set employee_name='".$_POST['employee_name']."',role='". $_POST['role']."',ssn='". $_POST['ssn']."',wage='". $_POST['wage']."'   where  employee_id=".$id;
				if($connection->exec($sql)>0){
					echo '<script>alert("edit success!");location.href="employlist.php"</script>';
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
			$sql='delete from employees where employee_id='.$id;
			$result=$connection->exec($sql); 
			if($result>0){
				echo '<script>alert("del success!");location.href="employlist.php"</script>';
			}
		}else if($types=='edit'){
			$sqlt='select * from employees where employee_id='.$id;
			$res=$connection->query($sqlt); 
			  if(count($res)==1){
			  	foreach($res as $row){
			  	?>
				  <form method="post">
					<label for="firstname">employee_name</label>
					<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $row['employee_id']; ?>">
					<input type="text" name="employee_name" id="employee_name" value="<?php echo $row['employee_name']; ?>">
					
					<label for="lastname">role</label>
					<input type="text" name="role" id="role" value="<?php echo $row['role']; ?>">
					<label for="email">ssn</label>
					<input type="text" name="ssn" id="ssn" value="<?php echo $row['ssn']; ?>">
					<label for="firstname">wage</label>
					<input type="text" name="wage" id="wage" value="<?php echo $row['wage']; ?>">
					<input type="submit" name="submit" value="Submit">
				   </form> 

			<?php }}}else {?>

				   <form method="post">
				    <input type="hidden" name="employee_id" id="employee_id" >
					<label for="firstname">employee_name</label>
					<input type="text" name="employee_name" id="employee_name" >
					<label for="firstname">role</label>
					<input type="text" name="role" id="role">
					<label for="lastname">ssn</label>
					<input type="text" name="ssn" id="ssn">
					<label for="email">wage</label>
					<input type="text" name="wage" id="wage">
					<input type="submit" name="submit" value="Submit">
				   </form> 

<?php }}else{?>
				   <form method="post">
				    <input type="hidden" name="employee_id" id="employee_id" >
					<label for="firstname">employee_name</label>
					<input type="text" name="employee_name" id="employee_name" >
					<label for="firstname">role</label>
					<input type="text" name="role" id="role">
					<label for="lastname">ssn</label>
					<input type="text" name="ssn" id="ssn">
					<label for="email">wage</label>
					<input type="text" name="wage" id="wage">
					<input type="submit" name="submit" value="Submit">
				   </form> 
<?php }?>
     
<?php require "templates/footer.php"; ?>