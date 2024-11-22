class EmpleadoController {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function agregarEmpleado($username, $password, $role) {
        $query = "INSERT INTO empleados (Nombre_Usuario, Contrasena, Rol) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        
        // Asegúrate de usar un método adecuado para manejar la contraseña (hashing)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $username, $hashedPassword, $role);

        if ($stmt->execute()) {
            return ['success' => true];
        } else {
            return ['success' => false, 'message' => $stmt->error];
        }
    }

    public function listarEmpleados() {
        $query = "SELECT * FROM empleados";
        $stmt = $this->conexion->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}