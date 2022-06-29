<?php

require 'vendor/autoload.php';

// Using the Dotenv package for using the .env and the global $_ENV
$dotenv = \Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">

    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/node_modules/axios/dist/axios.min.js"></script>

    <title>Mijn Document</title>
</head>
<body>
    <h1 id="first-name">What's your name?</h1>
    <div class="container">
        <div class="row">
            <div id="error-message" class="col-12" style="color: red;"></div>
        </div>

        <div class="row">
            <div class="col-12">
                <form action="form.php" method="POST" onsubmit="return false">
                    <input type="text" name="first_name" placeholder="Voornaam" id="first-name">
                    <input type="text" name="last_name" placeholder="Achternaam" id="last-name">
                    <input type="submit" value="Save" id="btn-save">
                </form>
            </div>
        </div>
    </div>

    <script>
        // Set headers to AJAX call for all axios calls
        window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

        let firstName = document.getElementById('first-name');
        let lastName = document.getElementById('last-name');
        let errorMessage = document.getElementById('error-message');

        // Add an event listner on the submit button and execute AJAX (axios) call
        let but = document.getElementById('btn-save');
        but.addEventListener('click', function() {
            formInput = new FormData();

            formInput.append('first_name', firstName.value);
            formInput.append('last_name', lastName.value);

            axios({
                url: 'form.php', // sent to...
                method: 'POST',  // this is a POST call

                // Data to send to back end (form.php)
                data: formInput,
            }).then(function(response) {
                // Response from backend
                if (response.data.success) {                    
                    firstName.innerHTML = 'Your name is "' + response.data.message + '"';
                    errorMessage.innerHTML = '';
                } else {
                    // Something went wrong
                    errorMessage.innerHTML = response.data.message;
                }
            }).catch(function(error) {
                // When error occurs...
                console.log(error);
            });
        })
    </script>
</body>
</html>