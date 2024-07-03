<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "db",
        "sql": {
          "type": "select",
          "columns": [
            {
              "table": "todo",
              "column": "id"
            },
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
            }
          ],
          "params": [],
          "table": {
            "name": "todo"
          },
          "primary": "id",
          "joins": [],
          "query": "select `id`, `state`, `item`, `description`, `due_date` from `todo` order by `state` DESC, `due_date` ASC",
          "sort": "",
          "dir": "",
          "orders": [
            {
              "table": "todo",
              "column": "state",
              "direction": "DESC"
            },
            {
              "table": "todo",
              "column": "due_date",
              "direction": "ASC"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "id"
        },
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
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>