<?php
/**
*Session Class
**/
class Session{

//initialize session, i.e once you login, checkout cart, or login in admin/user, the website saves session in these actions.
//When you refresh the website, the session is still there.
 public static function init(){
  if (version_compare(phpversion(), '5.4.0', '<')) {
        if (session_id() == '') {
            session_start();
        }
    } else {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
 }

 //user=admin, export admin value
 public static function set($key, $val){
    $_SESSION[$key] = $val;
 }

 public static function get($key){
    if (isset($_SESSION[$key])) {
     return $_SESSION[$key];
    } else {
     return false;
    }
 }

 //check whether session exists
 public static function checkSession(){
    self::init();
    if (self::get("adminlogin")== false) {
     self::destroy();
     header("Location:login.php");
    }
 }

 //check login = true -> redirect to index.php
 public static function checkLogin(){
    self::init();
    if (self::get("login")== true) {
     header("Location:index.php");
    }
 }

 public static function destroy(){
  session_destroy();
  header("Location:login.php");
 }
}
?>

