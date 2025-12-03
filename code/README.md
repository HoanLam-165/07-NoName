# Hướng Dẫn Cài Đặt và Thêm Thành Phần Cho Laravel Project

## 1. Giới Thiệu

Mục đích của project và yêu cầu môi trường:

-   PHP >= v8.2, Laravel 12.x, composer
-   MySQL

## 2. Cài Đặt

-Lưu ý: việc copy file rồi dán vào trong Project có thể không hoạt động vì framework có thể từ chối file lạ
-Nên tạo file theo cú pháp rồi copy nội dung dán vào

1. Nếu đã cài composer, laravel, Chạy `composer create-project laravel/laravel [Ten_Project]`
2. Bắt đầu thêm các file vào Project giống minh họa trong result.docx
3. Kiểm tra file .env.testing, nếu không có thì tạo, nếu đã có, tiến hành liên kết database
4. Chạy `php artisan key:generate`
5. Chạy migration:(xóa 3 file mẫu sau khi create project và sau khi thêm các file migrate mới chạy)
    ```bash
    php artisan migrate
    ```

## 3. Thêm Các Thành Phần Vào Project

### 3.1 Migration

-   Lệnh:
    ```bash
    php artisan make:migration create_[ten_bang]_table
    ```
-   File: `database/migrations/xxxx_xx_xx_xxxxxx_create_[ten_bang]_table.php`

### 3.2 Model

-   Lệnh:
    ```bash
    php artisan make:model [TenModel]
    ```
-   File: `app/Models/[TenModel].php`

### 3.3 Factory

-   Lệnh:
    ```bash
    php artisan make:factory [TenModel]Factory --model=[TenModel];
    ```
-   File: `database/factories/[TenModel]Factory.php`

### 3.4 Route

-   File: `routes/web.php`
-   Ví dụ :

    ```php
    Route::post('/searchOrder',  [OrderController::class, "search"] );

    ```

### 3.5 Controller

-   Lệnh:
    ```bash
    php artisan make:controller [TenController]
    ```
-   File: `app/Http/Controllers/[TenController].php`

### 3.6 Resource

Riêng phần này trực tiếp dán file index.blade.php vào resources/views/

### 3.7 Feature Test

-   Lệnh:
    ```bash
    php artisan make:test ModelNameTest
    ```
-   File: `tests/Feature/ModelNameTest.php`

---
