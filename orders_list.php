<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food_order";

// สร้างการเชื่อมต่อกับฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลคำสั่งซื้อทั้งหมด
$sql = "SELECT id, name, phone, menu FROM orders";
$result = $conn->query($sql);

// แสดงผลข้อมูล
echo "<h2>รายการคำสั่งซื้อทั้งหมด</h2>";
echo "<table border='1'>
<tr>
    <th>ID</th>
    <th>ชื่อผู้สั่ง</th>
    <th>เบอร์โทรศัพท์</th>
    <th>รายการอาหาร</th>
</tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["id"]. "</td>
        <td>" . $row["name"]. "</td>
        <td>" . $row["phone"]. "</td>
        <td>" . $row["menu"]. "</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='4'>ไม่มีคำสั่งซื้อ</td></tr>";
}

echo "</table>";

$conn->close();
?>