<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title><?php echo $this->title ?></title>
    <?php
    if(!empty($this->css)) {
        for ($i=0;$i<count($this->css);$i++) {
            echo "<link rel=\"stylesheet\" href=\"/College-Managment-System/css/{$this->css[$i]}\">";
        }
    }
?>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/College-Managment-System"></a>
    </div>
<?php
  if($this->data['logged']) {
    require "components/loggednav.php";
  }
?>
  </div>
</nav>
    
