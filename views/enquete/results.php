<div class="row">
	
	<div class="col-md-12">
		
		<h1 class="page-title"><a href="<?= URL; ?>">Questionmark?</a></h1>

	</div>

</div>

<div class="row content">
	
	<?php 

		$sessions = $this->sessions;
		$results = $this->results;

	?>

	<pre><? print_r($results); ?></pre>

	<div class="col-md-4">

		<ul class="list-group">

			<?php $counter = 1; ?>
		
			<?php foreach($sessions as $session) { ?>

				<a href="<?= URL; ?>enquete/results/<?= $session['Enquete_id']; ?>/<?= $session['id']; ?>" class="list-group-item">Ingevulde enquête <?= $session['id']; ?></a>

			<?php $counter++; } ?>

		</ul>

	</div>

	<div class="col-md-8">
		
		<?php foreach($results as $result) { ?>

			<div class="panel panel-default">
				
				

			</div>

		<?php } ?>

	</div>

</div>