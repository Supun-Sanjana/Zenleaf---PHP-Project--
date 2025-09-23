<?php
    // This file is the main entry point for the website.

    // 1. Include the header. This brings in the DOCTYPE, <head> section, and the navigation bar.
    // We use `require_once` because the page won't work without the header.
    require_once '../src/templates/shared/header.php';

    // 2. Include the content for this specific page.
    // For the homepage, we'll include the hero section you created.
    require_once '../src/templates/shared/hero.php';

   
    // 3. Finally, include the footer. This will close the <body> and <html> tags
    // and can include your site-wide JavaScript files.
    require_once '../src/templates/shared/footer.php';
?>
