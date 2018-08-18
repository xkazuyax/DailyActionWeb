<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Query;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class GroupsTable extends Table {
    public function validationDefault(Validator $validator) {
        $validator->notEmpty("name","値を入力してください")->maxLength("name",20,"20文字以内で入力してください");
        $validator->maxLength("comment",40,"40文字以内で入力してください");
        return $validator;
    }
}

?>
