<?
class Check extends AppModel{
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty',
            'required' => true,
        ),
        'description' => array(
            'rule' => 'notEmpty'
        ),
        'goals' => array(
            'rule' => 'notEmpty'
        ),
        'action' => array(
            'rule' => 'notEmpty',
        ),
        'actiontarget' => array(
            'rule' => 'notEmpty'
        ),
    );
    
}