 <?php
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://clientes.xhost.cl/includes/api.php');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt(
        $ch,
        CURLOPT_POSTFIELDS,
        http_build_query(
            array(
                'action' => 'ResetPassword',
                // See https://developers.whmcs.com/api/authentication
                'username' => 'IDENTIFIER_OR_ADMIN_USERNAME',
                'password' => 'SECRET_OR_HASHED_PASSWORD',
                'email' => 'john.doe@example.com',
                'responsetype' => 'json',
            )
        )
    );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
