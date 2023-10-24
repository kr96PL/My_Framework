<?php  

declare(strict_types = 1);

namespace Framework\Core;

use Exception;
use PDO;

abstract class Model 
{
    private PDO $db;
    protected string $table_name;
    protected array $columns;

    public function __construct()
    {
        $this->table_name = $this->extractClassName();
        $this->db = Db::getInstance();
    }

    public function all(): array
    {
        $stmt = $this->db->query('SELECT * FROM ' . $this->table_name);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $passed_values): void
    {   
        if (!$this->checkValuesAreAllowed($passed_values)) {
            throw new Exception('Some of passed columns are not allowed.');
        }

        $columns = implode(', ', array_keys($passed_values));
        $values = $this->extractValuesToInsert($passed_values);
        $query = 'INSERT INTO ' . $this->extractClassName() . ' (' . $columns . ') VALUES (' . $values . ')';

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($passed_values);
        } catch (Exception $e) {
            throw new Exception('Something goes wrong, try again later.');
        }
    }

    private function extractClassName(): string
    {
        $className = get_class($this);
        $pos = strrpos($className, "\\");
        return strtolower(substr($className, $pos + 1, strlen($className))) . 's';
    }

    private function checkValuesAreAllowed(array $values): bool
    {
        foreach ($values as $key => $value) 
        {
            if (!in_array($key, $this->columns)) {
                return false;
            }
        }
        return true;
    }

    private function extractValuesToInsert($values): string
    {
        $result = '';
        foreach ($values as $key => $value) 
        {
            $result .= ":$key,";
        }
        return substr($result, 0, strlen($result) - 1);
    }
}