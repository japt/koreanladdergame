<?php require_once('../tracker01.php');

set_visit('Korean Ladder Game');
?>
<!DOCTYPE html>
<html>
<head>
<title>Korean Ladder Game | John Adrian P. Tan</title>
<link rel="stylesheet" href="assets/libraries/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="assets/css/style.css" />
<script type="text/javascript" src="http://devjohnph.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="http://devjohnph.com/jquery.validate.js"></script>
</head>
<body>
<div class="wrapper">
   <div class="container">
      <div class="header well">
         <h2>Korean Ladder Game</h2>
      </div>
      <div class="main well">
         <div class="user-input-container">
            <h3>Add Players : <button class="btn btn-info add-user-btn" style="margin-bottom:4px">Add User</button></h3>
            <form class="form-search add-user-form" name="add-user-form" action="play.php" method="post">
               <div class="user-input-container">
                  <div class="user-input-append">
                  </div>
                  <button class="btn btn-large btn-success">Play Now</button>
               </div>
            </form>    
         </div>
      </div>
    <div id="footer">
      <div class="container">
        <p class="muted credit">Korean Ladder Game <a href="http://devjohnph.com">John Adrian P. Tan</a>. 2012</p>
      </div>
    </div>
   </div>
</div>
<script type="text/javascript" src="assets/js/setup.js"></script>
</body>
</html>