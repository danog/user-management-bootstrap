<?php

function declaresignup()
{
    if (isset($_GET['error'])) {
        $error = '
                    <h2 class="text-center">AN ERROR OCCURRED: PLEASE CHECK YOUR LOGIN CREDENTIALS AND TRY AGAIN.</h2>
';
    }
    $content = '
    <div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Signup
                        <strong>form</strong>
                    </h2>
                    <hr>
                    <p>Please fill out the fields to signup.</p>
                    <form name="sentMessage" id="signupForm" novalidate>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Name / Nome</label>
                                <input type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Email Address / Indirizzo Email</label>
                                <input type="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Username / Nome utente</label>
                                <input type="text" class="form-control" placeholder="Username" id="username" required data-validation-required-message="Please enter a username.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Password</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Password"
                                    id="passone"
                                    name="passone"
                                    required
                                    data-validation-required-message="Please enter a password."
                                    data-validation-regex-regex="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$"
                                    data-validation-regex-message="Must contain a number, a symbol, an upper case char and a lower case char." 
                                    minlength="8"
                                    data-validation-minlength-message="Must contain at least 8 chars." 
                                />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Retype password</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Retype password"
                                    id="passtwo"
                                    name="passtwo"
                                    required
                                    data-validation-required-message="Please reenter the same password."
                                    data-validation-match-match="passone" 
                                    data-validation-match-message="Please enter the same password"
                                />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Structure id / Identificativo struttura</label>
                                <input type="text" rows="5" class="form-control" placeholder="Structure id" id="sid" required data-validation-required-message="Please enter the structure id."></input>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Captcha</label>
                                <div class="g-recaptcha" data-sitekey="6LfVZRITAAAAAIffWrkZm-SrvTwIST38n6DtVx3H"></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" id="btnSubmit" class="btn btn-default">Submit</button>
                            </div>
                        </div>

                        <div id="success"></div>

                    </form>
                </div>
            </div>
        </div>

    </div>';

    echo $content;
}
