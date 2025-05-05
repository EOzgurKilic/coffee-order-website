<?php
session_start();
include 'db.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {

        $stmt = $conn->prepare("SELECT * FROM clients WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Username or email already exists.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO clients (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashedPassword);
            if ($stmt->execute()) {
              
                $_SESSION['client_username'] = $username;

                
                if (isset($_GET['redirect']) && $_GET['redirect'] === 'coffee_detail.php' && isset($_GET['coffee'])) {
                    $coffee = urlencode($_GET['coffee']);
                    header("Location: coffee_detail.php?coffee=$coffee");
                    exit();
                }

                header("Location: coffees.php");
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<?php include 'header.php'; ?>
<link rel="stylesheet" href="css/login.css">

<div class="login-container">
    <div class="login-box">
        <h2>Register</h2>
        <?php if ($error): ?>
            <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
        </form>
        <br>
        <a href="clientlogin.php">← Already have an account? Login</a>
    </div>
</div>

<?php include 'footer.php'; ?>
