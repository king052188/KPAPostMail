<?php
Route::get('/kpa/demo', function() {
  $html = "<html>
              <head>
                  <title>Demo | king052188/KPAPostMail dev-master</title>
              </head>
              <body style='text-align: center;'>
                <h3 style='margin: 300px 0 0 0;'>*** Well Done! You are good to go ***</h3>
                <p>@kingpauloaquino | kingpauloaquino@gmail.com</p>
                <p><a href='http://kpa.ph/kingpauloaquino'>kpa.ph/kingpauloaquino</a></p>
              </body>
          </html>";
  return $html;
});

Route::get('/kpa/services/{all?}', function($all = null) {
  $a = false;
  if($all != null) {
    $a = true;
  }
  return KPAPostMail::TestServices($a);
});

Route::get('/kpa/email', function($all = null) {
  return KPAPostMail::TestEmail();
});
