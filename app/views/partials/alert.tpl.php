<!-- Si un message est present dans la session -->
<?php if(!empty($_SESSION["alert"])):?>

<!-- Alert bootstrap avec en variable le type et les messages dans un tableau -->
<div class="alert-dismissible alert alert-<?=$_SESSION['alert']['type']?>" role="alert" >
  <?php foreach($_SESSION['alert']['messages'] as $message):?>
    <p><?= $message ?></p>
  <?php endforeach ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php endif ?>