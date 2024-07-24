<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "array",
        "name": "ids"
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
                "field": "id",
                "type": "double",
                "operator": "in",
                "value": "{{$_GET.ids}}",
                "data": {
                  "column": "id"
                },
                "operation": "IN"
              }
            ],
            "conditional": null,
            "valid": true
          },
          "returning": "id",
          "query": "delete from `todo` where `id` in ?",
          "params": []
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