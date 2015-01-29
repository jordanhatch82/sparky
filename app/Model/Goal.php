<?
class Goal extends AppModel{
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty',
            'required' => true,
        ),
        'description' => array(
            'rule' => 'notEmpty'
        ),
    );
    
    public $belongsTo = "Project";
    
    public $hasMany = array(
        'Event' => array(
            'className' => 'Event',
            'foreignKey' => 'goal_id'
        )
    );
}