<?php 
require 'db.php'; 
$msg = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ma = $_POST['MaSP']; $ten = $_POST['TenSP']; $loai = $_POST['MaLoai'];
    $gia = $_POST['DonGia']; $sl = $_POST['SoLuongTon'];

    try {
        $sql = "INSERT INTO SanPham (MaSP, TenSP, MaLoai, DonGia, SoLuongTon) VALUES (?, ?, ?, ?, ?)";
        $pdo->prepare($sql)->execute([$ma, $ten, $loai, $gia, $sl]);
        header("Location: index.php"); exit;
    } catch (Exception $e) { $msg = "Lỗi: " . $e->getMessage(); }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Thêm Sản Phẩm</title></head>
<body>
    <h2>Thêm Sản Phẩm</h2>
    <p style="color:red;"><?= $msg ?></p>
    <form method="POST">
        Mã SP: <input type="text" name="MaSP" required><br><br>
        Tên SP: <input type="text" name="TenSP" required><br><br>
        Mã Loại: <input type="text" name="MaLoai" required><br><br>
        Đơn Giá: <input type="number" name="DonGia" min="1" required><br><br>
        Số Lượng: <input type="number" name="SoLuongTon" min="0" required><br><br>
        <button type="submit">Lưu</button> <a href="index.php">Quay lại</a>
    </form>
</body>
</html>