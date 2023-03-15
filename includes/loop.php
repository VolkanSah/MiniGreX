<?php
/* Comment: file ready!
In this example, Prepared Statements is used to avoid SQL injection attacks. The HTML code is stored in a heredoc notation inside a variable and then output. 
The code also creates pagination for the articles by counting the total number of articles and adding links to the previous and next page.
*/

// include init.php
require_once("init.php");

// define the variable
$category = isset($_GET['category']) ? $_GET['category'] : 'all';
$status = 'published';
$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Execute the database query with prepared statements
$stmt = $pdo->prepare("SELECT * FROM articles WHERE category = :category AND status = :status ORDER BY date DESC LIMIT :offset, :limit");
$stmt->bindParam(':category', $category, PDO::PARAM_STR);
$stmt->bindParam(':status', $status, PDO::PARAM_STR);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();

// store the query results in a variable
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output of articles in HTML formatting
foreach ($articles as $article) {
    $article_title = htmlspecialchars($article['title']);
    $article_content = htmlspecialchars($article['content']);
    $article_date = date('Y-m-d', strtotime($article['date']));

    $html = <<<HTML
        <div class="article">
            <h2>$article_title</h2>
            <p>$article_content</p>
            <span class="date">$article_date</span>
        </div>
    HTML;

    echo $html;
}

// create the pagination links
$count_stmt = $pdo->prepare("SELECT COUNT(*) FROM articles WHERE category = :category AND status = :status");
$count_stmt->bindParam(':category', $category, PDO::PARAM_STR);
$count_stmt->bindParam(':status', $status, PDO::PARAM_STR);
$count_stmt->execute();
$total_articles = $count_stmt->fetchColumn();

$total_pages = ceil($total_articles / $limit);
$prev_page = ($page > 1) ? ($page - 1) : false;
$next_page = ($page < $total_pages) ? ($page + 1) : false;

$html = <<<HTML
    <div class="pagination">
HTML;

if ($prev_page !== false) {
    $html .= <<<HTML
        <a href="?category=$category&page=$prev_page">&laquo; Previous</a>
    HTML;
}

for ($i = 1; $i <= $total_pages; $i++) {
    $class = ($i == $page) ? 'active' : '';
    $html .= <<<HTML
        <a href="?category=$category&page=$i" class="$class">$i</a>
    HTML;
}

if ($next_page !== false) {
    $html .= <<<HTML
        <a href="?category=$category&page=$next_page">Next &raquo;</a>
    HTML;
}

$html .= <<<HTML
    </div>
HTML;

echo $html;
