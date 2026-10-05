<?php
session_start();
require_once __DIR__ . '/../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../frontend/register.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$phone    = trim($_POST['phone'] ?? '');

if ($username === '' || $email === '' || $password === '' || $phone === '') {
    $_SESSION['error'] = 'Semua field wajib diisi';
    header('Location: ../../frontend/register.php');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Format email tidak valid';
    header('Location: ../../frontend/register.php');
    exit;
}

if (strlen($password) < 6) {
    $_SESSION['error'] = 'Password minimal 6 karakter';
    header('Location: ../../frontend/register.php');
    exit;
}

try {
    // Cek username dan email sekaligus sebelum INSERT.
    $cek = $conn->prepare(
        'SELECT id, username, email
         FROM users
         WHERE username = ? OR email = ?
         LIMIT 1'
    );
    $cek->bind_param('ss', $username, $email);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {
        $existing = $result->fetch_assoc();

        if ($existing['username'] === $username) {
            $_SESSION['error'] = 'Username sudah digunakan';
        } else {
            $_SESSION['error'] = 'Email sudah digunakan';
        }

        $cek->close();
        header('Location: ../../frontend/register.php');
        exit;
    }

    $cek->close();

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $insert = $conn->prepare(
        'INSERT INTO users (username, email, password, phone)
         VALUES (?, ?, ?, ?)'
    );
    $insert->bind_param('ssss', $username, $email, $hashedPassword, $phone);
    $insert->execute();

    if ($insert->affected_rows !== 1) {
        throw new RuntimeException('Data user tidak berhasil ditambahkan.');
    }

    $insert->close();

    $_SESSION['success'] = 'Registrasi berhasil, silakan login';
    header('Location: ../../frontend/login.php');
    exit;
} catch (Throwable $e) {
    error_log('ReShare registration failed: ' . $e->getMessage());

    $_SESSION['error'] = 'Registrasi gagal. Pastikan database "reshare_db" dan tabel "users" sudah tersedia.';
    header('Location: ../../frontend/register.php');
    exit;
}
