<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "array",
        "multiple": true,
        "options": {
          "rules": {}
        },
        "name": "ids"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "repeat",
      "module": "core",
      "action": "repeat",
      "options": {
        "repeat": "{{$_GET.ids}}",
        "outputFields": [],
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
                      "operator": "equal",
                      "value": "{{$value}}",
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
                "query": "delete from `todo` where `id` = ?",
                "params": [
                  {
                    "operator": "equal",
                    "type": "expression",
                    "name": ":P1",
                    "value": "{{$value}}",
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
      },
      "output": true,
      "meta": [
        {
          "name": "$index",
          "type": "number"
        },
        {
          "name": "$number",
          "type": "number"
        },
        {
          "name": "$name",
          "type": "text"
        },
        {
          "name": "$value",
          "type": "object"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>