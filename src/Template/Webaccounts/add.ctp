
<div class="container">
<div class="row mt-5">
<div class="col-sm-12 text-info">
<h2>制御者追加画面</h2>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<?=$this->Form->create($entity,["url" => ["controller" => "webaccounts","action" => "addCheck"]]);?>
<div class="form-group">
<label for="login_id">ID</label>
<input type="text" name="login_id" id="login_id" class="form-control form-control-lg" placeholder="10文字以内で入力してください">
</div>
<div class="form-group">
<label for ="pass">パスワード</label>
<input type="password" name="pass" id="pass" class="form-control form-control-lg" placeholder="5～10文字以内で入力してください">
</div>
<div class="form-group">
<label for="pass2">パスワード再確認</label>
<input type="password" name="pass2" id="pass2" class="form-control form-control-lg" placeholder="上記のパスワードと同様の値を入力してください">
</div>
<div class="form-group">
<label for="name">アカウント名</label>
<input type="text" name="name" id="name" class="form-control form-control-lg" placeholder="20文字以内で入力してください">
</div>
</div>
<div class="col-sm-2">
<div class="form-group">
<select name="role" class="form-control form-control-lg">
<option value="1">保守</option>
<option value="2">通常</option>
</select>
</div>
</div>
<div class="col-sm-12">
<div class="form-group">
<button type="submit" class="btn btn-lg" name="send">追加</button>
</div>
</div>
</div>
</div>
</div>
