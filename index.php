<?php

/**
 * This code was created by myCaptcha.
 * myCAPTCHA is a free captcha service that allows you to protect your site with a captcha with no charge.
 *
 * Licensed under the MIT License. You may obtain a copy of the License at
 * https://opensource.org/licenses/MIT
 *
 * @author myCaptcha
 * @license MIT
 * @link https://www.mycaptcha.org
 */

$apiKey = 'YOUR_API_KEY';

function getCaptcha($apiKey) {
    $url = 'https://api.mycaptcha.org/captcha?api_key=' . $apiKey;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

function validateCaptcha($apiKey, $code, $answer) {
    $url = 'https://api.mycaptcha.org/validate_captcha';
    $payload = json_encode(['code' => $code, 'answer' => $answer]);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['captcha_code']) && isset($_POST['captcha_answer'])) {
    $validationResult = validateCaptcha($apiKey, $_POST['captcha_code'], $_POST['captcha_answer']);
    if ($validationResult['valid']) {
        echo 'Captcha response was correct!';
    } else {
        echo '<script>location.replace("/");</script>';
    }
} else {
    $captchaData = getCaptcha($apiKey);
    ?>

    <form method="post">
        <p>Please solve the following CAPTCHA:</p>
        <img src="<?php echo $captchaData['url']; ?>" alt="Captcha Image">
        <input type="hidden" name="captcha_code" value="<?php echo $captchaData['code']; ?>">
        <p><input type="text" name="captcha_answer"></p>
        <p><input type="submit" value="Submit"></p>
    </form>

    <?php
}
