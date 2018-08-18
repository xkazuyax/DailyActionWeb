<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Query;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class UseraccountsTable extends Table {
    public function validationDefault(Validator $validator) {
        $validator->notEmpty("login_id","値を入力してください")->maxLength("10","10文字以内で入力してください")->ascii("login_id","半角英数字で入力してください");
        $validator->notEmpty("pass","値を入力してください")->minLength("pass","5","5文字以上で入力してください")->maxLength("pass","10","10文字以下で入力してください");
        $validator->notEmpty("pass2","値を入力してください");
        $validator->notEmpty("name","ユーザー名を入力してください");
        $validator->notEmpty("latitude","値を入力してください")->numeric("latitude","数値のみを入力してください");
        $validator->notEmpty("longitude","値を入力してください")->numeric("longitude","数値のみを入力してください");
        return $validator;
    }
}
?>