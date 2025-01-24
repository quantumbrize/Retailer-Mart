<?php

namespace App\Models;

use CodeIgniter\Model;

class CommonModel extends Model
{
    /**
     * Execute a custom SQL query.
     *
     * @param string $sql The SQL query to execute.
     * @return array|null The result of the query.
     */
    public function customQuery(string $sql)
    {
        try {
            $query = $this->db->query($sql);

            // Check if the query is a SELECT statement
            if (stripos(trim($sql), 'SELECT') === 0) {
                return $query->getResult(); // Return results as an array for SELECT queries
            }

            // For other queries (UPDATE, DELETE, etc.), return affected rows
            return $this->db->affectedRows();
        } catch (\Exception $e) {
            // Log or handle the exception as needed
            log_message('error', 'CustomQuery Error: ' . $e->getMessage());
            return false; // Return false on failure
        }
    }
}