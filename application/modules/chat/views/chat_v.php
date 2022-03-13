<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Title</title>
</head>

<body>

    <label for="user-input">Type a message to encrypt and send:</label>
    <textarea id="user-input"></textarea>
    <button id="send-it" type="button">Send Encrypted Message</button>
    <hr />
    <ol id="output"></ol>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/sodium/dist/sodium-plus.min.js"></script>
    <script>
        var baseURL = '<?php echo base_url() ?>'
        /**
         * Get the example key. In the real world, you want to generate these randomly.
         */
        async function getExampleKey() {
            if (!window.sodium) window.sodium = await SodiumPlus.auto();
            return CryptographyKey.from(
                '42e5c026b85f69f5afbb2a03a5bd10ff9ca99498b855e3471809091d8dc65f75',
                'hex'
            );
            return await sodium.crypto_secretbox_keygen();
        }

        /**
         * Encrypt a message under a given key.
         */
        async function encryptMessage(message, key) {
            if (!window.sodium) window.sodium = await SodiumPlus.auto();

            let nonce = await sodium.randombytes_buf(24);
            let encrypted = await sodium.crypto_secretbox(message, nonce, key);
            return nonce.toString('hex') + encrypted.toString('hex');
        }

        async function sendEncryptedMessage() {
            let key = await getExampleKey();
            let message = $("#user-input").val();
            let encrypted = await encryptMessage(message, key);
            $.post(`${baseURL}api/users/sendMessage`, {
                "message": encrypted
            }, function(response) {
                console.log(response);
                $("#output").append("<li><pre>" + response.message + "</pre></li>");
            });
        }
    </script>

    <script type="text/javascript">
        $("#send-it").on('click', sendEncryptedMessage);
    </script>
</body>
