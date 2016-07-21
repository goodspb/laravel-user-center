<?php
namespace App\Library;

class ErrorCode
{
    const PARAMS_ERROR = 400001;                    //参数错误
    const ORIGIN_PASSWORD_IS_WRONG = 400002;        //原始密码错误
    const DB_SAVING_ERROR = 400003;                 //保存失败
}