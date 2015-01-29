<?
class Project extends AppModel{
    public $validate = array(
        'title' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A title is required'
            )
        ),
        'description' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A description is required'
            )
        ),
        'startDate' => array(
            'rule' => 'date',
            'message' => 'Enter a valid date'
        ),
        'endDate' => array(
            'rule' => 'date',
            'message' => 'Enter a valid date'
        ),
        'category' => array(
            'rule' => array('inList', array('vertical', 'marketplace', 'kickstart', 'other')),
            'message' => 'Please select a valid category'
        )
    );
    
    public $hasMany = array(
        'Goal' => array(
            'className' => 'Goal'
        )
    );
}