<?php

/**
 * Get order by title for route to make sorting
 *
 * @return string
 * */
function getOrderByTitle($title) {
    $return_order = 'desc';

    //dd(request()->has('email'));

    if(request()->get('order_by') == $title) {
        if(request()->has('order')) {
            $current_order = request()->get('order');
            if($current_order == 'asc') {
                $return_order = 'desc';
            } else if($current_order == 'desc') {
                $return_order = 'asc';
            }
        }
    }

    return $return_order;
}