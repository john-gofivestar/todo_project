<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "id"
      },
      {
        "type": "text",
        "options": {
          "rules": {}
        },
        "name": "state"
      }
    ]
  },
  "exec": {
    "steps": [
      {
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
              }
            ],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_POST.state}}",
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
                  "value": "{{$_POST.state}}",
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
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "select `state` from `todo` where `todo`.`id` = ?"
          }
        },
        "output": true,
        "meta": [
          {
            "type": "boolean",
            "name": "state"
          }
        ],
        "type": "dbconnector_single",
        "outputType": "object"
      },
      {
        "name": "update",
        "module": "dbupdater",
        "action": "update",
        "options": {
          "connection": "db",
          "sql": {
            "type": "update",
            "values": [
              {
                "table": "todo",
                "column": "state",
                "type": "boolean",
                "value": "{{$_POST.state}}"
              }
            ],
            "table": "todo",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "id",
                  "field": "id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.id}}",
                  "data": {
                    "column": "id"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "returning": "id",
            "query": "update `todo` set `state` = ? where `id` = ? returning `id`",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.state}}",
                "test": ""
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_POST.id}}",
                "test": ""
              }
            ]
          }
        },
        "meta": [
          {
            "name": "affected",
            "type": "number"
          }
        ]
      }
    ]
  }
}
JSON
);
?>