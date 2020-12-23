<?php
    switch($_SESSION['role']){
        case 'USER':
          $role = 'User';
          break;
        case 'CINEMAOWNER':
          $role = 'Cinema Owner';
          break;
        case 'ADMIN':
          $role = 'Admin';
          break;
        default:
          $role = $_SESSION['role'];
          break;
    }
?>
<nav class="navbar navbar-expand-lg navbar-dark indigo py-4">
    <a class="navbar-brand" href="./welcome.php"><b>Cine</b>film</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?=($_SERVER['PHP_SELF']=='/welcome.php')? "active":""?>">
                <a class="nav-link" href="./welcome.php">Home</a>
            </li>
            <li class="nav-item <?=($_SERVER['PHP_SELF']=='/movies.php')? "active":""?>">
                <a class="nav-link" href="./movies.php">Movies</a>
            </li>
            <li class="nav-item <?=($_SERVER['PHP_SELF']=='/owner.php')? "active":""?>">
                <a class="nav-link" href="./owner.php">Cinemas</a>
            </li>
            <!-- <li class="nav-item <?=($_SERVER['PHP_SELF']=='/admin.php')? "active":""?>">
                <a class="nav-link" href="./admin.php">Admninistration</a>
            </li> -->
        </ul>
        <div class="nav-item white-text dropdown" style="float: right !important;">
            <a class="nav-link user dropdown-toggle" target="#" id="navbarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?=$_SESSION['username']." (".$role.")"?>
            </a>
            <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdown" >
                <a class="dropdown-item" href="php/logoutAction.php">Logout</a>
            </div>
        </div>
    </div>
</nav>
