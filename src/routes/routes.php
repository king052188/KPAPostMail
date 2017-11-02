<?php
Route::get('/kpa/demo', function() {
  $html = "<html>
              <head>
                  <title>Demo | KPAPostMail v1.0</title>
              </head>
              <body style='text-align: center;'>
                <h3 style='margin: 300px 0 0 0;'>*** Well Done! You are good to go ***</h3>
                <p>@kingpauloaquino | kingpauloaquino@gmail.com</p>
                <p><a href='http://kpa.ph/kingpauloaquino'>kpa.ph/kingpauloaquino</a></p>
              </body>
          </html>";
  return $html;
});

Route::get('/kpa/services', function() {
  return KPAPostMail::TestServices();
  //return $kpa::TestServices(true); // show all services
});
