<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
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
      "name": "delete",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "db",
        "sql": {
          "type": "delete",
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
          "query": "delete from `todo` where `id` = ?",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
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