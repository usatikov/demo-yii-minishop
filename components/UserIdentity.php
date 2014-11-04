<?php
/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 *
 * Standard YII implementation. ONLY FOR DEMONSTRATION.
 * You should store only hash of admin's password in special storage and provide ability to change it.
 */
class UserIdentity extends CUserIdentity
{
    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'admin'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $users = array(
            // username => password
            'admin' => 'admin',
        );

        if (!isset($users[$this->username])) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif ($users[$this->username] !== $this->password) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->errorCode = self::ERROR_NONE;
        }

        return ($this->errorCode === self::ERROR_NONE);
    }
}
