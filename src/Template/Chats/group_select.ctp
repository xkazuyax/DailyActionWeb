<div class="container">
  <div class="row mt-5">
    <h1 class="text-info">グループチャット選択先</h1>
  </div>
  <div class="row mt-5">
    <h2>以下からチャットの相手先を選択してください</h2>
  </div>
  <div class="row mt-5">
    <div class="col-sm-12">
      <h2>制御者アカウント</h2>
      <table class="table">
        <thead>
          <tr class="table-info">
            <th scope="col">NO</th>
            <th scope="col">グループ名</th>
            <th scope="col">コメント</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $groups = $groups->toArray();
          var_dump($web_id);
          foreach($groups as $group) {
            if (preg_match("/w".$web_id."/",$group->member)) {
          ?>
              <tr>
                <td><a href="<?=$this->Url->build('/Chats/groupChat/'.$group->id.'/group');?>"><?=$group->id;?></a></td>
                <td><?=h($group->name);?></td>
                <td><?=h($group->comment);?></td>
             </tr>
          <?php
            }
          }?>
        </tbody>
      </table>
    </div>
  </div>