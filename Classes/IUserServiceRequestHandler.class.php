<?php
namespace Sendstation\Authentication;

interface IUserServiceRequestHandler {

    public static function processRequest(UserServiceRequest $request);
}