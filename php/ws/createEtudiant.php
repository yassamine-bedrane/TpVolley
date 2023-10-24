<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/EtudiantService.php';
    create();
}

function create() {
    // Get the JSON input data from the request body
    $data = json_decode(file_get_contents("php://input"), true);

    // Check if the required fields exist
    if (isset($data["nom"]) && isset($data["prenom"]) && isset($data["ville"]) && isset($data["sexe"])) {
        $nom = $data["nom"];
        $prenom = $data["prenom"];
        $ville = $data["ville"];
        $sexe = $data["sexe"];

        $es = new EtudiantService();
        $es->create(new Etudiant(1, $nom, $prenom, $ville, $sexe));
        header('Content-type: application/json');
        echo json_encode($es->findAllApi());
        
    } else {
        echo "One or more required fields are missing.";
    }
}
