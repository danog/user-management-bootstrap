<?php

function declarenone()
{
    global $pdo;
    global $error;
    global $pages;

    if ($_SESSION['usertype'] == '0') {
        $text = 'When your structure admin enables you, you will be able to do lots of intresting things on this website!';
    } else {
        $text = 'ACTIONS:<br>';
        foreach ($pages as list($name, $page)) {
            if ($page != 'none') {
                $text = "$text<a href=\"https://controllo.autocontrollo.ch/?p=$page\">$name</a><br>";
            }
        }
    }
    if ($error == 'y') {
        $errortxt = '<b>You have requested an invalid page. Please contact your structure admin.<br><br></b>';
    }

    $u = 0;

 // Prepare pdo
 $online = $pdo->prepare('SELECT loggedin FROM members WHERE sid = ?;');

 // Exec
 $online->execute([$_SESSION['sid']]);
    $rows = $online->fetchAll(PDO::FETCH_BOTH);

    while ($row = array_shift($rows)) {
        $u = $u + $row['loggedin'];
    }
    if ($u == '1') {
        $u = 'Currently there&apos;s 1 user online.';
    } elseif ($u == '') {
        $u = 'Currently there are 0 users online.';
    } else {
        $u = "Currently there are $u users online.";
    }
    echo '
    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Autocontrollo
                        <strong>personal section</strong>.
                    </h2>
                    <hr>
                    <hr class="visible-xs">
                    <p class="text-center">'.$errortxt.'This is the personal section of autocontrollo.ch.<br><br>'.$text.'<br>'.$u.'</p>
                </div>
            </div>
        </div>
    </div>
';
}
function declareuser()
{
    if ($st = $pdo->prepare('SELECT regolamento FROM members WHERE username=?')) {
        $st->bind_param('s', $curuser);
    // Esegui la query ottenuta.
    $st->execute();
        $st->bind_result($regol);
        $st->fetch();
    }
    error_log("regol for $curuser is $regol", 0);
    if ($regol == '0') {
        $top = "$itop";
        $desc = "$idesc";
        $section = "$isection";
    } else {
        $top = "$normtop";
        $desc = "$normdesc";
        $section = "$normsection";
    }
    echo '
    <STYLE TYPE="text/css">
    <!--
    	@page { margin-left: 0.79in; margin-right: 0.79in; margin-top: 0.98in; margin-bottom: 0.79in }
    	P { margin-bottom: 0.08in; direction: ltr; widows: 2; orphans: 2 }
    -->
    </STYLE>
</head>
<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">Scuola Fantasia Danza</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>

'.$top.'


                    <li class="page-scroll">
                        <a href="https://controllo.autocontrollo.ch/logout.php">Esci</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" alt="" src="img/profile.png">
                    <div class="intro-text">
                        <span class="name">Scuola Fantasia Danza</span>
                        <hr class="star-light">
                        <span class="skills">Benvenuti nella sezione personale.</span><br>
                        <h4 class="skills">Azioni:</h4>
                        <br><span class="skills daniil page-scroll">'.$desc.'<br><br></span>
                        <img src="img/aics.jpg" alt="AICS" class="img-responsive img-centered">
                    </div>
                </div>
            </div>
        </div>
    </header>
'.$section.'

    <script>
    function showMe (box) {
        
        var chboxs = document.getElementsByName("regolamento");
        var vis = "none";
        for(var i=0;i<chboxs.length;i++) { 
            if(chboxs[i].checked){
             vis = "block";
                break;
            }
        }
        document.getElementById(box).style.display = vis;
    
    
    }
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
    </script>';
}
