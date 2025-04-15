<?php
session_start();
require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = trim($_POST['identifier']); // username atau email
    $password   = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = :identifier OR email = :identifier LIMIT 1";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['identifier' => $identifier]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Simpan data ke session
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['fullname'] = $user['fullname'];

        // Redirect ke dashboard
        header("Location: dashboard/dashboard.php");
        exit;
    } else {
        echo "❌ Username/email atau password salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
  <header>
    <nav>
        <a class="logo">NewHeat <span>Pro</span></a>
        <div class="top-btn">
        <span class="text">Don't Have an Account?</span>
        <a href="signup.php" class="loginbtn">Sign Up</a>
        </div>
    </nav>
  </header>
  <div class="form-wrapper">
    <form method="POST">
      <h2>Login</h2>
        <input type="text" name="identifier" placeholder="Username or Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
    </form>
  </div>
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
    background: url('../img/section_bg01.png') no-repeat center center/cover;
    color: var(--text-color);
    scroll-behavior: smooth;
    object-fit: fit;
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
  .text {
      font-size: 1.2rem;
      margin-right: 5px;
    }
  .loginbtn {
    font-size: 1.3rem;
    color: var(--border-color);
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    padding: 0.5rem 1.2rem;
    transition: all 0.4s ease;
  }
  .loginbtn:hover {
    background: var(--border-color);
    color: var(--text-color);
    box-shadow: 0 0 12px var(--border-color);
  }
  .form-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
  }
  form {
    background: rgba(0, 0, 0, 0.7);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    width: 380px;
    text-align: center;
    color: var(--text-color);
  }
  form h2 {
    margin-bottom: 1.2rem;
    font-size: 1.8rem;
    color: var(--border-color);
    font-weight: 700;
  }
  form input[type="text"],
  form input[type="email"],
  form input[type="password"] {
    width: 90%;
    padding: 10px;
    margin: 10px 0;
    border: 1.5px solid var(--border-color);
    border-radius: 5px;
    background: var(--snd-bg-color);
    color: var(--text-color);
    font-size: 1rem;
    transition: 0.3s ease;
  }
  form input:focus {
    outline: none;
    box-shadow: 0 0 6px var(--border-color);
    background-color: rgba(255, 255, 255, 0.05);
  }
  form button {
    padding: 0.5rem 1.3rem;
    margin-top: 10px;
    background: transparent;
    border: 1.5px solid var(--border-color);
    border-radius: 8px;
    color: var(--border-color);
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
  }
  form button:hover {
    background: var(--border-color);
    color: var(--text-color);
    box-shadow: 0 0 10px var(--border-color);
  }
  </style>