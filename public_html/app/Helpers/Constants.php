<?php

namespace VFramework\Helpers;

define("REG_RULES",
    [
        'email' => ['required', 'exists'],
        'password' => ['required']
    ]
);

define("LOGIN_RULES",
    [
        'email' => ['required', 'exists'],
        'password' => ['required']
    ]
);

define("POST_RULES",
    [
        'title' => ['required'],
        'body' => ['required']
    ]
);
