    <!doctype html>
    <html ng-app="especial">
    <head>
        <meta charset="UTF-8">
        <title>Especial - Database</title>
    <!--    <link rel="stylesheet" href="css/index.css">-->
        <script src="scripts/angular-1.3.8.min.js"></script>
        <script src="scripts/angular-route.min.js"></script>
    <!--    <script src="scripts/angular-animate.js"></script>-->
    </head>

    <body>
    <div class="header">
        <img id="logo" src="images/especial-logo.jpg">
        <a id="logout" href="logout.php">Logout</a>
        <div class="menu"></div>
    </div>
    <div class="sub_menu"></div>

    <div class="main_area">
        <div id="main_area_holder" ng-view>
        </div>
    </div>
    <div class="footer"></div>
    <script src="app/app.js"></script>
    </body>
    </html>