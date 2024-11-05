<?php
/**
 * Session Class
 **/
class Session {

    // Khởi tạo session
    public static function init() {
        if (version_compare(phpversion(), '5.4.0', '<')) {
            if (session_id() == '') {
                session_start();
            }
        } else {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }
    }

    // Thiết lập giá trị session
    public static function set($key, $val) {
        $_SESSION[$key] = $val;
    }

    // Lấy giá trị session
    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    // Kiểm tra session, nếu không đăng nhập thì điều hướng đến login.php
    public static function checkSession() {
        self::init();
        if (self::get("login") == false) {
            self::destroy();
            header("Location:login.php");
            exit(); // Nên dừng script sau khi chuyển hướng
        }
    }

    // Kiểm tra đăng nhập, nếu đã đăng nhập thì điều hướng đến index.php
    public static function checkLogin() {
        self::init();
        if (self::get("login") == true) {
            header("Location:index.php");
            exit(); // Dừng script sau khi chuyển hướng
        }
    }

    // Hủy session
    public static function destroy() {
        session_destroy();
        session_unset(); // Xóa tất cả các biến session
        header("Location:login.php");
        exit(); // Dừng script sau khi chuyển hướng
    }
}
?>
