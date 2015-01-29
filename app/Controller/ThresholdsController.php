<?
    class ThresholdsController extends AppController {
        public $helpers = array('Html', 'Form');
        //var $uses = array('Event');
        
        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('checkthreshold');
            

        }
        
        public function index(){
            $this->set('thresholds', $this->Threshold->find('all'));
        }
        
        public function add($goalId) {
            if ($this->request->is('post')) {
                $this->Threshold->create();
                if ($this->Threshold->save($this->request->data)) {
                    $this->Session->setFlash(__('Your threshold has been created.'));
                    $goals = ClassRegistry::init('Goal');
                    $goalInfo = $goals->findById($goalId);
                    return $this->redirect(array('controller' => 'goals', 'action' => 'edit', $goalId, $goalInfo['project_id']));
                }
                $this->Session->setFlash(__('Unable to add your threshold.'));
            }
            else $this->set('goalId', $goalId);
        }
        public function edit($id = null, $goalId) {
            if (!$id) {
                throw new NotFoundException(__('Invalid threshold'));
            }
        
            $threshold = $this->Threshold->findById($id);
            $this->set('goalId', $goalId);
            if (!$threshold) {
                throw new NotFoundException(__('Invalid goal'));
            }
        
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->Threshold->id = $id;
                if ($this->Threshold->save($this->request->data)) {
                    $this->Session->setFlash(__('Your threshold has been updated.'));
                    return $this->redirect(array('controller' => 'thresholds', 'action' => 'edit', $id, $goalId));
                }
                $this->Session->setFlash(__('Unable to update your threshold.'));
            }
        
            if (!$this->request->data) {
                $this->request->data = $threshold;
            }
        }
        
        public function delete($id, $goalId) {
            if ($this->request->is('get')) {
                throw new MethodNotAllowedException();
            }
        
            if ($this->Threshold->delete($id)) {
                $this->Session->setFlash(__('Threshold %s has been deleted.', h($id)));
                return $this->redirect(array('controller' => 'goals', 'action' => 'view', $goalId));
            }
        }
        
        public function checkthreshold($appName, $goal_id){
            $this->render = false;
            
            $thresholds = $this->Threshold->find('all', array('conditions' => array('goal_id' => $goal_id)));
            
            $this->set('thresholds', $thresholds);
            $this->set('appName', $appName);
            
            $events = ClassRegistry::init('Event');
            
            foreach($thresholds as $threshold){
                $eventCount = $events->find('count', array('conditions' => array('appName' => $appName, 'goal_id' => $threshold['Threshold']['goal_id']), 'order'=>array('Threshold.number ASC')));
                if($eventCount == $threshold['Threshold']['number']){
                    //$message ='This app has hit the threshold ' . $threshold['Threshold']['id'];
                    App::import('Vendor', 'isdk');
                    $this->iSDK = new iSDK;
                    $this->iSDK->cfgCon('tt135');
                    $returnFields = array('Id');
                    $contactId = $this->iSDK->dsFind('Contact',1,0,'Company',$appName,$returnFields);
                    if(isset($contactId[0])){
                        $this->iSDK->sendTemplate(array($contactId[0]['Id']), $threshold['Threshold']['emailid']);
                        $message = $contactId[0]['Id'];
                    }
                    else $message = 'Contact Not Found';
                    break;
                }
                else $message = 'This app has not hit the threshold';
            }
            
            
            //$this->set('eventCount', $eventCount);
            
            //if($eventCount == $thresholdInfo['Threshold']['number']) 
            return $message;
            
        }
        
        public function test($appName, $goal_id){
            return "this worked - " . $appName . " - " . $goal_id;
        }
        
    }
    