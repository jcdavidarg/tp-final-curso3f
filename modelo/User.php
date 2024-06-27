<?php
class User
{
    private $conn;
    private $table_name = 'users';

    public $user_id;
    public $user_email;
    public $username;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function register()
    {
        $initial_status = 0;
        
        $query = "INSERT INTO " . $this->table_name . " (username, password, user_email, user_status) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $this->username, $this->password, $this->user_email, $initial_status);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function login()
    {
        // El método findByUsername ya establece los datos del usuario si encuentra una coincidencia
        return $this->findByUsername();
    }

    public function findByUsername()
    {
        $query = "SELECT user_id, username, password, user_email FROM " . $this->table_name . " WHERE username = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $stmt->bind_result($this->user_id, $this->username, $this->password, $this->user_email);
        $stmt->fetch();

        if ($this->user_id) {
            return true;
        }
        return false;
    }
    public function updateStatus($status)
    {
        $query = "UPDATE " . $this->table_name . " SET user_status = ? WHERE user_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $status, $this->user_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
}
