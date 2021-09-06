<style>
    .modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}
body.loading .modal {
    overflow: hidden;   
}

body.loading .modal {
    display: block;
}
</style>

<div id="adminContent">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="">
                    <h2><?= $pageHeaderTitle; ?></h2>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Doplnenie informácii</legend>
                        <div class="row">
                            <div class="col-md-3 col-sm-12 form__input-container mb-2">
                                <label for="">ŠPZ vozidla: *</label>
                                <input type="text" maxlength="64" class="form-control js-clientSuggestion" value="<?= $traffic_disruption['vrn'] ?>" name="vrn" id="evc" autocomplete="off" required>
                            </div>
                            <div class="col-md-3 col-sm-12 form__input-container mb-2">
                                <label for="">City: *</label>
                                <input type="text" maxlength="64" class="form-control js-clientSuggestion" value="<?= $traffic_disruption['city'] ?>" name="city" id="evc" autocomplete="off" required>
                            </div>
                            <div class="col-md-3 col-sm-12 form__input-container mb-2">
                                <label for="">Dňa</label>
                                <input readonly type="text" maxlength="32" value="<?= date("d.m.Y", strtotime($traffic_disruption['date'])) ?>" class="form-control" name="time" id="time">
                            </div>

                            <div class="col-md-3 col-sm-12 form__input-container mb-2">
                                <label for="">V čase</label>
                                <input readonly type="text" maxlength="32" value="<?= date("H:i:s", strtotime($traffic_disruption['date'])) ?>" class="form-control" name="date" id="date">
                            </div>
                            <div class="col-md-4 col-sm-12 form__input-container mb-2">
                                <label for="">Foto auta</label>
                                <input type="file" maxlength="32" value="" class="form-control" name="car_image">

                                <?php if (isset($traffic_disruption['car_image']) && !empty($traffic_disruption['car_image'])) : ?>
                                    <div class="image-wrapper" style="max-width: 100%;">
                                        <img style="max-width: 100%; margin-top: 10px; object-fit:contain; display: block;" src="<?= base_url("uploads/traffic/" . $traffic_disruption['vrn'] . "/" . $traffic_disruption['id'] . '/' . $traffic_disruption['car_image']) ?>" alt="">
                                        <button style="width: 100%; margin-top: 10px;" class="btn btn-danger delete-image" type="button" data-image="car_image">Odstrániť</button>
                                    </div>
                                    <input type="hidden" name="car_image_delete" value="0">
                                <?php endif; ?>
                            </div>
                            <div class="col-md-4 col-sm-12 form__input-container mb-2">
                                <label for="">Predná foto</label>
                                <input type="file" maxlength="32" value="" class="form-control" name="front_image">

                                <?php if (isset($traffic_disruption['front_image']) && !empty($traffic_disruption['front_image'])) : ?>
                                    <div class="image-wrapper" style="max-width: 100%;">
                                        <img style="max-width: 100%; margin-top: 10px; object-fit:contain; display: block;" src="<?= base_url("uploads/traffic/" . $traffic_disruption['vrn'] . "/" . $traffic_disruption['id'] . '/' . $traffic_disruption['front_image']) ?>" alt="">
                                        <button style="width: 100%; margin-top: 10px;" class="btn btn-danger delete-image" type="button" data-image="front_image">Odstrániť</button>
                                    </div>
                                    <input type="hidden" name="front_image_delete" value="0">
                                <?php endif; ?>
                            </div>

                            <div class="col-md-4 col-sm-12 form__input-container mb-2">
                                <label for="">Fotka dokumentu</label>
                                <input type="file" maxlength="32" value="" class="form-control" name="document_image">

                                <?php if (isset($traffic_disruption['document_image']) && !empty($traffic_disruption['document_image'])) : ?>
                                    <div class="image-wrapper" style="max-width: 100%;">
                                        <img style="max-width: 100%; margin-top: 10px; object-fit:contain; display: block;" src="<?= base_url("uploads/traffic/" . $traffic_disruption['vrn'] . "/" . $traffic_disruption['id'] . '/' . $traffic_disruption['document_image']) ?>" alt="">
                                        <button style="width: 100%; margin-top: 10px;" class="btn btn-danger delete-image" type="button" data-image="document_image">Odstrániť</button>
                                    </div>
                                    <input type="hidden" name="document_image_delete" value="0">
                                <?php endif; ?>
                            </div>
                            <div class="col-md-12 col-sm-12 form__input-container mb-2">
                                <label for="capture_by_paragraph_id">Paragraf*</label>
                                <select multiple class="form-control full select2" id="capture_by_paragraph_id" name="paragraphs[]" required>
                                    <?php
                                    foreach ($paragraphs as $paragraph) {
                                    ?>
                                        <option <?php if (isset($selected_paragraphs_ids) && !empty($selected_paragraphs_ids) && in_array($paragraph['id'], ($selected_paragraphs_ids))) {
                                                    echo 'selected';
                                                } ?> value="<?= $paragraph['id'] ?>"> <?= $paragraph['paragraph'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                    </fieldset>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-success" id="formConfirm">Odoslať</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal"></div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script>
    var selectTwo = $('.select2');
    $('.delete-image').on('click', function() {
        var self = $(this),
            data = self.data(),
            wrapper = self.closest('.image-wrapper');

        wrapper.remove();
        $('[name="' + data.image + '_delete"]').val(1);
    });
    selectTwo.select2();
</script>

<script>
    $('form').submit(function(e) {
        var trafficEditUrl = '<?= base_url('admin/traffic/edit/' . $traffic_disruption['id']) ?>',
            trafficPdftUrl = '<?= base_url('admin/traffic/pdf/' . $traffic_disruption['id']) ?>',
            trafficShowtUrl = '<?= base_url('admin/traffic') ?>';
        $body = $("body");

        $(document).on({
            ajaxStart: function() {
                $body.addClass("loading");
            },
            ajaxStop: function() {
                $body.removeClass("loading");
            }
        });
        $(this).css({
            background: 'gray'
        });

        $.ajax({
            url: trafficEditUrl,
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(data) {


                window.open(trafficPdftUrl);
                window.location.href = trafficShowtUrl;
            },
            error: function(xhr, ajaxOptions, thrownerror) {}
        });
        e.preventDefault();
    });
</script>