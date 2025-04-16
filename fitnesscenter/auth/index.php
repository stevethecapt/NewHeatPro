<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>NewHeat Pro</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
  <header>
    <nav>
        <a class="logo">NewHeat <span>Pro</span></a>
        <?php if (isset($_SESSION['username'])): ?>
          <span class="nav-user"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
        <?php else: ?>
          <a href="login.php" class="nav-btn">Login</a>
        <?php endif; ?>
    </nav>
  </header>
  <div class="text-container">
    <h3>Build Your</h3>
    <h1>Dream Body</h1>
    <h1><span id="changing-text">Body Building</span></h1>
    <script>
        const phrases = ["Body Building", "Build Your Body", "Fat Loose", "Power Lifting", "Be Unstopable"];
        const textElement = document.getElementById("changing-text");
        let index = 0;
        setInterval(() => {
            index = (index + 1) % phrases.length;
            textElement.style.opacity = 0;

            setTimeout(() => {
            textElement.textContent = phrases[index];
            textElement.style.opacity = 1;
            }, 300);
        }, 2500);
        </script>
  </div>
  <a href="dashboard.php" class="startnow-btn">Start Now</a>
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
      background: url('../img/h1_hero.png') no-repeat center center/cover;
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
      padding: 1rem 5%;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(8px);
    }

    .logo {
      font-size: 2rem;
      color: var(--header-color);
      font-weight: 900;
      letter-spacing: 1px;
      cursor: pointer;
      transition: transform 0.4s ease, color 0.4s ease;
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
    }
    .nav-btn:hover {
      background: var(--border-color);
      color: var(--text-color);
      box-shadow: 0 0 12px var(--border-color);
    }
    
    .startnow-btn {
        display: inline-block;
        padding: 1rem 2.5rem;
        margin-top: 2rem;
        background-color: red;
        color: white;
        font-size: 1.8rem;
        text-align: center;
        border-radius: 8px;
        transition: all 0.3s ease;
        white-space: nowrap;

        position: fixed;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 999;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .startnow-btn:hover {
        background-color: darkred;
        transform: translateX(-50%) scale(1.05);
        box-shadow: 0 10px 24px rgba(255, 0, 0, 0.4);
    }

    .text-container {
        position: absolute;
        top: 50%;
        left: 8%;
        transform: translateY(-50%);
        z-index: 2;
        color: white;
    }

    .text-container h3 {
        font-size: 3.4rem;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.6);
    }

    .text-container h1 {
        font-size: 3.6rem;
        line-height: 1.2;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.6);
    }
    #changing-text {
        color: red;
        font-weight: 700;
        transition: opacity 0.5s ease-in-out;
    }
  </style>