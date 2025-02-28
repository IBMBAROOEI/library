<?php

use Illuminate\Support\Facades\Redis;

 class Logger{

 public  static function log($level ,$message,$context=[]){


    $logEntry=[

'timestamp'=>now(),
'level'=>$level,
'message'=>$message,
'context'=>$context
    ];

    Redis::connection('REDIS_log_DB')->rpush
    ('app_logs',json_encode($logEntry));
 }

 }
