document.querySelector(".S-btn").addEventListener("click", function () {
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta ? csrfMeta.content : "";
    const userId = document.getElementById("searchInput").value.trim();
    const container = document.querySelector(".Order-container");

    const statusFilter = document.getElementById("statusFilter").value.trim();
    const categoryFilter = document
        .getElementById("categoryFilter")
        .value.trim();

    const load = { RoleID: 2 };

    if (userId) load.CustomerID = userId;
    if (statusFilter) load.Status = statusFilter;
    if (categoryFilter) load.Category = categoryFilter;

    fetch(`http://localhost/DeliveryService/public/searchOrder`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify(load),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Không tìm thấy đơn hàng.");
            }
            return response.json();
        })
        .then((data) => {
            console.log("Dữ liệu nhận về:", data);

            renderOrder(data.orders || data);

            document.getElementById("searchInput").value = "";
        })
        .catch((err) => {
            container.innerHTML = `<p style="color:red;">Không có sản phẩm phù hợp.</p>`;
            console.error("Lỗi:", err.message);
        });
});
