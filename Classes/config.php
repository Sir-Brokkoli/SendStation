<?php
//Database login data
!defined("DB_SERVERNAME") && define("DB_SERVERNAME", "localhost");
!defined("DB_USERNAME") && define("DB_USERNAME", "root");
!defined("DB_PASSWORD") && define("DB_PASSWORD", "1392781243729");

//Database Tables
!defined("DB_NAME") && define("DB_NAME", "climbitDB");
!defined("DT_CLIMBERS") && define("DT_CLIMBERS", "Climbers");
!defined("DT_SESSIONS") && define("DT_SESSIONS", "Sessions");
!defined("DT_ACTIVESESSIONS") && define("DT_ACTIVESESSIONS", "ActiveSessions");
!defined("DT_GOES") && define("DT_GOES", "Goes");
!defined("DT_CRAGS") && define("DT_CRAGS", "Crags");
!defined("DT_ROUTES") && define("DT_ROUTES", "Routes");
!defined("DT_REL_SESSION_ROUTE") && define("DT_REL_SESSION_ROUTE", "relSessionRoute");
//!defined("DT_REL_ACTIVESESSION_ROUTE") && define("DT_REL_ACTIVESESSION_ROUTE", ["relActiveSessionRoute"]);

//Predefined Errors and Warnings
!defined("ERR_SQL_EXECUTE") && define("ERR_SQL_EXECUTE", "Oops! Something went wrong, please try again later!");
!defined("WAR_INVALID_MAIL_PW") && define("WAR_INVALID_MAIL_PW", "Invalid e-mail or password.");
?>