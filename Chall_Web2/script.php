<?php
// Enregistrer pour les informations de visite dans un fichier texte et compter les visites par visiteur
function saveAnd_countVisit($ip, $date){
  // Charger les informations existantes depuis le fichier
  $fichier = "UserInformation.txt";
  $data = file_get_contents($fichier);
  $historic = json_decode($data, true);

  // Vérifier si l'utilisateur a déjà visité
  if (!isset($historic[$ip])) {
      $historic[$ip] = array(
          "visits" => 1,
          "dates" => array($date)
      );
  } else {
      // Mettre à jour le nombre de visites et ajouter la date de visite
      $historic[$ip]["visits"]++;
      $historic[$ip]["dates"][] = $date;
  }

  // Enregistrer les informations mises à jour dans le fichier
  file_put_contents($fichier, json_encode($historic));
}

// Enregistrement des informations de visite
$guestIP = $_SERVER['REMOTE_ADDR'];
$visitDate = date('Y-m-d H:i:s');
saveAnd_countVisit($guestIP, $visitDate);
