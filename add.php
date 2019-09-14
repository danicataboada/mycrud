<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
	$productname= $_POST['productname'];
	$productdescription= $_POST['productdescription'];
	$productprice= $_POST['productprice'];
	$productquantity= $_POST['productquantity'];
		
	// checking empty fields
	if(empty($productname) || empty($productdescription) || empty($productprice) || empty($productquantity))  {
				
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
			echo "<font color='red'>product quantity field is empty.</font><br/>";
		}
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database		
		$sql = "INSERT INTO product(productname, productdescription, productprice , productquantity) VALUES(:productname, :productdescription, :productquantity , :productquantity)";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':productname', $productname);
		$query->bindparam(':productdescription', $productdescription);
		$query->bindparam(':productprice', $productprice);
		$query->bindparam(':productquantity', $productquantity);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':name' => $name, ':email' => $email, ':age' => $age));
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	}
}
?>
</body>
</html>
