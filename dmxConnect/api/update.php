<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "boolean",
        "options": {
          "rules": {}
        },
        "name": "state"
      },
      {
        "type": "text",
        "options": {
          "rules": {
            "core:required": {}
          }
        },
        "name": "item"
      },
      {
        "type": "text",
        "options": {
          "rules": {}
        },
        "name": "description"
      },
      {
        "type": "text",
        "options": {
          "rules": {
            "core:required": {}
          }
        },
        "name": "due_date"
      },
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
    "steps": {
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
            },
            {
              "table": "todo",
              "column": "item",
              "type": "text",
              "value": "{{$_POST.item}}"
            },
            {
              "table": "todo",
              "column": "description",
              "type": "text",
              "value": "{{$_POST.description}}"
            },
            {
              "table": "todo",
              "column": "due_date",
              "type": "text",
              "value": "{{$_POST.due_date}}"
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
          "query": "update `todo` set `state` = ?, `item` = ?, `description` = ?, `due_date` = ? where `id` = ?",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.state}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.item}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.description}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.due_date}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P5",
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
  }
}
JSON
);
?>