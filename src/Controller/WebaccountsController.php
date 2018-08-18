<?php
    namespace App\Controller;

    use \Exception;
    use Cake\Log\Log;

    class WebaccountsController extends AppController {
        public function initialize() {
        	$this->autoRender = true;
        	$this->viewBuilder()->Layout("webaccounts");
        }

        public function index() {
        	$this->viewBuilder()->autoLayout(false);
            $entity = $this->Webaccounts->newEntity();
            $this->set("entity",$entity);
        }

        public function loginCheck() {
            $this->viewBuilder()->autoLayout(false);
            if ($this->request->isPost()) {
                $entity = $this->Webaccounts->newEntity($this->request->data);
                $login_id = $this->request->data['login_id'];
                $pass = $this->request->data['pass'];
                $webaccounts = $this->Webaccounts->find("all",[
                    "conditions" => [
                        "login_id" => $login_id,
                        "pass" => $pass
                    ]
                ]
               );
               if ($webaccounts->count() == 1) {
               	   $webaccount = $webaccounts->toArray();
               	   $web_id = $webaccount[0]["id"];
               	   $web_name = $webaccount[0]["name"];
               	   $web_role = $webaccount[0]["role"];
               	   var_dump($web_id);
                   $this->request->session()->write(["web_id" => $web_id,
                       "web_name" => $web_name,
                   	   "web_role" => $web_role
                   ]);
                   $this->redirect(["controller" => "webaccounts","action" => "webList"]);
               } else {
                   $this->set("error","IDまたはパスワードが異なります");
               }
               $this->set("entity",$entity);
        	}
        }

        public function webList() {
            if (!$this->request->session()->read("web_id")) {
                $this->request->session()->destroy();
                $this->redirect(["controller" => "webaccounts","action" => "index"]);
            }

            $webaccount_list = $this->Webaccounts->find("all");
            $this->set("webaccount_list",$webaccount_list);
        }

        public function add() {
            if(!$this->request->session()->read("web_id")) {
                $this->request->session()->destroy();
                $this->redirect(["controller" => "webaccounts","action" => "index"]);
            }

            $entity = $this->Webaccounts->newEntity();
            $this->set("entity",$entity);
        }

        public function addCheck() {
            if (!$this->request->session()->read("web_id")) {
            	$this->request->session()->destroy();
                $this->redirect(["controller" => "webaccounts","action" => "index"]);
            }

            if ($this->request->isPost()) {
                $entity = $this->Webaccounts->newEntity($this->request->data);
                $entity->create_date=time();
                $pass = $this->request->data["pass"];
                $pass2 = $this->request->data["pass2"];
                if ($this->Webaccounts->save($entity) && $pass == $pass2) {
                    $this->redirect(["controller" => "webaccounts","action" => "add_complete"]);
                } else {
                    $this->set("entity",$entity);
                    $this->set("error","on");
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
                $this->redirect(["controller" => "webaccounts","action" => "index"]);
            }

            $webaccount = $this->Webaccounts->find("all",[
                "conditions" => [
                    "id" => $id
                ]
            ]);

            if (!$webaccount) {
            	$this->redirect(["controller" => "webaccounts","action" => "webList"]);
            }

            $this->set("webaccount",$webaccount->toArray());
            $this->set("id",$id);
        }

        public function delete($id) {
            if (!$this->request->session()->read("web_id")) {
                $this->request->session()->destroy();
                $this->redirect(["controller" => "webaccounts","action" => "index"]);
            }

            try {
                $entity = $this->Webaccounts->get($id);
                $this->Webaccounts->delete($entity);
            } catch (Exception $e) {
                Log::write("debug",$e->getMessage());
            }
        }

        public function edit($id) {
            if (!$this->request->session()->read("web_id")) {
                $this->request->session()->destroy();
                $this->redirect(["controller" => "webaccounts","action" => "index"]);
            }

            $webaccount = $this->Webaccounts->find("all",[
                "conditions" => [
                    "id" => $id
                ]
            ]);

            $this->set("webaccount",$webaccount->toArray());
            $this->set("entity",$this->Webaccounts->get($id));
            $this->set("id",$id);
        }

        public function editCheck($id) {
            if (!$this->request->session()->read("web_id")) {
                $this->request->session()->destroy();
                $this->redirect(["controller" => "webaccounts","action" => "index"]);
            }

            $pass = $this->request->data["pass"];
            $pass2 = $this->request->data["pass2"];

            if ($this->request->is("put") && $pass == $pass2) {
                try {
                    $entity = $this->Webaccounts->get($id);
                    $entity->modified_date = time();
                    $this->Webaccounts->patchEntity($entity,$this->request->data);
                    if ($this->Webaccounts->save($entity)) {
                        $this->redirect(["controller" => "webaccounts","action" => "editComplete"]);
                    } else {
                        $entity = $this->Webaccounts->newEntity($id);
                        $this->set("entity",$entity);
                    }
                } catch (Exception $e) {
                    Logg::write("debug",$e->getMessage());
                }
            } else {
                $entity = $this->Webaccounts->newEntity($this->request->data);
                $this->set("entity",$entity);
                $this->set("id",$id);
                if ($pass != $pass2) {
                    $this->set("error","on");
                } else {
                    $this->set("error",false);
                }
            }
        }

        public function editComplete($id) {
            if (!$this->request->session()->read("web_id")) {
                $this->request->session()->destroy();
                $this->redirect(["controller" => "webaccounts","action" => "index"]);
            }
        }

        public function logout() {
            $this->request->session()->destroy();
            $this->redirect(["controller" => "webaccounts","action" => "index"]);
        }
    }
?>
