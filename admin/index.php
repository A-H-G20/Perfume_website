<?php
session_start();

// Include the database configuration
include '../connection.php';

// Initialize variables for charts
$users_data = [];
$orders_data = [];
$income_data = [];

try {
    // Fetch user verification data by day
    $stmt = $conn->query("
        SELECT DATE(created_at) AS day, COUNT(*) AS count 
        FROM users 
        WHERE role = 'user' 
        GROUP BY DATE(created_at) 
        ORDER BY day;
    ");
    while ($row = $stmt->fetch_assoc()) {
        $users_data[$row['day']] = $row['count'];
    }

    // Fetch order data by day
    $stmt = $conn->query("
        SELECT DATE(order_date) AS day, COUNT(*) AS count 
        FROM orders 
        WHERE status = 'Completed' 
        GROUP BY DATE(order_date) 
        ORDER BY day;
    ");
    while ($row = $stmt->fetch_assoc()) {
        $orders_data[$row['day']] = $row['count'];
    }

    // Fetch income data by day
    $stmt = $conn->query("
        SELECT DATE(order_date) AS day, SUM(total_price) AS total 
        FROM orders 
        WHERE status = 'Completed' 
        GROUP BY DATE(order_date) 
        ORDER BY day;
    ");
    while ($row = $stmt->fetch_assoc()) {
        $income_data[$row['day']] = $row['total'];
    }
} catch (Exception $e) {
    // Log errors
    error_log("Error fetching chart data: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <header>
    <ul>
    <li><a href="index.php">Dashboard</a></li>
    <li><a href="order.php">Orders</a></li>
    <li><a href="fetch_products.php">Products</a></li>
    <li><a href="admin_managment.php">Admin management</a></li>
    <li><a href="user_managment.php">User management</a></li>
    <li><a href="../logout.php">Logout</a></li>
</ul>

    </header>
    <style>
        /* General Styling */
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .navbar {
            background-color: #101828;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .menu {
            list-style: none;
            display: flex;
            gap: 15px;
            padding: 0;
            margin: 0;
        }

        .menu-item a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .menu-item a:hover {
            background-color: #4e6e8e;
        }

        .dashboard {
            padding: 20px;
        }

        .card-container {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            flex: 1;
            text-align: center;
        }

        .chart-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .chart-card {
            flex: 1;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        canvas {
            width: 100%;
            max-width: 600px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <h1>Enhanced Dashboard</h1>

        <!-- Cards Section -->
        <div class="card-container">
            <div class="card">
                <h2>Total Users</h2>
                <p><?= array_sum($users_data) ?></p>
            </div>
            <div class="card">
                <h2>Total Orders</h2>
                <p><?= array_sum($orders_data) ?></p>
            </div>
            <div class="card">
                <h2>Total Income</h2>
                <p>$<?= number_format(array_sum($income_data), 2) ?></p>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="chart-row">
            <div class="chart-card">
                <h3>Users Over Time</h3>
                <canvas id="usersChart"></canvas>
            </div>
            <div class="chart-card">
                <h3>Orders Over Time</h3>
                <canvas id="ordersChart"></canvas>
            </div>
            <div class="chart-card">
                <h3>Income Over Time</h3>
                <canvas id="incomeChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        const usersCtx = document.getElementById('usersChart').getContext('2d');
        const ordersCtx = document.getElementById('ordersChart').getContext('2d');
        const incomeCtx = document.getElementById('incomeChart').getContext('2d');

        const createChart = (ctx, labels, data, label, color) => {
            return new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        backgroundColor: color,
                        borderColor: color,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        };

        createChart(usersCtx, <?= json_encode(array_keys($users_data)) ?>, <?= json_encode(array_values($users_data)) ?>, 'Users', 'rgba(66, 133, 244, 0.6)');
        createChart(ordersCtx, <?= json_encode(array_keys($orders_data)) ?>, <?= json_encode(array_values($orders_data)) ?>, 'Orders', 'rgba(236, 64, 122, 0.6)');
        createChart(incomeCtx, <?= json_encode(array_keys($income_data)) ?>, <?= json_encode(array_values($income_data)) ?>, 'Income', 'rgba(103, 58, 183, 0.6)');
    </script>
</body>

</html>
