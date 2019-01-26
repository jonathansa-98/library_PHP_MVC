<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Library</title>
        <!-- Bootswatch styles: 
        default cerulean cosmo cyborg darkly flatly journal litera lumen lux materia 
        minty pulse sandstone simplex sketchy slate solar spacelab superhero united yeti-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.3/flatly/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/css/style.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
        $( function() {
          $( "#datepicker" ).datepicker({ minDate: 0, maxDate: "+6M" });
        } );
        </script>
    </head>
    <body>
        <header>
            <a href="<?=BASE_URL?>" class="logo"><img src="<?=BASE_URL?>assets/img/logo.png"></a>
            <nav>
                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="<?=BASE_URL?>book/seeAll" class="btn btn-primary" role="button" aria-pressed="true">Books</a></li>
                    <li class="nav-item"><a href="<?=BASE_URL?>user/edit" class="btn btn-primary" role="button" aria-pressed="true">Profile</a></li>
                    <?php if(isset($_SESSION['librarian'])): ?>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                              <a class="dropdown-item" href="<?=BASE_URL?>category/manage" type="button">Manage categories</a>
                              <a class="dropdown-item" href="<?=BASE_URL?>author/manage" type="button">Manage authors</a>
                              <a class="dropdown-item" href="<?=BASE_URL?>user/manage" type="button">Manage users</a>
                              <a class="dropdown-item" href="<?=BASE_URL?>book/manage" type="button">Manage books</a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="search_bar ml-4 mr-4">
                        <form class="form-inline">
                            <input class="form-control mr-1" type="text" placeholder="Search books">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </form>
                    </div>
                    <div class="login">
                    <?php if(!isset($_SESSION['userIdentity'])): ?>
                        <li class="nav-item"><a href="<?=BASE_URL?>user/login" class="btn btn-success mb-1" role="button" aria-pressed="true">Login</a></li>
                        <li class="nav-item"><a href="<?=BASE_URL?>user/register" class="btn btn-success" role="button" aria-pressed="true">Register</a></li>
                    <?php else: ?>
                        <p><?=$_SESSION['userIdentity']->getLogin();?></p>
                        <li class="nav-item"><a href="<?=BASE_URL?>user/logout" class="btn btn-danger " role="button" aria-pressed="true">Logout</a></li>
                    <?php endif; ?>
                    </div>
                </ul>
            </nav>
        </header>
        <div id="main-container">