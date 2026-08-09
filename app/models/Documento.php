<?php

class Documento extends Model
{
    protected static $table = 'documentos';
    protected static $primaryKey = 'id';

    
     //Crear registro de documentos para un jugador cuando se registra en el formulario
     
    public function crear(int $jugadorId): bool
    {
        $sql = "INSERT INTO documentos (jugador_id) VALUES (:jugador_id)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':jugador_id' => $jugadorId]);
    }

    
    // Obtener documentos de un jugador
     
    public function obtenerPorJugador(int $jugadorId): ?array
    {
        $sql = "SELECT * FROM documentos WHERE jugador_id = :jugador_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':jugador_id' => $jugadorId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    
     //Actualizar estado de un documento específico
     
    public function actualizarDocumento(int $jugadorId, string $campo, int $valor): bool
    {
        $camposPermitidos = ['doc_identidad', 'consentimiento', 'ficha_idrd', 'cert_eps'];

        if (!in_array($campo, $camposPermitidos)) {
            return false;
        }

        $sql = "UPDATE documentos SET $campo = :valor WHERE jugador_id = :jugador_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':jugador_id' => $jugadorId,
            ':valor' => $valor
        ]);
    }

    
     //Actualizar múltiples documentos de un jugador
     
    public function actualizarMultiples(int $jugadorId, array $datos): bool
    {
        $camposPermitidos = ['doc_identidad', 'consentimiento', 'ficha_idrd', 'cert_eps'];
        $updates = [];
        $params = [':jugador_id' => $jugadorId];

        foreach ($datos as $campo => $valor) {
            if (in_array($campo, $camposPermitidos)) {
                $updates[] = "$campo = :$campo";
                $params[":$campo"] = (int)$valor;
            }
        }

        if (empty($updates)) {
            return false;
        }

        $sql = "UPDATE documentos SET " . implode(', ', $updates) . " WHERE jugador_id = :jugador_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    
    //Verificar si todos los documentos están entregados
     
    public function documentosCompletos(int $jugadorId): bool
    {
        $documentos = $this->obtenerPorJugador($jugadorId);

        if (!$documentos) {
            return false;
        }

        return $documentos['doc_identidad'] == 1 &&
               $documentos['consentimiento'] == 1 &&
               $documentos['ficha_idrd'] == 1 &&
               $documentos['cert_eps'] == 1;
    }

    
     //Obtener resumen de documentos de un jugador
     
    public function getResumen(int $jugadorId): array
    {
        $documentos = $this->obtenerPorJugador($jugadorId);

        if (!$documentos) {
            return [
                'doc_identidad' => 0,
                'consentimiento' => 0,
                'ficha_idrd' => 0,
                'cert_eps' => 0,
                'total' => 0,
                'entregados' => 0,
                'completos' => false
            ];
        }

        $entregados = 0;
        $total = 4;

        if ($documentos['doc_identidad'] == 1) $entregados++;
        if ($documentos['consentimiento'] == 1) $entregados++;
        if ($documentos['ficha_idrd'] == 1) $entregados++;
        if ($documentos['cert_eps'] == 1) $entregados++;

        return [
            'doc_identidad' => (int)$documentos['doc_identidad'],
            'consentimiento' => (int)$documentos['consentimiento'],
            'ficha_idrd' => (int)$documentos['ficha_idrd'],
            'cert_eps' => (int)$documentos['cert_eps'],
            'total' => $total,
            'entregados' => $entregados,
            'completos' => $entregados === $total
        ];
    }

    
    //Obtener jugadores con documentos incompletos
     
    public function obtenerIncompletos(): array
    {
        $sql = "SELECT j.id, j.nombre, j.apellido, j.documento,
                       d.doc_identidad, d.consentimiento, d.ficha_idrd, d.cert_eps
                FROM jugadores j
                INNER JOIN documentos d ON j.id = d.jugador_id
                WHERE j.estado = 'activo'
                AND (d.doc_identidad = 0 
                     OR d.consentimiento = 0 
                     OR d.ficha_idrd = 0 
                     OR d.cert_eps = 0)
                ORDER BY j.apellido ASC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}