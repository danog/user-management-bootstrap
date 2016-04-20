<?php
function declarelogin() {

 if(isset($_GET['error'])) { 
  $error = '
                    <h2 class="text-center">AN ERROR OCCURRED: PLEASE CHECK YOUR LOGIN CREDENTIALS AND TRY AGAIN.</h2>
';
 };
 $content = '
    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Please
                        <strong>login</strong>.
                    </h2>
                    <hr>
                    <hr class="visible-xs">
                    <form action="https://controllo.autocontrollo.ch/process_login.php" method="post" name="login_form" id="login">
                        <div class="row control-group">
                            <fieldset id="inputs">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <input type="text" class="form-control" name="username"  placeholder="Nome utente" required data-validation-required-message="Prego inserire il nome utente"/><br />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <input type="password" class="form-control" name="p" id="password" placeholder="Password" required data-validation-required-message="Prego inserire la password"/><br />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </fieldset>
                        </div><br>
                        <div class="row">
                            <div class="form-group col-xs-12">
                            <button type="button" value="Login" id="submitb" onclick="formhash(this.form, this.form.password);" class="btn btn-success btn-lg">Login</button>
                            </div>
                        </div>
                    </form>
'.$error.'

                </div>
            </div>
        </div>
    </div>';

 echo $content;
};
?>
