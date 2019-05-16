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

    public function getAllContent()
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

    public function create($title)
    {
        $this->db->connect();
        $sql = "INSERT INTO $this->table (title) VALUES (?);";
        $this->db->execute($sql, [$title]);
        $id = $this->db->lastInsertId();
        return $id;
    }

    /**
     * Gets all post from the table.
     *
     * @return array
     * @param $id Content id
     */

    public function getContent($id)
    {
        $this->db->connect();
        $sql = "SELECT * FROM $this->table WHERE id = ?;";
        $content = $this->db->executeFetch($sql, [$id]);
        return $content;
    }

    /**
     * Gets all post from the table.
     *
     * @param $params Content information to update
     */
    public function updateContent($params)
    {
        $this->db->connect();
        $sql = "UPDATE $this->table SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
        $content = $this->db->execute($sql, $params);
    }

    /**
     * Gets all post from the table.
     *
     * @param $params Content information to update
     */
    public function deleteContent($id)
    {
        $this->db->connect();
        $sql = "UPDATE $this->table SET deleted=NOW() WHERE id = ?;";
        $content = $this->db->execute($sql, $id);
    }
}
