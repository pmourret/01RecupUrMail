<?php 

$imapPath = '{imap.gmail.com:993/ssl}';
$username='test1234zebi@gmail.com';
$password='test1234test1234';

//++++++++++++++++++++++++++++++++++
//+++AFFICHAGE DES RUBRIQUES MAIL+++
//++++++++++++++++++++++++++++++++++
$mail_con = imap_open($imapPath, $username, $password);
$mailboxes = imap_list($mail_con, $imapPath, '*');
foreach($mailboxes as $mail){
  $decoded = imap_mime_header_decode($mail);
  $nb_decoded=count($decoded);
  for($i=0;$i<$nb_decoded;$i++){
    echo "Charset : {$decoded[$i]->charset}\n";
    echo "<br/>";
    echo "Texte : {$decoded[$i]->text}\n\n"; 
    echo "<br/>";
  }
}
imap_close($mail_con);
//++++++++++++++++++++++++++++++++++
//++CONNEXION PARTIE MAILS ENVOYES++
//++++++++++++++++++++++++++++++++++
$imapPathSent= '{imap.gmail.com:993/ssl}[Gmail]/Messages envoy&AOk-s';
$mail_con = imap_open($imapPathSent, $username, $password);
$mailBoxInfos = imap_check($mail_con);
$mailList = imap_fetch_overview($mail_con,"1:{$mailBoxInfos->Nmsgs}",0);
foreach($mailList as $row){
  echo $row->date."<br>";
  echo $row->to."<br>";
}
imap_close($mail_con);

?>