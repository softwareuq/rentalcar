<?php

class Usuario {

    private $idUsuario;
    private $cedula;
    private $nombre;
    private $licencia;
    private $telefono;
    private $direccion;
    private $tipo;
    private $horasAcumuladas;
    
    function Usuario($idUsuario = "def", $cedula = "def", $nombre = "def", $licencia = "def", $telefono = "def", $direccion = "def", $tipo = "def", $horasAcumuladas = "def") {
        $this->idUsuario = $idUsuario;
        $this->cedula = $cedula;
        $this->nombre = $nombre;
        $this->licencia = $licencia;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->tipo = $tipo;
        $this->horasAcumuladas = $horasAcumuladas;
    }

    function getUsuario($id){
        include "database.php";
        $pdo = Database::connect();
        $query = "select * from usuarios where idUsuario =".$id;
        $result = $pdo->query($query);
        Database::disconnect();
    return $result;
  }
    
    function getUsuarios() {
        include "database.php";
        $pdo = Database::connect();
        $query = "select * from usuarios";
        $result = $pdo->query($query);
        Database::disconnect();
        return $result;
    }


    function createUsuario() {
        try {
            include "database.php";
            $pdo = Database::connect();
            $query = "insert into usuarios set idUsuario = ?, cedula = ?, nombre = ?, licencia = ?, telefono = ?, direccion = ?, tipo = ?, horasAcumuladas = ?";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->idUsuario);
            $stmt->bindParam(2, $this->cedula);
            $stmt->bindParam(3, $this->nombre);
            $stmt->bindParam(4, $this->licencia);
            $stmt->bindParam(5, $this->telefono);
            $stmt->bindParam(6, $this->direccion);
            $stmt->bindParam(7, $this->tipo);
            $stmt->bindParam(8, $this->horasAcumuladas);
            
            if ($stmt->execute()) {
                return "exito";
            } else {
                return "error";
            }
            
            Database::disconnect();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    function updateUsuario($id) {
       try {
            include "database.php";
            $pdo = Database::connect();
            $query1 = "select * from usuarios where idUsuario =".$id;
            $result = $pdo->query($query1);
            
            foreach ($result as $row) {
                $consultarRentas = "select * from rentas where rentas.idUsuario =".$row["idUsuario"];
                $result2 = $pdo->query($consultarRentas);
                if ($result2->rowCount() == 0) {
                    $query2 = "update usuarios set idUsuario = ?, cedula = ?, nombre = ?, licencia = ?, telefono = ?, direccion = ?, tipo = ?, horasAcumuladas = ? where idUsuario =".$row["idUsuario"];
                    $stmt = $pdo->prepare($query2);
                    $stmt->bindParam(1, $row["idUsuario"]);
                    $stmt->bindParam(2, $row["cedula"]);
                    $stmt->bindParam(3, $this->nombre);
                    $stmt->bindParam(4, $this->licencia);
                    $stmt->bindParam(5, $this->telefono);
                    $stmt->bindParam(6, $this->direccion);
                    $stmt->bindParam(7, $this->tipo);
                    $stmt->bindParam(8, $this->horasAcumuladas);
                    if ($stmt->execute()) {
                        Database::disconnect();
                        return "exito";
                    } else {
                        Database::disconnect();
                        return "error";
                    }
                } else {
                    Database::disconnect();
                    return "error";
                }
            }
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    function deleteUsuario($id) {
        try {
            include "database.php";
            $pdo = Database::connect();
            $query1 = "select * from usuarios where idUsuario =".$id;
            $result = $pdo->query($query1);
            
            foreach ($result as $row) {
                $consultarRentas = "select * from rentas where rentas.idUsuario =".$row["idUsuario"];
                $result2 = $pdo->query($consultarRentas);
                if ($result2->rowCount() == 0) {
                    $query2 = "delete from usuarios where idUsuario =".$row["idUsuario"];
                    $stmt = $pdo->prepare($query2);
                    if ($stmt->execute()) {
                        Database::disconnect();
                        return "exito";
                    } else {
                        Database::disconnect();
                        return "error";
                    }
                } else {
                    Database::disconnect();
                    return "error";
                }
            }
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}

?>
