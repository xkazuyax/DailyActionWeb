<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class GroupsController extends AppController {
    public function initialize() {
        $this->autoRender = true;
        $this->viewBuilder()->Layout("groups");
    }

    public function groupList() {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "Webaccounts","action" => "index"]);
        }

        $groups = $this->Groups->find("all");
        $this->set("groups",$groups->toArray());
    }

    public function add() {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "Webaccounts","action" => "index"]);
        }

        $this->set("entity",$this->Groups->newEntity());
    }

    public function addCheck() {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "Webaccounts","action" => "index"]);
        }

        if ($this->request->isPost()) {
            $entity = $this->Groups->newEntity($this->request->data);
            $entity->create_date = time();
            if ($this->Groups->save($entity)) {
                $this->redirect(["controller" => "Groups","action" => "addComplete"]);
            }
        } else {
            $entity = $this->Groups->newEntity();
        }

        $this->set("entity",$entity);
    }

    public function addComplete() {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "Webaccounts","action" => "index"]);
        }
    }

    public function detail($id) {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "Webaccounts","action" => "index"]);
        }

        $group = $this->Groups->find("all",[
            "conditions" => [
                "id" => $id
            ]
        ]);
        $this->set("group",$group->toArray());
    }

    public function edit($id) {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "Webaccounts","action" => "index"]);
        }

        $group = $this->Groups->find("all",[
            "conditions" => [
                "id" => $id
            ]
        ]);

        $entity = $this->Groups->get($id);
        $this->set("entity",$entity);
        $this->set("group",$group->toArray());
    }

    public function editCheck($id) {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "webaccounts","action" => "index"]);
        }

        if ($this->request->is("put")) {
            try {
                $entity = $this->Groups->get($id);
                $entity->modified_date = time();
                $this->Groups->patchEntity($entity,$this->request->data);
                if ($this->Groups->save($entity)) {
                    $this->redirect(["controller" => "groups","action" => "editComplete"]);
                } else {
                    $entity = $this->Groups->newEntity($entity);
                    $this->set("entity",$this->request->data);
                }
            } catch (Exception $e) {
                Logg::write("debug",$e->getMessage());
            }
        } else {
            $entity = $this->request->data;
        }
        $this->set("entity",$entity);
    }

    public function editComplete() {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "groups","action" => "index"]);
        }
    }

    public function delete($id) {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "webaccounts","action" => "index"]);
        }

        try {
            $entity = $this->Groups->get($id);
            $this->Groups->delete($entity);
        } catch(Exception $e) {
            Log::write("debug",$e->getMessage());
        }
    }

    public function memberList($group_id) {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "webaccounts","action" => "index"]);
        }


        $group = $this->Groups->find("all",[
            "conditions" => [
                "id" => $group_id
            ]
        ]);
        $members = ($group->toArray())[0]["member"];
        $web_data = array();
        $user_data = array();

        while (preg_match("/w|u/", $members)) {
            if (preg_match("/w/",$members)) {
                $members = substr($members,1);

                if (preg_match("/w/",$members)) {
                    array_push($web_data,substr($members,0,strpos($members,"w")));
                    $members = substr($members,1);
                } elseif (preg_match("/u/",$members)) {
                    array_push($web_data,substr($members,0,strpos($members,"u")));
                    $members = substr($members,1);
                } else {
                    array_push($web_data,substr($members,0));
                }
            } elseif (preg_match("/u/",$members)) {
                $members = substr($members,1);
                if (preg_match("/w/",$members)) {
                    array_push($user_data,substr($members,0,strpos($members,"w")));
                    $members = substr($members,1);
                } elseif (preg_match("/u/",$members)) {
                    array_push($user_data,substr($members,0,strpos($members,"u")));
                    $members = substr($members,1);
                } else {
                    array_push($user_data,substr($members,0));
                }
            }
        }

        $webaccounts = TableRegistry::get("webaccounts");
        $useraccounts = TableRegistry::get("useraccounts");
        $this->set("webaccounts",$webaccounts->find("all"));
        $this->set("useraccounts",$useraccounts->find("all"));
        $this->set("web",$web_data);
        $this->set("user",$user_data);
    }

    public function memberEdit($group_id) {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "webaccounts","action" => "index"]);
        }

        $group = $this->Groups->find("all",[
            "conditions" => [
                "id" => $group_id
            ]
        ]);

        $members = ($group->toArray())[0]["member"];
        $web_data = array();
        $user_data = array();

        while (preg_match("/w|u/", $members)) {
            if (preg_match("/w/",$members)) {
                $members = substr($members,1);

                if (preg_match("/w/",$members)) {
                    array_push($web_data,substr($members,0,strpos($members,"w")));
                    $members = substr($members,1);
                } elseif (preg_match("/u/",$members)) {
                    array_push($web_data,substr($members,0,strpos($members,"u")));
                    $members = substr($members,1);
                } else {
                    array_push($web_data,substr($members,0));
                }
            } elseif (preg_match("/u/",$members)) {
                $members = substr($members,1);
                if (preg_match("/w/",$members)) {
                    array_push($user_data,substr($members,0,strpos($members,"w")));
                    $members = substr($members,1);
                } elseif (preg_match("/u/",$members)) {
                    array_push($user_data,substr($members,0,strpos($members,"u")));
                    $members = substr($members,1);
                } else {
                    array_push($user_data,substr($members,0));
                }
            }
        }
        $webaccounts = TableRegistry::get("webaccounts");
        $useraccounts = TableRegistry::get("useraccounts");
        $this->set("webaccounts",$webaccounts->find("all"));
        $this->set("useraccounts",$useraccounts->find("all"));
        $this->set("web",$web_data);
        $this->set("user",$user_data);
        $this->set("entity",$this->Groups->newEntity());
        $this->set("group_id",$group_id);
    }

    public function memberEditCheck($group_id) {
        $this->autoRender = false;
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "webaccounts","action" => "index"]);
        }

        if ($this->request->is("post")) {
            $webs = $this->request->data["web"];
            $users = $this->request->data["user"];
            $web_ids_array = array();
            $user_ids_array = array();
            foreach ($webs as $web) {
                $web_id = "w".$web;
                array_push($web_ids_array,$web_id);
            }

            foreach ($users as $user) {
                $user_id = "u".$user;
                array_push($user_ids_array,$user_id);
            }
            $web_ids = implode($web_ids_array);
            $user_ids = implode($user_ids_array);
            $group_member = $web_ids.$user_ids;
            $entity = $this->Groups->get($group_id);
            $entity->member = $group_member;
            $entity->modified_date = time();
            if ($this->Groups->save($entity)) {
                $this->redirect(["controller" => "Groups","action" => "editComplete"]);
            }
        }
    }
}
?>
