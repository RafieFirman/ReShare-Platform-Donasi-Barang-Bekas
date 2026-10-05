<?php
session_start();
require_once __DIR__ . '/../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../frontend/login.php');
    exit;
}

$identifier = trim($_POST['identifier'] ?? '');
$password   = $_POST['password'] ?? '';

if ($identifier === '' || $password === '') {
    $_SESSION['error'] = 'Nama/Email dan password wajib diisi';
    header('Location: ../../frontend/login.php');
    exit;
}

try {
    $stmt = $conn->prepare(
        'SELECT id, username, phone, email, password
         FROM users
         WHERE email = ? OR username = ?
         LIMIT 1'
    );

    $stmt->bind_param('ss', $identifier, $identifier);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $stmt->close();
        $_SESSION['error'] = 'Nama/Email atau password salah';
        header('Location: ../../frontend/login.php');
        exit;
    }

    $user = $result->fetch_assoc();
    $stmt->close();

    if (!password_verify($password, $user['password'])) {
        $_SESSION['error'] = 'Nama/Email atau password salah';
        header('Location: ../../frontend/login.php');
        exit;
    }

    session_regenerate_id(true);

    $_SESSION['login']    = true;
    $_SESSION['user_id']  = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email']    = $user['email'];
    $_SESSION['phone']    = $user['phone'];

    header('Location: ../../frontend/welcome.php');
    exit;
} catch (Throwable $e) {
    error_log('ReShare login failed: ' . $e->getMessage());

    $_SESSION['error'] = 'Login gagal karena koneksi/database bermasalah.';
    header('Location: ../../frontend/login.php');
    exit;
}
