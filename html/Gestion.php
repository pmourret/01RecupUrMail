<?php 
  session_start();
  include_once "../library/modfAgents.php"
?>
<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Ajout d&amp;apos;un agent, MODIFICATION, SUPPRESSION D&amp;apos;UN AGENT">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Gestion</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="Gestion.css" media="screen">
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
    <meta property="og:title" content="Gestion">
    <meta property="og:type" content="website">
  </head>
  <body class="u-body"><header class="u-clearfix u-header u-header" id="sec-b571"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <a href="Admin.php" class="u-image u-logo u-image-1" data-image-width="430" data-image-height="380">
          <img src="images/20210409091953.png" class="u-logo-image u-logo-image-1">
        </a>
      </div></header>
    <section class="u-align-center u-clearfix u-section-1" id="sec-560d">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-default u-text-1">Ajout d'un agent</h2>
        <div class="u-expanded-width u-form u-form-1">
          <form action="../library/addAgent.php" method="POST" class="u-clearfix u-form-horizontal u-form-spacing-15 u-inner-form" style="padding: 15px;" source="custom">
            <div class="u-form-group u-form-name">
              <label for="name-ef64" class="u-form-control-hidden u-label">Name</label>
              <input type="text" placeholder="Nom" id="name-ef64" name="agentName" class="u-border-1 u-border-grey-30 u-input u-input-rectangle" required="">
            </div>
            <div class="u-form-group">
              <label for="name-ef64" class="u-form-control-hidden u-label">Surname</label>
              <input type="text" placeholder="Prénom" id="email-ef64" name="agentSurname" class="u-border-1 u-border-grey-30 u-input u-input-rectangle" required="required">
            </div>
            <div class="u-form-group u-form-group-3">
              <label for="text-7d9a" class="u-form-control-hidden u-label"></label>
              <input type="text" placeholder="Matricule" id="text-7d9a" name="agentMatricule" class="u-border-1 u-border-grey-30 u-input u-input-rectangle" required="required">
            </div>
            <div class="u-form-group u-form-submit">
              <a href="#" class="u-btn u-btn-submit u-button-style">AJOUTER<br>
              </a>
              <input type="submit" value="submit" class="u-form-control-hidden">
            </div>
            <div class="u-form-send-message u-form-send-success">#FormSendSuccess</div>
            <div class="u-form-send-error u-form-send-message" style="background-color:green">Agent ajouté avec succés.</div>
            <input type="hidden" value="" name="recaptchaResponse">
          </form>
        </div>
      </div>
    </section>
    <!--<section class="u-align-center u-clearfix u-section-2" id="carousel_eb50">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-default u-text-1">MODIFICATION</h2>
        <div class="u-expanded-width u-form u-form-1">
          <form action="../library/updateAgent.php" method="POST" class="u-clearfix u-form-horizontal u-form-spacing-15 u-inner-form" style="padding: 15px;" source="custom">
            <div class="u-form-group u-form-select u-form-group-1">
              <label for="select-2a9c" class="u-form-control-hidden u-label"></label>
              <div class="u-form-select-wrapper">
                  <?php $agent = selectAll(); $selectedAgent = optionList($agent); $_SESSION['agent'] = $selectedAgent?> 
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1" class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
              </div>
            </div>
            <div class="u-form-group u-form-name">
              <label for="name-ef64" class="u-form-control-hidden u-label">Name</label>
              <input type="text" placeholder="Nom" id="name-ef64" name="agentName" class="u-border-1 u-border-grey-30 u-input u-input-rectangle" required="">
            </div>
            <div class="u-form-group">
              <label for="name-ef64" class="u-form-control-hidden u-label">Surname</label>
              <input type="text" placeholder="Prénom" id="email-ef64" name="agentSurname" class="u-border-1 u-border-grey-30 u-input u-input-rectangle" required="required">
            </div>
            <div class="u-form-group u-form-group-4">
              <label for="text-7d9a" class="u-form-control-hidden u-label"></label>
              <input type="text" placeholder="Matricule" id="text-7d9a" name="agentMatricule" class="u-border-1 u-border-grey-30 u-input u-input-rectangle" required="required">
            </div>
            <div class="u-form-group u-form-submit">
              <a href="#" class="u-btn u-btn-submit u-button-style">MODIFIER<br>
              </a>
              <input type="submit" value="submit" class="u-form-control-hidden">
            </div>
            <div class="u-form-send-message u-form-send-success">#FormSendSuccess</div>
            <div class="u-form-send-error u-form-send-message">#FormSendError</div>
            <input type="hidden" value="" name="recaptchaResponse">
          </form>
        </div>
      </div>
    </section>-->
    <section class="u-align-center u-clearfix u-section-3" id="carousel_0a98">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-default u-text-1">SUPPRESSION D'UN AGENT</h2>
        <div class="u-expanded-width u-form u-form-1">
          <form action="../library/deleteAgent.php" method="POST" class="u-clearfix u-form-horizontal u-form-spacing-15 u-inner-form" style="padding: 15px;" source="custom">
            <div class="u-form-group u-form-group-3">
              <label for="text-7d9a" class="u-form-control-hidden u-label"></label>
              <input type="text" placeholder="Matricule" id="text-7d9a" name="agentMatricule" class="u-border-1 u-border-grey-30 u-input u-input-rectangle" required="required">
            </div>
            <div class="u-form-group u-form-submit">
              <a href="#" class="u-btn u-btn-submit u-button-style">SUPPRIMER<br>
              </a>
              <input type="submit" value="submit" class="u-form-control-hidden">
            </div>
            <div class="u-form-send-message u-form-send-success">#FormSendSuccess</div>
            <div class="u-form-send-error u-form-send-message" style="background-color:green">Agent supprimé avec succés.</div>
            <input type="hidden" value="" name="recaptchaResponse">
          </form>
        </div>
      </div>
    </section>
  </body>
</html>