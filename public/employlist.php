<?php
	require "../config.php";
	require "../common.php";
	try
	{
		$connection = new PDO($dsn, $username, $password, $options);
		$sql="select * from employees ";
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
                <li><cite></cite><a href="cardslist.php" target="rightFrame">creditcards</a><i></i></li>
                <li><cite></cite><a href="customerlist.php" target="rightFrame">customers</a><i></i></li>
                <li class="active"><cite></cite><a href="employlist.php" target="rightFrame">employees</a><i></i></li>
                <li><cite></cite><a href="order.php" target="rightFrame">orders</a><i></i></li>
                <li ><cite></cite><a href="plantslist.php" target="rightFrame">plants</a><i></i></li>
                <li><cite></cite><a href="shipmentslist.php" target="rightFrame">shipments</a><i></i></li>
            </ul>
        </dd>
      </dl>
 <div class="formbody"  style="width:900px;float:left;margin:0px auto">
  <form id="form1">
            <ul class="forminfo" style="padding-left:0px">
                <li><input name="" type="text" id="savebtn" class="btn" onclick="javascript:location.href='employ.php?type=add&id=0'" value="add" /></li>
            </ul>
        </form>
  <table class="tablelist">
        <thead>
            <tr>
            	<th>employee_id</th>
                <th>employee_name</th>
                <th>role</th>
                <th>ssn</th>
                <th>wage</th>
				<th></th>
            </tr>
        </thead>
        <tbody>
		  <?php foreach($res as $row){ ?>
			   <tr>
					<td><?php echo $row['employee_id'].'<br/>'; ?></td>
					<td><?php echo $row['employee_name'].'<br/>'; ?> </td>
					<td><?php echo $row['role'].'<br/>'; ?> </td>
					<td><?php echo $row['ssn'].'<br/>'; ?> </td>
					<td><?php echo $row['wage'].'<br/>'; ?> </td>
					<td><a class="tablelink" href="employ.php?type=edit&id=<?php echo $row['employee_id']; ?>">edit</a> <a class="tablelink" href="employ.php?type=del&id=<?php echo $row['employee_id']; ?>">del</a>  </td>
				</tr>
		  <?php } ?>
        </tbody>
    </table>
</div>
