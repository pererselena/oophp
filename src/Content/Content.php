<?php
/**
 * Dice game.
 */

namespace Elpr\Content;

/**
 * Showing off a standard class with methods and properties.
 */
class Content
{
    /**
     * @var string  $table   The table to work on.
     * @var object  $db   The database object.
     */

    private $table;
    private $db;


    /**
     * Constructor to initiate the object with current game settings,
     * if available.
     *
     * @param string $table The table to work on with default.
     * @var object  $db   The database object.
     *
     */

    public function __construct(object $db, string $table = "kmom06_content")
    {
        $this->table = $table;
        $this->db = $db;
    }

    /**
     * Gets all post from the table.
     *
     * @return int
     */

    public function getAllPost()
    {
        $this->db->connect();
        $sql = "SELECT * FROM $this->table;";
        $resultset = $this->db->executeFetchAll($sql);
        return $resultset;
    }
    /**
     * Gets all post from the table.
     *
     * @return int
     */

    public function create()
    {
        $this->db->connect();
        $sql = "INSERT INTO content (title) VALUES (?);";
        $db->execute($sql, [$title]);
        $id = $db->lastInsertId();
        return $id;
    }
}
