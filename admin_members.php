<?php
$conn = new mysqli("localhost", "root", "", "spirit_light", 3307);
$result = $conn->query("SELECT * FROM members ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin - Members List</title>
<style>
body{margin:0;font-family:Arial;background:#f8f9fa}
.navbar{display:flex;justify-content:space-between;align-items:center;padding:15px 40px;background:white;box-shadow:0 2px 10px rgba(0,0,0,0.1)}
.nav-links a{margin:0 10px;text-decoration:none;color:#333;font-weight:bold}
.nav-links a.active{color:#d4a017}
.hero-section{padding:40px;text-align:center;background:linear-gradient(135deg,#d4a017,#f7c948);color:white}
.container{max-width:1000px;margin:-20px auto 40px;background:white;padding:25px;border-radius:15px;box-shadow:0 5px 20px rgba(0,0,0,0.1)}
table{width:100%;border-collapse:collapse;margin-top:20px}
th,td{padding:12px;text-align:left;border-bottom:1px solid #eee}
th{background:#fff8e1;color:#333}
.badge{padding:4px 8px;background:#d4a017;color:white;border-radius:10px;font-size:12px}
</style>
</head>
<body>
<div class="navbar">
  <div><b>SLM ADMIN</b></div>
  <div class="nav-links">
    <a href="index.php">Home</a>
    <a href="admin_members.php" class="active">Members</a>
    <a href="events.php">Events</a>
    <a href="donate.php">Donations</a>
  </div>
</div>
<div class="hero-section">
  <h1>Registered Members</h1>
  <p>Total: <?php echo $result ? $result->num_rows : 0; ?> members</p>
</div>
<div class="container">
<table>
<tr><th>ID</th><th>Name</th><th>Phone / Email</th><th>Location</th><th>Date Joined</th></tr>
<?php
if($result && $result->num_rows > 0){
  while($row = $result->fetch_assoc()){
    // Try to guess column names - adjust if needed
    $name = $row['name'] ?? $row['full_name'] ?? $row['member_name'] ?? 'N/A';
    $contact = $row['phone'] ?? $row['email'] ?? $row['contact'] ?? 'N/A';
    $loc = $row['location'] ?? $row['estate'] ?? $row['area'] ?? 'N/A';
    $date = $row['created_at'] ?? $row['reg_date'] ?? $row['date'] ?? 'N/A';
    echo "<tr><td>{$row['id']}</td><td><b>$name</b></td><td>$contact</td><td>$loc</td><td>$date</td></tr>";
  }
} else {
  echo "<tr><td colspan='5' style='text-align:center;padding:20px;color:#999;'>No members yet. When someone registers on members.php, they will appear here.</td></tr>";
}
?>
</table>
<br>
<p style="font-size:13px;color:#777;">👉 This is what Admin sees! Every new registration appears here instantly.</p>
</div>
</body>
</html>