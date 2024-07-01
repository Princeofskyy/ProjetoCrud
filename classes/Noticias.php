<?php

class Noticias
{
    private $db;
    private $table_name = "noticias";

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function ler($search = '', $order_by = '')
    {
        $query = "SELECT * FROM noticias";
        $conditions = [];
        $params = [];
        if ($search) {
            $conditions[] = "(titulo LIKE :search OR noticia LIKE :search)";
            $params[':search'] = '%' . $search . '%';
        }
        if ($order_by === 'data') {
            $query .= " ORDER BY data DESC";
        } elseif ($order_by === 'titulo') {
            $query .= " ORDER BY titulo";
        }
        if (count($conditions) > 0) {
            $query .= " WHERE " . implode(' AND ', $conditions);
        }
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);

        return $stmt;
    }

    public function inserir($idusu, $data, $titulo, $noticia)
    {
        $query = "INSERT INTO " . $this->table_name . " (idusu, data, titulo, noticia) VALUES (?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$idusu, $data, $titulo, $noticia]);
        return $stmt;
    }

    public function lerPorId($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idnot = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $titulo, $noticia)
    {
        $query = "UPDATE " . $this->table_name . " SET titulo = ?, noticia = ? WHERE idnot = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$titulo, $noticia, $id]);
        return $stmt;
    }

    public function deletar($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE idnot = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt;
    }
}
