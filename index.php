<?php
// Connexion MySQL via Docker
$mysqli = new mysqli("db", "root", "root", "patients_db");

// Vérifie la connexion
if ($mysqli->connect_error) {
    die("Erreur de connexion : " . $mysqli->connect_error);
}

// Création de la table si elle n'existe pas
$mysqli->query("CREATE TABLE IF NOT EXISTS patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    age INT,
    email VARCHAR(100)
)");

// Insertion patient
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ajouter'])) {
        $nom = $mysqli->real_escape_string($_POST["nom"]);
        $prenom = $mysqli->real_escape_string($_POST["prenom"]);
        $age = (int)$_POST["age"];
        $email = $mysqli->real_escape_string($_POST["email"]);
        $mysqli->query("INSERT INTO patients (nom, prenom, age, email) VALUES ('$nom', '$prenom', $age, '$email')");
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit();
    }

    if (isset($_POST['vider'])) {
        $mysqli->query("DELETE FROM patients");
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Patients</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #e8f5e9, #d0f0c0);
            color: #1b5e20;
            margin: 0;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1, h2 {
            text-align: center;
            margin-bottom: 1rem;
            text-shadow: 1px 1px 2px #c8e6c9;
        }
        form {
            background: #ffffff;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(76, 175, 80, 0.2);
            max-width: 420px;
            width: 100%;
            margin-bottom: 1rem;
        }
        input, button {
            width: 100%;
            margin-top: 12px;
            padding: 12px;
            border: 2px solid #c8e6c9;
            border-radius: 10px;
            font-size: 1rem;
        }
        input:focus {
            outline: none;
            border-color: #66bb6a;
            box-shadow: 0 0 8px rgba(102, 187, 106, 0.4);
        }
        button {
            background-color: #66bb6a;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background-color: #43a047;
        }
        .vider-form button {
            background-color: #e53935;
            margin-top: 10px;
        }
        .vider-form button:hover {
            background-color: #c62828;
        }
        table {
            border-collapse: collapse;
            width: 90%;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.2);
        }
        th, td {
            border-bottom: 1px solid #e0f2f1;
            padding: 12px 16px;
            text-align: center;
        }
        th {
            background-color: #a5d6a7;
            color: #1b5e20;
        }
        tr:hover {
            background-color: #f1f8e9;
        }
    </style>
</head>
<body>
    <h1>Ajouter un Patient</h1>

    <form method="post">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="number" name="age" placeholder="Âge" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit" name="ajouter">Ajouter</button>
    </form>

    <form method="post" class="vider-form">
        <button type="submit" name="vider">Vider la liste</button>
    </form>

    <h2>Liste des Patients</h2>
    <table>
        <tr><th>Nom</th><th>Prénom</th><th>Âge</th><th>Email</th></tr>
        <?php
        $result = $mysqli->query("SELECT nom, prenom, age, email FROM patients ORDER BY id DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['nom']}</td>
                    <td>{$row['prenom']}</td>
                    <td>{$row['age']}</td>
                    <td>{$row['email']}</td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
