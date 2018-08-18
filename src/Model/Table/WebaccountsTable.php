<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Query;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class WebaccountsTable extends Table {
    public function validationDefault(Validator $validator) {
        $validator->notEmpty("login_id","値を入力してください")->maxLength("login_id",10,"10文字以内で入力してください")->ascii("login_id","半角英数字のみです");
        $validator->notEmpty("pass","値を入力してください")->minLength("pass",5,"5文字以上で入力してください")->maxLength("pass",10,"10文字以内で入力してください")->ascii("pass","半角英数字のみです");
        $validator->notEmpty("pass2","値を入力してください");
        $validator->notEmpty("name","値を入力してください")->maxLength("name",20,"20文字以内で入力してください");
        return $validator;
    }
}

?>