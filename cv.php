<?php
session_start();
// session_destroy();
// session_unset();
if (!isset($_SESSION['cv_data'])) {
    header('Location: index.php');
    exit();
}

$data = $_SESSION['cv_data'];
$photoPath = isset($data['photo']) ? 'uploads/' . basename($data['photo']) : 'default-profile.jpg';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - <?= htmlspecialchars($data['name']) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #008B8B,rgb(3, 67, 67));
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }
        .container {
            max-width: 900px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            overflow-y: auto;
        }
        .left-column {
            width: 30%;
            background: #008B8B;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px 0 0 10px;
        }
        .right-column {
            width: 70%;
            padding: 20px;
        }
        .photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: white;
            margin: 0 auto 20px;
            overflow: hidden;
        }
        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .section h3 {
            border-bottom: 2px solid white;
            padding-bottom: 5px;
            font-size: 1.2em;
        }
        .right-column .section h3 {
            border-bottom: 2px solid #008B8B;
            color: #008B8B;
        }
        .section ul {
            list-style-type: square;
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="logout.php" style="text-align: end;text-decoration: none;font-style: normal;color: red;margin:0 20px;" title="logout"><h2>X</h2></a>
        <div class="left-column">
            <div class="photo">
                <img src="<?= htmlspecialchars($photoPath) ?>" alt="Foto Profil">
            </div>
            <div class="contact-info">
                <h3>CONTACT</h3>
                <p><i class="fas fa-phone"></i> <?= htmlspecialchars($data['phone']) ?></p>
                <p><i class="fas fa-envelope"></i> <?= htmlspecialchars($data['email']) ?></p>
                <p><i class="fas fa-home"></i> <?= htmlspecialchars($data['location']) ?></p>
            </div>
            <div class="section">
                <h3>EDUCATION</h3>
                <ul>
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                        <?php if (!empty($data['edu'.$i])): ?>
                            <li><strong><?= htmlspecialchars($data['edu_year'.$i]) ?></strong><br><?= htmlspecialchars($data['edu'.$i]) ?></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                </ul>
            </div>
            <div class="section">
                <h3>SKILLS</h3>
                <ul>
                    <?php foreach (explode(",", $data['skills']) as $skill) : ?>
                        <li><?= htmlspecialchars(trim($skill)) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="section">
                <h3>LANGUAGES</h3>
                <ul>
                    <?php foreach (explode(",", $data['languages']) as $language) : ?>
                        <li><?= htmlspecialchars(trim($language)) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="right-column">
            <div class="header">
                <h1><?= htmlspecialchars($data['name']) ?></h1>
            </div>
            <div class="section">
                <h3>PROFILE</h3>
                <p><?= htmlspecialchars($data['profile']) ?></p>
            </div>
            <div class="section">
                <h3>EXPERIENCE</h3>
                <ul>
                    <?php for ($i = 1; $i <= 3; $i++): ?>
                        <?php if (!empty($data['experience'.$i])): ?>
                            <li><?= htmlspecialchars(trim($data['experience'.$i])) ?></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
