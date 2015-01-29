<?
    class EventsController extends AppController {
        public $helpers = array('Html', 'Form');
        
        //public $uses = array('Threshold');
        
        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('record');
        }
        
        public function index(){
            $this->set('events', $this->Event->find('all'));
        }
        
        public function record($goalId){
            if ($this->request->is('post')) {
                if(isset($this->request->data['app_name'])){
                    $appPost = parse_url($this->request->data['app_name']);
                    $appInfo = explode('.', $appPost['host']);
                    $appName = $appInfo[0];
                }
                else if(isset($this->request->data['appName'])){
                    $appName = $this->request->data['appName'];
                }
                else $appName = '(undefined)';
                if(isset($this->request->data['contact_id'])) $contactId = $this->request->data['contact_id'];
                else $contactId = 'undefined';
                // If the form data can be validated and saved...
                $data = array('goal_id' => $goalId,
                              'dateCreated' => date('Y-m-d H:i:s'),
                              'contactId' => $contactId,
                              'appName' => $appName,
                              'referringUrl' => $_SERVER['REMOTE_ADDR']);
                if ($this->Event->save($data)) {
                    // Set a session flash message and redirect.
                    $this->Session->setFlash('Event Saved!');
                    //return $this->redirect('/projects/view');
                }
            }


            if($goalId == 4386 || $goalId == 4398 || $goalId == 4406){
                App::import('Controller', 'Thresholds'); // mention at top

                // Instantiation // mention within cron function
                $Thresholds = new ThresholdsController;
                // Call a method from
                $return = $Thresholds->checkthreshold($appName, $goalId);
                $this->set('return', $return);
            }
            $this->set('request', $this->request->query);
            $this->set('post', $this->request->data);
            $this->set('referrer', $_SERVER['REMOTE_ADDR']);
        }
        
        public function recordtest(){
            
        }
        
        public function count($goalId){
            $eventCount = $this->Event->find('count', array(
                'conditions' => array('goal_id' => $goalId)
            ));
            $this->set('count', $eventCount);
        }
        
        public function data($goalId){
            set_time_limit (240);
            $allEventsForGoal = $this->Event->find('all', array(
                'conditions' => array('goal_id' => $goalId),
                'order' => array('dateCreated DESC')
            ));
            $this->set('allEventData', $allEventsForGoal);
            
            $eventsByDate = $this->Event->find('all', array(
                'fields' => array('COUNT(Event.id)',
                                  'Event.dateCreated'),
                'conditions' => array('goal_id' => $goalId),
                'group' => array('Event.dateCreated'),
            ));
            $this->set('eventsByDate', $eventsByDate);
            
            $eventsByApp = $this->Event->find('all', array(
                'fields' => array('COUNT(Event.id) as eventCount',
                                  'appName'),
                'conditions' => array('goal_id' => $goalId),
                'group' => array('appName'),
            ));
            $this->set('eventsByApp', $eventsByApp);
            
        }
        
        public function report($filter = 'all'){
            App::import('model', 'Project');
            set_time_limit (240);
            $projects = new Project();
            if($filter == 'all') $allProjects = $projects->find('all',
                                            array(
                                                'order' => array('id')     
                                            ));
            else $allProjects = $projects->find('all',
                                            array(
                                                'order' => array('id'),
                                                'conditions' => array('category' => $filter)
                                            ));
            $this->set('allProjects', $allProjects);
            $reportData = array();
            $counter = 0;
            foreach($allProjects as $project){
                $reportData[$counter] = array('ProjectId' => $project['Project']['id'], 'ProjectTitle' => $project['Project']['title']);
                $fifteenDayRange = "'" . date('Y-m-d', strtotime('-15 days')) . "' and '" . date('Y-m-d', strtotime('now')) . "'";
                $thirtyDayRange = "'" . date('Y-m-d', strtotime('-30 days')) . "' and '" . date('Y-m-d', strtotime('now')) . "'";
                foreach($project['Goal'] as $goal){
                    
                    $fifteenDayEvents = $this->Event->find('count', array(
                        'conditions' => array(
                                            'goal_id' => $goal['id'],
                                            'dateCreated between' . $fifteenDayRange
                                            )
                    ));
                    
                    $fifteenDayApps = $this->Event->find('all', array(
                        'fields' => array(
                                          'count(distinct appName) as appCount'
                                          ),
                        'conditions' => array(
                                            'goal_id' => $goal['id'],
                                            'dateCreated between' . $fifteenDayRange
                                            )
                    ));
                    
                    $thirtyDayEvents = $this->Event->find('count', array(
                        'conditions' => array(
                                            'goal_id' => $goal['id'],
                                            'dateCreated between' . $thirtyDayRange
                                            )
                    ));
                    
                    $thirtyDayApps = $this->Event->find('all', array(
                        'fields' => array(
                                          'count(distinct appName) as appCount'
                                          ),
                        'conditions' => array(
                                            'goal_id' => $goal['id'],
                                            'dateCreated between' . $thirtyDayRange
                                            )
                    ));
                    
                    $appsReporting = $this->Event->find('all', array(
                        'fields' => array(
                                          'count(distinct appName) as appCount'
                                          ),
                        'conditions' => array(
                                            'goal_id' => $goal['id']
                                            )
                    ));
                    if($goal['event_count']== NULL) $goal['event_count'] = 0;
                    $reportData[$counter]['goals'][$goal['id']] = array('GoalTitle' => $goal['title'],
                                                                        'Event Count' => $goal['event_count'],
                                                                        '15Days' => $fifteenDayEvents,
                                                                        '30Days' => $thirtyDayEvents,
                                                                        '15DaysApps' => $fifteenDayApps[0][0]['appCount'],
                                                                        '30DaysApps' => $thirtyDayApps[0][0]['appCount'],
                                                                        'AppCount' => $appsReporting[0][0]['appCount']);
                    
                }
                $counter++;
            }
            $this->set('reportData', $reportData);
        }
        
        public function globalreport(){
            $appsReporting = $this->Event->find('all', array(
                'fields' => array(
                                  'count(distinct appName) as appCount'
                                  )
            ));
            $fifteenDayRange = "'" . date('Y-m-d', strtotime('-15 days')) . "' and '" . date('Y-m-d', strtotime('now')) . "'";
            $thirtyDayRange = "'" . date('Y-m-d', strtotime('-30 days')) . "' and '" . date('Y-m-d', strtotime('now')) . "'";
            
            $fifteenDayApps = $this->Event->find('all', array(
                        'fields' => array(
                                          'count(distinct appName) as appCount'
                                          ),
                        'conditions' => array(
                                            'dateCreated between' . $fifteenDayRange
                                            )
            ));
            
            $thirtyDayApps = $this->Event->find('all', array(
                        'fields' => array(
                                          'count(distinct appName) as appCount'
                                          ),
                        'conditions' => array(
                                            'dateCreated between' . $thirtyDayRange
                                            )
            ));
            
            $eventCountByApp = $this->Event->find('all', array(
                        'fields' => array(
                                        'appName',
                                        'count(*) as eventCount'),
                        'group' => array('appName'),
                        'order' => array('eventCount desc')
            ));
            
            $this->set('appsReporting', $appsReporting);
            $this->set('fifteenDayApps', $fifteenDayApps);
            $this->set('thirtyDayApps', $thirtyDayApps);
            $this->set('eventCountByApp', $eventCountByApp);
        }
        
        public function appusage(){
            if(!isset($this->request->query['fromDate'])) $fromDate = date('Y-m-d', strtotime("-1 month"));
            else $fromDate = $this->request->query['fromDate'];
            if(!isset($this->request->query['toDate'])) $toDate = date('Y-m-d', strtotime("today"));
            else $toDate = $this->request->query['toDate'];
            if(!isset($this->request->query['type'])) $campaignType = 'kickstart';
            else $campaignType = $this->request->query['type'];
            
            $data = $this->Event->query("select appName, count(distinct projects.id) as 'projectsCount', count(events.id) as 'eventCount'
                                  from events
                                  inner join goals on goals.id = events.goal_id
                                  inner join projects on projects.id = goals.project_id
                                  where projects.category = '". $campaignType ."'
                                  and events.dateCreated >= '". $fromDate ."'
                                  and events.dateCreated <= '". $toDate ."'
                                  group by appName
                                  order by appName");

            
            $this->set('data', $data);
        }
        
        public function eventcount(){
            $eventCount = $this->Event->find('count');
            return new CakeResponse(array('body' => json_encode(number_format($eventCount))));
        }
    }