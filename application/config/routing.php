<?php
/**
 * User: Jony
 * Date: 2017. 02. 01.
 * Time: 9:17
 * Project: game_of_life
 * Company: GreenTech
 */
Route::set('homeAjax', 'home/ajax/<actiontarget>(/<maintarget>(/<subtarget>))')
    ->defaults(array(
        'controller' => 'home',
        'action'     => 'ajax',
        'actiontarget' => 'index'
    ));

Route::set('homeIndex', '')
    ->defaults(array(
        'controller' => 'home',
        'action'     => 'index',
    ));