<?php
$conn = new mysqli("localhost", "root", "", "spirit_light", 3307);
if($conn->connect_error){ die("Connection failed: ".$conn->connect_error); }
if(isset($_POST['register'])){
 $stmt=$conn->prepare("INSERT INTO members (fullname, phone, estate, gender) VALUES (?,?,?,?)");
 $stmt->bind_param("ssss", $_POST['fullname'], $_POST['phone'], $_POST['estate'], $_POST['gender']);
 if($stmt->execute()){ $msg="✅ Registration Successful! Welcome!"; } else { $msg="❌ Error: ".$conn->error; }
}
?>
<!DOCTYPE html><html><head><title>Members</title><meta name="viewport" content="width=device-width, initial-scale=1"><style>body{font-family:Arial;background:#f4f4ff;padding:20px}form{background:#fff;padding:20px;border-radius:12px;max-width:400px;margin:auto}input,select{width:100%;padding:10px;margin:8px 0;border:1px solid #ccc;border-radius:6px}button{width:100%;padding:12px;background:#3a2d8a;color:#fff;border:none;border-radius:6px;font-weight:700}</style></head><body>
<h2 style="text-align:center;color:#3a2d8a;">Member Registration</h2>
<form method="POST"><?php if(isset($msg)) echo "<div style='background:#e6ffe6;padding:10px;border-radius:6px;margin-bottom:10px'>$msg</div>"; ?>
<input type="text" name="fullname" placeholder="Full Name" required>
<input type="text" name="phone" placeholder="Phone" required>
<input type="text" name="estate" placeholder="Estate" required>
<select name="gender" required><option value="">Gender</option><option>Male</option><option>Female</option></select>
<button type="submit" name="register">Register Now</button>
<p style="text-align:center"><a href="index.php">← Home</a></p></form></body></html>