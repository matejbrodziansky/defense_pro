<div id="adminContent">
	<a href="<?= base_url('admin/traffic/create'); ?>" class="btn btn-success mb-3 add-tablet"><i class="fas fa-plus"></i></a>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="row">
					<div class="col-12 d-flex justify-content-between heading-container">
						<h2 class="page-heading"><i class="fas fa-truck"></i>Doprava</h2>
						<div>
							<a href="<?= base_url('admin/traffic/create') ?>" class="btn btn-success add-tablet-hidden"><i class="fas fa-plus"></i> Pridať poučenie</a>
						</div>
					</div>
				</div>
				<div class="row pt-2 ">
					<div class="col-12 ">
						<div class="d-md-flex d-sm-block justify-content-between align-items-start ">
							<div class="d-flex custom-group d-flex">
								<form method="get" class="d-flex custom-form js-submit-form ">
									<input type="text" name="dateRange" placeholder="Dátum" class="js-date-range mr-1 form-control search-form__search js-filterInput" autocomplete="off" value="<?= $this->input->get('dateRange') ?>">
									<input type="text" name="search" placeholder="Vyhľadávanie" class="form-control search-form__search js-filterInput" data-wait="500" value="<?= $this->input->get('search') ?>">
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php
				foreach ($traffic_disruptions as $disruption) {
				?>

					<div class="col-12 d-flex justify-content-between heading-container border-top border-secondary">
						<p style="font-weight: bold;"><a href="<?= base_url('admin/traffic/edit/' . $disruption['id']); ?>"> # <?= $disruption['id']; ?></a></p>
						<div class="d-flex position-relative">
							<button class="view-more js-view-more"><i class="fas js-icon fa-ellipsis-h"></i></button>

							<div class="responsive-card__options js-options responsive-card__options--is-hidden shadow">
								<a href="<?= base_url('admin/traffic/pdf/' . $disruption['id']); ?>" target="_blank" class="btn btn-sm"><i class="fas fa-print"></i>Vytlačiť</a>
								<a href="<?= base_url('admin/traffic/edit/' . $disruption['id']); ?>" class="btn btn-sm"><i class="fas fa-edit"></i>Upraviť</a>
								<form action="<?= base_url('admin/traffic/delete/' . $disruption['id']); ?>" method="post">
									<input hidden class="btn btn-danger" name="id" value="<?= $disruption['id'] ?>">
									<input hidden class="btn btn-danger" name="vrn" value="<?= $disruption['vrn'] ?>">
									<button style="margin-top: 10px; margin-left: 10px ;" class="btn btn-sm options__delete"><i class="fas fa-trash-alt">Odstrániť</i></button>
								</form>
							</div>
						</div>
					</div>

					<div class="col-12 d-flex justify-content-between heading-container">
						<p style="font-weight: bold;"> Priestupok vypracoval:</p>
						<p><?= $disruption['created_by']; ?></p>
					</div>
					<div class="col-12 d-flex justify-content-between heading-container">
						<p style="font-weight: bold;">Spoločnosť:</p>
						<p>Defense Pro, s.r.o.</p>
					</div>
					<div class="col-12 d-flex justify-content-between heading-container">
						<p style="font-weight: bold;">Dátum priestupku:</p>
						<!-- <p>< ?= $disruption['date']; ?></p> -->
						<p><?= date("d.m.Y", strtotime($disruption['date'])) . '  ' . date("H:i:s", strtotime($disruption['date']))  ?></p>
						<!-- <p>< ?= date($disruption['date'], "Y/m/d H:i:s");; ?></p> -->

					</div>
					<div style="font-weight: bold;" class="col-12 d-flex justify-content-between heading-container">
						<p style="font-weight: bold;">Miesto priestupku:</p>
						<p><?= $disruption['city']; ?></p>
					</div>

				<?php
				}
				?>
			</div>
		</div>
	</div>
</div>

<script>
	var isOpen = false;

	$(document).on('click', '.js-view-more', function() {
		$('.js-icon').removeClass('fa-times').addClass('fa-ellipsis-h');
		var elementHeightPercentage = Math.floor(($(this).offset().top / document.body.scrollHeight) * 100);
		$('.js-table-options').addClass('options--is-hidden');
		$(this).siblings('.js-table-options').removeClass('options--is-hidden');
		$('.js-options').addClass('responsive-card__options--is-hidden');
		if (isOpen) {
			$(this).siblings('.js-table-options').addClass('options--is-hidden').removeClass(`${elementHeightPercentage > 90 ? 'options__from-top' : ''}`);
			isOpen = !isOpen
			$(this).children().removeClass('fa-times').addClass('fa-ellipsis-h');
			$(this).siblings('.js-options').addClass('responsive-card__options--is-hidden')
		} else {
			$(this).siblings('.js-table-options').removeClass('options--is-hidden').addClass(`${elementHeightPercentage > 90 ? 'options__from-top' : ''}`);
			isOpen = !isOpen
			$(this).children().removeClass('fa-ellipsis-h').addClass('fa-times');
			$(this).siblings('.js-options').removeClass('responsive-card__options--is-hidden').addClass(`${elementHeightPercentage > 90 ? 'responsive-card__options--from-top' : ''}`);
		}
	})

	$(document).click(function(event) {
		$target = $(event.target);
		if (!$target.closest('.js-view-more').length) {
			$('.js-table-options').addClass('options--is-hidden');
			$('.js-icon').removeClass('fa-times').addClass('fa-ellipsis-h');
			$('.js-options').addClass('responsive-card__options--is-hidden')
			isOpen = false;
		}
	});
</script>