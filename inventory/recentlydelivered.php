<?php 
	require_once("includes/connection.php");
	$to = date("Y-m-d");
	$from = date("Y-m-d", strtotime("-1 week", strtotime($to)));
	function recentlyDel($from,$to){	
		$result=mysqli_query($GLOBALS['con'],"select delivery_list.item_name, delivery_list.item_quantity, delivery_list.unit_price, delivery_list.del_id, delivery.delivery_date FROM delivery_list INNER JOIN delivery ON delivery_list.del_id=delivery.delivery_ID WHERE delivery.delivery_date >= date('" . $from . "') AND delivery.delivery_date <= date('" . $to . "')");
		return $result;
	}
?>

	<table id="stock-tbl" border="1">
		<thead>
			<tr>
				<th>Items</th>
				<th class="tbl-sellingprice">Item Quantity</th>
				<th class="tbl-sellingprice">Unit Price</th>
			</tr>
		</thead>
		<tbody>	
		<?php $items = recentlyDel($from,$to);
		while($row = mysqli_fetch_array($items)){ ?>
			<tr>
				<td><?php echo $row['item_name']?></td>
				<td class="tbl-sellingprice"><?php echo $row['item_quantity']?></td>
				<td class="tbl-sellingprice"><?php echo $row['unit_price']?></td>
			</tr>
		<?php } ?>
		</tbody>	
	</table>

<?php 
	$result=mysqli_query($con,"select count(delivery_list.item_name) as total, delivery_list.del_id, delivery.delivery_date FROM delivery_list INNER JOIN delivery ON delivery_list.del_id=delivery.delivery_ID WHERE delivery.delivery_date >= date('" . $from . "') AND delivery.delivery_date <= date('" . $to . "')");
	
	$num=mysqli_fetch_assoc($result);
	$count=$num['total'];

	if($count==0){ ?>
		<h3 class="note"><i>No Items Delivered Recently</i></h3>
	<?php }
?>