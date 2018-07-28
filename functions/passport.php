<?php


function setPassportDataErrors($user_id, $errors, $response = false)
{
    $args = [
        'user_id' => $user_id,
        'errors'  => $errors
    ];

    if ($response) {
        return curlRequest('setPassportDataErrors', $args);
    } else {
        return jsonPayload('setPassportDataErrors', $args);
    }
}
