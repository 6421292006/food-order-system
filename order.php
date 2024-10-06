<?php
// ตรวจสอบว่าฟอร์มถูกส่งมาด้วย POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ตั้งค่าการเชื่อมต่อกับฐานข้อมูล
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

    // รับข้อมูลจากฟอร์ม
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $menu = $_POST['menu'] ?? [];

    $to = "admin@example.com";
    $subject = "คำสั่งซื้อใหม่จากระบบสั่งอาหารออนไลน์";
    $message = "มีคำสั่งซื้อใหม่จาก: $name\nเบอร์โทร: $phone\nรายการอาหาร: $menu";
    $headers = "From: orders@example.com";

mail($to, $subject, $message, $headers);


    if (empty($name) || empty($phone) || empty($menu)) {
        die("กรุณากรอกข้อมูลให้ครบถ้วน");
    }

    // รวมรายการอาหารที่เลือกเป็นข้อความเดียว
    $menu = implode(", ", $menu);

    // สร้างคำสั่ง SQL สำหรับบันทึกข้อมูลลงในตาราง
    $sql = "INSERT INTO orders (name, phone, menu) VALUES ('$name', '$phone', '$menu')";

    // ตรวจสอบและบันทึกข้อมูลลงในฐานข้อมูล
    if ($conn->query($sql) === TRUE) {
        echo "คำสั่งซื้อถูกบันทึกเรียบร้อยแล้ว!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // ปิดการเชื่อมต่อ
    $conn->close();
} else {
    echo "กรุณาส่งฟอร์มก่อน!";
}
?>