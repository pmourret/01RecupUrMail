<?php
    include_once "../library/functions.php" ;
?>
<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>modifyDelay</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="modifyDelay.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 4.2.6, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "",
		"logo": "images/20210409091953.png"
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="modifyDelay">
    <meta property="og:type" content="website">
  </head>
  <body class="u-body"><header class="u-clearfix u-header u-header" id="sec-b571"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <a href="admin.php" class="u-image u-logo u-image-1" data-image-width="430" data-image-height="380">
          <img src="images/20210409091953.png" class="u-logo-image u-logo-image-1">
        </a>
      </div></header>
    <section class="u-clearfix u-section-1" id="sec-4d2a">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h4 class="u-text u-text-1">Délai actuel : <?php echo getDelay()." jours." ?></h4>
        <div class="u-form u-form-1">
          <form action="../library/setDelay.php" method="POST" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" source="custom" name="form" style="padding: 10px;">
            <input type="hidden" id="siteId" name="siteId" value="2326930727">
            <input type="hidden" id="pageId" name="pageId" value="443911035">
            <div class="u-form-group u-form-name u-form-group-1">
              <label for="name-bb1a" class="u-form-control-hidden u-label"></label>
              <input type="text" placeholder="Nouveau délai" id="name-bb1a" name="newDelay" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
            </div>
            <div class="u-align-center u-form-group u-form-submit u-form-group-2">
              <a onclick="location.href='modifyDelay.php'" class="u-btn u-btn-submit u-button-style">Soumettre</a>
              <input type="submit" value="submit" class="u-form-control-hidden">
            </div>
          </form>
        </div>
      </div>
    </section>

  </body>
</html>