<?php

// include init.php
require_once("init.php");

// Definieren der Variablen
$category = isset($_GET['category']) ? $_GET['category'] : 'all';
$status = 'published';
$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Ausführen der Datenbankabfrage mit Prepared Statements
$stmt = $pdo->prepare("SELECT * FROM articles WHERE category = :category AND status = :status ORDER BY date DESC LIMIT :offset, :limit");
$stmt->bindParam(':category', $category, PDO::PARAM_STR);
$stmt->bindParam(':status', $status, PDO::PARAM_STR);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();

// Speichern der Abfrageergebnisse in einer Variable
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ausgabe der Artikel in HTML-Formatierung
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

// Erstellen der Pagination-Links
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
