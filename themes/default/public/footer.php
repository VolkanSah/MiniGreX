<?php
/* MiniGreX 1.0 /themes/default/public/footer.php */
// load init.php
require_once "init.php";
// get database connection
$conn = get_connection();
// Load sitetitel and Meta-informationen
$site_info = get_site_info($conn); 
// create footer
$html = "<footer class="pt-5 my-5 text-muted border-top">";
$html = " Created with MiniGreX &copy; 2023";
$html = " </footer>";
$html = "</div>";
$html = "<script src="https://cdn.com/bootstrap.bundle.min.js"></script>";    
// HTML-Fuß in Variable schreiben
$html .= "</body>
</html>";
// HTML-Output ausgeben
print($html);
// Verbindung zur Datenbank schließen
$conn->close();
