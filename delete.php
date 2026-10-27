<?php
require 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    try {
        // Cảnh báo: Nếu SP này đã có trong ChiTietDonHang, lệnh xóa sẽ báo lỗi khóa ngoại. 
        // Để đơn giản, ta cứ thử xóa.
        $pdo->prepare("DELETE FROM SanPham WHERE MaSP = ?")->execute([$id]);
    } catch (Exception $e) {
        die("Không thể xóa vì sản phẩm đã có trong đơn hàng!");
    }
}
header("Location: index.php");
?>