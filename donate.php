<?php
$msg = "";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    
    $conn = new mysqli("localhost", "root", "", "church_db");
    if(!$conn->connect_error){
        $conn->query("CREATE TABLE IF NOT EXISTS contributions (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100), phone VARCHAR(20), amount VARCHAR(20), type VARCHAR(30), mpesa_code VARCHAR(30), date TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
        $code = $_POST['mpesa_code'];
        $stmt = $conn->prepare("INSERT INTO contributions (name, phone, amount, type, mpesa_code) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $name, $phone, $amount, $type, $code);
        if($stmt->execute()){ $msg = "✅ God Bless You $name! Your $type of KES $amount received. Thank you!"; }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Give - Spirit Light Ministries</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
:root{--purple:#3a2d8a;--gold:#d4af37;--green:#1b8c3e;}
body{font-family:Arial,sans-serif;background:#f8f7ff;margin:0}
.header{display:flex;align-items:center;gap:14px;padding:14px 20px;background:#fff;border-bottom:3px solid var(--gold)}
.logo-wrap img{width:85px;height:85px;border-radius:50%;border:3px solid var(--gold);object-fit:cover}
.brand h1{margin:0;font-size:22px;color:var(--purple)} .brand h1 span{color:var(--gold)}
.subline{font-size:13px;color:#555} .subline span{font-size:18px;font-weight:800;color:var(--purple)}
.box{max-width:600px;margin:30px auto;background:#fff;padding:25px;border-radius:16px;box-shadow:0 10px 30px rgba(0,0,0,0.1)}
.mpesa{background:linear-gradient(135deg,#1b8c3e,#2ecc71);color:#fff;padding:20px;border-radius:12px;text-align:center;margin-bottom:20px}
.mpesa h2{margin:0 0 10px} .mpesa .number{font-size:28px;font-weight:800;letter-spacing:2px;background:#fff;color:var(--green);padding:8px 15px;border-radius:8px;display:inline-block;margin:10px 0}
.steps{text-align:left;background:rgba(255,255,255,0.2);padding:10px 15px;border-radius:8px;font-size:14px}
input,select{width:100%;padding:12px;margin:8px 0 14px;border:1px solid #ddd;border-radius:8px;box-sizing:border-box}
button{width:100%;padding:14px;background:var(--purple);color:#fff;border:none;border-radius:10px;font-weight:700;font-size:16px;cursor:pointer}
.msg{padding:12px;background:#e8f5e9;border-radius:8px;text-align:center;margin-bottom:15px;font-weight:600;color:var(--green)}
.back{display:block;text-align:center;margin-top:20px;color:var(--purple);text-decoration:none}
</style>
</head>
<body>
<div class="header">
 <div class="logo-wrap"><img src="logo.png"></div>
 <div class="brand"><h1>SPIRIT LIGHT <span>MINISTRIES</span></h1>
 <p class="subline">Led by <span>Prophet Caleb Wekesa</span></p></div>
</div>

<div class="box">
<div class="mpesa">
<h2>Give Via M-PESA</h2>
<div class="number">0748 163 301</div>
<p>Name: Prophet Caleb Wekesa / Spirit Light Church</p>
<div class="steps">
<b>How to give:</b><br>
1. Go to M-PESA > Send Money<br>
2. Enter number 0748163301<br>
3. Enter Amount<br>
4. Enter M-PESA PIN<br>
5. Copy M-PESA Code below
</div>
</div>

<?php if($msg) echo "<div class='msg'>$msg</div>"; ?>

<form method="POST">
<input type="text" name="name" placeholder="Your Full Name" required>
<input type="text" name="phone" placeholder="Your M-PESA Phone Number" required>
<select name="type" required><option value="">Select Giving Type</option><option>Tithe</option><option>Offering</option><option>Thanksgiving</option><option>Building Project</option><option>Seed</option></select>
<input type="number" name="amount" placeholder="Amount e.g. 1000" required>
<input type="text" name="mpesa_code" placeholder="M-PESA Code e.g. QGH5..." required>
<button type="submit">I Have Given - Record My Giving</button>
</form>
<a class="back" href="index.php">← Back to Home</a>
<a class="back" href="members.php">Go to Member Registration</a>
</div>
</body>
</html>