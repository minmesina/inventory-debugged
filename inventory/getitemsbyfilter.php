<?php 
	require_once("includes/connection.php");
	$filter_value=$_GET["filter_value"];

	function getCurrentStock($start,$perpage){
		$result=mysqli_query($GLOBALS['con'],"select * from item where item_quantity >= 1 order by item_quantity ASC Limit $start, $perpage");
		return $result;
	}

	function getOutStock(){
		$result=mysqli_query($GLOBALS['con'],"select * from item where item_quantity=0");
		return $result;
	}

	function countCurrentStock(){
		$result=mysqli_query($GLOBALS['con'],"select count(*) as total from item where item_quantity >= 1");		
		return $result;
	}

	function countOutStock(){
		$result=mysqli_query($GLOBALS['con'],"select count(*) as total from item where item_quantity=0");	
		$num=mysqli_fetch_assoc($result);
		$count=$num['total'];	
		return $count;
	}
?>

	<table id="stock-tbl" border="1">
		<thead>
			<tr>
				<th>Items</th>
				<th class="tbl-stock">Stock</th>
				<th class="tbl-sellingprice">Selling Price</th>
			</tr>
		</thead>
		<tbody>	
			<?php
			if($filter_value=="Current Stocks"){
				$perpage = 10;
			if(isset($_GET["page"])){
				$page = intval($_GET["page"]);
			}
			else {
			$page = 1;
			}

			$calc = $perpage * $page;
			$start = $calc - $perpage;
				$items = getCurrentStock($start,$perpage);
				$rows = mysqli_num_rows($items);
				$result = countCurrentStock();
					$num=mysqli_fetch_assoc($result);
					$count=$num['total'];
				if($count==0){ ?>
					<h3 class="note"><i>No Available Items Please Contact You Suppliers!</i></h3>
				<?php } 
				} 
				
			else if($filter_value=="Out of Stock") {
				$items = getOutStock();
				$count = countOutStock();
				if($count==0){ ?>
					<h3 class="note" style="margin-top:25%;"><i>All items are available.</i></h3>
				<?php }
			}
			if($rows){
				$i = 0;
				while($row = mysqli_fetch_array($items)){ ?>
				<tr>
					<td><?php echo $row['item_name']?></td>
					<td class="tbl-stock"><?php echo $row['item_quantity']?></td>
					<td class="tbl-sellingprice"><?php echo $row['selling_price']?></td>
				</tr>
			<?php }
			} ?>
		</tbody>	
	</table>

	<div id="cont">
			<?php if(isset($page)){
				$result = mysqli_query($con,"select count(*) as Total from item where item_quantity >= 1");
					$rows = mysqli_num_rows($result);
					if($rows){
						$rs = mysqli_fetch_assoc($result);
						$total = $rs["Total"];
					}
					$totalPages = ceil($total / $perpage);
					if($page <=1 ){
						echo "<button>Prev</button>";
					}else{
						$j = $page - 1;
						echo "<button><a id='page_a_link' href='stocks.php?page=$j'>Prev</a></button>";
					}

					for($i=1; $i <= $totalPages; $i++){
						if($i<>$page){
							echo "<button><a id='page_a_link' href='stocks.php?page=$i'>$i</a></button>";
						}else{
							echo "<button>$i</button>";
						}
					}

				if($page == $totalPages){
					echo "<button>Next</button>";
				}else{
					$j = $page + 1;
					echo "<button><a id='page_a_link' href='stocks.php?page=$j'>Next</a></button>";
				}
			}?>
	</div>