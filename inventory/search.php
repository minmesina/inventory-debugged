<?Php
require_once("includes/connection.php");
$item_name=$_GET['item_name'];

	function searching($item_name,$start,$perpage){
		$result=mysqli_query($GLOBALS['con'],"select item_name, item_quantity, selling_price from item where item_name like '$item_name%' Limit $start, $perpage");
		return $result;
	}
?>

<table id="stock-tbl" border="1">
	<thead>
		<tr>
			<th>Items</th>
			<th class="tbl-stock">Stock</th>
			<th class="tbl-sellingprice">Price</th>
		</tr>
	</thead>
	<tbody>	
		<?php 
		 $perpage = 10;
			if(isset($_GET["page"])){
				$page = intval($_GET["page"]);
			}
			else {
			$page = 1;
			}

			$calc = $perpage * $page;
			$start = $calc - $perpage;
			$items= searching($item_name,$start,$perpage);
			$rows = mysqli_num_rows($items);

			if($rows){
				$i = 0;
			while($row = mysqli_fetch_array($items)){ ?>
			<tr>
				<td><?php echo $row['item_name']?></td>
				<td class="tbl-stock"><?php echo $row['item_quantity']?></td>
				<td class="tbl-sellingprice"><?php echo $row['selling_price']?></td>
			</tr>
		<?php } 
		}?>
	</tbody>
</table>
<div id="cont">
			<?php if(isset($page)){
				$result = mysqli_query($con,"select count(*) As Total from item where item_name like '$item_name%'");
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
			}?></div>
<?php
$result=mysqli_query($con,"select count(item_name) as total from item where item_name like '$item_name%'");
$num=mysqli_fetch_assoc($result);
	$count=$num['total'];
	if($count==0){ ?>
		<h3 class="note"><i>No Available Items</i></h3>
	<?php }
?>




