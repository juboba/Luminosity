define({ "api": [
  {
    "group": "Auth",
    "name": "AuthorizeUser",
    "type": "get",
    "url": "/authorizeUser",
    "title": "Authorize user with token.",
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
    "sampleRequest": [
      {
        "url": "http://localhost:80/api/v0_01/authorizeUser"
      }
    ],
    "version": "0.1.0",
    "filename": "app/Http/Controllers/AuthController.php",
    "groupTitle": "Auth"
  },
  {
    "group": "Auth",
    "name": "CheckAuthorization",
    "type": "get",
    "url": "/checkAuthorization",
    "title": "Check if request is authorizabled.",
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
    "sampleRequest": [
      {
        "url": "http://localhost:80/api/v0_01/checkAuthorization"
      }
    ],
    "version": "0.1.0",
    "filename": "app/Http/Controllers/AuthController.php",
    "groupTitle": "Auth"
  },
  {
    "group": "Auth",
    "name": "ExistToken",
    "type": "get",
    "url": "/existToken",
    "title": "Check if token exist in cache.",
    "sampleRequest": [
      {
        "url": "http://localhost:80/api/v0_01/existToken"
      }
    ],
    "version": "0.1.0",
    "filename": "app/Http/Controllers/AuthController.php",
    "groupTitle": "Auth"
  },
  {
    "group": "Task",
    "name": "DeleteTask",
    "type": "delete",
    "url": "/tasks/:id",
    "title": "Delete a task.",
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
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>Whether the task was deleted or not.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost:80/api/v0_01/tasks/1"
      }
    ],
    "version": "0.1.0",
    "filename": "app/Http/Controllers/TaskController.php",
    "groupTitle": "Task"
  },
  {
    "group": "Task",
    "name": "GetTask",
    "type": "get",
    "url": "/tasks/:id",
    "title": "Get a task.",
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
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost:80/api/v0_01/tasks/1"
      }
    ],
    "version": "0.1.0",
    "filename": "app/Http/Controllers/TaskController.php",
    "groupTitle": "Task"
  },
  {
    "group": "Task",
    "name": "GetTasks",
    "type": "get",
    "url": "/tasks",
    "title": "Get all tasks.",
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
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost:80/api/v0_01/tasks"
      }
    ],
    "version": "0.1.0",
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
      }
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
      }
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
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost:80/api/v0_01/tasks"
      }
    ],
    "version": "0.1.0",
    "filename": "app/Http/Controllers/TaskController.php",
    "groupTitle": "Task"
  },
  {
    "group": "Task",
    "name": "PutTask",
    "type": "put",
    "url": "/tasks/:id",
    "title": "Update a task.",
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
      }
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
      }
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
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost:80/api/v0_01/tasks/1"
      }
    ],
    "version": "0.1.0",
    "filename": "app/Http/Controllers/TaskController.php",
    "groupTitle": "Task"
  },
  {
    "group": "Task",
    "name": "TasksOptions",
    "type": "options",
    "url": "/tasks",
    "title": "Get allowed methods.",
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
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost:80/api/v0_01/tasks"
      }
    ],
    "version": "0.1.0",
    "filename": "app/Http/Controllers/TaskController.php",
    "groupTitle": "Task"
  }
] });
