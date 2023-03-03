<?php

// Hero Conatiner- in admin settings
$html = "<main>;
$html = "<h1>" . htmlspecialchars($site_info['title'], ENT_QUOTES) . "</h1>"; 
$html = "<p class="fs-5 col-md-8">" . htmlspecialchars($site_info['hero'], ENT_QUOTES) . "</p>";
$html = "<div class="mb-5"><a href="hero-promo-home.php." class="btn btn-primary btn-lg px-4">Get involved</a></div>":
$html = "<hr class="col-3 col-md-2 mb-5">";
$html = "<div class="row g-5">";
$html = "<div class="col-md-6">";
$html = "<h2>Starter projects</h2>";
// start loop here


 // ??? loop not finished




  //end loop here

}
$html = "    </div>  
$html = "</div>";
$html = "<div class="col-md-6">";
$html = "<h2>" . htmlspecialchars($site_info['homelink_title'], ENT_QUOTES) . "</h2>";
$html = "<p>Read more detailed instructions and documentation on using or contributing to Bootstrap.</p>";
$html = "<ul class="icon-list ps-0">";
$html = "<li class="d-flex align-items-start mb-1"><a href="../getting-started/introduction/">Privacy & Inprint</a></li>";
$html = "<li class="d-flex align-items-start mb-1"><a href="../getting-started/webpack/">Donate for MiniGgreX</a></li>";
$html = "<li class="d-flex align-items-start mb-1"><a href="../getting-started/parcel/">MiniGreX on Github</a></li>";
$html = "<li class="d-flex align-items-start mb-1"><a href="../getting-started/vite/">Documantation of MiniGreX</a></li>";
$html = " <li class="d-flex align-items-start mb-1"><a href="../getting-started/contribute/">Contributing to MiniGreX</a></li>";
$html = "</ul>";
$html = "</div>";
$html = "</div>";
$html = "</main>";
  
  
  
  // HTML-Output 
print($html);


