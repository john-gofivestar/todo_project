<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
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
    ]
  },
  "exec": {
    "steps": {
      "name": "insert",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "db",
        "sql": {
          "type": "insert",
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
          "returning": "id",
          "query": "insert into `todo` (`description`, `due_date`, `item`, `state`) values (?, ?, ?, ?)",
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
            }
          ]
        }
      },
      "meta": [
        {
          "name": "identity",
          "type": "text"
        },
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