<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Chat extends Entity {
    protected $_accessible = [
        "*" => true,
        "id" => false
    ];
}
?>
