<?php
/**
 * User: Jony
 * Date: 2017. 02. 01.
 * Time: 14:36
 * Project: game_of_life
 * Company: GreenTech
 */
class Model_Pattern extends ORM
{
    protected $_table_name = 'patterns';
    protected $_primary_key = 'pat_id';
    
    protected $_has_many = array(
        'points'=>array(
            'model'=>'Pattern_Points',
            'foreign_key'=>'patpoi_pat_id'
        )
    );

}