<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/assets/img/favicons/favicon.ico">

    <title>Index</title>

    <!-- <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #edf1f5;
            margin-top: 20px;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid transparent;
            border-radius: 0;
        }

        .btn-circle.btn-lg,
        .btn-group-lg>.btn-circle.btn {
            width: 50px;
            height: 50px;
            padding: 14px 15px;
            font-size: 18px;
            line-height: 23px;
        }

        .text-muted {
            color: #8898aa !important;
        }

        [type=button]:not(:disabled),
        [type=reset]:not(:disabled),
        [type=submit]:not(:disabled),
        button:not(:disabled) {
            cursor: pointer;
        }

        .btn-circle {
            border-radius: 100%;
            width: 40px;
            height: 40px;
            padding: 10px;
        }

        .user-table tbody tr .category-select {
            max-width: 150px;
            border-radius: 20px;
        }
    </style>
</head>

<?php

use Kreait\Firebase\Factory;
use DateTime;

session_start();
require __DIR__ . '/../vendor/autoload.php';

$factory         = (new Factory)->withServiceAccount(__DIR__ . '/../config/firebase_credentials.json');
$auth            = $factory->createAuth();
$users = $auth->listUsers($defaultMaxResults = 1000, $defaultBatchSize = 1000);
?>

<body class="text-center">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase mb-0">Manage Users</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap user-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium">Username</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium">Email</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium">Added</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium">Category</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($users as $user) {

                                    $date = $user->metadata->createdAt->format("d M Y");
                                    $time = $user->metadata->createdAt->format("h:ma");
                                ?>
                                    <tr>
                                        <td class="pl-4"><?php echo $user->uid; ?></td>
                                        <td>
                                            <h5 class="font-medium mb-0"><?php echo $user->displayName; ?></h5>
                                        </td>
                                        <td>
                                            <span class="text-muted"><?php echo $user->email; ?></span><br>
                                        </td>
                                        <td>
                                            <span class="text-muted"><?php echo $date ?></span><br>
                                            <span class="text-muted"><?php echo $time ?></span>
                                        </td>
                                        <td>
                                            <select class="form-control category-select" id="exampleFormControlSelect1">
                                                <option>Modulator</option>
                                                <option>Admin</option>
                                                <option selected>User</option>
                                                <option>Subscriber</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle"><i class="fa fa-key"></i> </button>
                                            <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-trash"></i> </button>
                                            <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-edit"></i> </button>
                                            <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-upload"></i> </button>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="./js/admin.js"></script>
    <button onclick="adminLogin();">Login</button>
</body>

</html>

<!-- <script>
    var GoogleAuth;
    var SCOPE = 'https://www.googleapis.com/auth/drive.metadata.readonly';

    function handleClientLoad() {
        // Load the API's client and auth2 modules.
        // Call the initClient function after the modules load.
        gapi.load('client:auth2', initClient);
    }

    function initClient() {
        // In practice, your app can retrieve one or more discovery documents.
        var discoveryUrl = 'https://www.googleapis.com/discovery/v1/apis/drive/v3/rest';

        // Initialize the gapi.client object, which app uses to make API requests.
        // Get API key and client ID from API Console.
        // 'scope' field specifies space-delimited list of access scopes.
        gapi.client.init({
            'apiKey': 'AIzaSyA0SnuNVYh2162Rh0yeNHa7vytJHX1LCik',
            'clientId': '136523721534-ughibhk2cb2hh47p2d7rt8f5cqedvqkq.apps.googleusercontent.com',
            'discoveryDocs': [discoveryUrl],
            'scope': SCOPE
        }).then(function() {
            GoogleAuth = gapi.auth2.getAuthInstance();

            // Listen for sign-in state changes.
            GoogleAuth.isSignedIn.listen(updateSigninStatus);

            // Handle initial sign-in state. (Determine if user is already signed in.)
            var user = GoogleAuth.currentUser.get();
            console.log(user.hasGrantedScopes(SCOPE))
            window.user = user
            setSigninStatus();

            // Call handleAuthClick function when user clicks on
            //      "Sign In/Authorize" button.
            $('#sign-in-or-out-button').click(function() {
                handleAuthClick();
            });
            $('#revoke-access-button').click(function() {
                revokeAccess();
            });
        });
    }

    function handleAuthClick() {
        if (GoogleAuth.isSignedIn.get()) {
            // User is authorized and has clicked "Sign out" button.
            GoogleAuth.signOut();
        } else {
            // User is not signed in. Start Google auth flow.
            GoogleAuth.signIn();
        }
    }

    function revokeAccess() {
        GoogleAuth.disconnect();
    }

    function setSigninStatus() {
        var user = GoogleAuth.currentUser.get();
        var isAuthorized = user.hasGrantedScopes(SCOPE);
        if (isAuthorized) {
            $('#sign-in-or-out-button').html('Sign out');
            $('#revoke-access-button').css('display', 'inline-block');
            $('#auth-status').html('You are currently signed in and have granted ' +
                'access to this app.');
        } else {
            $('#sign-in-or-out-button').html('Sign In/Authorize');
            $('#revoke-access-button').css('display', 'none');
            $('#auth-status').html('You have not authorized this app or you are ' +
                'signed out.');
        }
    }

    function updateSigninStatus() {
        setSigninStatus();
    }
</script>

<button id="sign-in-or-out-button" style="margin-left: 25px">Sign In/Authorize</button>
<button id="revoke-access-button" style="display: none; margin-left: 25px">Revoke access</button>

<div id="auth-status" style="display: inline; padding-left: 25px"></div>
<hr>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script async defer src="https://apis.google.com/js/api.js" onload="this.onload=function(){};handleClientLoad()" onreadystatechange="if (this.readyState === 'complete') this.onload()">
</script> -->