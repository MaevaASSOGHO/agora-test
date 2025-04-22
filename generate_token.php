<?php
require_once "RtcTokenBuilder2.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Clés Agora
$appID = "7f4d992ad57b4900a0effebb7477502f";
$appCertificate = "73117646b24e4f7087f5ed1b5e83e248";

// Récupération sécurisée des paramètres GET
$channelName = isset($_GET["channel"]) ? $_GET["channel"] : null;
$uid = isset($_GET["uid"]) ? $_GET["uid"] : null;

if (!$channelName || !$uid) {
    echo json_encode(["error" => "Paramètres manquants."]);
    exit();
}

// Rôle de l’utilisateur (Attendee = participant standard)
$role = RtcTokenBuilder2::ROLE_PUBLISHER;

// Durée de validité (en secondes)
$expireTime = 3600; // 1 heure

// Timestamp UTC actuel
$currentTimestamp = (new DateTime("now", new DateTimeZone("UTC")))->getTimestamp();
$privilegeExpiredTs = $currentTimestamp + $expireTime;

// Génération du token
$token = RtcTokenBuilder2::buildTokenWithUid($appID, $appCertificate, $channelName, (int)$uid, $role, $privilegeExpiredTs);

// Envoi du token
echo json_encode(["token" => $token]);
