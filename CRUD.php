<?php
$host = 'localhost';
$dbname = 'bd_mundo';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// CRUD for managing countries and cities
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Handle countries
        if ($action === 'add_country') {
            $name = $_POST['name'];
            $population = $_POST['population'];
            $continent = $_POST['continent'];
            $language = $_POST['language'];

            $stmt = $pdo->prepare("INSERT INTO paises (nome, populacao, continente, idioma) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $population, $continent, $language]);
        } elseif ($action === 'edit_country') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $population = $_POST['population'];
            $continent = $_POST['continent'];
            $language = $_POST['language'];

            $stmt = $pdo->prepare("UPDATE paises SET nome = ?, populacao = ?, continente = ?, idioma = ? WHERE id_pais = ?");
            $stmt->execute([$name, $population, $continent, $language, $id]);
        } elseif ($action === 'delete_country') {
            $id = $_POST['id'];

            $stmt = $pdo->prepare("DELETE FROM paises WHERE id_pais = ?");
            $stmt->execute([$id]);
        }

        // Handle cities
        elseif ($action === 'add_city') {
            $name = $_POST['name'];
            $population = $_POST['population'];
            $country_id = $_POST['country_id'];

            $stmt = $pdo->prepare("INSERT INTO cidades (nome, populacao, id_pais) VALUES (?, ?, ?)");
            $stmt->execute([$name, $population, $country_id]);
        } elseif ($action === 'edit_city') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $population = $_POST['population'];
            $country_id = $_POST['country_id'];

            $stmt = $pdo->prepare("UPDATE cidades SET nome = ?, populacao = ?, id_pais = ? WHERE id_cidade = ?");
            $stmt->execute([$name, $population, $country_id, $id]);
        } elseif ($action === 'delete_city') {
            $id = $_POST['id'];

            $stmt = $pdo->prepare("DELETE FROM cidades WHERE id_cidade = ?");
            $stmt->execute([$id]);
        }
    }
}

// Fetch countries and cities for display
$countries = $pdo->query("SELECT * FROM paises")->fetchAll(PDO::FETCH_ASSOC);
$cities = $pdo->query("SELECT * FROM cidades")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Mundo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #444;
        }
        form {
            margin: 20px auto;
            padding: 10px;
            max-width: 400px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        form input, form select, form button {
            display: block;
            width: calc(100% - 20px);
            margin: 10px auto;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form button {
            background-color: #5cb85c;
            color: white;
            border: none;
            cursor: pointer;
        }
        form button:hover {
            background-color: #4cae4c;
        }
        ul {
            list-style: none;
            padding: 0;
            max-width: 600px;
            margin: 20px auto;
        }
        ul li {
            background: #fff;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        ul li form {
            display: inline;
        }
        ul li form button {
            background-color: #d9534f;
            color: white;
            border: none;
            cursor: pointer;
            padding: 5px 10px;
            font-size: 14px;
        }
        ul li form button:hover {
            background-color: #c9302c;
        }
    </style>
    <script>
        function validateForm(form) {
            const inputs = form.querySelectorAll('input, select');
            for (const input of inputs) {
                if (input.value.trim() === '') {
                    alert('Por favor, preencha todos os campos.');
                    return false;
                }
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>Gerenciar Países</h1>
    <form method="POST" onsubmit="return validateForm(this);">
        <input type="hidden" name="action" value="add_country">
        <input type="text" name="name" placeholder="Nome">
        <input type="number" name="population" placeholder="População">
        <input type="text" name="continent" placeholder="Continente">
        <input type="text" name="language" placeholder="Idioma">
        <button type="submit">Adicionar País</button>
    </form>
    <ul>
        <?php foreach ($countries as $country): ?>
            <li>
                <?= htmlspecialchars($country['nome']) ?> - <?= htmlspecialchars($country['populacao']) ?>
                <form method="POST" style="display:inline;" onsubmit="return validateForm(this);">
                    <input type="hidden" name="action" value="delete_country">
                    <input type="hidden" name="id" value="<?= $country['id_pais'] ?>">
                    <button type="submit">Excluir</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <h1>Gerenciar Cidades</h1>
    <form method="POST" onsubmit="return validateForm(this);">
        <input type="hidden" name="action" value="add_city">
        <input type="text" name="name" placeholder="Nome">
        <input type="number" name="population" placeholder="População">
        <select name="country_id">
            <option value="">Selecione um país</option>
            <?php foreach ($countries as $country): ?>
                <option value="<?= $country['id_pais'] ?>"><?= htmlspecialchars($country['nome']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Adicionar Cidade</button>
    </form>
    <ul>
        <?php foreach ($cities as $city): ?>
            <li>
                <?= htmlspecialchars($city['nome']) ?> - <?= htmlspecialchars($city['populacao']) ?>
                <form method="POST" style="display:inline;" onsubmit="return validateForm(this);">
                    <input type="hidden" name="action" value="delete_city">
                    <input type="hidden" name="id" value="<?= $city['id_cidade'] ?>">
                    <button type="submit">Excluir</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
