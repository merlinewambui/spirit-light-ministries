<?php
$conn = new mysqli("localhost", "root", "", "spirit_light", 3307);

// DELETE
if(isset($_GET['delete'])){
  $id = intval($_GET['delete']);
  $conn->query("DELETE FROM events WHERE id=$id");
  header("Location: events.php");
  exit();
}

// UPDATE
if(isset($_POST['update'])){
  $stmt = $conn->prepare("UPDATE events SET title=?, event_date=?, location=?, description=? WHERE id=?");
  $stmt->bind_param("ssssi", $_POST['title'], $_POST['event_date'], $_POST['location'], $_POST['description'], $_POST['id']);
  $stmt->execute();
  header("Location: events.php");
  exit();
}

// ADD
if(isset($_POST['add'])){
  $stmt = $conn->prepare("INSERT INTO events (title, event_date, location, description) VALUES (?,?,?,?)");
  $stmt->bind_param("ssss", $_POST['title'], $_POST['event_date'], $_POST['location'], $_POST['description']);
  $stmt->execute();
  header("Location: events.php");
  exit();
}

// For editing
$editRow = null;
if(isset($_GET['edit'])){
  $id = intval($_GET['edit']);
  $editRow = $conn->query("SELECT * FROM events WHERE id=$id")->fetch_assoc();
}

$result = $conn->query("SELECT * FROM events ORDER BY event_date DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Events - Spirit Light Ministries</title>
<style>
body{margin:0;font-family:Arial;background:#f8f9fa}
.navbar{display:flex;justify-content:space-between;align-items:center;padding:15px 40px;background:white;box-shadow:0 2px 10px rgba(0,0,0,0.1)}
.logo-wrap{display:flex;align-items:center;gap:10px}
.logo-wrap img{width:50px;height:50px;border-radius:50%}
.logo-text h2{margin:0;color:#222}
.logo-text span{font-size:12px;color:#666}
.nav-links a{margin:0 10px;text-decoration:none;color:#333;font-weight:bold}
.nav-links a:hover,.nav-links a.active{color:#d4a017}
.loc{font-size:13px;color:#555}
.hero-section{padding:50px 40px;text-align:center;background:linear-gradient(135deg,#d4a017,#f7c948);color:white}
.hero-section h1{font-size:36px;margin:0}
.container{max-width:900px;margin:-30px auto 40px;background:white;padding:30px;border-radius:15px;box-shadow:0 5px 20px rgba(0,0,0,0.1)}
.event-card{border-left:5px solid #d4a017;background:#fffdf0;padding:20px;margin:15px 0;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.05)}
.event-card h3{margin:0 0 5px;color:#222}
.event-card .meta{font-size:13px;color:#888;margin-bottom:10px}
.event-actions{margin-top:10px}
.event-actions a{margin-right:15px;text-decoration:none;font-size:13px;font-weight:bold}
.btn-edit{color:#d4a017} .btn-delete{color:#e74c3c}
.form-box{background:#f1f1f1;padding:20px;border-radius:10px;margin-top:30px}
.form-box input,.form-box textarea{width:100%;padding:8px;margin:5px 0 10px;border:1px solid #ccc;border-radius:5px}
.form-box button{border:none;padding:10px 20px;border-radius:5px;cursor:pointer;font-weight:bold;color:white}
.btn-add{background:#d4a017} .btn-update{background:#27ae60} .btn-cancel{background:#888}
</style>
</head>
<body>

<div class="navbar">
  <div class="logo-wrap">
    <img src="logo.png" alt="SLM Logo">
    <div class="logo-text"><h2>SLM</h2><span>Spirit Light Ministries</span></div>
  </div>
  <div class="nav-links">
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="members.php">Members</a>
    <a href="donate.php">Contributions</a>
    <a href="events.php" class="active">Events</a>
    <a href="contact.php">Contact</a>
  </div>
  <div class="loc">📍 Utawala Opp Shell Petrol Station</div>
</div>

<div class="hero-section">
  <h1>Church Events & Announcements</h1>
  <p>Cell Groups • Services • Kesha • Youth Meetings</p>
</div>

<div class="container">

<?php
if ($result && $result->num_rows > 0) {
  while($row = $result->fetch_assoc()){
    echo "<div class='event-card'>";
    echo "<h3>".$row['title']."</h3>";
    echo "<div class='meta'>📅 ".$row['event_date']." | 📍 ".$row['location']."</div>";
    echo "<p>".$row['description']."</p>";
    echo "<div class='event-actions'>";
    echo "<a class='btn-edit' href='events.php?edit=".$row['id']."'>✏️ Edit</a>";
    echo "<a class='btn-delete' href='events.php?delete=".$row['id']."' onclick=\"return confirm('Delete this event?')\">🗑️ Delete</a>";
    echo "</div></div>";
  }
} else {
  echo "<p style='text-align:center;color:#777;'>No events yet. Be the first to add!</p>";
}
?>

<div class="form-box">
<?php if($editRow): ?>
<h3>✏️ Edit Event</h3>
<form method="post">
<input type="hidden" name="id" value="<?php echo $editRow['id']; ?>">
Title: <input name="title" value="<?php echo $editRow['title']; ?>" required>
Date: <input type="date" name="event_date" value="<?php echo $editRow['event_date']; ?>" required>
Location: <input name="location" value="<?php echo $editRow['location']; ?>" required>
Description: <textarea name="description" rows="3"><?php echo $editRow['description']; ?></textarea>
<button type="submit" name="update" class="btn-update">Update Event</button>
<a href="events.php" style="margin-left:10px;"><button type="button" class="btn-cancel">Cancel</button></a>
</form>
<?php else: ?>
<h3>Add New Event / Announcement</h3>
<form method="post">
Title: <input name="title" placeholder="e.g. Cell Group - Umoja" required>
Date: <input type="date" name="event_date" required>
Location: <input name="location" placeholder="e.g. Umoja Estate" required>
Description: <textarea name="description" rows="3" placeholder="Details..."></textarea>
<button type="submit" name="add" class="btn-add">Add Event</button>
</form>
<?php endif; ?>
</div>

</div>
</body>
</html>