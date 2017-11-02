<?php

namespace king052188\KPAPostMail;

use Illuminate\Support\Facades\Config;

class KPAPostMail
{
  private static $configs;
  private static $err_code;
  private static $err_message;

  public function __construct() {
    $this::$configs = Config::get('services');
  }

  public function getDomain() {
    return $this::$configs["KPAPostMail"]["domain"];
  }

  public function getUserEmail() {
    return $this::$configs["KPAPostMail"]["email"];
  }

  public function getUID() {
    return $this::$configs["KPAPostMail"]["uid"];
  }

  public function TestServices($showAll = false) {
    if($showAll) {
      return $this::$configs;
    }

    if($this->Check_Point()) {
      return $this::$configs["KPAPostMail"];
    }

    return array(
      "Code" => $this::$err_code,
      "Message" => $this::$err_message
    );
  }

  public function TestEmail($showAll = false) {
    if(!$this->Check_Point()) {
      return array(
        "Code" => $this::$err_code,
        "Message" => $this::$err_message
      );
    }

    $send_to = array(
      "Name" => "Hello Member,",
      "Email" => $this->getUserEmail()
    );
    $subject = "Sample Email From KPAPostMail | ". rand(1000, 9999);
    $message = "Hello, This is a test email from KPAPostMail";

    return  $this::Send($send_to, $subject, $message);
  }

  public function Check_Point() {
    if(!IsSet($this::$configs["KPAPostMail"])) {
      $this::$err_code = 301;
      $this::$err_message = "Please check your config/services.php";
      return false;
    }

    if(!IsSet($this::$configs["KPAPostMail"]["domain"])) {
      $this::$err_code = 302;
      $this::$err_message = "Please check your [DOMAIN] in config/services.php";
      return false;
    }

    if(!IsSet($this::$configs["KPAPostMail"]["email"])) {
      $this::$err_code = 303;
      $this::$err_message = "Please check your [EMAIL] in config/services.php";
      return false;
    }

    if(!IsSet($this::$configs["KPAPostMail"]["uid"])) {
      $this::$err_code = 304;
      $this::$err_message = "Please check your [UID] in config/services.php";
      return false;
    }

    return true;
  }

  public function Send($SendTo = [], $Subject, $Message) {

    if(!$this->Check_Point()) {
      return array(
        "Code" => $this::$err_code,
        "Message" => $this::$err_message
      );
    }

    $configs = $this::$configs["KPAPostMail"];

    $data = array(
       "id" => $this->getUID(),
       "name" => $SendTo["Name"],
       "email" => $SendTo["Email"],
       "subject" => $Subject,
       "temp_name" => "KPA.Notification",
       "message" => $Message
     );

     $result = $this->Execute_Curl($data, $configs);

     $msg = "Your email has been sent.";
     if($result["Status"] > 200 ) {
       $msg = "Your email sending failed.";
     }

     return array(
       "Code" => $result["Status"],
       "Message" => $msg
     );
  }

  private function Execute_Curl($data, $configs) {
    // Email API
    $url = "http://". $this->getDomain() ."/mail/post/email";

    // Array to Json
    $toJSON = json_encode($data);

    // Added JSON Header
    $headers= array('Accept: application/json','Content-Type: application/json');

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $toJSON);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = json_decode(curl_exec($ch), true);
    curl_close($ch);
    return $result;
  }
}
