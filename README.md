# myCaptcha PHP Integration

This `index.php` file integrates the myCaptcha service into a PHP application, providing a simple CAPTCHA solution to protect forms from automated submissions. The myCaptcha service is a free, easy-to-use tool that generates CAPTCHA challenges to differentiate between human users and bots.

## Features
- **CAPTCHA Generation**: Automatically generates CAPTCHA challenges.
- **CAPTCHA Validation**: Validates user responses to ensure they are correct before proceeding.

## Usage
To use this CAPTCHA service in your project, you need to obtain an API key from [myCaptcha](https://www.mycaptcha.org). Replace `YOUR_API_KEY` in the `index.php` file with your actual API key.

The form will display a CAPTCHA challenge to the user. The user must solve the CAPTCHA and submit the form. The server-side script then validates the CAPTCHA response using the myCaptcha API. If the validation is successful, it proceeds with the form submission process; otherwise, it redirects the user to retry.

## License
This integration is licensed under the MIT License, as is the myCaptcha service itself.
