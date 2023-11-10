<!DOCTYPE html>
<html>
<head>
    
    <title>Gym Coursework</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="stylesheet.css">
    
</head>
<body>
<div class="header">
    
<ul class="nav nav-pills">
  <li class="active"><a data-toggle="pill" href="#profile">Profile</a></li>
  <li><a data-toggle="pill" href="#workout">Workout</a></li>
  <li><a data-toggle="pill" href="#history">History</a></li>
</ul>

<div class="tab-content">
  <div id="profile" class="tab-pane fade in active">
    <h3>profile</h3>
    <p>Some content.</p>
    <a href="login.php"><button type="button" class="btn btn-primary btn-lg">login</button></a>
    <a href="logout.php"><button type="button" class="btn btn-primary btn-lg">logout</button></a>
  </div>
  <div id="workout" class="tab-pane fade">
    <h3>workout</h3>
    <p>Some content in menu 1.</p>
    <a href=""><button type="button" class="btn btn-primary btn-lg">start workout</button></a>
    <a href="createworkout.php"><button type="button" class="btn btn-primary btn-lg">create workout</button></a>
    <a href="editworkout.php"><button type="button" class="btn btn-primary btn-lg">edit workout</button></a>
  </div>
  <div id="history" class="tab-pane fade">
    <h3>history</h3>
    <p>Some content in menu 2.</p>
  </div>
</div>
</div>
</body>
</html>