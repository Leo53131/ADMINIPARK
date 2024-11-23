<?php
class BaseController {
    protected $db;
    protected $table;
    protected $idColumn;

    public function __construct($conexion, $table, $idColumn = 'id') {
        $this->db = $conexion;
        $this->table = $table;
        $this->idColumn = $idColumn;
    }

    public function crear($datos) {
        $columnas = implode(", ", array_keys($datos));
        $valores = ":" . implode(", :", array_keys($datos));
        
        $query = "INSERT INTO {$this->table} ($columnas) VALUES ($valores)";
        $stmt = $this->db->prepare($query);
        
        foreach ($datos as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        
        return $stmt->execute();
    }

    public function leer($id = null) {
        if ($id) {
            $query = "SELECT * FROM {$this->table} WHERE {$this->idColumn} = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $query = "SELECT * FROM {$this->table}";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function actualizar($id, $datos) {
        $set = [];
        foreach ($datos as $key => $value) {
            $set[] = "$key = :$key";
        }
        $set = implode(", ", $set);
        
        $query = "UPDATE {$this->table} SET $set WHERE {$this->idColumn} = :id";
        $stmt = $this->db->prepare($query);
        
        $stmt->bindValue(":id", $id);
        foreach ($datos as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        
        return $stmt->execute();
    }

    public function eliminar($id) {
        $query = "DELETE FROM {$this->table} WHERE {$this->idColumn} = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":id", $id);
        return $stmt->execute();
    }
}

