// Hàm nhận data và render ra màn hình
function renderOrder(data) {
    let container = document.querySelector(".Order-container");
    container.innerHTML = "";

    if (!data) return;

    if (Array.isArray(data)) {
        data.forEach((order) => {
            let html = "";
            html += `
                <div class="Order-card">
                    <h3> Customer ID: ${order.CustomerID}</h3>
                    <p>Category ID: ${order.CategoryID}</p>       
                    <p>Nơi xuất hàng: ${order.FromLocation}</p>
                    <p>Nơi nhận hàng: ${order.ToLocation}</p>
                    <p>Tổng giá: ${order.Total ?? "N/A"}</p>
                    <p>Phí cước: ${order.Charge ?? "N/A"}</p>
                    <p>Status: ${order.DeliveryStatus ?? "N/A"}</p>
                    <p>Current Location: ${order.CurrentLocation ?? "N/A"}</p>
                </div>

            `;
            container.innerHTML += html;
        });
    } else {
        // Nếu API trả về 1 object (1 sản phẩm)
        container.innerHTML = `
            <div class="Order-card">
                    <h3>Customer ID: ${order.CustomerID}</h3>       
                    <p>Nơi xuất hàng: ${order.FromLocation}</p>
                    <p>Nơi nhận hàng: ${order.ToLocation}</p>
                    <p>Tổng giá: ${order.Total ?? "N/A"}</p>
                    <p>Phí cước: ${order.Charge ?? "N/A"}</p>
                    <p>Status: ${order.DeliveryStatus ?? "N/A"}</p>
                    <p>Current Location: ${order.CurrentLocation ?? "N/A"}</p>
                </div>
        `;
    }
}

window.renderOrder = renderOrder;

document.addEventListener("DOMContentLoaded", function () {
    renderOrder();
});
