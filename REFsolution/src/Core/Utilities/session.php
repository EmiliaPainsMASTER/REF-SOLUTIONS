<?php
class session
{
    public function killSession()
    {
        // Overwrite the current session array with an empty array.
        $_SESSION = [];

        // Overwrite the session cookie with empty data too.
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
    }

    public function forgetSession()
    {
        $this->killSession();
        header("Location: login.php"); // Redirect to login page
        exit;
    }
}
?>