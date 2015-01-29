<?
class Threshold extends AppModel{

    
    var $belongsTo = array(
        'Goal' => array(
        'className' => 'Goal',
        'foreignKey' => 'goal_id',
        'counterCache' => true
    ));
    
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty',
            'required' => true,
        ),
        'description' => array(
            'rule' => 'notEmpty'
        ),
        'number' => array(
            'rule' => 'isUnique'
        ),
    );
    
}