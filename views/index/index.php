
<div class="container">

  <div class="row">

    <div class="col-md-8 col-md-push-2">

      <h1>QuestionFriet?</h1>

    </div>

  </div>


  <div class="row content">

    <div class="col-md-8 col-md-push-2">

      <? foreach ($this->enquetes as $enquete) : ?> 
      <pre><? print_r($enquete); ?></pre>
      <br><br><br>
      <? endforeach; ?>

    </div>

  </div>