<!DOCTYPE html>
    <head>
        <title>To-do app demo</title>
        <link  rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="resources/css/jquery.min.js"></script>
		    <link href="resources/css/bootstrap.mini.css" rel="stylesheet" type="text/css" />
		    <script src="resources/css/bootstrap.min.js"></script>
        <style>
          body{ 
            background: lightyellow;
          }
          .navbar-mystyle{ 
            background: yellow !important;
          }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-mystyle">
      <a class="navbar-brand" href="/">Todo App Demo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="/tasks">All Tasks</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/tasks/create">New Task</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/tasks/ready">Ready Tasks</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/tasks/todo">Todo Tasks</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
      @yield('content')
    </div>
    </body>
</html>
