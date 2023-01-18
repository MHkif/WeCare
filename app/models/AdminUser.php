<?php
class AdminUser extends UserModel
{
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function tableName(): string
    {
        return 'admin';
    }
    // Regsiter Admin
    public function register($data)
    {
        $this->db->prepareQuery("INSERT INTO " . $this->tableName()  . " (first_name, last_name, email, password, avatar) VALUES(:first_name , :last_name,:email, :password, :avatar)");
        // Bind values
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':avatar', $data['avatar']);



        // Execute
        if ($this->db->execute()) {

            return true;
        } else {
            return false;
        }
    }

    // Login Admin
    public function login($email, $password)
    {
        $this->db->prepareQuery("SELECT * FROM " . $this->tableName()  . "  WHERE email = :email");
        $this->db->bind(':email', $email);

        $row = $this->db->singleRow();

        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            // if($hashed_password == $password){
            return $row;
        } else {
            return false;
        }
    }

    // Find user by email
    public function findUserByEmail($email)
    {
        $this->db->prepareQuery("SELECT * FROM " . $this->tableName()  . "  WHERE email = :email");
        // Bind value
        $this->db->bind(':email', $email);

        $row = $this->db->singleRow();

        // Check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Get User by ID
    public function getUserById($id)
    {
        $this->db->prepareQuery("SELECT * FROM " . $this->tableName()  . "  WHERE id = :id");
        // Bind value
        $this->db->bind(':id', $id);

        $row = $this->db->singleRow();

        return $row;
    }
}
