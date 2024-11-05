<?php
include "config.php";

?>

<?php
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $link;
    private $error;

    public function __construct() { 
        $this->connectDB();
    }

    private function connectDB() {
        // Kết nối cơ sở dữ liệu và xử lý lỗi
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if ($this->link->connect_error) {
            $this->error = "Connection failed: " . $this->link->connect_error;
            return false;
        }
        return true;
    }

    // Select hoặc đọc dữ liệu
    public function select($query) {
        $result = $this->link->query($query);
        if (!$result) {
            die("Error on SELECT query: " . $this->link->error);
        }
        return ($result->num_rows > 0) ? $result : false;
    }

    // Chèn dữ liệu
    public function insert($query) {
        $insert_row = $this->link->query($query);
        if (!$insert_row) {
            die("Error on INSERT query: " . $this->link->error);
        }
        return $insert_row;
    }

    // Cập nhật dữ liệu
    public function update($query) {
        $update_row = $this->link->query($query) or
        die($this->link->error.__LINE__);
        if ($update_row) {
            return $update_row;
        }else{
            return false;
        }
    }

    // Xóa dữ liệu
    public function delete($query) {
        $delete_row = $this->link->query($query);
        if (!$delete_row) {
            die("Error on DELETE query: " . $this->link->error);
        }
        return $delete_row;
    }

    // Đóng kết nối
    public function close() {
        $this->link->close();
    }
}
