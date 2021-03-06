define({ "api": [
  {
    "group": "Auth",
    "name": "AuthorizeUser",
    "type": "get",
    "url": "/login",
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
        "url": "http://localhost:80/api/v0_01/login"
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
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "Language",
            "description": "<p>Add the language object to the response (Opcional).</p>"
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
    "type": "post",
    "url": "/tasks/{uid}/{tid}",
    "title": "Update an specific task.",
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
        "url": "http://localhost:80/api/v0_01/tasks/1/1"
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
  },
  {
    "group": "User",
    "name": "CreateUser",
    "type": "post",
    "url": "/users",
    "title": "Create an User.",
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
            "description": "<p>User name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>Nick name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "surname",
            "description": "<p>User surname.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User mail.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>User Address.</p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "enabled",
            "description": "<p>User status.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "birthday",
            "description": "<p>user Birthday.</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "language_id",
            "description": "<p>Language Id.</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "country_id",
            "description": "<p>Country Id.</p>"
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
            "description": "<p>User name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>Nick name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "surname",
            "description": "<p>User surname.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User mail.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>User Address.</p>"
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "enabled",
            "description": "<p>User status.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "birthday",
            "description": "<p>user Birthday.</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "language_id",
            "description": "<p>Language Id.</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "country_id",
            "description": "<p>Country Id.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -i -H \"Authorization:Bearer <token>\" http://localhost:80/api/register",
        "type": "curl"
      }
    ],
    "sampleRequest": [
      {
        "url": "http://localhost:80/api/register"
      }
    ],
    "version": "0.1.0",
    "filename": "app/Http/Controllers/UserController.php",
    "groupTitle": "User"
  },
  {
    "group": "User",
    "name": "Disable_an_user",
    "type": "post",
    "url": "/users/{id}/disable",
    "title": "Disable an User.",
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
            "type": "Number",
            "optional": false,
            "field": "Id",
            "description": "<p>User Id.</p>"
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
            "description": "<p>User name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>Nick name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "surname",
            "description": "<p>User surname.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User mail.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>User Address.</p>"
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "enabled",
            "description": "<p>User status.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "birthday",
            "description": "<p>user Birthday.</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "language_id",
            "description": "<p>Language Id.</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "country_id",
            "description": "<p>Country Id.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -i -H \"Authorization:Bearer <token>\" http://localhost:80/api/v0_01/users/1/disable",
        "type": "curl"
      }
    ],
    "sampleRequest": [
      {
        "url": "http://localhost:80/api/v0_01/users/1/disable"
      }
    ],
    "version": "0.1.0",
    "filename": "app/Http/Controllers/UserController.php",
    "groupTitle": "User"
  },
  {
    "group": "User",
    "name": "Enable_an_user",
    "type": "post",
    "url": "/users/{id}/enable",
    "title": "Enable an User.",
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
            "type": "Number",
            "optional": false,
            "field": "Id",
            "description": "<p>User Id.</p>"
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
            "description": "<p>User name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>Nick name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "surname",
            "description": "<p>User surname.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User mail.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>User Address.</p>"
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "enabled",
            "description": "<p>User status.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "birthday",
            "description": "<p>user Birthday.</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "language_id",
            "description": "<p>Language Id.</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "country_id",
            "description": "<p>Country Id.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -i -H \"Authorization:Bearer <token>\" http://localhost:80/api/v0_01/users/1/enable",
        "type": "curl"
      }
    ],
    "sampleRequest": [
      {
        "url": "http://localhost:80/api/v0_01/users/1/enable"
      }
    ],
    "version": "0.1.0",
    "filename": "app/Http/Controllers/UserController.php",
    "groupTitle": "User"
  },
  {
    "group": "User",
    "name": "GetUser",
    "type": "get",
    "url": "/users/{id}{?tasks=true}",
    "title": "Get user by id.",
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
            "type": "Number",
            "optional": false,
            "field": "Id",
            "description": "<p>User Id (Mandatory).</p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "Tasks",
            "description": "<p>Add the tasks to the response (Optional).</p>"
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
            "description": "<p>User name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>Nick name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "surname",
            "description": "<p>User surname.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User mail.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>User Address.</p>"
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "enabled",
            "description": "<p>User status.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "birthday",
            "description": "<p>user Birthday.</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "language_id",
            "description": "<p>Language Id.</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "country_id",
            "description": "<p>Country Id.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -i -H \"Authorization:Bearer <token>\" http://localhost:80/api/v0_01/users/1?tasks=true",
        "type": "curl"
      }
    ],
    "sampleRequest": [
      {
        "url": "http://localhost:80/api/v0_01/users/1"
      }
    ],
    "version": "0.1.0",
    "filename": "app/Http/Controllers/UserController.php",
    "groupTitle": "User"
  },
  {
    "group": "User",
    "name": "GetUsers",
    "type": "get",
    "url": "/users",
    "title": "Get all users.",
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
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -i -H \"Authorization:Bearer <token>\" http://localhost:80/api/v0_01/users",
        "type": "curl"
      }
    ],
    "sampleRequest": [
      {
        "url": "http://localhost:80/api/v0_01/users"
      }
    ],
    "version": "0.1.0",
    "filename": "app/Http/Controllers/UserController.php",
    "groupTitle": "User"
  },
  {
    "group": "User",
    "name": "Get_allowed_methods",
    "type": "get",
    "url": "/users/options",
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
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "Id",
            "description": "<p>User Id.</p>"
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
            "description": "<p>User name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>Nick name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "surname",
            "description": "<p>User surname.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User mail.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>User Address.</p>"
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "enabled",
            "description": "<p>User status.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "birthday",
            "description": "<p>user Birthday.</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "language_id",
            "description": "<p>Language Id.</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "country_id",
            "description": "<p>Country Id.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -i -H \"Authorization:Bearer <token>\" http://localhost:80/api/v0_01/users/options",
        "type": "curl"
      }
    ],
    "sampleRequest": [
      {
        "url": "http://localhost:80/api/v0_01/users/options"
      }
    ],
    "version": "0.1.0",
    "filename": "app/Http/Controllers/UserController.php",
    "groupTitle": "User"
  },
  {
    "group": "User",
    "name": "UpdateUser",
    "type": "put",
    "url": "/users/{uid}",
    "title": "Update specified User.",
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
            "description": "<p>User's name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "surname",
            "description": "<p>User's surname.</p>"
          },
          {
            "group": "Parameter",
            "type": "Email",
            "optional": false,
            "field": "email",
            "description": "<p>User's email (Mandatory).</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "direction",
            "description": "<p>User's address.</p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "enabled",
            "description": "<p>User's status.</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "optional": false,
            "field": "birthday",
            "description": "<p>User's date of birth.</p>"
          },
          {
            "group": "Parameter",
            "type": "language_id",
            "optional": false,
            "field": "language_id",
            "description": "<p>User's language (Mandatory).</p>"
          },
          {
            "group": "Parameter",
            "type": "country_id",
            "optional": false,
            "field": "country_id",
            "description": "<p>User's country (Mandatory).</p>"
          },
          {
            "group": "Parameter",
            "type": "username",
            "optional": false,
            "field": "username",
            "description": "<p>User's username.</p>"
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
            "description": "<p>User name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>Nick name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "surname",
            "description": "<p>User surname.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User mail.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>User Address.</p>"
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "enabled",
            "description": "<p>User status.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "birthday",
            "description": "<p>user Birthday.</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "language_id",
            "description": "<p>Language Id.</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "country_id",
            "description": "<p>Country Id.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -i -H \"Authorization:Bearer <token>\" http://localhost:80/api/v0_01/users/1",
        "type": "curl"
      }
    ],
    "sampleRequest": [
      {
        "url": "http://localhost:80/api/v0_01/users/1"
      }
    ],
    "version": "0.1.0",
    "filename": "app/Http/Controllers/UserController.php",
    "groupTitle": "User"
  }
] });
