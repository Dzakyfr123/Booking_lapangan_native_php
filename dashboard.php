<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center>
    <?php
include 'db.php';
if (!isset($_SESSION['user_id'])) header("Location: index.php");

$user_id = $_SESSION['user_id'];
$res = $conn->query("SELECT b.id, l.nama, l.lokasi, b.tanggal, b.jam 
    FROM bookings b
    JOIN lapangan l ON b.lapangan_id = l.id
    WHERE b.user_id = $user_id");
?>

<h2>Daftar Booking Anda</h2>
<a href="logout.php">Logout</a> | <a href="booking_create.php">+ Booking Baru</a>
<table border="1" cellpadding="10">
    <tr>
        <th>Lapangan</th>
        <th>Lokasi</th>
        <th>Tanggal</th>
        <th>Jam</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = $res->fetch_assoc()): ?>
    <tr>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['lokasi'] ?></td>
        <td><?= $row['tanggal'] ?></td>
        <td><?= $row['jam'] ?></td>
        <td>
            <a href="booking_edit.php?id=<?= $row['id'] ?>">Edit</a> | 
            <a href="booking_delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus booking ini?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>