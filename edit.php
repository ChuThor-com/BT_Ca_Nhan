<?php 
require 'db.php';
$id = $_GET['id'] ?? '';
$sp = $pdo->prepare("SELECT * FROM SanPham WHERE MaSP = ?");
$sp->execute([$id]);
$data = $sp->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten = $_POST['TenSP']; $loai = $_POST['MaLoai'];
    $gia = $_POST['DonGia']; $sl = $_POST['SoLuongTon'];
    
    $sql = "UPDATE SanPham SET TenSP=?, MaLoai=?, DonGia=?, SoLuongTon=? WHERE MaSP=?";
    $pdo->prepare($sql)->execute([$ten, $loai, $gia, $sl, $id]);
    header("Location: index.php"); exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Sửa Sản Phẩm</title></head>
<body>
    <h2>Sửa Sản Phẩm: <?= $data['MaSP'] ?></h2>
    <form method="POST">
        Tên SP: <input type="text" name="TenSP" value="<?= $data['TenSP'] ?>" required><br><br>
        Mã Loại: <input type="text" name="MaLoai" value="<?= $data['MaLoai'] ?>" required><br><br>
        Đơn Giá: <input type="number" name="DonGia" value="<?= $data['DonGia'] ?>" min="1" required><br><br>
        Số Lượng: <input type="number" name="SoLuongTon" value="<?= $data['SoLuongTon'] ?>" min="0" required><br><br>
        <button type="submit">Cập nhật</button> <a href="index.php">Quay lại</a>
    </form>
</body>
</html>