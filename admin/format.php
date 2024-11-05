<?php

// Format Class
class Format {

    // Định dạng ngày tháng
    public function formatDate($date) {
        return date('F j, Y, g:i a', strtotime($date));
    }

    // Rút ngắn văn bản
    public function textShorten($text, $limit = 400) {
        $text = $text . " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));
        $text .= ".....";
        return $text;
    }

    // Xử lý đầu vào dữ liệu để tránh lỗi bảo mật
    public function validation($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Lấy tiêu đề trang
    public function title() {
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, '.php');

        if ($title == 'index') {
            $title = 'home';
        } elseif ($title == 'contact') {
            $title = 'contact';
        }

        return ucfirst($title);
    }
}
?>
