<?php
/**
 * User: Jony
 * Date: 2017. 02. 01.
 * Time: 14:36
 * Project: game_of_life
 * Company: GreenTech
 */
class Model_Pattern_Point extends ORM
{
    protected $_table_name = 'pattern_points';
    protected $_primary_key = 'patpoi_id';
    
    protected $_belongs_to = array(
        'pattern'=>array(
            'model'=>'Pattern',
            'foreign_key'=>'patpoi_pat_id'
        )
    );

}