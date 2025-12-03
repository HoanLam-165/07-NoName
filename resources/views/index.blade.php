<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('index.css') }}">
    <link rel="stylesheet" href="{{ asset('button.css') }}">
    <title>Document</title>
    <style>

</style>

</head>
<body>
    <div class="searchContainer">
        <input id="searchInput" type="text" placeholder="Tìm kiếm">

        <select id="statusFilter">
            <option value="">Tất cả trạng thái</option>
            <option value="On-going">On-going</option>
            <option value="Delivered">Delivered</option>
            <option value="Assigned">Assigned</option>
        </select>

        <select id="categoryFilter">
            <option value="">Tất cả danh mục</option>
            <option value="1">Tài liệu</option>
            <option value="2">Đồ ăn</option>
            <option value="3">Hàng dễ vỡ</option>
        </select>

        <button class="S-btn">Tìm kiếm</button>
    </div>
    <div style="position: relative;">
 
    <div class="Order-container" id="orderContainer">
        <!-- Sản phẩm sẽ được chèn vào đây bởi JavaScript -->
    </div>

</div>

<script src="{{ asset('index.js') }}"></script>
 <script src="{{ asset('search.js') }}"></script>
</body>
</html>