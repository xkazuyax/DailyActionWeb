
<div class="container">
<div class="row mt-5 mb-5">
<div class="col-sm-12">
<h2 class="text-info text-center">ユーザー追加</h2>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<?=$this->Form->create($entity,["url" => ["controller" => "useraccounts","action" => "addCheck"]]);?>
<div class="form-group">
<label for="login_id">ログインID</label>
<input type="text" name="login_id" class="form-control form-control-lg" placeholder="10文字以内で入力してください" maxLength="10">
<div class="error text-danger"><?=$this->Form->error("login_id");?></div>
</div>
<div class="form-group">
<label for="pass">パスワード</label>
<input type="password" name="pass" class="form-control form-control-lg" placeholder="5～10文字以内で入力してください" maxLength="10" minLength="5">
<div class="error text-danger"><?=$this->Form->error("pass");?></div>
</div>
<div class="form-group">
<label for="pass2">パスワード再確認</label>
<input type="password" name="pass2" class="form-control form-control-lg" placeholder="上記とパスワードを入力してください" maxLength="10" minLength="5">
<div class="error text-danger"><?=$this->Form->error("pass2");?></div>
<?php
if ($error) {
?>
<div class="text-danger"><p>パスワードが異なります</p></div>
<?php
}
?>
</div>
<div class="form-group">
<label for="name">ユーザー名</label>
<input type="text" name="name" class="form-control form-control-lg" placeholder="10文字以内で入力してください" maxLength="10">
<div class="error text-danger"><?=$this->Form->error("login_id");?></div>
</div>
<div class="form-group">
<label for="picture">顔写真アップロード</label>
<input type="text" name="picture" class="form-control form-control-lg" placeholder="顔写真をアップロードしてください">
</div>
<div class="form-group">
<label for="latitude">緯度</label>
<input type="text" name="latitude" class="form-control form-control-lg" placeholder="緯度を入力してください">
<div class="text-danger error"><?=$this->Form->error("latitude");?></div>
</div>
<div class="form-group">
<label for="longitude">経度</label>
<input type="text" name="longitude" class="form-control form-control-lg" placeholder="経度を入力してください">
<div class="text-danger error"><?=$this->Form->error("longitude");?></div>
</div>
<input type="submit" name="submit" class="btn btn-lg btn-info" value="追加">
</div>
</div>
</div>
