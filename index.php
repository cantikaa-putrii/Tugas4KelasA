<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['cv_data'] = $_POST;
    $_FILES['photo']['name'] = $_POST['name'] . '.jpg';
    $_SESSION['cv_data']['photo'] = $_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . $_FILES['photo']['name']);
    header('Location: cv.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form CV</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #008B8B, #004D4D);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }
        .container {
            width: 90%;
            max-width: 900px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            overflow-y: auto;
        }
        h1 {
            text-align: center;
            color: #008B8B;
        }
        .form-group {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }
        .left, .right {
            width: 48%;
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
        }
        input, textarea {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        textarea {
            resize: vertical;
            min-height: 80px;
        }
        input:focus, textarea:focus {
            border-color: #008B8B;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 139, 139, 0.5);
        }
        button {
            width: 100%;
            padding: 12px;
            background: #008B8B;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            margin-top: 20px;
        }
        button:hover {
            background: #006666;
            transform: scale(1.05);
        }
        @media (max-width: 768px) {
            .form-group {
                flex-direction: column;
            }
            .left, .right {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="logout.php" style="text-align: end;text-decoration: none;font-style: normal;color: red;" title="logout"><h2>X</h2></a>
        <h1>Form CV</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <div class="left">
                    <label>Nama:</label>
                    <input type="text" name="name" required>
                    
                    <label>Profil Singkat:</label>
                    <textarea name="profile" required></textarea>
                    
                    <h3>Pendidikan</h3>
                    <label>SD:</label>
                    <input type="text" name="edu1">
                    <label>Tahun:</label>
                    <input type="text" name="edu_year1">
                    
                    <label>SMP:</label>
                    <input type="text" name="edu2">
                    <label>Tahun:</label>
                    <input type="text" name="edu_year2">
                    
                    <label>SMA:</label>
                    <input type="text" name="edu3">
                    <label>Tahun:</label>
                    <input type="text" name="edu_year3">
                    
                    <label>Kuliah:</label>
                    <input type="text" name="edu4">
                    <label>Tahun:</label>
                    <input type="text" name="edu_year4">
                </div>
                <div class="right">
                <h3>Pengalaman</h3>
                    <label>Pengalaman 1:</label>
                    <textarea name="experience1" placeholder="Posisi, Tahun, Deskripsi singkat..." required></textarea>
                    
                    <label>Pengalaman 2:</label>
                    <textarea name="experience2" placeholder="Posisi, Tahun, Deskripsi singkat..."></textarea>
                    
                    <label>Pengalaman 3:</label>
                    <textarea name="experience3" placeholder="Posisi, Tahun, Deskripsi singkat..."></textarea>
                    
                    <label>Keahlian:</label>
                    <textarea name="skills" placeholder="Pisahkan dengan koma jika lebih dari satu..." required></textarea>
                    
                    <label>Bahasa:</label>
                    <textarea name="languages" placeholder="Pisahkan dengan koma jika lebih dari satu..." required></textarea>
                    
                    <h3>Kontak</h3>
                    <label>Nomor Telepon:</label>
                    <input type="text" name="phone" required>
                    
                    <label>Email:</label>
                    <input type="email" name="email" value="<?= isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']) : ''?>" readonly required>


                    <label>Lokasi:</label>
                    <input type="text" name="location" required>
                    
                    <label>Upload Foto:</label>
                    <input type="file" name="photo" accept="image/*" required>
                </div>
            </div>
            <button type="submit">Simpan CV</button>
        </form>
    </div>
</body>
</html>
