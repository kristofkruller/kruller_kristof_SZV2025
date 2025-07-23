
    <?php
    require_once(__DIR__ . "/../vendor/autoload.php");

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
    $dotenv->load();

    class Database
    {
      private string $host;
      private string $db_name;
      private string $username;
      private string $password;
      private ?PDO $conn = null;

      public function __construct()
      {
        $this->host = $_ENV['DB_HOST'];
        $this->db_name = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];
      }

      public function getConnection(): ?PDO
      {
        if ($this->conn === null) {
          try {
            $this->conn = new PDO(
              "mysql:host={$this->host};dbname={$this->db_name};charset=utf8",
              $this->username,
              $this->password,
              [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
              ]
            );
          } catch (PDOException $exception) {
            error_log("DB connection failed: " . $exception->getMessage());
            throw $exception; // Vagy dobj egy custom hibát
          }
        }
        return $this->conn;
      }
    }
