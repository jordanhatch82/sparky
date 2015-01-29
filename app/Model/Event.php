<?
class Event extends AppModel{

    
    var $belongsTo = array(
        'Goal' => array(
        'className' => 'Goal',
        'foreignKey' => 'goal_id',
        'counterCache' => true
     ));
    
}