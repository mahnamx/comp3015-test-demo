<?php
session_start();

$grocery_items = [
  'Milk',
  'Whole Milk',
  '2% Milk',
  'Skim Milk',
  'Almond Milk',
  'Coconut Milk',
  'Soy Milk',
  'Cashew Milk',
  'Orange Juice',
  'Pineapple Juice',
  'Cranberry Juice',
  'Grapefruit Juice',
  'Apple Juice',
  'Pear Juice',
  'Peach Juice',
  'Mango Juice',
  'Grape Juice',
  'Cherry Juice',
  'Blueberry Juice',
  'Strawberry Juice',
  'Cheddar Cheese',
  'Mozzarella Cheese',
  'Swiss Cheese',
  'Pepper Jack Cheese',
  'Provolone Cheese',
  'Colby Jack Cheese',
  'Gouda Cheese',
  'Feta Cheese',
  'Parmesan Cheese',
  'Ricotta Cheese',
  'Spaghetti Noodles',
  'Udon Noodles',
  'Ramen Noodles',
  'Soba Noodles',
  'Rice Noodles'
];


if(isset($_SESSION['search_query'])) {
  $search_query = $_SESSION['search_query'];
} else {
  $search_query = '';
}

if(isset($_GET['search_query'])) {
  $search_query = $_GET['search_query'];
  $search_results = array_filter($grocery_items, function($item) use($search_query) {
    return stripos($item, $search_query) !== false;
  });
  $_SESSION['search_query'] = $search_query;
} else if(isset($_POST['clear'])) {
  unset($_SESSION['search_query']);
  $search_query = '';
  $search_results = $grocery_items;
} else {
  $search_results = $grocery_items;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>My Grocery List</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">My Grocery List</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item ">
          <a class="nav-link" href="./index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./about.php">About</a>
        </li>
      </ul>
    </div>
  </nav>


<div class="container mt-4">
  <div class="row">
    <div class="col-md-6">
      <form method="get">
        <div class="input-group">
          <input type="text" name="search_query" class="form-control" placeholder="Search for grocery items" value="<?php echo $search_query; ?>">
          <button type="submit" class="btn btn-primary">Search</button>
        </div>
      </form>
    </div>
    <div class="col-md-6 text-right">
      <form method="post" action="clear_search.php">
      <button type="submit" class="btn btn-danger" name="clear">Clear</button>
      </form>
    </div>
  </div>
  <?php if(empty($search_results)): ?>
    <p class="mt-4">No items found.</p>
  <?php else: ?>
    <ul class="list-group mt-4">
      <?php foreach($search_results as $item): ?>
        <li class="list-group-item"><?php echo $item; ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</div>
<style>
  body {
    background-image: url('https://images.unsplash.com/photo-1528460033278-a6ba57020470?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=435&q=80');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
  }
</style>

      </body>
