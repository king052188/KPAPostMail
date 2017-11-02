<?php

namespace king052188\KPAPostMail;

use Illuminate\Support\Facades\Config;

class KPAPostMail
{
  private static $configs;

  public function __construct() {
    $this::$configs = Config::get('services');
  }

  public function TestServices($showAll = false) {

    if($showAll) {
      return $this::$configs;
    }

    if($this->Check_Point()) {
      return $this::$configs["KPAPostMail"];
    }

    return array(
      "Code" => 404,
      "Message" => "Please check your config/services.php"
    );
  }

  public function Check_Point() {
    if(!IsSet($this::$configs["KPAPostMail"])) {
      return false;
    }
    return true;
  }

  public function Send($SendTo = [], $Subject, $Message) {

    if(!$this->Check_Point()) {
      return array(
        "Code" => 404,
        "Message" => "Please check your config/services.php"
      );
    }

    $configs = $this::$configs["KPAPostMail"];

     $data = array(
       "id" => $configs["uid"],
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
    $url = "http://". $configs["domain"] ."/mail/post/email";

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
