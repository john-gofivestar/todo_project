<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "options": {
          "rules": {}
        },
        "name": "id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "db",
        "sql": {
          "type": "select",
          "columns": [
            {
              "table": "todo",
              "column": "state"
            },
            {
              "table": "todo",
              "column": "item"
            },
            {
              "table": "todo",
              "column": "description"
            },
            {
              "table": "todo",
              "column": "due_date"
            },
            {
              "table": "todo",
              "column": "id"
            }
          ],
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.id}}",
              "test": ""
            }
          ],
          "table": {
            "name": "todo"
          },
          "primary": "id",
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "todo.id",
                "field": "todo.id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.id}}",
                "data": {
                  "table": "todo",
                  "column": "id",
                  "type": "number",
                  "columnObj": {
                    "type": "increments",
                    "primary": true,
                    "unique": false,
                    "nullable": false,
                    "name": "id"
                  }
                },
                "operation": "=",
                "table": "todo"
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "select `state`, `item`, `description`, `due_date`, `id` from `todo` where `todo`.`id` = ?",
          "orders": []
        }
      },
      "output": true,
      "meta": [
        {
          "type": "boolean",
          "name": "state"
        },
        {
          "type": "text",
          "name": "item"
        },
        {
          "type": "text",
          "name": "description"
        },
        {
          "type": "text",
          "name": "due_date"
        },
        {
          "type": "number",
          "name": "id"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>