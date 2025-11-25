<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = (int)$_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM tracker WHERE id='$id'");
if (!$query) die("Query gagal: " . mysqli_error($koneksi));
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='tracker.php';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal_latihan']);
    $exercise = mysqli_real_escape_string($koneksi, $_POST['exercise']);
    $sets = (int)$_POST['sets'];
    $reps = (int)$_POST['reps'];
    $weight = (float)$_POST['weight'];
    $note = mysqli_real_escape_string($koneksi, $_POST['note']);

    $update = mysqli_query($koneksi, "UPDATE tracker 
        SET tanggal_latihan='$tanggal', exercise='$exercise', sets='$sets', reps='$reps', weight='$weight', note='$note' 
        WHERE id='$id'");

    if ($update) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='tracker.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Tracker - FitTask</title>
    <style>
        body {
            background: linear-gradient(135deg,#0b1120 0%,#1e293b 100%);
            color: #e2e8f0;
            font-family:'Segoe UI',sans-serif;
            display:flex;justify-content:center;align-items:center;
            height:100vh;
        }
        .form-box {
            background: rgba(30,41,59,0.7);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 10px;
            width: 320px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }
        .form-box h2 {text-align:center;color:#60a5fa;margin-bottom:1rem;}
        input,textarea,button {
            width:100%;margin-bottom:0.8rem;padding:8px 10px;
            border:none;border-radius:6px;font-size:0.9rem;
        }
        input,textarea {background:rgba(255,255,255,0.9);color:#0f172a;}
        button {
            background:#3b82f6;color:white;cursor:pointer;transition:0.3s;
        }
        button:hover {background:#2563eb;}
        a.back {display:block;text-align:center;margin-top:0.6rem;color:#94a3b8;text-decoration:none;}
        a.back:hover {text-decoration:underline;}
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Edit Latihan</h2>
        <form method="POST">
            <input type="date" name="tanggal_latihan" value="<?= htmlspecialchars($data['tanggal_latihan']); ?>" required>
            <input type="text" name="exercise" value="<?= htmlspecialchars($data['exercise']); ?>" required>
            <input type="number" name="sets" value="<?= htmlspecialchars($data['sets']); ?>" required>
            <input type="number" name="reps" value="<?= htmlspecialchars($data['reps']); ?>" required>
            <input type="number" step="0.1" name="weight" value="<?= htmlspecialchars($data['weight']); ?>" required>
            <textarea name="note" placeholder="Catatan"><?= htmlspecialchars($data['note']); ?></textarea>
            <button type="submit">Simpan Perubahan</button>
        </form>
        <a href="tracker.php" class="back">← Kembali</a>
    </div>
</body>
</html>
