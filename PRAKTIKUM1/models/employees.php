<?php
class employee
{
    // Connection
    private $conn;
    // Table
    private $db_table = "employee";
    // Columns
    public $id;
    public $Nama_Bengkel;
    public $alamat_Bengkel;
    public $Undangan_Bengkel;
    public $Specialist_Bengkel;
    public $created;
    // Db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // GET ALL
    public function getEmployees()
    {
        $sqlQuery = "SELECT id, Nama_Bengkel, alamat_Bengkel, Undangan_Bengkel, Specialist_Bengkel, created FROM "
            . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    // CREATE
    public function createEmployee()
    {
        $sqlQuery = "INSERT INTO
" . $this->db_table . "
SET
Nama_Bengkel = :Nama_Bengkel,
alamat_Bengkel = :alamat_Bengkel,
Undangan_Bengkel = :Undangan_Bengkel,
Specialist_Bengkel = :Specialist_Bengkel,
created = :created";
        $stmt = $this->conn->prepare($sqlQuery);
        // sanitize
        $this->Nama_Bengkel = htmlspecialchars(strip_tags($this->Nama_Bengkel));
        $this->alamat_Bengkel = htmlspecialchars(strip_tags($this->alamat_Bengkel));
        $this->Undangan_Bengkel = htmlspecialchars(strip_tags($this->Undangan_Bengkel));
        $this->Specialist_Bengkel = htmlspecialchars(strip_tags($this->Specialist_Bengkel));
        $this->created = htmlspecialchars(strip_tags($this->created));
        // bind data
        $stmt->bindParam(":Nama_Bengkel", $this->Nama_Bengkel);
        $stmt->bindParam(":alamat_Bengkel", $this->alamat_Bengkel);
        $stmt->bindParam(":Undangan_Bengkel", $this->Undangan_Bengkel);
        $stmt->bindParam(":Specialist_Bengkel", $this->Specialist_Bengkel);
        $stmt->bindParam(":created", $this->created);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // READ single
    public function getSingleEmployee()
    {
        $sqlQuery = "SELECT
id,
Nama_Bengkel,
alamat_Bengkel,
Undangan_Bengkel,
Specialist_Bengkel,
created
FROM
" . $this->db_table . "
WHERE
id = ?
LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->Nama_Bengkel = $dataRow['Nama_Bengkel'];
        $this->alamat_Bengkel = $dataRow['alamat_Bengkel'];
        $this->Undangan_Bengkel = $dataRow['Undangan_Bengkel'];
        $this->Specialist_Bengkel = $dataRow['Specialist_Bengkel'];
        $this->created = $dataRow['created'];
    }
    // UPDATE
    public function updateEmployee()
    {
        $sqlQuery = "UPDATE
" . $this->db_table . "
SET
Nama_Bengkel = :Nama_Bengkel,
alamat_Bengkel = :alamat_Bengkel,
Undangan_Bengkel = :Undangan_Bengkel,
Specialist_Bengkel = :Specialist_Bengkel,
created = :created
WHERE
id = :id";
        $stmt = $this->conn->prepare($sqlQuery);
        $this->Nama_Bengkel = htmlspecialchars(strip_tags($this->Nama_Bengkel));
        $this->alamat_Bengkel = htmlspecialchars(strip_tags($this->alamat_Bengkel));
        $this->Undangan_Bengkel = htmlspecialchars(strip_tags($this->Undangan_Bengkel));
        $this->Specialist_Bengkel = htmlspecialchars(strip_tags($this->Specialist_Bengkel));
        $this->created = htmlspecialchars(strip_tags($this->created));
        $this->id = htmlspecialchars(strip_tags($this->id));
        // bind data
        $stmt->bindParam(":Nama_Bengkel", $this->Nama_Bengkel);
        $stmt->bindParam(":alamat_Bengkel", $this->alamat_Bengkel);
        $stmt->bindParam(":Undangan_Bengkel", $this->Undangan_Bengkel);
        $stmt->bindParam(":Specialist_Bengkel", $this->Specialist_Bengkel);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":id", $this->id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // DELETE
    function deleteEmployee()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>