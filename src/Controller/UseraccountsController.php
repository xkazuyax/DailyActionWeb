<?php
namespace App\Controller;

use \Exception;
use Cake\Log\Log;

class UseraccountsController extends AppController {
    public function initialize() {
        $this->autoRender = true;
        $this->viewBuilder()->Layout("useraccounts");
    }

    public function userList() {
        if (!$this->request->session()->read("web_id")) {
        	$this->request->session()->destroy();
        	$this->redirect(["controller" => "webaccounts","action" => "index"]);
        }

        $users = $this->Useraccounts->find("all");
        $this->set("users",$users->toArray());
    }

    public function add() {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "webaccounts","action" => "index"]);
        }

        $this->set("entity",$this->Useraccounts->newEntity());
    }

    public function addCheck() {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "webaccounts","action" => "index"]);
        }

        if ($this->request->isPost()) {
            $pass = $this->request->data["pass"];
            $pass2 = $this->request->data["pass2"];

            $entity = $this->Useraccounts->newEntity($this->request->data);
            $entity->create_date = time();

            if ($this->Useraccounts->save($entity) && $pass == $pass2) {
                $this->redirect(["controller" => "useraccounts","action" => "add_complete"]);
            } else {
                if ($pass != $pass2) {
                    $this->set("error","パスワードが異なります");
                } else {
                    $this->set("error",false);
                }
                $this->set("entity",$this->Useraccounts->newEntity($this->request->data));
            }
        }
    }

    public function addComplete() {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "webaccounts","action" => "index"]);
        }
    }

    public function detail($id) {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "Webaccounts","action" => "index"]);
        }

        $user = $this->Useraccounts->find("all",[
            "conditions" => [
                "id" => $id
            ]
        ]);

        $this->set("user",$user->toArray());
        $this->set("id",$id);
    }

    public function delete($id) {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "Webaccounts","action" => "index"]);
        }

        try {
            $entity = $this->Useraccounts->get($id);
            $this->Useraccounts->delete($entity);
            $this->redirect(["controller" => "Useraccounts","action" => "deleteComplete"]);
        } catch(Exception $e) {
            Log::write("debug",$e->getMessage());
        }
    }

    public function deleteComplete() {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "webaccounts","action" => "index"]);
        }
    }

    public function edit($id) {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "webaccounts","action" => "index"]);
        }

        $entity = $this->Useraccounts->get($id);
        $this->set("entity",$entity);
        $this->set("id",$id);
    }

    public function editCheck($id) {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "Webaccounts","action" => "index"]);
        }
        $pass =$this->request->data["pass"];
        $pass2 = $this->request->data["pass2"];

        if ($this->request->is("put") && $pass == $pass2) {
            try {
                $entity = $this->Useraccounts->get($id);
                $entity->modified_date = time();
                $this->Useraccounts->patchEntity($entity,$this->request->data);
                if ($this->Useraccounts->save($entity)) {
                    $this->redirect(["controller" => "Useraccounts","action" => "editComplete"]);
                } else {
                	$this->set("entity",$entity);
                }
            } catch (Exception $e) {
           	    Log::write("debug",$e->getMessage());
            }
        } else {
            if ($pass != $pass2 ) {
                $error = "パスワードが異なります";
            } else {
            	$error = null;
            }
            $this->set("error",$error);
            $this->set("entity",$this->Useraccounts->newEntity($this->request->data));
            $this->set("id",$id);
        }
    }

    public function editComplete() {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "Useraccounts","action" => "index"]);
        }
    }

    public function posRegister() {
    	$this->autoRender = false;
    	$data = array("longitude" => $this->request->data["longitude"],"latitude" => $this->request->data["latitude"]);
    	$useraccount = $this->Useraccounts->get(2);
    	$useraccount->longitude = $this->request->data["longitude"];
    	$useraccount->latitude = $this->request->data["latitude"];
    	if ($this->Useraccounts->save($useraccount)) {
    		echo  json_encode($data);
    	}
    }
}

?>
