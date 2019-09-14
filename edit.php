<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	
	$productname=$_POST['productname'];
	$productdescription=$_POST['productdescription'];
	$productprice=$_POST['productprice'];	
	$productquantity=$_POST['productquantity'];	
	
	
	// checking empty fields
	if(empty($productname) || empty($productdescription) || empty($productprice) || empty($productquantity) ) {	
			
		if(empty($productname)) {
			echo "<font color='red'>productname field is empty.</font><br/>";
		}
		
		if(empty($productdescription)) {
			echo "<font color='red'>productdescription field is empty.</font><br/>";
		}
		
		if(empty($productprice)) {
			echo "<font color='red'>productprice field is empty.</font><br/>";
		}	
		if(empty($productquantity)) {
			echo "<font color='red'>productquantity field is empty.</font><br/>";
		}	

	} else {	
		//updating the table
		$sql = "UPDATE product SET productname=:productname, productdescription=:productdescription, productprice=:productprice,  productquantity=:productquantity  WHERE id=:id";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':id', $id);
		$query->bindparam(':productname', $productname);
		$query->bindparam(':productdescription', $productdescription);
		$query->bindparam(':productprice', $productprice);
		$query->bindparam(':productquantity', $productquantity);



		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':age' => $age));
				
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$sql = "SELECT * FROM product WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	$pname = $row['productname'];
	$pdescription = $row['productdescription'];
	$pprice = $row['productprice'];
	$pquantity = $row['productquantity'];

}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>productname</td>
				<td><input type="text" name="productname" value="<?php echo $name;?>"></td>
			</tr>
			<tr> 
				<td>productdescription</td>
				<td><input type="text" name="productdescription" value="<?php echo $description;?>"></td>
			</tr>
			<tr> 
				<td>productprice</td>
				<td><input type="text" name="productprice" value="<?php echo $price;?>"></td>
			</tr>
			<tr>
				<td>productquantity</td>
				<td><input type="text" name="productquantity" value="<?php echo $quantity;?>"></td>
			</tr>
			<tr>

				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
