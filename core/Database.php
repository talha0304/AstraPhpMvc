<?php

namespace app\core;



/**
 * Class Database
 * 
 *  @author Talha Saleem
 *  @package app\core
 */


class Database
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applymigrations()
    {
        $this->creatMigrationsTable();
        $appliedMigrations = $this->getApplyMigrations();
        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR . '/migrations');

        $toApplyMigrations = array_diff($files, $appliedMigrations);

        foreach ($toApplyMigrations as $migrations) {
            if ($migrations === '.' || $migrations === '..') {
                continue;
            }

            require_once Application::$ROOT_DIR . '/migrations/' . $migrations;

            $className = 'app\\migrations\\' . pathinfo($migrations, PATHINFO_FILENAME);
            $instance = new $className;
            $this->log("Appling migartion $migrations");
            $instance->up();
            $this->log("Applied migartion $migrations");
            $newMigrations[] = $migrations;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All migrations are applied");
        }
    }



    public function creatMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        migration VARCHAR(225),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB ;");
    }


    public function getApplyMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {
        $str = implode(",", array_map(fn ($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES  $str");
        $statement->execute();
    }

    public function prepare($sql){
        return $this->pdo->prepare($sql);
    }    

    protected function log($msg)
    {
        echo '[' . date('Y-m-d H:i:s') . '] -' . $msg . PHP_EOL;
    }

    public function delete($tableName, $condition, $params = [])
    {
        $sql = "DELETE FROM $tableName WHERE $condition";
        $statement = $this->prepare($sql);
        foreach ($params as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        return $statement->execute();
    }
}

