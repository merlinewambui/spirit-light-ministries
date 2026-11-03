<?php
$conn = new mysqli("127.0.0.1", "root", "", "spirit_light", 3307);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>SLM - Spirit Light Ministries</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
:root{--purple:#3a2d8a;--blue:#1a237e;--gold:#d4af37;--gold-light:#ffd700;--white:#ffffff}
body{font-family:'Outfit',sans-serif;background:var(--white);color:#222;overflow-x:hidden}
.navbar{background:rgba(255,255,255,0.95);backdrop-filter:blur(10px);display:flex;justify-content:space-between;align-items:center;padding:12px 5%;box-shadow:0 4px 20px rgba(58,45,138,0.08);position:sticky;top:0;z-index:1000;border-bottom:2px solid transparent;border-image:linear-gradient(90deg,var(--gold),var(--purple)) 1}
.logo-wrap{display:flex;align-items:center;gap:12px}
.logo-wrap img{width:85px;height:85px;border-radius:50%;border:3px solid var(--gold);box-shadow:0 0 15px rgba(212,175,55,0.4);object-fit:cover}
.logo-text h2{font-family:'Playfair Display',serif;color:var(--purple);font-size:26px;line-height:1;margin:0}
.logo-text span{font-size:11px;letter-spacing:1px;color:var(--blue);font-weight:600;text-transform:uppercase}
.nav-links{display:flex;gap:32px}
.nav-links a{text-decoration:none;color:#444;font-weight:600;position:relative;padding:6px 0;transition:0.3s}
.nav-links a::after{content:'';position:absolute;bottom:0;left:0;width:0;height:3px;background:linear-gradient(90deg,var(--gold),var(--gold-light));transition:0.4s;border-radius:10px}
.nav-links a:hover::after,.nav-links a.active::after{width:100%}
.nav-links a.active{color:var(--purple)}
.loc{font-size:12px;color:#666;background:#f8f7ff;padding:6px 12px;border-radius:20px;border:1px solid #e9e6ff}
.hero{display:flex;align-items:center;justify-content:space-between;padding:70px 5% 50px;background:radial-gradient(1200px at 10% 0%, #f3f0ff 0%, #ffffff 55%, #ffffff 100%);min-height:88vh}
.hero-left{max-width:580px;animation:fadeInLeft 1s ease}
.hero-left h1{font-family:'Playfair Display',serif;font-size:56px;line-height:1.05;color:var(--blue);margin-bottom:18px}
.hero-left h1 span{background:linear-gradient(90deg,var(--purple),var(--blue));-webkit-background-clip:text;-webkit-text-fill-color:transparent}
.tagline{font-size:19px;color:var(--purple);font-weight:600;margin-bottom:12px}
.subline{font-size:14px;color:#777;margin-bottom:28px;line-height:1.6}
.btn-main{position:relative;background:linear-gradient(135deg,var(--purple),var(--blue));color:white;padding:16px 32px;border-radius:50px;font-weight:700;text-decoration:none;display:inline-flex;align-items:center;gap:8px;box-shadow:0 10px 25px rgba(58,45,138,0.3);overflow:hidden;transition:0.4s}
.btn-main::before{content:'';position:absolute;top:0;left:-100%;width:100%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.3),transparent);transition:0.6s}
.btn-main:hover::before{left:100%}
.btn-main:hover{transform:translateY(-3px) scale(1.03);box-shadow:0 15px 35px rgba(58,45,138,0.4)}
.btn-gold{background:linear-gradient(135deg,var(--gold),var(--gold-light));color:var(--blue);margin-left:12px;box-shadow:0 10px 25px rgba(212,175,55,0.3)}
.hero-right{position:relative;width:48%;animation:fadeInRight 1s ease}
.img-frame{position:relative;border-radius:24px;padding:8px;background:linear-gradient(135deg,var(--gold),var(--gold-light),var(--purple));box-shadow:0 25px 60px rgba(58,45,138,0.25)}
.img-frame img{width:100%;height:520px;object-fit:cover;border-radius:18px;display:block}
.float-badge{position:absolute;bottom:-20px;left:-20px;background:white;padding:14px 18px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.1);display:flex;align-items:center;gap:10px;border-left:4px solid var(--gold);animation:float 3s ease-in-out infinite}
.cards{display:flex;gap:22px;padding:0 5% 50px;margin-top:-40px;position:relative;z-index:2}
.card{flex:1;background:white;border-radius:16px;padding:22px;box-shadow:0 10px 30px rgba(58,45,138,0.08);border:1px solid #f0eeff;transition:0.4s}
.card:hover{transform:translateY(-6px);box-shadow:0 20px 40px rgba(58,45,138,0.12)}
.card h3{color:var(--purple);margin-bottom:8px}
.mpesa{background:linear-gradient(135deg,#1b5e20,#2e7d32);color:white;border:none}
.mpesa h3{color:#ffd54f}
.pulse{animation:pulseGold 2s infinite}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes pulseGold{0%{box-shadow:0 0 0 0 rgba(212,175,55,0.6)}70%{box-shadow:0 0 0 12px rgba(212,175,55,0)}100%{box-shadow:0 0 0 0 rgba(212,175,55,0)}}
@keyframes fadeInLeft{from{opacity:0;transform:translateX(-40px)}to{opacity:1;transform:translateX(0)}}
@keyframes fadeInRight{from{opacity:0;transform:translateX(40px)}to{opacity:1;transform:translateX(0)}}
@media(max-width:900px){.hero{flex-direction:column}.hero-right{width:100%;margin-top:35px}.nav-links{display:none}.cards{flex-direction:column;margin-top:20px}.hero-left h1{font-size:38px}}
</style>
</head>
<body>

<div class="navbar">
  <div class="logo-wrap">
    <img src="logo.png" alt="SLM Logo">
    <div class="logo-text"><h2>SLM</h2><span>Spirit Light Ministries</span></div>
  </div>
  <div class="nav-links">
  <a href="index.php" class="active">Home</a>
  <a href="about.php">About</a>
  <a href="members.php">Members</a>
  <a href="donate.php">Contributions</a>
  <a href="events.php">Events</a>
  <a href="contact.php">Contact</a>
</div>
  <div class="loc">📍 Utawala • Opp Shell Petrol Station</div>
</div>

<div class="hero">
  <div class="hero-left">
    <h1>Welcome to <span>Spirit Light Ministries</span></h1>
    <p class="tagline">Seek His Presence, Hear His Voice, Walk In His Power.</p>
    <p class="subline">Led by <span style="font-size:19px;font-weight:900;color:#d4af37;font-family:serif;">Prophet Caleb Wekesa</span> - Worship, Community, and Faith in Action</p>
    <a href="members.php" class="btn-main">Member Registration →</a>
    <a href="donate.php" class="btn-main btn-gold pulse">Give via M-PESA</a>
    <div style="margin-top:22px;display:flex;gap:10px;align-items:center">
        <a href="https://youtube.com/@spirit_light_ministries?si=97Q-BX55zrKCvyHS" target="_blank" style="display:inline-block;margin-top:12px;padding:12px 22px;background:#FF0000;color:#fff;border-radius:10px;text-decoration:none;font-weight:800;font-family:Arial;">
▶️ Watch Us on YouTube
</a>
      <img src="logo.png" style="width:85px;height:85px;border-radius:50%;border:2px solid #d4af37">
      <span style="font-size:13px;color:#666">Official SLM Church Website • <b style="color:#2e7d32">M-PESA 0748 163301</b></span>
    </div>
  </div>
  <div class="hero-right">
    <div class="img-frame">
      <img src="https://images.unsplash.com/photo-1436397543931-01c1a252b356?q=80&w=800" alt="Church">
      <div class="float-badge">
        <div style="width:40px;height:40px;background:linear-gradient(135deg,#3a2d8a,#1a237e);border-radius:10px;display:flex;align-items:center;justify-content:center;color:gold;font-weight:bold">✝️</div>
        <div><strong style="color:#3a2d8a">Sunday Service</strong><br><span style="font-size:12px;color:#666">9:00 AM - 12:30 PM</span></div>
      </div>
    </div>
  </div>
</div>

<div class="cards">
  <div class="card">
    <h3>📅 Our Service</h3>
    <p>Every Sunday 9:00 AM - 12:30 PM<br>Spirit Light Church, Utawala<br><b>Call: 0748 163301</b></p>
  </div>
  <div class="card mpesa">
    <h3>💚 M-PESA GIVING</h3>
    <p style="font-size:26px;font-weight:800;letter-spacing:2px;margin:8px 0">0748 163301</p>
    <p style="font-size:13px;opacity:0.9">Send Tithe / Offering - Name: Spirit Light Church<br>Powered by SLM Ministries</p>
  </div>
  <div class="card">
    <h3>🙏 Our Mission</h3>
    <p><b>Matthew 5:14</b> - "You are the light of the world. A city set on a hill cannot be hidden."</p>
    <p style="margin-top:8px;font-size:12px;color:#888">White • Purple • Blue • Gold - Light of Christ</p>
  </div>
</div>

</body>
</html>