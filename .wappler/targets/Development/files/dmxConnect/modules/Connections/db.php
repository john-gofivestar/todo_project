<?php
// Database Type : "SQlite"
// Database Adapter : "sqlite"
$exports = <<<'JSON'
{
    "name": "db",
    "module": "dbconnector",
    "action": "connect",
    "options": {
        "server": "sqlite",
        "connectionString": "sqlite:/db.sqlite3",
        "meta"  : {}
    }
}
JSON;
?>