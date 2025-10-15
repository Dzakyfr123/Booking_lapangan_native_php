<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link rel="stylesheet" href="style.css">
</head>
<body><center>
    <?php
include 'db.php';
if (!isset($_SESSION['user_id'])) header("Location: index.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lapangan_id = $_POST['lapangan_id'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $user_id = $_SESSION['user_id'];

    $conn->query("INSERT INTO bookings (user_id, lapangan_id, tanggal, jam) 
        VALUES ($user_id, $lapangan_id, '$tanggal', '$jam')");
    header("Location: dashboard.php");
}

$lapangan = $conn->query("SELECT * FROM lapangan");
?>

<h2>Booking Lapangan</h2>
<form method="POST">
    Pilih Lapangan:
    <select name="lapangan_id">
        <?php while ($row = $lapangan->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>"><?= $row['nama'] ?> - <?= $row['lokasi'] ?></option>
        <?php endwhile; ?>
    </select><br>
    Tanggal: <input type="date" name="tanggal" required><br>
    Jam: <input type="time" name="jam" required><br>
    <button type="submit">Simpan</button>
</form>
<a href="dashboard.php">Kembali</a>

</body>
</html>