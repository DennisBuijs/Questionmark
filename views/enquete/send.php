<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=276231042510173&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

  var url = window.location.href;
  var id = url.split("/");
  var id = id[id.length-1];

  var share_url = "<?= URL; ?>enquete/index/"+id;

</script>

<div class="container">

  <div class="col-md-8 col-md-push-2">

    <h1 class="page-title"><a href="<?= URL; ?>">Questionmark?</a></h1>
    <a href="<?= URL ?>enquete/run" data-action="main-form" class="btn btn-primary pull-right run-form" style="margin-top:-40px;">Verstuur</a>
  
  </div>

  <div class="row">
    
    <div class="col-md-8 col-md-push-2 content">
      
      <ul class="list-group">
        <form class="main-form" action="<?= URL ?>enquete/run" method="post">
          <textarea name="message"  class="form-control" rows="12">
          </textarea>
          <div>U kunt de volgende tags gebruiken: <b>{{first_name}}</b>, <b>{{last_name}}</b> en <b>{{email}}</b></div><br>
          <input type="hidden" class="form-control" name="type" value="send">
          <input type="hidden" class="form-control" name="form_id" value="<?= $this->form_id ?>">
          <? foreach ($this->contacts as $contact) : ?>   
            <li class="list-group-item"><input type="checkbox" name="contacts[]" value="<?= $contact['id'] ?>"> - <?= $contact['first_name'] . " " . $contact['first_name']; ?> <small><?= $contact['email'] ?></small></li>        
          <? endforeach; ?>
        </form>

      </ul>

    </div>

    <div class="col-md-8 col-md-push-2 content">
      
      <div class="fb-share-button" id="fb-share" data-href="" data-type="button_count"></div>

      <a href="https://twitter.com/share" class="twitter-share-button" id="tw-share" data-url="share_url">Tweet</a>
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    </div>

  </div>

</div>

<script>
  document.getElementById("fb-share").setAttribute("data-href", share_url);
  document.getElementById("tw-share").setAttribute("data-url", share_url);
</script>