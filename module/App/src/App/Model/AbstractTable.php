<?php

namespace App\Model;

use Zend\Db\Metadata\Metadata;

/**
 * Class AbstractTable
 */

class AbstractTable
{
    
    public function getColumns()
    {
        $metaData = new Metadata($this->TableGateway->getAdapter());

        return $metaData->getColumnNames($this->TableGateway->getTable());
    }

    /**
     * Method for formatting result set with more than one record to array object.
     * @param $resultSet
     * @return array
     */
    public function toArray($resultSet)
    {
        $results = array();
        foreach ($resultSet as $r)
        {
            $results[] = $r;
        }

        return $results;
    }

    /**
     * @param $row_fields
     * @param $rec_values
     */
    public function insertRows($row_fields, $rec_values)
    {
        if (sizeof($row_fields) > 0 && sizeof($rec_values) > 0) {

            $tmp_values = '';
            $str_row_fields = '';
            $str_row_values = '';
            $records = array();

            // convert array $row_fields to string row fields
            $str_row_fields = implode(", ", $row_fields);

            for ($i=0; $i < sizeof($row_fields); $i++) {
                $tmp_values .= ($tmp_values ? ", " : "") . "?";
            }

            foreach ($rec_values as $record) {
                $str_row_values .= ($str_row_values ? "," : ""). "({$tmp_values})";
                $records = array_merge($records, $record);
            }

            // construct insert query
            $query = "INSERT INTO {$this->TableGateway->getTable()} ({$str_row_fields}) VALUES {$str_row_values}";

            // prepare query
            $adapter = $this->TableGateway->getAdapter();

            $adapter->query($query, $records);
        }
    }

    /**
     * Method for insert records in the table.
     * @param $data
     */
    public function insert($data)
    {
        $this->TableGateway->insert($data);
        return $this->TableGateway->lastInsertValue;
    }

    /**
     * Method for updating data to a specific table.
     * @param $data
     * @param $where
     */
    public function update($data, $where)
    {
        $this->TableGateway->update($data, $where);
    }

    /**
     * Method for deleting data to a specific table.
     * @param $where
     */
    public function delete($where)
    {
        $this->TableGateway->delete($where);
    }
}