
<div class="container">
<div class="row">
<div class="col-sm-12">
<h2 class="text-info text-center">ユーザー編集画面</h2>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<?=$this->Form->create($entity,["url" => ["controller" => "Useraccounts","action" => "editCheck/".$id]]);?>
<div class="form-group">
<label for="login_id">ログインID</label>
<input type="text" id="login_id" name="login_id" class="form-control" maxLength="10" value="<?=h($entity->login_id);?>">
</div>
<div class="form-group">
<label for="pass">パスワード</label>
<input type="password" id="pass" name="pass" class="form-control" maxLength="10" value="<?=h($entity->pass);?>">
</div>
<div class="form-group">
<label for="pass2">パスワード再確認</label>
<input type="password" id="pass2" name="pass2" class="form-control" maxLength="10" value="<?=h($entity->pass);?>">
</div>
<div class="form-group">
<label for="name">ユーザー名</label>
<input type="text" id="name" name="name" class="form-control" maxLength="20" value="<?=h($entity->name);?>">
</div>
<div class="form-group">
<label for="picture">顔写真アップロード</label>
<input type="text" name="picture" id="picture" class="form-control" value="<?=h($entity->picture);?>">
</div>
<div class="form-group">
<label for="latitude">緯度</label>
<input type="text" name="latitude" id="latitude" class="form-control" value="<?=h($entity->latitude);?>">
</div>
<div class="form-group">
<label for="longitude">経度</label>
<input type="text" name="longitude" id="longitude" class="form-control" value="<?=h($entity->longitude);?>">
</div>
<div class="form-group">
<input type="submit" name="submit" class="btn btn-info btn-lg" value="編集">
</div>
</div>
</div>
</div>
