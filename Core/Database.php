<?php


namespace Cakyuz\Core;


/**
 * Class Database
 * @package Cakyuz\Core
 */
class Database
{
    public \PDO $db;
    public static string $table = '';
    public array $where = [];
    protected string $sql = '';

    /**
     * Database constructor.
     */
    public function __construct()
    {
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', getenv('DB_HOSTNAME'), getenv('DB_DATABASENAME'), getenv('DB_CHARSET'));
        $this->db = new \PDO($dsn, getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
        // $this->db->exec('SET NAMES `UTF8`');
        $this->db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        $this->db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @param string $name
     * @return Database
     */
    public static function table(string $name): Database
    {
        self::$table = $name;
        return new self();
    }

    /**
     * @param string $column
     * @param $value
     * @param string $operation
     * @return $this
     */
    public function where(string $column, $value, $operation = '='): Database
    {
        $this->where[] = $column . ' ' . $operation . ' "' . $value . '"';
        return $this;
    }

    /**
     *
     */
    protected function prepareSql(): void
    {
        $this->sql = sprintf('SELECT * FROM %s', self::$table);
        if (count($this->where))
            $this->sql .= ' WHERE ' . implode(' AND ', $this->where);
    }

    /**
     * @return array
     */
    public function get(): array
    {
        $this->prepareSql();
        $query = $this->db->prepare($this->sql);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * @return object
     */
    public function first(): object
    {
        $this->prepareSql();
        $query = $this->db->prepare($this->sql);
        $query->execute();
        return $query->fetch(\PDO::FETCH_OBJ);
    }
}