<?
    class ChecksController extends AppController {
        public $helpers = array('Html', 'Form');
        
        public function beforeFilter() {
            parent::beforeFilter();
            App::import('Vendor', 'isdk');
            $this->iSDK = new iSDK;
            $this->iSDK->cfgCon('tt135');
            
            $this->Auth->allow('run');
        }
        
        public function add() {
            if ($this->request->is('post')) {
                $this->Check->create();
                if ($this->Check->save($this->request->data)) {
                    $this->Session->setFlash(__('Your checkup has been created.'));
                    return $this->redirect(array('controller' => 'checks', 'action' => 'index'));
                }
                $this->Session->setFlash(__('Unable to add your checkup.'));
            }
        }
        
        public function index(){
            $this->set('checks', $this->Check->find('all'));
        }
        
        public function edit($id) {
            if (!$id) {
                throw new NotFoundException(__('Invalid checkup'));
            }
        
            $check = $this->Check->findById($id);
            
            $this->set('checks', $check['Check']);
            /*if (!$goal) {
                throw new NotFoundException(__('Invalid goal'));
            }*/
        
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->Check->id = $id;
                if ($this->Check->save($this->request->data)) {
                    $this->Session->setFlash(__('Your checkup has been updated.'));
                    return $this->redirect(array('controller' => 'checks', 'action' => 'index'));
                }
                $this->Session->setFlash(__('Unable to update your checkup.'));
            }
        
            if (!$this->request->data) {
                $this->request->data = $check;
            }

        }
        
        public function run($check_id, $appName, $contactId){
            $events = ClassRegistry::init('Event');
            
            $check = $this->Check->findById($check_id);
            
            $goals = explode(',', $check['Check']['goals']);
            
            $dates = array('today'=> date('Y-m-d H:i:s'),
                           '7' => date('Y-m-d H:i:s', strtotime("-7 days")),
                           '14'=> date('Y-m-d H:i:s', strtotime("-14 days")),
                           '30'=> date('Y-m-d H:i:s', strtotime("-30 days")));
            
            foreach($goals as $key=>$goal){
                $eventCount[$goal]['total'] = $events->find('count', array('conditions' => array('goal_id' => $goal, 'appName' => $appName)));
                $eventCount[$goal]['7'] = $events->find('count', array('conditions' => array('goal_id' => $goal, 'appName' => $appName, 'dateCreated between ? and ?' => array($dates["7"], $dates["today"]))));
                $eventCount[$goal]['14'] = $events->find('count', array('conditions' => array('goal_id' => $goal, 'appName' => $appName, 'dateCreated between ? and ?' => array($dates["14"], $dates["today"]))));
                $eventCount[$goal]['30'] = $events->find('count', array('conditions' => array('goal_id' => $goal, 'appName' => $appName, 'dateCreated between ? and ?' => array($dates["30"], $dates["today"]))));
            }
            
            $this->set('events', $eventCount);
            $this->set('dates', $dates);
            
            switch($check['Check']['action']){
                case 'email':
                    $emailCode = $this->iSDK->getEmailTemplate($check['Check']['actiontarget']);
            
                    foreach($goals as $goal){
                        //totals
                        $emailCode['htmlBody'] = str_replace('{{' . $goal . '}}', $eventCount[$goal]['total'], $emailCode['htmlBody']);
                        $emailCode['textBody'] = str_replace('{{' . $goal . '}}', $eventCount[$goal]['total'], $emailCode['textBody']);
                        
                        //7 days
                        $emailCode['htmlBody'] = str_replace('{{7-' . $goal . '}}', $eventCount[$goal]['7'], $emailCode['htmlBody']);
                        $emailCode['textBody'] = str_replace('{{7-' . $goal . '}}', $eventCount[$goal]['7'], $emailCode['textBody']);
                        
                        //14 days
                        $emailCode['htmlBody'] = str_replace('{{14-' . $goal . '}}', $eventCount[$goal]['14'], $emailCode['htmlBody']);
                        $emailCode['textBody'] = str_replace('{{14-' . $goal . '}}', $eventCount[$goal]['14'], $emailCode['textBody']);
                        
                        //30 days
                        $emailCode['htmlBody'] = str_replace('{{30-' . $goal . '}}', $eventCount[$goal]['30'], $emailCode['htmlBody']);
                        $emailCode['textBody'] = str_replace('{{30-' . $goal . '}}', $eventCount[$goal]['30'], $emailCode['textBody']);
                        
                        //% growth 7 - 14 days
                        $prev7 = $eventCount[$goal]['14'] - $eventCount[$goal]['7'];
                        $emailCode['htmlBody'] = str_replace('{{7p-' . $goal . '}}', round(((($eventCount[$goal]['7'] - $prev7))/$prev7), 3) * 100 . "%", $emailCode['htmlBody']);
                        $emailCode['textBody'] = str_replace('{{7p-' . $goal . '}}', round(((($eventCount[$goal]['7'] - $prev7))/$prev7), 3) * 100 . "%", $emailCode['textBody']);
                        
                    }
                    
                    $status = $this->iSDK->sendEmail(array($contactId),$emailCode['fromAddress'],$emailCode['toAddress'], '','','Multipart',$emailCode['subject'],$emailCode['htmlBody'],$emailCode['textBody']);
                    
                    $this->set('code', $emailCode);
                    
                    $this->set('status', $status);
                    break;
                case 'goal':
                    $status = $this->iSDK->achieveGoal('sparky',$check['Check']['actiontarget'],$contactId);
                    $this->set('status',$check['Check']['actiontarget']);
                    
                    break;
            }
            
        }
        
    }