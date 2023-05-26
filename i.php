<?php 
include "init.php";
include "connect.php";
                         

 ?>
<html>
<head>
	<title>Dependent Category Subcategory Dropdown</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
	<div>
		<label for="category">Select a category:</label>
		<select id="category" name="category">
			<option value="">--Select Category--</option>
			<?php
			//connect to database
            //get all categories
			$stmt = $con->prepare('SELECT * FROM myshop.category');
			$stmt->execute();
			$categories = $stmt->fetchAll();
			//loop through the categories and add them as options in the select dropdown
			foreach ($categories as $category) {
				echo '<option value="'.$category['CategoryID'].'">'.$category['CategoryName'].'</option>';
			}
			?>
		</select>
	</div>
	<div>
		<label for="subcategory">Select a subcategory:</label>
		<select id="subcategory" name="subcategory">
			<option value="">--Select Subcategory--</option>
		</select>
	</div>
	<script>
	$(document).ready(function() {
		//when a category is selected, update the subcategory dropdown
		$('#category').change(function() {
			var category_id = $(this).val();
			$.ajax({
				type: 'POST',
				url: 'GetSubCat.php',
				data: {category_id: category_id},
				dataType: 'json',
				success: function(data) {
					$('#subcategory').empty();
					$('#subcategory').append('<option value="">--Select Subcategory--</option>');
					$.each(data, function(index, subcategory) {
						$('#subcategory').append('<option value="'+subcategory.SubCateID+'">'+subcategory.SubCatName+'</option>');
					});
				},
				error: function() {
					alert('Error: Could not retrieve subcategories.');
				}
			});
		});
	});
	</script>
    </body>
</html>

<?php ?>
