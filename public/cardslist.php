<?php
	require "../config.php";
	require "../common.php";
	try
	{
		$connection = new PDO($dsn, $username, $password, $options);
		$sql="select a.*,b.address_id,b.state,b.city,b.street,b.street_num,c.client_id,c.customer_name from creditcards a  left join address b on a.billing_address_id=b.address_id  left join customers c on a.credit_card_user_id=c.client_id ";
		$res=$connection->query($sql);
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
                  Menu
            </div>
            <ul class="menuson">
                <li><cite></cite><a href="index.php" target="rightFrame">Add Order</a><i></i></li>
                <li ><cite></cite><a href="addresslist.php" target="rightFrame">address</a><i></i></li>
                <li class="active"><cite></cite><a href="cardslist.php" target="rightFrame">creditcards</a><i></i></li>
                <li><cite></cite><a href="customerlist.php" target="rightFrame">customers</a><i></i></li>
                <li><cite></cite><a href="employlist.php" target="rightFrame">employees</a><i></i></li>
                <li><cite></cite><a href="order.php" target="rightFrame">orders</a><i></i></li>
                <li ><cite></cite><a href="plantslist.php" target="rightFrame">plants</a><i></i></li>
                <li><cite></cite><a href="shipmentslist.php" target="rightFrame">shipments</a><i></i></li>
            </ul>
        </dd>
      </dl>
 <div class="formbody"  style="width:900px;float:left;margin:0px auto">
 <div class="formtitle"><span>plantlist</span></div>
        <form id="form1">
            <ul class="forminfo" style="padding-left:0px">
                <li><input name="" type="text" id="savebtn" class="btn" onclick="javascript:location.href='cards.php?type=add&id=0'" value="add" /></li>
            </ul>
        </form>
  <table class="tablelist">
        <thead>
            <tr>
            	<th>credit_card_id</th>
                <th>cc_num</th>
                <th>bank_name</th>
                <th>billing_address</th>
                <th>credit_card_user</th>
				<th></th>
            </tr>
        </thead>
        <tbody>
		  <?php foreach($res as $row){ ?>
			   <tr>
					<td><?php echo $row['credit_card_id']; ?></td>
					<td><?php echo $row['cc_num'].''; ?> </td>
					<td><?php echo $row['bank_name'].''; ?> </td>
					<td><?php echo $row['state'].'/'.$row['city'].'/'.$row['street'].'/'.$row['street_num']; ?> </td>
					<td><?php echo $row['customer_name'].''; ?> </td>
					<td><a class="tablelink" href="cards.php?type=edit&id=<?php echo $row['credit_card_id']; ?>">edit</a> <a class="tablelink" href="cards.php?type=del&id=<?php echo $row['credit_card_id']; ?>">del</a>  </td>
				</tr>
		  <?php } ?>
        </tbody>
    </table>
</div>
