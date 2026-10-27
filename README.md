DANH SÁCH 5 TEST CASE KIỂM THỬ CHỨC NĂNG

1. Test Case 1: Thêm sản phẩm hợp lệ
- Dữ liệu nhập: MaSP=SP99, TenSP=Bút xóa, MaLoai=L01, DonGia=15000, SoLuongTon=10
- Kết quả mong đợi: Thêm thành công, chuyển về trang danh sách.
- Kết quả thực tế: Thành công (Pass).

2. Test Case 2: Thêm sản phẩm bị trùng mã (Sai)
- Dữ liệu nhập: MaSP=SP01 (đã tồn tại), TenSP=Test...
- Kết quả mong đợi: Báo lỗi khóa chính trùng, không cho thêm.
- Kết quả thực tế: Hệ thống báo lỗi (Pass).

3. Test Case 3: Thêm sản phẩm có giá trị âm (Sai)
- Dữ liệu nhập: DonGia = -5000
- Kết quả mong đợi: Không cho phép nhập, báo lỗi validate hoặc CSDL chặn.
- Kết quả thực tế: Thẻ input HTML chặn lại (Pass).

4. Test Case 4: Cập nhật tên sản phẩm (Sửa)
- Dữ liệu nhập: Sửa SP01 thành "Bút bi xanh", giá 6000.
- Kết quả mong đợi: Lưu thành công, tên hiển thị đổi mới.
- Kết quả thực tế: Thành công (Pass).

5. Test Case 5: Xóa sản phẩm đang có trong đơn hàng (Sai)
- Dữ liệu nhập: Bấm xóa SP01 (SP này đang có trong ChiTietDonHang).
- Kết quả mong đợi: Báo lỗi không thể xóa do ràng buộc khóa ngoại.
- Kết quả thực tế: Hệ thống báo "Không thể xóa vì sản phẩm đã có trong đơn hàng!" (Pass).
