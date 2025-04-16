<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
  <nav>
  <div class="nav-left">
    <div class="hamburger" id="hamburger"><i class='bx bx-menu'></i></div>
    <a class="logo">NewHeat <span>Pro</span></a>
  </div>
  <div class="top-btn">
  <?php if (isset($_SESSION['username'])): ?>
    <span class="nav-user" style="margin-right: 20px;"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
  <?php else: ?>
    <a href="login.php" class="nav-btn">Login</a>
  <?php endif; ?>
  </div>
</nav>
  <div class="sidebar" id="sidebar">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="sidebar/gym.php">Gym</a></li>
      <li><a href="sidebar/trainer.php">Trainer</a></li>
    </ul>
  </div>
  <div class="overlay" id="overlay"></div>
  <script>
    const hamburger = document.getElementById('hamburger');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    hamburger.addEventListener('click', () => {
      sidebar.classList.toggle('active');
      overlay.classList.toggle('active');
    });

    overlay.addEventListener('click', () => {
      sidebar.classList.remove('active');
      overlay.classList.remove('active');
    });
  </script>
</body>
</html>
<style>
  :root {
    --bg-color: #000;
    --snd-bg-color: #111;
    --text-color: #fff;
    --main-color: #111;
    --header-color: silver;
    --highlight-color: red;
    --border-color: silver;
  }
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
    text-decoration: none;
    list-style: none;
  }
  body {
    background: #000;
    color: var(--text-color);
    scroll-behavior: smooth;
    min-height: 100vh;
  }
  nav {
    position: fixed;
    width: 100%;
    top: 0;
    right: 0;
    z-index: 1000;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(8px);
  }
  .nav-left {
    display: flex;
    align-items: center;
    gap: 1.2rem;
    padding-left: 1rem;
  }
  .hamburger {
    font-size: 2rem;
    color: var(--text-color);
    cursor: pointer;
    display: block;
    z-index: 1100;
    margin-left: 0;
  }
  .logo {
    font-size: 2rem;
    color: var(--header-color);
    font-weight: 900;
    letter-spacing: 1px;
    cursor: pointer;
    transition: transform 0.4s ease, color 0.4s ease;
    margin-right: 0;
  }
  .logo span {
    color: var(--highlight-color);
  }
  .logo:hover {
    transform: scale(1.1);
    color: var(--text-color);
  }
  .top-btn {
    display: flex;
    gap: 0.5rem;
  }
  .nav-btn {
    font-size: 1.3rem;
    color: var(--border-color);
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    padding: 0.5rem 1.2rem;
    transition: all 0.4s ease;
    margin-right: 20px;
  }
  .nav-btn:hover {
    background: var(--border-color);
    color: var(--text-color);
    box-shadow: 0 0 12px var(--border-color);
  }
  .sidebar {
    width: 250px;
    background: transparent;
    padding: 15px;
    height: 100%;
    position: fixed;
    left: -260px;
    z-index: 1050;
    transition: left 0.3s ease;
  }
  .sidebar.active {
    left: 0;
  }
  .sidebar ul {
    display: flex;
    flex-direction: column;
    margin-top: 60px;
  }
  .sidebar ul li {
    margin: 8px 0;
  }
  .sidebar ul li a {
    display: block;
    font-size: 1.2rem;
    color: var(--text-color);
    padding: 5px;
    border-radius: 5px;
    text-align: center;
    transition: background-color 0.3s;
  }
  .sidebar ul li a:hover {
    background-color: var(--highlight-color);
  }
  .overlay {
    position: fixed;
    top: 0;
    left: 0;
    background: rgba(0,0,0,0.4);
    width: 100%;
    height: 100%;
    display: none;
    z-index: 1040;
  }
  .overlay.active {
    display: block;
  }
</style>