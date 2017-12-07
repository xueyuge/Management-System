<?php
	require "../config.php";
	require "../common.php";
	$connection = new PDO($dsn, $username, $password, $options);
	try
	{
		$sql="select a.product_id,a.approved_status,a.order_date,a.client_id,a.person_in_charge,(case a.approved_status when 0  then 'Shipped”'  else 'Delivered' end) as approved,b.plants_name as product_name,c.customer_name as clientname,d.address as shipment from orders a LEFT JOIN plants b on a.product_id=b.product_id  left join customers c  on a.client_id=c.client_id  left join shipments d on  a.shipment_id=d.shipment_id ";
		$res=$connection->query($sql);
	}
	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}
	if(!empty($_GET['cid']) && !empty($_GET['id']) && !empty($_GET['charge'])){
		$sql='update  orders set approved_status=1  where product_id='.$_GET['id'].'  and  client_id='.$_GET['cid'].'  and  person_in_charge='.$_GET['charge'];
		if($connection->exec($sql)>0){
			echo '<script>alert("check out success!");location.href="order.php"</script>';
		}

	}
 require "templates/header.php"; ?>

 <link href="css/bootstrap.css" rel="stylesheet" />
 <link href="css/style.css" rel="stylesheet" />
 <script src="js/jquery-1.9.1.min.js"></script>
 <dl class="leftmenu" style="float:left">
        <dd>
            <div class="title">
                <span><img src="images/leftico01.png" /></span>
                  Menu
            </div>
            <ul class="menuson">
                <li><cite></cite><a href="index.php" target="rightFrame">Add Order</a><i></i></li>
                <li ><cite></cite><a href="addresslist.php" target="rightFrame">address</a><i></i></li>
                <li><cite></cite><a href="cardslist.php" target="rightFrame">creditcards</a><i></i></li>
                <li><cite></cite><a href="customerlist.php" target="rightFrame">customers</a><i></i></li>
                <li><cite></cite><a href="employlist.php" target="rightFrame">employees</a><i></i></li>
                <li  class="active"><cite></cite><a href="order.php" target="rightFrame">orders</a><i></i></li>
                <li><cite></cite><a href="plantslist.php" target="rightFrame">plants</a><i></i></li>
                <li><cite></cite><a href="shipmentslist.php" target="rightFrame">shipments</a><i></i></li>
            </ul>
        </dd>
      </dl>
 <div class="formbody"  style="width:900px;float:left;margin:0px auto">
  <table class="tablelist">
        <thead>
            <tr>
                <th>product_name</th>
                <th>clientname</th>
                <th>order_date</th>
                <th>approved_status</th>
                <th>person_in_charge</th>
				<th>shipment</th>
				<th></th>
            </tr>
        </thead>
        <tbody>
		  <?php foreach($res as $row){ ?>
			   <tr>
					<td><?php echo $row['product_name'].'<br/>'; ?></td>
					<td><?php echo $row['clientname'].'<br/>'; ?> </td>
					<td><?php echo $row['order_date'].'<br/>'; ?> </td>
					<td><?php echo $row['approved'].'<br/>'; ?> </td>
					<td><?php echo $row['person_in_charge'].'<br/>'; ?> </td>
					<td><?php echo $row['shipment'].'<br/>'; ?> </td>
					<td>
					<?php if($row['approved_status']==0) {?>
					<a class="tablelink" href="order.php?id=<?php echo $row['product_id']; ?>&cid=<?php echo $row['client_id']; ?>&charge=<?php echo $row['person_in_charge']; ?>">Shipped</a>
					<?php }?>
					</td>
				</tr>
		  <?php } ?>
        </tbody>
    </table>
</div>
