<!DOCTYPE html>
<?php session_start(); ?>
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Bienvenue Administrateur">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Admin</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="Admin.css" media="screen">
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
    <meta property="og:title" content="Admin">
    <meta property="og:type" content="website">
  </head>
  <body class="u-body"><header class="u-clearfix u-header u-header" id="sec-b571"><div class="u-clearfix u-sheet u-sheet-1">
        <a href="../formulaire.php" class="u-image u-logo u-image-1" data-image-width="430" data-image-height="380">
          <img src="images/20210409091953.png" class="u-logo-image u-logo-image-1">
        </a>
      </div></header>
    <section class="u-clearfix u-section-1" id="sec-e39d">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-align-center u-text u-text-default u-text-1">Bienvenue Administrateur</h2>
        <br/>
        <p class="u-align-center u-text u-text-2">Vous trouverez ici des informations relatives au programme ainsi que des fonctionnalités supplémentaires.</p>
        <div class="u-expanded-width u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <div class="u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-1">
                <span class="u-file-icon u-icon u-icon-rectangle u-icon-1">
                  <a href="#"> <img id="delay" src="images/500811.png" alt=""></a>	
                </span>
                <h3 class="u-align-center u-text u-text-default u-text-3">Modifier Traitement</h3>
                <p class="u-align-center u-text u-text-default u-text-4">Modification du délai de traitement.</p>
              </div>
            </div>
            <div class="u-align-center u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-2">
                <span class="u-file-icon u-icon u-icon-rectangle u-icon-2">
                  <img src="images/3399043.png" alt="">
                </span>
                <h3 class="u-align-center u-text u-text-default u-text-5">Performances</h3>
                <p class="u-align-center u-text u-text-default u-text-6"><?php echo $_SESSION['perf']?> % des mails ont été répondus.</p>
              </div>
            </div>
            <div class="u-align-center u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-3">
                <span class="u-file-icon u-icon u-icon-rectangle u-icon-3">
                  <a href="Gestion.php"> <img src="images/266134.png" alt=""> </a>
                </span>
                <h3 class="u-align-center u-text u-text-default u-text-7">Gestion des agents</h3>
                <p class="u-align-center u-text u-text-default u-text-8">Ajouter, modifier, supprimer un agent.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="u-align-center u-clearfix u-section-2" id="sec-cb25">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-expanded-width u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <div class="u-align-center u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1"><span class="u-icon u-icon-circle u-icon-1"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 54 54" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-a607"></use></svg><svg class="u-svg-content" viewBox="0 0 54 54" x="0px" y="0px" id="svg-a607" style="enable-background:new 0 0 54 54;"><g><path d="M51.22,21h-5.052c-0.812,0-1.481-0.447-1.792-1.197s-0.153-1.54,0.42-2.114l3.572-3.571
		c0.525-0.525,0.814-1.224,0.814-1.966c0-0.743-0.289-1.441-0.814-1.967l-4.553-4.553c-1.05-1.05-2.881-1.052-3.933,0l-3.571,3.571
		c-0.574,0.573-1.366,0.733-2.114,0.421C33.447,9.313,33,8.644,33,7.832V2.78C33,1.247,31.753,0,30.22,0H23.78
		C22.247,0,21,1.247,21,2.78v5.052c0,0.812-0.447,1.481-1.197,1.792c-0.748,0.313-1.54,0.152-2.114-0.421l-3.571-3.571
		c-1.052-1.052-2.883-1.05-3.933,0l-4.553,4.553c-0.525,0.525-0.814,1.224-0.814,1.967c0,0.742,0.289,1.44,0.814,1.966l3.572,3.571
		c0.573,0.574,0.73,1.364,0.42,2.114S8.644,21,7.832,21H2.78C1.247,21,0,22.247,0,23.78v6.439C0,31.753,1.247,33,2.78,33h5.052
		c0.812,0,1.481,0.447,1.792,1.197s0.153,1.54-0.42,2.114l-3.572,3.571c-0.525,0.525-0.814,1.224-0.814,1.966
		c0,0.743,0.289,1.441,0.814,1.967l4.553,4.553c1.051,1.051,2.881,1.053,3.933,0l3.571-3.572c0.574-0.573,1.363-0.731,2.114-0.42
		c0.75,0.311,1.197,0.98,1.197,1.792v5.052c0,1.533,1.247,2.78,2.78,2.78h6.439c1.533,0,2.78-1.247,2.78-2.78v-5.052
		c0-0.812,0.447-1.481,1.197-1.792c0.751-0.312,1.54-0.153,2.114,0.42l3.571,3.572c1.052,1.052,2.883,1.05,3.933,0l4.553-4.553
		c0.525-0.525,0.814-1.224,0.814-1.967c0-0.742-0.289-1.44-0.814-1.966l-3.572-3.571c-0.573-0.574-0.73-1.364-0.42-2.114
		S45.356,33,46.168,33h5.052c1.533,0,2.78-1.247,2.78-2.78V23.78C54,22.247,52.753,21,51.22,21z M52,30.22
		C52,30.65,51.65,31,51.22,31h-5.052c-1.624,0-3.019,0.932-3.64,2.432c-0.622,1.5-0.295,3.146,0.854,4.294l3.572,3.571
		c0.305,0.305,0.305,0.8,0,1.104l-4.553,4.553c-0.304,0.304-0.799,0.306-1.104,0l-3.571-3.572c-1.149-1.149-2.794-1.474-4.294-0.854
		c-1.5,0.621-2.432,2.016-2.432,3.64v5.052C31,51.65,30.65,52,30.22,52H23.78C23.35,52,23,51.65,23,51.22v-5.052
		c0-1.624-0.932-3.019-2.432-3.64c-0.503-0.209-1.021-0.311-1.533-0.311c-1.014,0-1.997,0.4-2.761,1.164l-3.571,3.572
		c-0.306,0.306-0.801,0.304-1.104,0l-4.553-4.553c-0.305-0.305-0.305-0.8,0-1.104l3.572-3.571c1.148-1.148,1.476-2.794,0.854-4.294
		C10.851,31.932,9.456,31,7.832,31H2.78C2.35,31,2,30.65,2,30.22V23.78C2,23.35,2.35,23,2.78,23h5.052
		c1.624,0,3.019-0.932,3.64-2.432c0.622-1.5,0.295-3.146-0.854-4.294l-3.572-3.571c-0.305-0.305-0.305-0.8,0-1.104l4.553-4.553
		c0.304-0.305,0.799-0.305,1.104,0l3.571,3.571c1.147,1.147,2.792,1.476,4.294,0.854C22.068,10.851,23,9.456,23,7.832V2.78
		C23,2.35,23.35,2,23.78,2h6.439C30.65,2,31,2.35,31,2.78v5.052c0,1.624,0.932,3.019,2.432,3.64
		c1.502,0.622,3.146,0.294,4.294-0.854l3.571-3.571c0.306-0.305,0.801-0.305,1.104,0l4.553,4.553c0.305,0.305,0.305,0.8,0,1.104
		l-3.572,3.571c-1.148,1.148-1.476,2.794-0.854,4.294c0.621,1.5,2.016,2.432,3.64,2.432h5.052C51.65,23,52,23.35,52,23.78V30.22z"></path><path d="M27,18c-4.963,0-9,4.037-9,9s4.037,9,9,9s9-4.037,9-9S31.963,18,27,18z M27,34c-3.859,0-7-3.141-7-7s3.141-7,7-7
		s7,3.141,7,7S30.859,34,27,34z"></path>
</g></svg></span>
                <h3 class="u-text u-text-1">Mails dans la boîte :&nbsp;&nbsp;</h3>
                <p class="u-text u-text-2"><?php echo $_SESSION['nbMails'] ?>
                </p>
              </div>
            </div>
            <div class="u-align-center u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-top u-container-layout-2">
                <span class="u-file-icon u-icon u-icon-circle u-icon-2">
                  <a href="mailTrue.php"><img src="images/1004765.png" alt=""></a>
                </span>
                <h3 class="u-text u-text-3">Mails répondus :&nbsp;</h3>
                <p class="u-text u-text-4"> <?php echo $_SESSION['mailTrue'] ?><br>
                </p>
              </div>
            </div>
            <div class="u-align-center u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-top u-container-layout-3"><span class="u-file-icon u-icon u-icon-circle u-icon-3"><img src="images/2089646.png" alt=""></span>
                <h3 class="u-text u-text-5">Mails non répondus :</h3>
                <p class="u-text u-text-6"> <?php echo $_SESSION['mailFalse'] ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="u-align-center u-clearfix u-section-3" id="sec-4d33">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <div class="u-container-style u-list-item u-repeater-item u-list-item-1">
              <div class="u-container-layout u-similar-container u-container-layout-1"><span class="u-file-icon u-icon u-icon-circle u-icon-1"><img src="images/54993.png" alt=""></span>
                <h3 class="u-align-center u-text u-text-1">Téléchargement au format CSV</h3>
              </div>
            </div>
          </div>
        </div>
        <a href="NULL" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-50 u-btn-1">TELECHARGER</a>
      </div>
    </section>
  </body>
</html>