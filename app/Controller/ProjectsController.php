<?
    class ProjectsController extends AppController {
        public $helpers = array('Html', 'Form');
        
        public function index(){
            $allProjects=$this->Project->find('all');
            
            $this->set('projects', $allProjects);
            
            $allEvents = array();
            foreach($allProjects as $project){
                $allEvents[$project['Project']['id']]['ProjectId'] = $project['Project']['id'];
                $allEvents[$project['Project']['id']]['Title'] = $project['Project']['title'];
                $eventSum = 0;
                foreach($project['Goal'] as $goal){
                    $eventSum += $goal['event_count'];
                }
                $allEvents[$project['Project']['id']]['EventCount'] = $eventSum;
            }
            $this->set('allEvents', $allEvents);
        }
        
        public function view($id = null) {
            if (!$id) {
                throw new NotFoundException(__('Invalid project'));
            }
    
            $project = $this->Project->findById($id);
            if (!$project) {
                throw new NotFoundException(__('Invalid project'));
            }
            
            /*foreach($project['Goal'] as $goal){
                $goal['eventCount'] = $this->Project->Goal->Event->count($goal['id']);
            }*/
            
            
            $this->set('project', $project);
            
            //find all the associated events
            //$this->set('events', $this->Project->Goal->Event->find('all'));
        }
        
        public function add() {
            if ($this->request->is('post')) {
                $this->Project->create();
                if ($this->Project->save($this->request->data)) {
                    $this->Session->setFlash(__('Your project has been created.'));
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash(__('Unable to add your project.'));
            }
        }
        public function edit($id = null) {
            if (!$id) {
                throw new NotFoundException(__('Invalid project'));
            }
        
            $project = $this->Project->findById($id);
            if (!$project) {
                throw new NotFoundException(__('Invalid project'));
            }
        
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->Project->id = $id;
                if ($this->Project->save($this->request->data)) {
                    $this->Session->setFlash(__('Your project has been updated.'));
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash(__('Unable to update your project.'));
            }
        
            if (!$this->request->data) {
                $this->request->data = $project;
            }
        }
        
        public function delete($id) {
            if ($this->request->is('get')) {
                throw new MethodNotAllowedException();
            }
        
            if ($this->Project->delete($id)) {
                $this->Session->setFlash(__('Project %s has been deleted.', h($id)));
                return $this->redirect(array('action' => 'index'));
            }
        }
        public function testlist(){
            $allProjects = $this->Project->find('all');
            $allEvents = array();
            foreach($allProjects as $project){
                $allEvents[$project['Project']['id']]['ProjectId'] = $project['Project']['id'];
                $allEvents[$project['Project']['id']]['Title'] = $project['Project']['title'];
                $eventSum = 0;
                foreach($project['Goal'] as $goal){
                    $eventSum += $goal['event_count'];
                }
                $allEvents[$project['Project']['id']]['EventCount'] = $eventSum;
            }
            $this->set('allEvents', $allEvents);
        }
        
    }