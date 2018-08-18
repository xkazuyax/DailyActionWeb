
<div class="container">
<div class="row mt-5">
<div class="col-sm-12 text-info">
<h2 class="text-center">制御者追加画面</h2>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<?=$this->Form->create($entity,["url" => ["controller" => "webaccounts","action" => "editCheck/".$id]]);?>
<div class="form-group">
<label for="id">ID</label>
<input type="text" id="id" name="id" class="form-control form-control-lg" disabled value="<?=h($entity->id);?>">
</div>
<div class="form-group">
<label for="pass">パスワード</label>
<input type="password" id="pass" name="pass" class="form-control form-control-lg" value="<?=h($entity->pass);?>">
</div>
<div class="form-group">
<label for="pass2">パスワード再確認</label>
<input type="password" id="pass2" name="pass2" class="form-control form-control-lg" value="<?=h($entity->pass);?>">
</div>
<div class="form-group">
<label for="name">制御者アカウント名</label>
<input type="text" id="name" name="name" class="form-control form-control-lg" value="<?=h($entity->name);?>">
</div>
</div>
<div class="col-sm-2">
<div class="form-group">
<select name="role" class="form-control form-control-lg">
<option value=1>保守</option>
<option value=2>通常</option>
</select>
</div>

<input type="submit" name="submit" value="編集" class="btn btn-info btn-lg">
</div>
</div>
</div>
