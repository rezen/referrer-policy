<?php

$policies = [
    [ 
      'value'       => 'no-referrer',
      'description' => 'Referer will never be set.',
    ],
  
    [ 
      'value'       => 'no-referrer-when-downgrade',
      'description' => 'Referer will not be set when navigating from HTTPS to HTTP.',
    ],
  
    [ 
      'value'       => 'same-origin',
      'description' => 'Full Referer for same-origin requests, and no Referer for cross-origin requests.'
    ],
    [ 
      'value'       => 'origin',
      'description' => "Referer will be set to just the origin, omitting the URL's path and search."
    ],
  
    [ 
      'value' =>     'strict-origin',
      'description' => implode(" \n",[
        'Referer will be set to just the origin except when navigating from ',
        'HTTPS to HTTP, in which case no Referer is sent.',
      ]),
    ],
  
    [ 
      'value'       =>  'origin-when-cross-origin',
      'description' => 'Full Referer for same-origin requests, and bare origin for cross-origin requests.',
    ],
    [ 
      'value'       => 'strict-origin-when-cross-origin',
      'description' => implode(" \n",[
        'Full Referer for same-origin requests, and bare origin for ',
        'cross-origin requests except when navigating from HTTPS to ',
        'HTTP, in which case no Referer is sent.'
      ]),
    ],
    [
      'value'       => 'unsafe-url',
      'description' => 'Full Referer for all requests, whether same- or cross-origin.'
    ]
];

$domains = [
  "other"     => "local.refer",
  "subdomain" => "dev.localhost",
];

$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/')));
$protocols = ['http', 'https'];
$port = $_SERVER['SERVER_PORT'] ?? '80';
$port = in_array($port, ["80", "443"]) ? "" : ":{$port}";