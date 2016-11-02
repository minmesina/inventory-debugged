<!DOCTYPE html>
<?php
require_once("includes/connection.php");
	$top_quantity1 = 0;
	$top_quantity2 = 0;
	$top_quantity3 = 0;
	$top_quantity4 = 0;
	$top_quantity5 = 0;

	function getAllItems($start,$perpage) {
		$result=mysqli_query($GLOBALS['con'],"select * from item order by item_quantity ASC Limit $start, $perpage");
		return $result;
	}

	function getCategories() {
		$result=mysqli_query($GLOBALS['con'],"select category_name from category");
		return $result;
	}

	function getItemId(){
		$result=mysqli_query($GLOBALS['con'],"select item_id from item_list_sold"); 
		return $result;
	}

	function countItemId($id){
		$result=mysqli_query($GLOBALS['con'],"select item_id as cnt from item_list_sold where item_id='$id'");
			$count=mysqli_num_rows($result);
		return $count;
	}

	function getMultiQnty($id){
		$result=mysqli_query($GLOBALS['con'],"select quantity_sold, item_sold_name from item_list_sold where item_id=$id");
		return $result;
	}

	function getQnty($id){
		$result=mysqli_query($GLOBALS['con'],"select quantity_sold, item_sold_name from item_list_sold where item_id=$id"); 
			$row_qnty=mysqli_fetch_assoc($result);
		return $row_qnty;
	}
?>
<html>
<head>
	<link rel="stylesheet" href="css/cssnav.css">
	<link rel="stylesheet" href="css/style.css">
	<title>Inventory | Stocks</title>
</head>
<body>
	<div id="container">
		<img src="css/mainbg.png" id="bg" alt="" /> 
		<div id="nav"><?php include("navbar.php"); ?></div>	

		<div id="main-content">
		<div id="categorized"></div>
		<div id="all-stocks">
			<table id="stock-tbl" border="1">
				<thead>
					<tr>
						<th>Items</th>
						<th class="tbl-stock">Stock</th>
						<th class="tbl-sellingprice">Selling Price</th>
					</tr>
				</thead>
				<?php $perpage = 10;
				if(isset($_GET["page"])){
					$page = intval($_GET["page"]);
				}
				else {
				$page = 1;
				}

				$calc = $perpage * $page;
				$start = $calc - $perpage;
				$result = getAllItems($start,$perpage);
				$rows = mysqli_num_rows($result);

				if($rows){
					$i = 0;
				?>
				<tbody>	
					<?php while($row = mysqli_fetch_array($result)){ ?>
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
					$result = mysqli_query($con,"select count(*) As Total from item");
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
							echo "<button><a id='page_a_link' href='?page=$j'>Prev</a></button>";
						}

						for($i=1; $i <= $totalPages; $i++){
							if($i<>$page){
								echo "<button><a id='page_a_link' href='?page=$i'>$i</a></button>";
							}else{
								echo "<button>$i</button>";
							}
						}

					if($page == $totalPages){
						echo "<button>Next</button>";
					}else{
						$j = $page + 1;
						echo "<button><a id='page_a_link' href='?page=$j'>Next</a></button>";
					}
				}?>
			</div>
		</div>
	</div>

	<div id="side-content">
		<div id="search-box">
			<label class="lbl">Search:</label>
			<input type="text" name="search" id="search" onkeyup="searching(this.value);">
		</div>
		<div id="filter">
			<label class="lbl">Category:</label>
			<select name="select_cat" id="select_cat" onchange="getbycategory(this.value);">
				<option selected>All</option>
				<?php $category_res = getCategories();
				while($row = mysqli_fetch_array($category_res)){ ?>
				<option class="cat_name" name="cat_name"><?php echo $row['category_name']?></option>           
				<?php } ?>
			</select> 

			<label class="lbl">Filter:</label>
			<select name="select_filter" id="select_filter" onchange="filtering(this.value);">
				<option selected>All</option>
				<option class="cat_name" name="curr_stocks">Current Stocks</option>
				<option class="cat_name" name="recently_del">Recently Delivered</option> 
				<option class="cat_name" name="out_stock">Out of Stock</option>           
			</select> 
		</div>
		<div id="top-items">
			<table id="topitems-tbl" border="1">
				<thead>
					<tr>
						<th colspan="2">Top Items</th>
					</tr>
				</thead>
				<tbody>
				<?php for($i=1; $i<=5; $i++){
					$item_id=getItemId();
					while($row_id = mysqli_fetch_array($item_id)){
						$id=$row_id['item_id'];
							$quantity = 0;
							$count = countItemId($id);
							if($count!=0){
								$result = getMultiQnty($id); 
								while($row_qnty = mysqli_fetch_array($result)){
									$quantity=$quantity+$row_qnty['quantity_sold'];
									$item=$row_qnty['item_sold_name'];
								}
							}else{
								$row_qnty = $getQnty($id);
								$quantity=$row_qnty['quantity_sold'];
								$item=$row_qnty['item_sold_name'];
							}
						
						if($quantity>=$top_quantity1){
							$top_quantity1 = $quantity;
							$top_item1 = $item;
						}else if($quantity<=$top_quantity1&&$quantity>=$top_quantity2){
							$top_quantity2 = $quantity;
							$top_item2 = $item;
						}else if($quantity<$top_quantity2&&$quantity>$top_quantity3){
							$top_quantity3 = $quantity;
							$top_item3 = $item;
						}else if($quantity<=$top_quantity3&&$quantity>=$top_quantity4){
							$top_quantity4 = $quantity;
							$top_item4 = $item;
						}else if($quantity<$top_quantity4&&$quantity>$top_quantity5){
							$top_quantity5 = $quantity;
							$top_item5 = $item;
						}						
					}
				}
				?>
					<tr>
						<td class="qnty-tbl"><?php echo $top_quantity1;?></td>
						<td><?php echo $top_item1;?></td>
					</tr>
					<tr>
						<td class="qnty-tbl"><?php echo $top_quantity2;?></td>
						<td><?php echo $top_item2;?></td>
					</tr>
					<tr>
						<td class="qnty-tbl"><?php echo $top_quantity3;?></td>
						<td><?php echo $top_item3;?></td>
					</tr>
					<tr>
						<td class="qnty-tbl"><?php echo $top_quantity4;?></td>
						<td><?php echo $top_item4;?></td>
					</tr>
					<tr>
						<td class="qnty-tbl"><?php echo $top_quantity5;?></td>
						<td><?php echo $top_item5;?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>  
	</div>	
</body>
</html>

<script type="text/javascript">
function searching(item_name){
	var element = document.getElementById('select_cat');
    	element.value = "All";
    var element = document.getElementById('select_filter');
    	element.value = "All";

	if(item_name==""||item_name==null){
		document.getElementById("all-stocks").style.display="inline";
		document.getElementById("categorized").innerHTML="";
	}
	else{
		var httpxml;
		try{
		  httpxml=new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
		  }
		catch (e){
		  try{
		    httpxml=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		    }
		  catch (e){
		    try{
		      httpxml=new ActiveXObject("Microsoft.XMLHTTP");
		      }
		    catch (e){
		      alert("Your browser does not support AJAX!");
		      return false;
		    }
		  }
		}

		function stateChanged(){
		    if(httpxml.readyState==4){
				document.getElementById("categorized").innerHTML=httpxml.responseText;
				document.getElementById("all-stocks").style.display="none";
		    }
		}
		var url="search.php";
		url=url+"?item_name="+item_name;
		url=url+"&sid="+Math.random();
		httpxml.onreadystatechange=stateChanged;
		httpxml.open("GET",url,true);
		httpxml.send();
  	}
}

//-------------------CATEGORY--------------------------
function getbycategory(cat_value){
	var element = document.getElementById('select_filter');
    	element.value = "All";
    document.getElementById("search").value="";

	if(cat_value=="All"){
		document.getElementById("all-stocks").style.display="inline";
		document.getElementById("categorized").innerHTML="";
	}
	else{
	  	if (window.XMLHttpRequest){
	    	xmlhttp=new XMLHttpRequest();//code for IE7+, Firefox, Chrome, Opera, Safari
	  	} else { 
	    	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");//code for IE6, IE5
	  	}

  		xmlhttp.onreadystatechange=function(){
	    	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	      		document.getElementById("categorized").innerHTML=xmlhttp.responseText;
	      		document.getElementById("all-stocks").style.display="none";	      		
	    	}
	  	}
	  	xmlhttp.open("GET","getitemsbycat.php?cat_value="+cat_value,true);
	  	xmlhttp.send();
	}
}

//-------------------FILTERING--------------------------

function filtering(filter_value){
	var element = document.getElementById('select_cat');
    	element.value = "All";
    document.getElementById("search").value="";

	if(filter_value=="All"){
		document.getElementById("all-stocks").style.display="inline";
		document.getElementById("categorized").innerHTML="";
	}
	else{
	  	if (window.XMLHttpRequest){
	    	xmlhttp=new XMLHttpRequest();//code for IE7+, Firefox, Chrome, Opera, Safari
	  	} else { 
	    	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");//code for IE6, IE5
	  	}

	  	xmlhttp.onreadystatechange=function(){
	    	if (xmlhttp.readyState==4 && xmlhttp.status==200){
	      		document.getElementById("categorized").innerHTML=xmlhttp.responseText;
	      		document.getElementById("all-stocks").style.display="none";		
	    	}
	  	}

	  	if(filter_value=="Current Stocks" || filter_value=="Out of Stock"){
	  		xmlhttp.open("GET","getitemsbyfilter.php?filter_value="+filter_value,true);
	  	}
	  	else if(filter_value=="Recently Delivered"){
			xmlhttp.open("GET","recentlydelivered.php",true);
	  	}
	  		xmlhttp.send();
	}
}
</script>
