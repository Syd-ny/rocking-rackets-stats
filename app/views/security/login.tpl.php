<h1>login</h1>
<form method="POST">
  <div class="mb-3">
    <label for="pseudo" class="form-label">pseudo</label>
    <input type="pseudo" class="form-control" id="pseudo" aria-describedby="pseudoHelp" name="pseudo" placeholder="pseudo">
    <div id="pseudoHelp" class="form-text">don't share it to anyone</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="*******">
  </div>
  <button type="submit" class="btn btn-primary">login</button>
</form>