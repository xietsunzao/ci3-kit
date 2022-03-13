

const getExampleKey = async () => {
    if (!window.sodium) window.sodium = await SodiumPlus.auto();
    return CryptographyKey.from(
        '42e5c026b85f69f5afbb2a03a5bd10ff9ca99498b855e3471809091d8dc65f75',
        'hex'
    );
    return await sodium.crypto_secretbox_keygen();
};

const encryptMessage = async (message, key) => {
    if (!window.sodium) window.sodium = await SodiumPlus.auto();

    let nonce = await sodium.randombytes_buf(24);
    let encrypted = await sodium.crypto_secretbox(message, nonce, key);
    return nonce.toString('hex') + encrypted.toString('hex');
};

const sendEncryptedMessage = async () => {
    let key = await getExampleKey();
    let message = $("#user-input").val();
    let encrypted = await encryptMessage(message, key);
    $.post(`${baseURL}api/users/sendMessage`, {
        "message": encrypted
    }, (response) => {
        console.log(response);
        $("#output").append("<li><pre>" + response.message + "</pre></li>");
    });
};

