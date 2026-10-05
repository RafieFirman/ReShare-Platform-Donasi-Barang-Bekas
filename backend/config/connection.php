<?php
/**
 * Central MySQL connection for ReShare.
 *
 * Local XAMPP defaults:
 * host     = localhost
 * username = root
 * password = empty
 * database = reshare_db
 */

$DB_HOST = getenv('RESHARE_DB_HOST') ?: 'localhost';
$DB_USER = getenv('RESHARE_DB_USER') ?: 'root';
$DB_PASS = getenv('RESHARE_DB_PASS') ?: '';
$DB_NAME = getenv('RESHARE_DB_NAME') ?: 'reshare_db';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    error_log('ReShare DB connection failed: ' . $e->getMessage());

    http_response_code(500);
    exit('Koneksi database gagal. Pastikan MySQL/MariaDB aktif dan database "reshare_db" sudah dibuat.');
}
