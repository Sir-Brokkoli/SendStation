<?php namespace Sendstation\Authentication;

class SignupValidationResponse {

    private bool $emailTaken = false;
    private bool $usernameTaken = false;

    private bool $success = false;

    public function setEmailTaken() :void {

        $this->emailTaken = true;
    }

    public function setUsernameTaken() :void {

        $this->usernameTaken = true;
    }

    public function isEmailValid() :bool {

        return !$this->emailTaken;
    }

    public function isUsernameValid() :bool {

        return !$this->usernameTaken;
    }

    public function setSuccess() :void {

        $this->success = true;
    }

    public function succeed() :bool {

        return $this->success;
    }
}

?>