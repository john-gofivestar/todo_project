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
    ],
    "$_POST": [
      {
        "type": "number",
        "options": {
          "rules": {
            "core:required": {}
          }
        },
        "name": "id"
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
                "value": "{{$_POST.id}}",
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
                  "value": "{{$_POST.id}}",
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
                "value": "{{1 ^ query.state}}"
              }
            ],
            "table": "todo",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.id}}",
                  "data": {
                    "column": "id"
                  },
                  "operation": "="
                }
              ]
            },
            "returning": "id",
            "query": "update `todo` set `state` = ? where `id` = ?",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{1 ^ query.state}}",
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