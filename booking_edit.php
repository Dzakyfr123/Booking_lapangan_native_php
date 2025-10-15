<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center>
        
        
<?php
include 'db.php';
if (!isset($_SESSION['user_id'])) header("Location: index.php");

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lapangan_id = $_POST['lapangan_id'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];

    $conn->query("UPDATE bookings SET lapangan_id=$lapangan_id, tanggal='$tanggal', jam='$jam' 
                  WHERE id=$id AND user_id=$user_id");
    header("Location: dashboard.php");
}

$booking = $conn->query("SELECT * FROM bookings WHERE id=$id AND user_id=$user_id")->fetch_assoc();
$lapangan = $conn->query("SELECT * FROM lapangan");
?>

<h2>Edit Booking</h2>
<form method="POST">
    Pilih Lapangan:
    <select name="lapangan_id">
        <?php while ($row = $lapangan->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>" <?= $row['id'] == $booking['lapangan_id'] ? 'selected' : '' ?>>
                <?= $row['nama'] ?> - <?= $row['lokasi'] ?>
            </option>
        <?php endwhile; ?>
    </select><br>
    Tanggal: <input type="date" name="tanggal" value="<?= $booking['tanggal'] ?>" required><br>
    Jam: <input type="time" name="jam" value="<?= $booking['jam'] ?>" required><br>
    <button type="submit">Update</button>
</form>
<a href="dashboard.php">Kembali</a>

</body>
</html>