define({ "api": [
  {
    "group": "Task",
    "name": "GetTask",
    "type": "get",
    "url": "/tasks/:id",
    "title": "Get a task.",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "authorization",
            "description": "<p>Authorization value.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -i -H \"Authorization:Bearer <token>\" http://localhost:80/api/v0_01/tasks/1",
        "type": "curl"
      }
    ],
    "version": "0.0.0",
    "filename": "app/Http/Controllers/TaskController.php",
    "groupTitle": "Task"
  },
  {
    "group": "Task",
    "name": "GetTasks",
    "type": "get",
    "url": "/tasks",
    "title": "Get all tasks.",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "authorization",
            "description": "<p>Authorization value.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -i -H \"Authorization:Bearer <token>\" http://localhost:80/api/v0_01/tasks",
        "type": "curl"
      }
    ],
    "version": "0.0.0",
    "filename": "app/Http/Controllers/TaskController.php",
    "groupTitle": "Task"
  },
  {
    "group": "Task",
    "name": "PostTask",
    "type": "post",
    "url": "/tasks",
    "title": "Create a task.",
    "permission": [
      {
        "name": "login"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "authorization",
            "description": "<p>Authorization value.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Accept-Encoding\": \"Authorization:Bearer <token>\",\n  \"Content-Type:application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Mandatory task name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Mandatory task description.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "language_id",
            "description": "<p>Mandatory language ID.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"name\":\"Task name\", \"description\":\"Task description\", \"language_id\":\"1\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Task name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Task description.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "language_id",
            "description": "<p>Language ID.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"name\":\"Task name\", \"description\":\"Task description\", \"language_id\":\"1\"}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "http://localhost:80"
      }
    ],
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -i -X POST -H \"Authorization:Bearer <token>,Content-Type:application/json\" http://localhost:80/api/v0_01/tasks -d '{\"name\":\"Task name\", \"description\":\"Task description\", \"language_id\":\"1\"}'",
        "type": "curl"
      }
    ],
    "version": "0.0.0",
    "filename": "app/Http/Controllers/TaskController.php",
    "groupTitle": "Task"
  }
] });
