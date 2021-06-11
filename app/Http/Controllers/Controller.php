<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Date : 12-03-2021
     * Description : General validation
     */
    public function validateGeneral(Request $request, array $rules, array $customAttributes = [])
    {
        $validator = Validator::make($request->all(), $rules, $customAttributes);

        if ($validator->fails()) {
            $message = $validator->errors()->getMessages();

            $errMessages = "";
            if ($message != null) {
                if (is_array($message)) {
                    foreach ($message as $item) {
                        foreach ($item as $m) {
                            if (str_contains($m, '.'))
                                $errMessages .= $m . ' ';
                            else
                                $errMessages .= $m . '. ';
                        }
                    }
                }
            }
            return $errMessages;
        }
    }
}
