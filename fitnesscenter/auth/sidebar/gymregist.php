<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Anda harus login terlebih dahulu!'); window.location.href='login.php';</script>";
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../../config/database.php';

    $gym_name = $_POST['gym_name'];
    $location = $_POST['location'];
    $user_id = $_SESSION['user_id'];
    $trainer_name = $_POST['trainer_name'];
    $trainer_username = $_POST['trainer_username'];
    $profile_picture = 'upload/gym_profile/default.png';
    if (isset($_FILES['gym_profile_picture']) && $_FILES['gym_profile_picture']['error'] === 0) {
        $uploadDir = '../../upload/gym_profile/';
        $filename = time() . '_' . basename($_FILES['gym_profile_picture']['name']);
        $uploadPath = $uploadDir . $filename;
        if (move_uploaded_file($_FILES['gym_profile_picture']['tmp_name'], $uploadPath)) {
            $profile_picture = $uploadPath;
        }
    }
    try {
        $stmtGym = $pdo->prepare("INSERT INTO gyms (user_id, gym_name, trainer_name, trainer_username, location, profile_picture) 
                                  VALUES (?, ?, ?, ?, ?, ?)");
        $stmtGym->execute([$user_id, $gym_name, $trainer_name, $trainer_username, $location, $profile_picture]);
        $stmtTrainer = $pdo->prepare("INSERT INTO trainers (user_id, gym_id) VALUES (?, ?)");
        $stmtTrainer->execute([$user_id, $gym_id]);
        echo "<script>alert('Gym berhasil didaftarkan!'); window.location.href='gym_dashboard.php';</script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>GYM</title>
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
            <a href="../login.php" class="nav-btn">Login</a>
        <?php endif; ?>
        </div>
    </nav>
  <div class="sidebar" id="sidebar">
    <ul>
      <li><a href="../dashboard.php">Home</a></li>
      <li><a href="gym.php">Gym</a></li>
      <li><a href="trainer.php">Trainer</a></li>
      <li><a href="gymregist.php">Your Gym</a></li>
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
    <div class="form-wrapper">
        <form method="POST" enctype="multipart/form-data">
            <div style="text-align: center; margin-bottom: 20px;">
                <div style="position: relative; width: 450px; height: 200px; margin: auto;">
                <img id="gymProfilePreview" 
                    src="upload/gym_profile/default.png" 
                    style="width: 450px; height: 200px; border-radius: 8px; object-fit: cover; background: transparent;">
                    
                <label for="gym_profile_picture" 
                        style="position: absolute; bottom: 0; right: 0; background: #2196F3; 
                                width: 30px; height: 30px; border-radius: 50%; color: white; 
                                text-align: center; font-size: 20px; cursor: pointer; line-height: 30px;">
                    +
                </label>
                <input type="file" id="gym_profile_picture" name="gym_profile_picture" accept="image/*" style="display: none;" onchange="previewGymImage(event)">
                </div>
            </div>
            <script>
            function previewGymImage(event) {
            const input = event.target;
            const reader = new FileReader();

            reader.onload = function () {
                const imgElement = document.getElementById('gymProfilePreview');
                imgElement.src = reader.result;
            };

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
            }
            </script>
                <h2>Register Your Gym</h2>
                <input type="text" name="gym_name" placeholder="Gym Name" required />
                <input type="text" name="location" placeholder="Location" required />
                <input type="hidden" name="trainer_id" value="<?php echo $user_id; ?>" />
                <input type="hidden" name="trainer_username" value="<?php echo $username; ?>" />
                <input type="hidden" name="trainer_name" value="<?php echo $fullname; ?>" />
                <button type="submit">Submit</button>
        </form>
    </div>
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
    background: url('../../img/gym2.jpeg') no-repeat center center/cover;
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
  .form-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
  }
  form {
    background: rgba(0, 0, 0, 0.7);
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    width: 650px;
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
    background: var(--highlight-color);
    color: var(--text-color);
    box-shadow: 0 0 10px var(--border-color);
  }
</style>