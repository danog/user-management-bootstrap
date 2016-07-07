<?php

function declareindex($array)
{
    $username = $_SESSION['username'];

    foreach ($array as $menu) {
        $list = "$list<a href=\"https://controllo.autocontrollo.ch/?p=$menu\">$menu</a><br>";
    }

    $content = '
    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Hello
                        <strong>'.$username.'</strong>.
                    </h2>
                    <hr>
                    <hr class="visible-xs">
                    <p class="text-center">This is the private section of the autocontrollo.ch website.<br>What do you wish to do?<br>'.$list.'</p>
                </div>
            </div>
        </div>

    </div>
 ';
    echo $content;
}
