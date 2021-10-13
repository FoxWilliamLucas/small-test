<?php
namespace App\Helpers;


class Response {

    public const SUCCESS                = 'response.success';
    public const FAILED                 = 'response.failed';
    public const NOT_AUTHORIZED         = 'response.not_authorized';
    public const NOT_AUTHENTICATED      = 'response.not_authenticated';
    public const USER_NOT_FOUND         = 'response.user_not_found';
    public const WRONG_PASSWORD         = 'response.wrong_password';
    public const LOGIN_SUCCESSFULLY     = 'response.login_successfully';
    public const LOGOUT_SUCCESSFULLY    = 'response.logout_successfully';
    public const LOGIN_FAILED           = 'response.login_failed';
    public const MUST_LOGIN             = 'response.must_login';
    public const ADDED_SUCCESSFULLY     = 'response.added_successfully';
    public const UPDATED_SUCCESSFULLY   = 'response.updated_successfully';
    public const DELETED_SUCCESSFULLY   = 'response.deleted_successfully';
    public const TRASHED_SUCCESSFULLY   = 'response.trashed_successfully';
    public const RESTORED_SUCCESSFULLY  = 'response.restored_successfully';
    public const NOT_ALLOWED            = 'response.not_allowed';
    public const NOT_FOUND              = 'response.not_found';
    
    /**
     * @param mixed $message
     * @param null $content
     * @param integer $status
     * 
     * @return JsonResponse
     */
    public static function respondSuccess($message ,$content = null ,$status = 200){
        return response()->json([
            'content' => $content,
            'message' => trans($message),
            'code' => $status,
        ], $status);
    }
    /**
     * @param mixed $message
     * @param integer $status
     * 
     * @return JsonResponse
     */
    public static function respondError($message ,$status = 500){
        return response()->json([
            'content' => null,
            'message' => \is_array($message)?$message:[trans($message)],
            'code' => $status,
        ], $status);
    }
}