<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 25.01.18
 * Time: 21:59
 */

// TODO: zpracovat formular
// TODO: ulozit do DB (objednavka a user)
// TODO: Poslat email
// TODO: administrace


$handler->debug("Debug message: ".$_SERVER['DOCUMENT_ROOT'] );


// require_once 'model/public/PHPmailer/PHPMailerAutoload.php';
    require_once 'model/public/PHPMailer/PHPMailerAutoload.php';



$kosik_id   = $_SESSION['kosik']['kosik_id'];
$user_id    = $_SESSION['kosik']['user'];
$cenacelkem = $kosikClass->getCena();
$kosikClass ->deleteTempKosik();

foreach ($_POST as $key => $value) {
    $$key = $value;
}
$casdoruceni = ($cas == "")?"Co nejdříve":$cas;


$insert = array(
    'user_id' => $user_id,
    'cenacelkem' => $cenacelkem,
    'zpusobdoruceni' => '0',
    'adresadoruceni' => $adresa,
    'poznamka' => $poznamka,
    'email' => $email,
    'mobil' => $mobil,
    'kosik_id' => $kosik_id,
    'casdoruceni' => $casdoruceni
);
// TODO: IF FALSE....
$objednavka_result = $objednavkaClass->addObjednavka($insert);

//TODO: IS USER LOGGED IN?
$update = array(
    'username' => 'anonym',
    'email' => $email,
    'jmeno' => $jmeno,
    'mobil' => $mobil,
    'adresa' => $adresa,
    'registered' => 0
);

$where = array(
    'id' => $user_id
);
// TODO: IF FALSE....
$user_result = $userClass->editUser($update,$where);

// set kosik to transfered (to objednavka)
$kosikClass->editKosik(array('transfered' => 1), array('id' => $kosik_id));

// IF ALL GOOOD, emails:

$subject = 'Objednávka Bel3s';

//Create a new PHPMailer instance
$mail = new PHPMailer;
// Set PHPMailer to use the sendmail transport
//$mail->isSendmail();
$mail->CharSet = 'UTF-8';
//Set who the message is to be sent from
$mail->setFrom($email, $jmeno);
//Set who the message is to be sent to
$mail->addAddress("k.kosut@gmail.com", "Bel3s Restaurant");
//Set the subject line
$mail->Subject = "Objednávka";

$mail->ContentType = 'text/plain';
$mail->IsHTML(false);
//TODO: GENEROVANI MAILU I S POLOZKAMA A CENOU
//TODO: DO KDY MA ZASILKA DORAZIT V PRIPADE CO NEJDRIVE?
// Very important: don't have lines for MsgHTML and AltBody
$mail->Body = "Dobrý den, \n
Přijali jsme vaši objednávku, měly by dorazit do:
\n \n
Přejeme dobrou chuť,
Team Bel3s!
";
$mail->Send();