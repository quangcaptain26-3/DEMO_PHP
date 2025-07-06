Dưới đây là nội dung hoàn chỉnh cho file `README.md` bạn yêu cầu:

---

## 📘 Student Management CRUD – PHP + MySQL + JS + CSS

Quản lý sinh viên với các chức năng: thêm, sửa, xoá, tìm kiếm, phân trang, chi tiết modal, đăng nhập/quyền truy cập.
Công nghệ sử dụng: **PHP + MySQL + JavaScript (ES6) + CSS (modern responsive UI)**

---

## 🚀 Clone project

```bash
git clone https://github.com/quangcaptain26-3/DEMO_PHP.git
cd DEMO_PHP
```

👉 Mở bằng XAMPP, đặt thư mục vào `htdocs`.

---

## 🛠 Cấu trúc cơ bản

```
DEMO_PHP/
├── index.php              # Danh sách sinh viên + tìm kiếm + modal chi tiết
├── create.php             # Form thêm sinh viên
├── update.php             # Sửa sinh viên
├── delete.php             # Xoá (tùy chọn, hiện dùng index.php xử lý GET)
├── login.php              # Đăng nhập
├── logout.php             # Đăng xuất
├── details.php            # AJAX load chi tiết sinh viên (modal)
├── db.php                 # Kết nối CSDL
├── public/
│   ├── style.css          # Giao diện chính
│   ├── form.css           # Form tạo/sửa sinh viên
│   ├── auth.css           # Giao diện login
│   └── main.js            # Xử lý tìm kiếm, modal, validate form
└── README.md
```

---

## 🧾 Câu lệnh tạo CSDL MySQL

```sql
-- Bảng sinh viên
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20),
    address VARCHAR(255)
);

-- Bảng chi tiết sinh viên (1-1 với students)
CREATE TABLE student_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    student_code VARCHAR(20),
    gpa DECIMAL(3,2),
    math FLOAT,
    literature FLOAT,
    english FLOAT,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

-- Bảng tài khoản quản lý
CREATE TABLE manager (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Tạo tài khoản admin (password: 123456 với SHA2)
INSERT INTO manager (username, password)
VALUES ('admin', SHA2('123456', 256));
```

---

## 🔄 Luồng hoạt động

### 🔐 Đăng nhập (login.php)

* Người dùng nhập tài khoản và mật khẩu
* Nếu đúng → chuyển hướng sang `index.php`
* Sai → hiện thông báo lỗi

### 📋 Quản lý sinh viên (`index.php`)

* Hiển thị danh sách từ bảng `students`
* Có nút **Thêm**, **Sửa**, **Xoá**, **Xem chi tiết**
* Tìm kiếm **theo tên/email** (JavaScript lọc realtime)

### 📄 Chi tiết sinh viên (Modal + `details.php`)

* Khi bấm icon "🔍" → gửi AJAX lên `details.php`
* Dữ liệu hiển thị từ bảng `student_details`

### ➕ Thêm/Sửa sinh viên (`create.php`, `update.php`)

* Form nhập dữ liệu với **validate JS**
* Sau khi submit → lưu dữ liệu vào `students` (và `student_details` nếu cần)

### 🔓 Đăng xuất (`logout.php`)

* Huỷ session và quay lại trang login

---

## 🧑‍💻 LinkedIn cá nhân

📎 [linkedin.com/in/quangcaptain26](https://www.linkedin.com/in/minhquang2604)

> Kết nối để chia sẻ về PHP, Backend, Fullstack Web Dev và các dự án thực chiến.

---

## 📸 Giao diện

> ![](public/preview.png)
> *Đẹp – Gọn – Rõ ràng – Có hiệu ứng hover & modal popup.*

---

## 📢 Gợi ý nâng cấp tiếp theo

* ✅ Phân quyền admin/user
* ✅ Mã hoá mật khẩu chuẩn `password_hash()`
* ✅ Export CSV, lọc nâng cao
* ✅ Upload ảnh đại diện sinh viên

---

