<?php

namespace Connection;

class Database {
    private string $hostname;
    private int $port;
    private string $user;
    private string $pass;

    function __construct(string $hostname, int $port, string $user, string $password) {
        $this->user = $hostname;
        $this->port = $port;
        $this->user = $user;
        $this->pass = $password;
    }

    public function connect() : bool {return true;}
    public function delete(string $query, array $params, string $paramTypes): int {return 0;}
    public function insert(string $query, array $params, string $paramTypes): int {return 0;}
    public function select(string $query, array $params, string $paramTypes): array {return [];}
    public function update(string $query, array $params, string $paramTypes): int {return 0;}

    public static function questionMarks(int $count, int $sets = 1) : string {
        return substr(str_repeat(",(".substr(str_repeat(",?", $count), 1).")", $sets), 1);
    }
}