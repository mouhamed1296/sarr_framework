<?php

namespace App\Core\Database;

/**
 * [Description Query]
 */
final class Query extends Database
{
    private string $sql;

    /**
     * @param string $tableName
     * @param string $fieldToSelect
     * @return Query
     */
    public function select(string $tableName, string $fieldToSelect = "*"): Query
    {
        $this->sql = "SELECT " . $fieldToSelect . " FROM " . $tableName;
        return $this;
    }

    /**
     * @param string $tableName
     * @return Query
     */
    public function selectCount(string $tableName): Query
    {
        $this->sql = "SELECT COUNT(*) FROM " . $tableName;
        return $this;
    }

    /**
     * @param string $tableName
     * @return Query
     */
    public function delete(string $tableName): Query
    {
        $this->sql = "DELETE FROM " . $tableName;
        return $this;
    }

    /**
     * @param string $tableName
     * @return Query
     */
    public function update(string $tableName): Query
    {
        $this->sql = "UPDATE " . $tableName;
        return $this;
    }

    /**
     * @param string $strSet
     * @return Query
     */
    public function set(string $strSet): Query
    {
        $this->sql .= " SET " . $strSet;
        return $this;
    }

    /**
     * @param string $joinTable
     * @return Query
     */
    public function innerJoin(string $joinTable): Query
    {
        $this->sql .= " JOIN " . $joinTable;
        return $this;
    }

    /**
     * @param string $joinField
     * @return Query
     */
    public function on(string $joinField): Query
    {
        $this->sql .= " ON " . $joinField;
        return $this;
    }

    /**
     * @param string|array $condition
     * @return Query
     */
    public function where($condition): Query
    {
        $this->sql .= " WHERE " . $condition;
        return $this;
    }

    /**
     * @param string $condition
     * @return Query
     */
    public function and(string $condition): Query
    {
        $this->sql .= " AND " . $condition;
        return $this;
    }

    /**
     * @param string $condition
     * @return Query
     */
    public function or(string $conditions): Query
    {
        $this->sql .= " OR " . $conditions;
        return $this;
    }

    public function in(string $values): Query
    {
        $this->sql .= " IN ($values)";
        return $this;
    }

    /**
     * @param int $type
     * @return array|false
     */
    public function execute($type = 0)
    {
        $rows = false;
        switch ($type) :
            case 0:
                $results =  $this->pdo->query($this->sql);
                if ($results) :
                    $rows = [];
                    while ($row = $results->fetchAll()) :
                        $rows = $row;
                    endwhile;
                endif;
                $results->closeCursor();
                break;
            case 1:
                $results = $this->pdo->query($this->sql);
                $results->closeCursor();
                break;
            case 2:
                $results = $this->pdo->query($this->sql);
                $rows = $results->fetchColumn();
                break;
            default:
                return $rows;
        endswitch;
        return $rows;
    }
}
