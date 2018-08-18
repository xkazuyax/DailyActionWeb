<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

class ChatsController extends AppController {
    public $webaccounts;
    public $useraccounts;
    public $sendfrom;
    public $sendto;

	public function initialize() {
		parent::initialize();
	    $this->autoRender = true;
	    $this->viewBuilder()->Layout("chats");
	    $this->webaccounts = TableRegistry::get("webaccounts");
	    $this->useraccounts = TableRegistry::get("useraccounts");
	    $this->sendfrom = TableRegistry::get("sendfrom");
	    $this->sendto = TableRegistry::get("sendto");
	}

    public function memberSelect() {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "webaccounts","action" => "index"]);
        }

        $webs = $this->webaccounts->find("all");
        $users = $this->useraccounts->find("all");
        $this->set("webs",$webs->toArray());
        $this->set("users",$users->toArray());
        $this->set("web_id",$this->request->session()->read("web_id"));
    }

    public function singleChat($account_id, $type) {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "webaccounts","action" => "index"]);
        }
        $login_name = $this->webaccounts->find("all",[
            "conditions" => [
                "id" => $this->request->session()->read("web_id")
            ]
        ]);
        $login_name = $login_name->toArray();
        $this->set("login_name",$login_name[0]->name);

        if ($type == "user") {
            $user_name = $this->useraccounts->find("all",[
                "conditions" => [
                    "id" => $account_id
                ]
            ]);
            $user_name = $user_name->toArray();
            $this->set("user_name", $user_name[0]->name);
        } else {
            $web_name = $this->webaccounts->find("all", [
                "conditions" => [
                    "id" => $account_id
                ]
            ]);
            $web_name = $web_name->toArray();
            $this->set("web_name", $web_name[0]->name);
        }
        $chat_data = $this->Chats->find("all",[
            "conditions" => [
                "web_id" => $this->request->session()->read("web_id")
            ]
        ]);
        $sendfrom = $this->sendfrom->find("all",[
            "conditions" => [
                "web_id" => $this->request->session()->read("web_id")
            ]
        ]);

        $sendto = $this->sendto->find("all",[
            "conditions" => [
                "web_id" => $this->request->session()->read("web_id")
            ]
        ]);
        $this->set("sendfrom_data", $sendfrom->toArray());
        $this->set("sendto_data", $sendto->toArray());
        $this->set("chat_data", $chat_data->toArray());
        $this->set("account_id", $account_id);
        $this->set("type", $type);
        $this->set("web_id", $this->request->session()->read("web_id"));

    }

    public function chatRegister () {
        if ($this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "webaccounts","action" => "index"]);
        }

        $this->autoRender = false;
        $web_id = $this->request->data["web_id"];
        $opponent_id = $this->request->data["opponent_id"];
        $msg = $this->request->data["msg"];
        $type = $this->request->data["type"] == "user" ? 0 : 1;
        $send_data = array("msg" => $msg,
                           "web_id" => $web_id,
                           "opponent_id" => $opponent_id,
                           "type" => $type
                          );
        $entity_sendto = $this->sendto->newEntity();
        $entity_sendto->web_id = $web_id;
        $entity_sendto->opponent_id = $opponent_id;
        $entity_sendto->type = $type;
        $entity_sendto->message = $msg;
        $entity_sendto->date = time();

        if ($this->sendto->save($entity_sendto)) {
            $entity_chat = $this->Chats->newEntity();
            $entity_chat->web_id = $entity_sendto->web_id;
            $entity_chat->sendto_id = $entity_sendto->id;
            $entity_chat->sendfrom_id = null;
        if ($this->Chats->save($entity_chat)) {

            }

        }
        echo $entity_sendto;
    }

    public function groupSelect() {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "webaccounts","action" => "index"]);
        }

        $groups = TableRegistry::get("groups");
        $this->set("groups",$groups->find("all"));
        $this->set("web_id",$this->request->session()->read("web_id"));
    }

    public function groupChat($group_id) {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "webaccounts","action" => "index"]);
        }

        $group_data = TableRegistry::get("groups");
        $group = $group_data->find("all",[
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

        $login_name = $this->webaccounts->find("all",[
                "conditions" => [
                    "id" => $this->request->session()->read("web_id")
                ]
        ]);
        $login_name = $login_name->toArray();

        $sendto_data = TableRegistry::get("sendto");
        $sendfrom_data = TableRegistry::get("sendfrom");
        $sendto = $sendto_data->find("all",[
                "opponent_id" => "g".$group_id
        ]);
        $sendfrom = $sendfrom->find("all",[
                "opponent_id" => "g".$group_id
        ]);

        $chat_data = $this->Chats->find("all",[
            "conditions" => [
                "web_id" => $this->request->session()->read("web_id")
             ]
        ]);

        $this->set("web_data",$web_data);
        $this->set("user_data",$user_data);
        $this->set("login_name",$login_name);
        $this->set("group_id",$group_id);
        $this->set("sendto_data",$sendto->toArray());
        $this->set("sendfrom_data",$sendfrom->toArray());
        $this->set("chat_data",$chat_data->toArray());
        $this->set("group_name",($group->toArray())[0]["name"]);
    }
}

?>
