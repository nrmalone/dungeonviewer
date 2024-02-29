<?php

function sanitize($input) {
    $sanitizedInput = htmlspecialchars($input);
    $sanitizedInput = addslashes($sanitizedInput);

    return $sanitizedInput;
}

?>
