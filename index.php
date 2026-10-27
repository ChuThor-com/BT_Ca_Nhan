<?php require 'db.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Quản lý Sản Phẩm</title></head>
<body>
    <h2>Danh sách Sản Phẩm</h2>
    <form method="GET">
        <input type="text" name="search" placeholder="Tìm tên sản phẩm..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit">Tìm</button>
        <a href="create.php">Thêm Sản Phẩm Mới</a>
    </form>
    <br>
    
    <?php
    // Xử lý tìm kiếm & phân trang
    $search = $_GET['search'] ?? '';
    $page = $_GET['page'] ?? 1;
    $limit = 5; // Số dòng mỗi trang
    $offset = ($page - 1) * $limit;

    $sql = "SELECT * FROM SanPham WHERE TenSP LIKE :search ORDER BY MaSP LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search', "%$search%");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $products = $stmt->fetchAll();

    // Đếm tổng số để phân trang
    $countSql = "SELECT COUNT(*) FROM SanPham WHERE TenSP LIKE :search";
    $stmtCount = $pdo->prepare($countSql);
    $stmtCount->execute([':search' => "%$search%"]);
    $totalPages = ceil($stmtCount->fetchColumn() / $limit);
    ?>

    <table border="1" cellpadding="10">
        <tr>
            <th>Mã SP</th><th>Tên SP</th><th>Mã Loại</th><th>Đơn Giá</th><th>Số Lượng</th><th>Hành động</th>
        </tr>
        <?php foreach ($products as $sp): ?>
        <tr>
            <td><?= $sp['MaSP'] ?></td>
            <td><?= $sp['TenSP'] ?></td>
            <td><?= $sp['MaLoai'] ?></td>
            <td><?= number_format($sp['DonGia']) ?> VNĐ</td>
            <td><?= $sp['SoLuongTon'] ?></td>
            <td>
                <a href="edit.php?id=<?= $sp['MaSP'] ?>">Sửa</a> |
                <!-- Xóa dùng POST theo yêu cầu -->
                <form action="delete.php" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                    <input type="hidden" name="id" value="<?= $sp['MaSP'] ?>">
                    <button type="submit">Xóa</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- Phân trang -->
    <div style="margin-top: 10px;">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>" 
               style="<?= ($i == $page) ? 'font-weight:bold; color:red;' : '' ?>">
               <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
</body>
</html>