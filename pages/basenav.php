<?php
function declarenavbase() {
 
 $nav = '
<body>

    <div class="brand">Dido System</div>
    <div class="address-bar">999 Campo Marzio | BELLINZONA, TI 6500, SWITZERLAND | Tél: +41 (0)78 848-92-94 | Fax: (887) 123-4567</div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="https://controllo.autocontrollo.ch">Dido system</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="https://autocontrollo.ch/">Main site</a>
                    </li>
                    <li>
                        <a href="https://controllo.autocontrollo.ch/">Login</a>
                    </li>
                    <li>
                        <a href="https://controllo.autocontrollo.ch/?p=signup">Signup</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
';
 echo $nav;
}
function declarenav($array) {
 $username = $_SESSION['username'];

 foreach ($array as list($name, $page)) {
  if($page != "none") {
   $navbar = "
$navbar
                    <li>
                        <a href=\"https://controllo.autocontrollo.ch/?p=$page\">$name</a>
                    </li>
";
  };
 };

 $nav = '
<body>
    <div class="brand">Dido System</div>
    <div class="address-bar">999 Campo Marzio | BELLINZONA, TI 6500, SWITZERLAND | Tél: +41 (0)78 848-92-94 | Fax: (887) 123-4567</div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="https://controllo.autocontrollo.ch">Dido system</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="https://autocontrollo.ch">Main site</a>
                    </li>

                    <li>
                        <a href="https://controllo.autocontrollo.ch/">Autocontrollo</a>
                    </li>
'."$navbar".'

                    <li>
                        <a href="https://controllo.autocontrollo.ch/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
 ';

 echo $nav;
}
?>
