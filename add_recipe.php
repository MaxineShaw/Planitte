<?php
 include 'includes/nav.php';
 include 'includes/footer.php';
 if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
	{
	  # Connect to the database.
	  require ('connect_db.php'); 

  # Initialize an error array.
  $errors = array();

  # Check for item name .
  if ( empty( $_POST[ 'item_name' ] ) )
  { $errors[] = 'Enter the item name.' ; }
  else
  { $n = mysqli_real_escape_string( $link, trim( $_POST[ 'item_name' ] ) ) ; }

  # Check for a item decription.
  if (empty( $_POST[ 'item_desc' ] ) )
  { $errors[] = 'Enter the item decription.' ; }
  else
  { $d = mysqli_real_escape_string( $link, trim( $_POST[ 'item_desc' ] ) ) ; }
  
  # Check for a item image.
  if (empty( $_POST[ 'item_img' ] ) )
  { $errors[] = 'Enter the item image.' ; }
  else
  { $img = mysqli_real_escape_string( $link, trim( $_POST[ 'item_img' ] ) ) ; }
  
  # Check for a item price.
  if (empty( $_POST[ 'item_price' ] ) )
  { $errors[] = 'Enter the item image.' ; }
  else
  { $p = mysqli_real_escape_string( $link, trim( $_POST[ 'item_price' ] ) ) ; }
  
  # Check for a stock count.
  if (empty( $_POST[ 'stock_count' ] ) )
  { $errors[] = 'Enter the stock count.' ; }
  else
  { $s = mysqli_real_escape_string( $link, trim( $_POST[ 'stock_count' ] ) ) ; }

	
   # On success data into my_table on database.
  if ( empty( $errors ) ) 
  {
    $q = "INSERT INTO products (item_name, item_desc, item_img, item_price, stock_count) 
	VALUES ('$n', '$d', '$img', '$p', '$s' )";
    $r = @mysqli_query ( $link, $q ) ;
    if ($r)
    { echo '<p>New record created successfully</p>'; }
  
    # Close database connection.
    mysqli_close($link); 

    exit();
  }
   
  # Or report errors.
  else 
  {
    echo '<p>The following error(s) occurred:</p>' ;
    foreach ( $errors as $msg )
    { echo "$msg<br>" ; }
    echo '<p>Please try again.</p></div>';
    # Close database connection.
    mysqli_close( $link );
	
  }  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="includes/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <title>Recipe Add</title>
</head>
<body>
    
    <div class="container">
        <h1>Write New Recipe</h1>
        <form action="add_recipe_action.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="recipe_name">Recipe Name:</label>
                <input type="text" id="recipe_name" name="recipe_name" required>
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" required>
                <label for="ingredients">Ingredients:</label>
                <input type="text" id="ingredients" name="ingredients" required>
                <label for="instructions">Instructions:</label>
                <input type="text" id="instructions" name="instructions" class="flex_box" required>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required><br>
                <label for="meal">Meal Type:</label>
                <input type="text" id="meal" name="meal" required>
                <button type="submit" class="btn btn-primary">Add Recipe</button>
            </div>
</body>
</html>