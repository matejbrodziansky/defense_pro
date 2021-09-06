<?php

?>

<div id="adminContent">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="">
                    <h2><?= $pageHeaderTitle; ?></h2>
                </div>
                <div class="card-body pt-0">
                    <form method="post">
                        <fieldset>
                            <legend>Evidencia o vozidle</legend>
                            <div class="row">
                                <div class="col-md-3 col-sm-12 form__input-container mb-2">
                                    <label for="">ŠPZ vozidla: *</label>
                                    <input type="text" maxlength="64" class="form-control js-clientSuggestion" name="vrn" id="evc" autocomplete="off" required>
                                </div>
                                <div class="col-md-3 col-sm-12 form__input-container mb-2">
                                    <label for="">City: *</label>
                                    <input type="text" maxlength="64" class="form-control js-clientSuggestion" name="city" id="evc" autocomplete="off" required>
                                </div>

                                <div class="col-md-3 col-sm-12 form__input-container mb-2">
                                    <label for="capture_date">Dátum priestupku *</label>
                                    <input class="form-control" type="date" name="date" id="datePicker" value="<?= date('d.m.Y') ?>" required>
                                </div>
                                <div class="col-md-3 col-sm-12 form__input-container mb-2">
                                    <label for="">V čase</label>
                                    <input type="text" maxlength="32" value="<?php echo date('H:i:s'); ?>" class="form-control" name="time" id="time">
                                </div>
                                <div class="col-md-3 col-sm-12 form__input-container mb-2">
                                    <label hidden for="">Latitude</label>
                                    <input hidden type="text" maxlength="32" value="" class="form-control" name="latitude" id="latitude">
                                </div>
                                <div class="col-md-3 col-sm-12 form__input-container mb-2">
                                    <label hidden for="">Longitude</label>
                                    <input hidden type="text" maxlength="32" value="" class="form-control" name="longitude" id="longitude">
                                </div>
                                <div class="col-md-12 col-sm-12 form__input-container mb-2">
                                    <label for="capture_by_paragraph_id">Paragraf*</label>
                                    <select multiple class="form-control full select2" id="capture_by_paragraph_id" name="paragraphs[]" required>
                                        <?php
                                        foreach ($paragraphs as $paragraph) {
                                        ?>
                                            <option value="<?= $paragraph['id'] ?>"> <?= $paragraph['paragraph'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                        </fieldset>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-0">
                                    <input type="submit" class="btn btn-success" id="formConfirm">
                                    <button class="btn btn-primary" formtarget="_blank" formaction="<?= base_url('admin/traffic/show_pdf') ?>">Zobraz PDF</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script>
    $('.select2').select2();
</script>



<!-- SET GPS TO INPUT -->
<script>
    (function autoGetGpsLocation() {

        // var x = document.getElementById("demo");


        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }

        function showPosition(position) {
            var latitude = position.coords.latitude,
                longitude = position.coords.longitude;

            $('#latitude').val(latitude);
            $('#longitude').val(longitude);
        }


    })();
</script>


<!-- SET DATE TO INPUT -->
<script>
    var now = new Date();

    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);

    var today = now.getFullYear() + "-" + (month) + "-" + (day);

    $('#datePicker').val(today);
</script>