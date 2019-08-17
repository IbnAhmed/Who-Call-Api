<?php
if (!function_exists('userInfoOrganizing')) {
    /***
     *
     * 
     *
     * @param array
     * @return array
     */

    function userInfoOrganizing($user = null){
        if($user){

            $info = [
                'id'            => $user->id,
                'first_name'    => $user->first_name,
                'last_name'     => $user->last_name,
                'phone'     	=> $user->phone,
            ];
            return $info;
        } else {
            return null;
        }
    }
}