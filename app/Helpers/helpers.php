<?php

// Laravel Helpers
function have_premission($right_id) {
    return true;
    $user = \Auth::user();
//        dd($user); 

    if ($user->role->first()->id > 1 && $user->role->first()->id != NULL) {
        //check if have permission or not

        $permission = \DB::table('role_permissions')
                ->where('role_id', $user->role->first()->id)
                ->where('permission_id', $right_id)
                ->where('status', 1)
                ->count();

        if ($permission > 0) {
            return true;
        } else {
            return false;
        }
    }

    if ($user->role->first()->id == 1) {
        return true;
    }

    return false;
}

function not_permissions_redirect($check) {
    return true;
    if (!$check) {
//        return redirect(url('/profile/'.Hashids::encode(Auth::user()->id). '/edit?action=profile&permission=error' )); 
        header("Location: " . asset('/profile?permission=error'));
        die();
    }
}

function checkImage($path = '') {
    $check = storage_path('/app/' . $path);
    if (\File::exists($check) && !File::isDirectory($check)) {
        return url('/storage/app/' . $path);
    }

    return asset('public/img/no_image.jpg');
}

function mysql_escape($inp) {
    if (is_array($inp))
        return array_map(__METHOD__, $inp);

    if (!empty($inp) && is_string($inp)) {
        return str_replace(
                ['\\', "\0", "\n", "\r", "'", '"', "\x1a"], ['\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'], $inp);
    }

    return $inp;
}

function clean_string($str) {

    $str = preg_replace('/[^A-Za-z0-9\ -]/', '', $str);
    $str = rtrim($str);
    $str = ltrim($str);

    // Replace sequences of spaces with space
    $str = preg_replace('/  */', '_', $str);
    
    return strtolower($str);
}

function strToCamelCase($string, $delimiter, $capitalizeFirstCharacter = false, $separateWith = '')
{
    $str = str_replace($delimiter, $separateWith, ucwords($string, $delimiter));

    if (!$capitalizeFirstCharacter) {
        $str = lcfirst($str);
    }

    return $str;
}
?>