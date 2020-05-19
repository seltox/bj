
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Beejee</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/pricing/">

    <!-- Bootstrap core CSS -->
    <link href="/assets/tb/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/tb/css/bootstrap-theme.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="/assets/tb/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Beejee</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/tasks/index">Список задач</a></li>
                <? if(\application\components\Auth::getInstance()->isAdmin()): ?>
                    <li><a href="/admins/logout">Выйти</a></li>
                <? else: ?>
                    <li><a href="/admins/login">Войти как администратор</a></li>
                <? endif; ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>


<div class="container" style="margin-top: 80px;">
    <? if($message = \application\components\Helpers::getFlashMessage()): ?>
    <div class="alert alert-success" role="alert">
        <?=$message?>
    </div>
    <? endif; ?>
    <?=$content?>
</div>


</body>
</html>
