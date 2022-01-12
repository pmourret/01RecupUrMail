<!DOCTYPE html>
<?php 
  include_once "../library/generateTable.php";
  include_once "../library/table2.php";
?>
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Mails répondus</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="Page-1.css" media="screen">
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
    <meta property="og:title" content="Page 1">
    <meta property="og:type" content="website">
  </head>
  <body class="u-body"><header class="u-clearfix u-header u-header" id="sec-b571"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <a href="Admin.php" class="u-image u-logo u-image-1" data-image-width="430" data-image-height="380">
          <img src="images/20210409091953.png" class="u-logo-image u-logo-image-1">
        </a>
      </div></header>
    <section class="u-align-center u-clearfix u-section-1" id="sec-b42b">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-expanded-width u-table u-table-responsive u-table-1">
          <table class="u-table-entity u-table-entity-1">
            <colgroup>
              <col width="25%">
              <col width="25%">
              <col width="25%">
              <col width="25%">
            </colgroup>
            <tbody class="u-table-alt-palette-1-light-3 u-table-body">
              <tr style="height: 65px;">
                <td class="u-table-cell">Date de la demande : </td>
                <td class="u-table-cell">Expéditeur :</td>
                <td class="u-table-cell">Date réponse : </td>
                <td class="u-table-cell">Délai : </td>
              </tr>
              <?php 
              $agentName=selectAll(); 
              generateTableName($agentName);
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>

  </body>
</html>