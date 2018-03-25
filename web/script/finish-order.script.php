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
// require_once 'model/public/PHPmailer/PHPMailerAutoload.php';
    require_once 'model/public/PHPMailer/PHPMailerAutoload.php';

$kosik_id   = $_SESSION['kosik']['kosik_id'];
$user       = $_SESSION['kosik']['user'];
$cenacelkem = $kosikClass->getCena();
// $kosikClass ->deleteTempKosik();
$user_id = (isset($_SESSION['user_id']))?$_SESSION['user_id']:0;

foreach ($_POST as $key => $value) {
    $$key = $value;
}
$casdoruceni = ($cas == "")?"Co nejdříve":$cas;

// if user not logged in -- create user record
if ($user_id == 0){
    $user_insert = array(
        'username'  =>  (string)$user,
        'email'     =>  (string)$email,
        'jmeno'     =>  (string)$jmeno,
        'mobil'     =>  (string)$mobil,
        'adresa'    =>  (string)$adresa,
        'registered'=>  0
    );
    $user_id = $userClass->addUser($user_insert);
    if($user_id == false){
        echo 'add user failed<br>';
        \core\core::debugLog($user_insert);
        die();
    }
}


$insert = array(
    'user_id' => $user_id,
    'cenacelkem' => $cenacelkem,
    'zpusobdoruceni' => '0',
    'adresadoruceni' => $adresa,
    'poznamka' => $poznamka,
    'email' => $email,
    'mobil' => $mobil,
    'kosik_id' => $kosik_id,
    'casdoruceni' => $casdoruceni,
    'status'    => 1
);

$objednavka_result = $objednavkaClass->addObjednavka($insert);

if ($objednavka_result != TRUE){
    echo '<pre>';
    echo 'Pridani do objednavky failed<br>';
    print_r($insert);
    echo '</pre>';
    die();
}
$kosikClass ->deleteTempKosik();
//TODO: IS USER LOGGED IN?
$update = array(
    'email' => $email,
    'jmeno' => $jmeno,
    'mobil' => $mobil,
    'adresa' => $adresa,
    'registered' => 1
);

$where = array(
    'id' => $user_id
);
// TODO: IF FALSE....
$user_result = $userClass->editUser($update,$where);

if (!$user_result){
    echo '<pre>';
    echo 'edit user failed';
    print_r($update);
    print_r($where);
    echo '</pre>';
    die();
}
// set kosik to transfered (to objednavka)
$trasnferResult = $kosikClass->editKosik(array('transfered' => 1), array('id' => $kosik_id));

if (!$trasnferResult){
    echo '<pre>';
        echo 'Transfer kosik to objednavka failed';
    echo '</pre>';
    die();
}

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
Přijali jsme vaši objednávku, měly by dorazit do: $casdoruceni
\n \n
Přejeme dobrou chuť,
Team Bel3s!
";
$mail->Send();

if ($userClass->isLogged()){
    $kosikClass->createUsersKosik($userClass->id);
} else {
    $kosikClass->createTempKosik();
}