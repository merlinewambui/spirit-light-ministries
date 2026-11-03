<?php
session_start();

// === ADD / REMOVE ADMINS HERE - YOU CAN CHANGE ANYTIME ===
$ADMINS = [
    "admin" => "Spirit2026",      // Main Admin
    "merline" => "Merline123",    // You - Merline
    "prophet" => "Caleb2026"      // Prophet Caleb Wekesa
];

if(isset($_POST['logout'])){ 
    session_destroy(); 
    header("Location: admin.php"); 
    exit; 
}

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];
    if(isset($ADMINS[$user]) && $ADMINS[$user] == $pass){
        $_SESSION['logged'] = true;
        $_SESSION['username'] = $user;
    } else {
        $error = "Wrong username or password!";
    }
}

if(!isset($_SESSION['logged'])){
?>
<!DOCTYPE html><html><head><title>Admin Login - Spirit Light Ministries</title><meta name="viewport" content="width=device-width, initial-scale=1">
<style>body{font-family:Arial;background:#f4f4ff;display:flex;justify-content:center;align-items:center;height:100vh;margin:0} .box{background:#fff;padding:30px;border-radius:16px;box-shadow:0 10px 30px rgba(0,0,0,0.1);width:90%;max-width:350px;text-align:center} input{width:100%;padding:12px;margin:8px 0;border:1px solid #ddd;border-radius:8px;box-sizing:border-box} button{width:100%;padding:12px;background:#3a2d8a;color:#fff;border:none;border-radius:8px;font-weight:700;cursor:pointer} .err{color:red;margin-bottom:10px;background:#ffe6e6;padding:8px;border-radius:6px}</style></head><body>
<div class="box"><h2>🔒 Admin Login</h2><p>Spirit Light Ministries</p>
<?php if(isset($error)) echo "<div class='err'>$error</div>"; ?>
<form method="POST"><input type="text" name="username" placeholder="Username" required><input type="password" name="password" placeholder="Password" required><button type="submit" name="login">Login</button></form>
<p style="font-size:12px;margin-top:15px;color:#666;text-align:left;background:#f9f9f9;padding:10px;border-radius:8px;">
<strong>Current Logins:</strong><br>
• admin / Spirit2026<br>
• merline / Merline123<br>
• prophet / Caleb2026<br><br>
Change them in admin.php top lines
</p><a href="index.php">← Back to Home</a></div></body></html>
<?php exit; } 

// === IF LOGGED IN - SHOW DATA ===
$conn = new mysqli("localhost", "root", "", "church_db");
if($conn->connect_error){ die("Database connection failed: " . $conn->connect_error); }

$members = $conn->query("SELECT * FROM members ORDER BY id DESC");
$contribs = $conn->query("SELECT * FROM contributions ORDER BY id DESC");
?>
<!DOCTYPE html><html><head><title>Admin - Spirit Light Ministries</title><meta name="viewport" content="width=device-width, initial-scale=1">
<style>body{font-family:Arial;background:#f4f4ff;margin:0;padding:20px} h1{color:#3a2d8a} table{width:100%;background:#fff;border-collapse:collapse;margin-bottom:30px;border-radius:10px;overflow:hidden;box-shadow:0 5px 15px rgba(0,0,0,0.1)} th{background:#3a2d8a;color:#fff;padding:10px;font-size:13px} td{padding:8px;border-bottom:1px solid #eee;text-align:center;font-size:13px} .card{padding:20px;background:#fff;border-radius:10px;margin-bottom:20px;overflow-x:auto} .top{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap} button.logout{padding:8px 15px;background:#d33;color:#fff;border:none;border-radius:6px;cursor:pointer;font-weight:700} .welcome{background:#e6e6ff;padding:10px 15px;border-radius:8px;margin:10px 0}</style></head><body>
<div class="top"><h1>Spirit Light Ministries - Admin Dashboard</h1><form method="POST"><button class="logout" name="logout">Logout</button></form></div>
<div class="welcome">Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>! You are logged in. | <a href="index.php">View Website</a></div>

<div class="card"><h2>Registered Members (<?php echo $members ? $members->num_rows : 0; ?>)</h2>
<table><tr><th>ID</th><th>Name</th><th>Phone</th><th>Estate</th><th>Gender</th><th>Date</th></tr>
<?php 
if($members && $members->num_rows > 0){
    while($r=$members->fetch_assoc()){ echo "<tr><td>{$r['id']}</td><td>{$r['fullname']}</td><td>{$r['phone']}</td><td>{$r['estate']}</td><td>{$r['gender']}</td><td>{$r['reg_date']}</td></tr>"; } 
} else { echo "<tr><td colspan='6'>No members yet - Try registering in members.php</td></tr>"; }
?>
</table></div>

<div class="card"><h2>Contributions / Offerings (<?php echo $contribs ? $contribs->num_rows : 0; ?>)</h2>
<table><tr><th>ID</th><th>Name</th><th>Phone</th><th>Amount</th><th>Type</th><th>M-PESA Code</th><th>Date</th></tr>
<?php 
if($contribs && $contribs->num_rows > 0){
    while($r=$contribs->fetch_assoc()){ echo "<tr><td>{$r['id']}</td><td>{$r['name']}</td><td>{$r['phone']}</td><td>KES {$r['amount']}</td><td>{$r['type']}</td><td>{$r['mpesa_code']}</td><td>{$r['date']}</td></tr>"; } 
} else { echo "<tr><td colspan='7'>No contributions yet</td></tr>"; }
?>
</table></div>

</body></html>