<?php
	require "../config.php";
	require "../common.php";
	if (isset($_POST['submit']))
	{
		try
		{
			$connection = new PDO($dsn, $username, $password, $options);
			$plants = array(
					"product_id" => $_POST['product_id'],
					"client_id"  => $_POST['client_id'],
					"order_date"     =>  date('Y-m-d H:i:s'),
					"approved_status"     =>0,
					"person_in_charge"     =>$_POST['person_in_charge'],
					"shipment_id"     =>$_POST['shipment_id']
			);
			if(empty($_POST['person_in_charge'])){
				$statement=0;
				echo '<script>alert("person_in_charge  is  empty!");</script>';
			}else{

					$sql = sprintf(
							"INSERT INTO %s (%s) values (%s)",
							"orders",
							implode(", ", array_keys($plants)),
							":" . implode(", :", array_keys($plants))
					);
					$statement = $connection->prepare($sql);
					if($statement->execute($plants)){
						echo '<script>alert("order success!");location.href="order.php"</script>';
					}
			}
		}
		catch(PDOException $error)
		{
			echo $sql . "<br>" . $error->getMessage();
		}

	}
	try
	{
		$connection = new PDO($dsn, $username, $password, $options);
		$sql="select * from plants  ";
		$plants=$connection->query($sql);
		$sql="select * from customers  ";
		$customers=$connection->query($sql);
		$sql="select * from shipments  ";
		$shipments=$connection->query($sql);
	}
	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}

 require "templates/header.php"; ?>

 <link href="css/bootstrap.css" rel="stylesheet" />
 <link href="css/style.css" rel="stylesheet" />
 <script src="js/jquery-1.9.1.min.js"></script>
 <dl class="leftmenu" style="float:left">
        <dd>
            <div class="title">
                <span><img src="images/leftico01.png" /></span>
                  Management System
            </div>
            <ul class="menuson">
                <li class="active"><cite></cite><a href="index.php" target="rightFrame">Add Order</a><i></i></li>
                <li ><cite></cite><a href="addresslist.php" target="rightFrame">address</a><i></i></li>
                <li><cite></cite><a href="cardslist.php" target="rightFrame">creditcards</a><i></i></li>
                <li><cite></cite><a href="customerlist.php" target="rightFrame">customers</a><i></i></li>
                <li><cite></cite><a href="employlist.php" target="rightFrame">employees</a><i></i></li>
                <li><cite></cite><a href="order.php" target="rightFrame">orders</a><i></i></li>
                <li ><cite></cite><a href="plantslist.php" target="rightFrame">plants</a><i></i></li>
                <li><cite></cite><a href="shipmentslist.php" target="rightFrame">shipments</a><i></i></li>
            </ul>
        </dd>
      </dl>
 <div class="formbody" style="width:900px;float:left;margin:0px auto">
   <form method="post">
    <ul>
			<li style="line-height: 40px;"><span for="firstname">product_name</span>
					<select name="product_id" id="product_id" style="border: 1px solid #dadada;width: 180px;height: 26px;">
					   <?php  foreach($plants as $mm){?>
					       <option value="<?php echo $mm['product_id']; ?>"><?php echo $mm['plants_name']; ?></option>
					   <?php }?>
					</select>
 			</li>
 			<li style="line-height: 40px;">
					<span for="email">client_name</span>
					<select name="client_id" id="client_id" style="border: 1px solid #dadada;width: 180px;height: 26px;">
					   <?php  foreach($customers as $mm){
					     if($mm['address_id']==$row['billing_address_id']){?>
					       <option value="<?php echo $mm['client_id']; ?>"><?php echo $mm['customer_name']; ?></option>
					   <?php }}?>
					</select>
		    </li>
		    <li style="line-height: 40px;">
					<span for="firstname">person_in_charge</span>
					 <input type="text" name="person_in_charge" id="person_in_charge" style="border: 1px solid #dadada;height: 26px;" value="">
		    </li>
		    <li style="line-height: 40px;">
					 <span for="email">shipments</span>
					<select name="shipment_id" id="shipment_id" style="border: 1px solid #dadada;width: 180px;height: 26px;">
					   <?php  foreach($shipments as $mm){
					     if($mm['address_id']==$row['billing_address_id']){?>
					       <option value="<?php echo $mm['shipment_id']; ?>"><?php echo $mm['address']; ?></option>
					   <?php }}?>
					</select>
		    </li>
		    <li style="line-height: 40px;">
					<input type="submit" class="btn" name="submit" value="Submit">
			</li>
		 </ul>
	   </form>
</div>
