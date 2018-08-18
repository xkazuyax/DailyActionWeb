
<div class="container">
  <div class="row mt-5">
    <h1 class="text-info">チャット相手選択先</h1>
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
            <th scope="col">ログインID</th>
            <th scope="col">制御者名</th>
            <th scope="col">ログイン状態</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($webs as $web) {
            if ($web_id != $web->id) {
          ?>
              <tr>
                <td><a href="<?=$this->Url->build('/Chats/singleChat/'.$web->id.'/web');?>"><?=$web->id;?></a></td>
                <td><?=h($web->login_id);?></td>
                <td><?=h($web->name);?></td>
                <td><?php $web->token == true ? print "ログイン中" :  print "ログアウト中";?></td>
             </tr>
          <?php
            }
          }?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-sm-12">
      <h2>ユーザーアカウント</h2>
      <table class="table">
        <thead>
          <tr class="table-info">
            <th scope="col">NO</th>
            <th scope="col">ログインID</th>
            <th scope="col">ユーザー名</th>
            <th scope="col">ログイン状態</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($users as $user) {?>
            <tr>
              <td><a href="<?=$this->Url->build('/Chats/singleChat/'.$user->id.'/user');?>"><?=$user->id;?></a></td>
              <td><?=h($user->login_id);?></td>
              <td><?=h($user->name);?></td>
              <td><?php $user->token == true ? print "ログイン中" :  print "ログアウト中";?></td>
           </tr>
         <?php }?>
        </tbody>
      </table>
    </div>
  </div>
