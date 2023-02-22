<p class="display-8">
  Welcome in the Back Office of <strong>Rocking Rackets stats</strong>.<br>
  This site is collaborative with the goal to provide better datas about players ratings in GW 2 . <br>
  I trust you to don't mess up everything ;).
</p>


<div class="row mt-5">
  <div class="">
    <div class="card text-white mb-3">
      <div class="card-header bg-dark">Last updated players</div>
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">First name</th>
              <th scope="col">Last name</th>
              <th scope="col">Age</th>
              <th scope="col">country</th>
              <th scope="col">single rating</th>
              <th scope="col">double rating</th>
              <th scope="col">Updated by</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($categories as $category): ?>
            <tr>
              <th scope="row"><?=$category->getId()?></th>
              <td><?= htmlspecialchars($category->getName())?></td>
              <td class="text-end">
                <a href="" class="btn btn-sm btn-warning">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
                <!-- Example single danger button -->
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">yes, i want to delete</a>
                    <a class="dropdown-item" href="#" data-toggle="dropdown">no, i made a mistake</a>
                  </div>
                </div>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <div class="d-grid gap-2">
          <a href="<?=$router->generate('category-list')?>" class="btn btn-success">see more</a>
        </div>
      </div>
    </div>
  </div>
</div>