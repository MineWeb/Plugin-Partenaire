<?php
class PartenaireController extends PartenaireAppController{



    public function index(){
    	$this->set('partenaire', $this->Partenaire->find('all'));
        $this->set('total', $this->Partenaire->find('count'));
        $this->set('ytb', $this->Partenaire->find('count', array(
        'conditions' => array('Partenaire.type' => 'Y')
        )));
        $this->set('twt', $this->Partenaire->find('count', array(
        'conditions' => array('Partenaire.type' => 'T')
        )));
        $this->set('fb', $this->Partenaire->find('count', array(
        'conditions' => array('Partenaire.type' => 'F')
        )));
        $this->set('dis', $this->Partenaire->find('count', array(
        'conditions' => array('Partenaire.type' => 'D')
        )));

	}

    public function ajax_get_partenaire($id){
        $this->layout = null;
        $this->autoRender = false;

        $id = (((int)$id) == 0) ? 1 : (int)$id;

        $partenaire = $this->Partenaire->find('first', [
            'conditions' => [
                'id' => $id
            ],
        ]);

        if(!empty($partenaire))
            $partenaire = json_encode(current($partenaire), JSON_PRETTY_PRINT);
        else
            $partenaire = 0;

        $this->response->type('json');
        $this->response->body($partenaire);
    }


    public function admin_index(){


        if($this->isConnected AND $this->User->isAdmin()){
            $this->set('title_for_layout');
            $this->layout = 'admin';
            $partenaires = $this->Partenaire->find('all', [
                'order' => 'id'
            ]);
            $this->set(compact("partenaires"));
        }
        else
            throw new ForbiddenException();



    }

    public function admin_ajax_save_partenaire(){
        if($this->isConnected AND $this->User->isAdmin()){
            if($this->request->is('post')){
                $this->layout = null;
                $this->autoRender = false;
                $data = $this->request->data;
                $return = 0;
                if($data['action'] == "edit") {
                    $data['id'] = (((int)$data['id']) == 0) ? 1 : (int)$data['id'];
                    $partenaire = $this->Partenaire->find('first', ['conditions' => ['id' => $data['id']]]);
                    $partenaire = current($partenaire);
                    $partenaire['channel'] = $data['channel'];
                    $partenaire['pseudo'] = $data['pseudo'];
                    $partenaire['type'] = $data['type'];
					$partenaire['desc'] = $data['desc'];
                    $partenaire['link'] = $data['link'];
                    if($this->Partenaire->save($partenaire)){
                        $return = json_encode($partenaire);
                    }
                    else
                        $return = 1;
                }else if($data['action'] == "add"){
                    $this->Partenaire->read(null, null);
                    
                    if ($data['type'] == "D") {
                        $this->Partenaire->set([
                            "channel" => $data['channel'],
                            "pseudo" => $data['pseudo'],
                            "type" => $data['type'],
        					"desc" => $data['desc'],
                            "link" => $data['link']
                        ]);
                    } else {
                        $this->Partenaire->set([
                            "channel" => $data['channel'],
                            "pseudo" => $data['pseudo'],
                            "type" => $data['type'],
    						"desc" => $data['desc']
                        ]);
                    }
                    if($partenaire = $this->Partenaire->save()){
                        $return = json_encode([
                            "action" => "add",
                            "id" => $this->Partenaire->id,
	                        "channel" => $data['channel'],
	                        "pseudo" => $data['pseudo'],
	                        "type" => $data['type'],
							"desc" => $data['desc'],
                            "link" => $data['link']
                        ]);
                    }
                    else
                        $return = 1;
                }
            }
            else
                throw new ForbiddenException();

            $this->response->type('json');
            $this->response->body($return);
        }
    }

    public function admin_ajax_remove_partenaire(){
        if($this->isConnected AND $this->User->isAdmin()) {
            $this->layout = null;
            $this->autoRender = false;
            $return = 1;
            if ($this->request->is('post')) {
                if(isset($this->request->data['id'])){
                    $data = $this->request->data;
                    $id = (((int)$data['id']) == 0) ? "" : (int)$data['id'];
                    if(!empty($id) && is_int($id)){
                        $this->Partenaire->delete($id);
                        $return = 0;
                    }
                }
            }

            $this->response->type('json');
            $this->response->body($return);
        } else {
          throw new ForbiddenException();
        }
    }
}
