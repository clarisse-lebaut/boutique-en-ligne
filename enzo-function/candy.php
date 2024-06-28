<?php
require_once __DIR__ . '/../enzo-function/candy_class.php';
require_once __DIR__ . '/../classes/request.php';

$candy = new Candy();
$request = new Request();

$page = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
$candys_per_page = 10;
$category = isset($_GET['category']) ? $_GET['category'] : null;
$min_price = isset($_GET['min_price']) ? (float)$_GET['min_price'] : null;
$max_price = isset($_GET['max_price']) ? (float)$_GET['max_price'] : null;
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'name';
$order = isset($_GET['order']) ? $_GET['order'] : 'asc';

$candys = $candy->getPaginatedCandy($page, $candys_per_page, $category, $min_price, $max_price, $sort_by, $order);
$total_candys = $candy->getTotalCandyCount($category, $min_price, $max_price);
$total_pages = ceil($total_candys / $candys_per_page);

// Handle adding/removing from favorites
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['candy_id'], $_POST['action'])) {
    $candy_id = (int)$_POST['candy_id'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if ($user_id) {
        if ($_POST['action'] === 'favorite') {
            $candy->toggleFavorite($user_id, $candy_id);
        } elseif ($_POST['action'] === 'add_to_cart') {
            $candy->addToCart($user_id, $candy_id);
        }
    } else {
        $error_message = "Please log in to perform this action.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candy Shop</title>
    <link rel="stylesheet" href="/path/to/your/css/file.css">
</head>
<body>
    <div class="container">
        <h1>Discover Our Candies</h1>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="get" class="filter-form">
            <input type="hidden" name="page" value="<?php echo PAGE_CANDY; ?>">
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($category); ?>">
            </div>
            <div class="form-group">
                <label for="min_price">Min Price:</label>
                <input type="number" id="min_price" name="min_price" value="<?php echo htmlspecialchars($min_price); ?>">
            </div>
            <div class="form-group">
                <label for="max_price">Max Price:</label>
                <input type="number" id="max_price" name="max_price" value="<?php echo htmlspecialchars($max_price); ?>">
            </div>
            <div class="form-group">
                <label for="sort_by">Sort By:</label>
                <select id="sort_by" name="sort_by">
                    <option value="name" <?php echo $sort_by === 'name' ? 'selected' : ''; ?>>Name</option>
                    <option value="price" <?php echo $sort_by === 'price' ? 'selected' : ''; ?>>Price</option>
                    <option value="created_at" <?php echo $sort_by === 'created_at' ? 'selected' : ''; ?>>Date Added</option>
                </select>
            </div>
            <div class="form-group">
                <label for="order">Order:</label>
                <select id="order" name="order">
                    <option value="asc" <?php echo $order === 'asc' ? 'selected' : ''; ?>>Ascending</option>
                    <option value="desc" <?php echo $order === 'desc' ? 'selected' : ''; ?>>Descending</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Apply Filters</button>
        </form>

        <div class="candy-grid">
            <?php foreach ($candys as $candy_item): ?>
                <div class="candy-item">
                    <h2><?php echo htmlspecialchars($candy_item['name']); ?></h2>
                    <p>Price: $<?php echo number_format($candy_item['price'], 2); ?></p>
                    <form method="post">
                        <input type="hidden" name="candy_id" value="<?php echo $candy_item['id']; ?>">
                        <button type="submit" name="action" value="favorite" class="btn btn-secondary">
                            <?php echo $candy->isFavorite($_SESSION['user_id'] ?? null, $candy_item['id']) ? 'Remove from Favorites' : 'Add to Favorites'; ?>
                        </button>
                        <button type="submit" name="action" value="add_to_cart" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo PAGE_CANDY; ?>&page_num=<?php echo $i; ?>&category=<?php echo urlencode($category); ?>&min_price=<?php echo urlencode($min_price); ?>&max_price=<?php echo urlencode($max_price); ?>&sort_by=<?php echo urlencode($sort_by); ?>&order=<?php echo urlencode($order); ?>"
                   class="<?php echo $i === $page ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
    </div>
    <script src="/path/to/your/js/file.js"></script>
</body>
</html>
