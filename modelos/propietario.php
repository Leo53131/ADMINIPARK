    <?php
    class Propietario {
        private $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        // Verificar si el username ya existe
        public function existeUsuario($username) {
            $sql = "SELECT id FROM propietario WHERE Username = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([$username]);
            return $stmt->rowCount() > 0;
        }

        // Listar todos los propietarios
        public function listar() {
            $query = "SELECT * FROM propietario";
            $result = $this->conexion->query($query);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        // Registrar propietario
        public function registrar($nombre, $apellido, $correo) {
            $query = "INSERT INTO propietario (Nombre, Apellido, Correo) VALUES (?, ?, ?)";
            $stmt = $this->conexion->prepare($query);
            return $stmt->execute([$nombre, $apellido, $correo]);
        }

        // Editar propietario
        public function editar($id, $nombre, $apellido, $correo) {
            $query = "UPDATE propietario SET Nombre = ?, Apellido = ?, Correo = ? WHERE id = ?";
            $stmt = $this->conexion->prepare($query);
            return $stmt->execute([$nombre, $apellido, $correo, $id]);
        }

        // Agregar propietario con username, role y password
        public function agregar($username, $role, $hashedPassword) {
            if ($this->existeUsuario($username)) {
                throw new Exception("El nombre de usuario ya existe.");
            }

            $query = "INSERT INTO propietario (Username, Role, Password) VALUES (?, ?, ?)";
            $stmt = $this->conexion->prepare($query);
            return $stmt->execute([$username, $role, $hashedPassword]);
        }
    }
    ?>
