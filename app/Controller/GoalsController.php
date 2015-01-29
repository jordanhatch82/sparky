<?
    class GoalsController extends AppController {
        public $helpers = array('Html', 'Form');

        
        public function index(){
            $this->set('goals', $this->Goal->find('all'));
        }
        
        public function view($id = null) {
            if (!$id) {
                throw new NotFoundException(__('Invalid goal'));
            }
    
            $goal = $this->Goal->findById($id);
            if (!$goal) {
                throw new NotFoundException(__('Invalid goal'));
            }
            $this->set('goal', $goal);
        }
        
        public function add($projectId) {
            if ($this->request->is('post')) {
                $this->Goal->create();
                if ($this->Goal->save($this->request->data)) {
                    $this->Session->setFlash(__('Your goal has been created.'));
                    return $this->redirect(array('controller' => 'projects', 'action' => 'view', $projectId));
                }
                $this->Session->setFlash(__('Unable to add your goal.'));
            }
            else $this->set('projectId', $projectId);
        }
        public function edit($id) {
            if (!$id) {
                throw new NotFoundException(__('Invalid goal'));
            }
        
            $goal = $this->Goal->findById($id);
            $this->set('projectId', $goal['Goal']['project_id']);
            $this->set('goal', $goal['Goal']);
            /*if (!$goal) {
                throw new NotFoundException(__('Invalid goal'));
            }*/
        
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->Goal->id = $id;
                if ($this->Goal->save($this->request->data)) {
                    $this->Session->setFlash(__('Your goal has been updated.'));
                    return $this->redirect(array('controller' => 'projects', 'action' => 'view', $projectId));
                }
                $this->Session->setFlash(__('Unable to update your goal.'));
            }
        
            if (!$this->request->data) {
                $this->request->data = $goal;
            }
            
            $threshold = ClassRegistry::init('Threshold');
            
            
            $thresholds = $threshold->find('all', array(
               'conditions' => array('goal_id' => $goal['Goal']['id'])
            ));
            $this->set('thresholds', $thresholds);
        }
        
        public function delete($id, $projectId) {
            if ($this->request->is('get')) {
                throw new MethodNotAllowedException();
            }
        
            if ($this->Goal->delete($id)) {
                $this->Session->setFlash(__('Project %s has been deleted.', h($id)));
                return $this->redirect(array('controller' => 'projects', 'action' => 'view', $projectId));
            }
        }
    }