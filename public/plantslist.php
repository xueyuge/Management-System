<?php
	require "../config.php";
	require "../common.php";
	try
	{
		$connection = new PDO($dsn, $username, $password, $options);
		$tempkeywords =!empty($_GET['keywords'])? " plants_name like  '%".urldecode($_GET['keywords'])."%' or  price like  '%".urldecode($_GET['keywords'])."%'  or  category like  '%".urldecode($_GET['keywords'])."%'  or  color like  '%".urldecode($_GET['keywords'])."%'   or  size like  '%".urldecode($_GET['keywords'])."%'   or  min_ph like  '%".urldecode($_GET['keywords'])."%'     or  max_ph like  '%".urldecode($_GET['keywords'])."%' ":' 1=1';
		$sql="select * from plants  where  ".$tempkeywords.'  order by  min_ph asc';
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
                  Management System
            </div>
            <ul class="menuson">
                <li><cite></cite><a href="index.php" target="rightFrame">Add Order</a><i></i></li>
                <li ><cite></cite><a href="addresslist.php" target="rightFrame">address</a><i></i></li>
                <li><cite></cite><a href="cardslist.php" target="rightFrame">creditcards</a><i></i></li>
                <li><cite></cite><a href="customerlist.php" target="rightFrame">customers</a><i></i></li>
                <li><cite></cite><a href="employlist.php" target="rightFrame">employees</a><i></i></li>
                <li><cite></cite><a href="order.php" target="rightFrame">orders</a><i></i></li>
                <li class="active"><cite></cite><a href="plantslist.php" target="rightFrame">plants</a><i></i></li>
                <li><cite></cite><a href="shipmentslist.php" target="rightFrame">shipments</a><i></i></li>
            </ul>
        </dd>
      </dl>
 <div class="formbody"  style="width:900px;float:left;margin:0px auto">
        <div class="formtitle"><span>plantlist</span></div>
        <form id="form1">
            <ul class="forminfo">
                <li><label>keywords<b>*</b></label><input id="keywords" name="keywords" placeholder="category/color/name/price/size/ph" type="text" class="dfinput"/><input name="" type="submit" id="savebtn" class="btn" value="search" /><input name="" type="text" id="savebtn" class="btn" style="margin-left:20px"  onclick="javascript:location.href='plants.php?type=add&id=0'" value="add" /></li>
			</ul>
        </form>
  <table class="tablelist">
        <thead>
            <tr>
                <th>product_id</th>
                <th>plants_name</th>
                <th>price</th>
                <th>category</th>
                <th>color</th>
				<th>size</th>
                <th>min_ph</th>
				<th>max_ph</th>
				<th>stock</th>
				<th></th>
            </tr>
        </thead>
        <tbody>
		  <?php foreach($res as $row){ ?>
			   <tr>
					<td><?php echo $row['product_id'].'<br/>'; ?></td>
					<td><?php echo $row['plants_name'].'<br/>'; ?> </td>
					<td><?php echo $row['price'].'<br/>'; ?> </td>
					<td><?php echo $row['category'].'<br/>'; ?> </td>
					<td><?php echo $row['color'].'<br/>'; ?> </td>
					<td><?php echo $row['size'].'<br/>'; ?> </td>
					<td><?php echo $row['min_ph'].'<br/>'; ?> </td>
					<td><?php echo $row['max_ph'].'<br/>'; ?> </td>
					<td><?php echo $row['stock'].'<br/>'; ?> </td>
					<td><a class="tablelink" href="plants.php?type=edit&id=<?php echo $row['product_id']; ?>">edit</a> <a class="tablelink" href="plants.php?type=del&id=<?php echo $row['product_id']; ?>">del</a>  </td>
				</tr>
		  <?php } ?>
        </tbody>
    </table>
</div>
