<?php
	require "../config.php";
	require "../common.php";
	try 
	{
		$connection = new PDO($dsn, $username, $password, $options);
		$sql="select * from address "; 
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
                <li><cite></cite><a href="index.php" target="rightFrame">home</a><i></i></li>
                <li class="active"><cite></cite><a href="addresslist.php" target="rightFrame">address</a><i></i></li>
                <li><cite></cite><a href="cardslist.php" target="rightFrame">creditcards</a><i></i></li>
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
                <li><input name="" type="text" id="savebtn" class="btn" onclick="javascript:location.href='address.php?type=add&id=0'" value="add" /></li>
            </ul>
        </form>
  <table class="tablelist">
        <thead>
            <tr>
            	<th>address_id</th>
                <th>street</th>
                <th>street_num</th>
                <th>city</th>
                <th>state</th>
                <th>zip_code</th>
				<th></th>
            </tr>
        </thead>
        <tbody>
		  <?php foreach($res as $row){ ?>
			   <tr>
					<td><?php echo $row['address_id'].'<br/>'; ?></td>
					<td><?php echo $row['street'].'<br/>'; ?> </td>
					<td><?php echo $row['street_num'].'<br/>'; ?> </td>
					<td><?php echo $row['city'].'<br/>'; ?> </td>
					<td><?php echo $row['state'].'<br/>'; ?> </td>
					<td><?php echo $row['zip_code'].'<br/>'; ?> </td>
					<td><a class="tablelink" href="address.php?type=edit&id=<?php echo $row['address_id']; ?>">edit</a> <a class="tablelink" href="address.php?type=del&id=<?php echo $row['address_id']; ?>">del</a>  </td>
				</tr>
		  <?php } ?>  
        </tbody>
    </table>
</div>