<section class="content">
    <div class="card">
        <div class="card-header with-border">
            <h3><?= $Lang->get("PARTENAIRE"); ?></h3>
        </div>
        <div class="card-body">
            <h1><?= $Lang->get("ADD_PARTENAIRE"); ?></h1>
            <div id="error_msg"></div>
            <button type="button" class="btn btn-large btn-block btn-success" onclick="PARTENAIRE.addPartenaire()">
                <?= $Lang->get("ADD_PARTENAIRE") ?>
            </button>
            <hr>

            <h1><?= $Lang->get("LIST_PARTENAIRE"); ?></h1>

            <table class="table table-hover" id="partenaire_list">
                <thead>
                    <tr>
                        <th><?= $Lang->get('PARTENAIRE_ID') ?></th>
                        <th><?= $Lang->get('PARTENAIRE_CHANNEL') ?></th>
                        <th><?= $Lang->get('PARTENAIRE_PSEUDO') ?></th>
                        <th><?= $Lang->get('PARTENAIRE_TYPE') ?></th>
                        <th><?= $Lang->get('GLOBAL__ACTIONS') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($partenaires as $v): $v = current($v);?>
                        <tr id="partenaire-<?= $v['id'] ?>">
                            <th id="partenaire-<?= $v['id'] ?>-Id"><?= $v['id'] ?></th>
                            <td id="partenaire-<?= $v['id'] ?>-Channel"><?= $v['channel'] ?></td>
                            <td id="partenaire-<?= $v['id'] ?>-Pseudo"><?= $v['pseudo'] ?></td>
                            <?php if ($v['type'] == 'T') { ?>
                                <td id="partenaire-<?= $v['id'] ?>-Plateforme">Twitter</td>
                            <?php } ?>
                            <?php if ($v['type'] == 'Y') { ?>
                                <td id="partenaire-<?= $v['id'] ?>-Plateforme">Youtube</td>
                            <?php } ?>
                            <?php if ($v['type'] == 'F') { ?>
                                <td id="partenaire-<?= $v['id'] ?>-Plateforme">Facebook</td>
                            <?php } ?>
                            <?php if ($v['type'] == 'A') { ?>
                                <td id="partenaire-<?= $v['id'] ?>-Plateforme">Autre</td>
                            <?php } ?>
                            <td>
                                <a href="#" onclick="PARTENAIRE.editPartenaire(<?= $v['id'] ?>);" class="btn btn-info"><?= $Lang->get('GLOBAL__EDIT') ?></a>
                                <a href="#" onclick="PARTENAIRE.removePartenaire(<?= $v['id'] ?>);" class="btn btn-danger"><?= $Lang->get('GLOBAL__DELETE') ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!--   PARTENAIRE Form Modal -->
<div class="modal fade" id="partenaire_modal" tabindex="-1" role="dialog" aria-labelledby="partenaire_modal_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="add_partenaire_modal_label"><?= $Lang->get("ADD_PARTENAIRE") ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="partenaire_form" action="">
                <div class="modal-body">
                    <div id="modal_alert_msg"></div>
                    <input type="hidden" name="action" id="action">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="channel"><?= $Lang->get("PARTENAIRE_ADD_CHANNEL") ?></label>
                        <input type="text" class="form-control" id="channel" name="channel" placeholder="<?= $Lang->get("PARTENAIRE_ADD_CHANNEL_PLACEHOLDER") ?>">
                        <label for="pseudo"><?= $Lang->get("PARTENAIRE_ADD_PSEUDO") ?></label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="<?= $Lang->get("PARTENAIRE_ADD_PSEUDO_PLACEHOLDER") ?>">
                        <label for="desc"><?= $Lang->get("PARTENAIRE_ADD_DESC") ?></label>
                        <input type="text" class="form-control" id="desc" name="desc" placeholder="<?= $Lang->get("PARTENAIRE_ADD_DESC_PLACEHOLDER") ?>">
                        <label for="type"><?= $Lang->get("PARTENAIRE_ADD_PLATEFORME") ?></label>
                        <select name="type" id="type" data-live-search="true" class="form-control website_type" tabindex="-98">
                            <option value="Y" selected="selected">Youtube</option>
                            <option value="T">Twitter</option>
                            <option value="F">Facebook</option>
                            <option value="A">Autre</option>
                        </select>
                        <br />
                        <!--
                        404 (Not Found)
                        <label for="atr">?= $Lang->get("PARTENAIRE_HELP_PLATEFORME") ?></label>
                        <img src="https://image.noelshack.com/fichiers/2017/16/1492420257-ytb.png">
                        <img src="https://image.noelshack.com/fichiers/2017/16/1492420964-twt.png">
                        <img src="https://image.noelshack.com/fichiers/2017/16/1492420957-fb.png"> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= $Lang->get("GLOBAL__CLOSE") ?></button>
                    <button type="submit" class="btn btn-primary"><?= $Lang->get("GLOBAL__SUBMIT") ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
var PARTENAIRE = {};
PARTENAIRE.editPartenaire = function(id) {
    data = {};
    data["data[_Token][key]"] = '<?= $csrfToken ?>';
    $.ajax({
            method: "POST",
            data: data,
            url: "<?= $this->Html->url(array('controller' => 'partenaire', 'admin' => false, 'action' => 'ajax_get_partenaire')) ?>/" + id
        })
        .done(function(data) {
            if (typeof data == "object") {
                $('#partenaire_modal').modal('show');
                $('#partenaire_form #action').val("edit");
                $('#partenaire_form #id').val(data.id);
                $('#partenaire_form #channel').val(data.channel);
                $('#partenaire_form #pseudo').val(data.pseudo);
                $('#partenaire_form #type').val(data.type);
                $('#partenaire_form #desc').val(data.desc);

            } else if (data == 0)
                $('#error_msg').html('' +
                    '<div class="alert alert-error">' +
                    '<?= $Lang->get("PARTENAIRE_LOAD_ERROR") ?>' +
                    '</div>'
                );

        })
        .fail(function() {
            $('#error_msg').html('' +
                '<div class="alert alert-error">' +
                '<?= $Lang->get("PARTENAIRE_LOAD_ERROR") ?>' +
                '</div>'
            );
        })
        .always(function() {});
};
PARTENAIRE.removePartenaire = function(id) {
    if (confirm("<?= $Lang->get("PARTENAIRE_CONFIRM_REMOVING") ?>")) {
        data = {};
        data['id'] = id;
        data["data[_Token][key]"] = '<?= $csrfToken ?>';
        $.ajax({
                method: "POST",
                url: "<?= $this->Html->url(array('controller' => 'partenaire', 'action' => 'ajax_remove_partenaire')) ?>",
                data: data
            })
            .done(function(data) {
                if (data == 0) {
                    $('#error_msg').html('' +
                        '<div class="alert alert-success">' +
                        '<?= $Lang->get("PARTENAIRE_SUCCESSFULY_REMOVED") ?>' +
                        '</div>'
                    );
                    $('#partenaire-' + id).remove();
                } else
                    $('#error_msg').html('' +
                        '<div class="alert alert-error">' +
                        '<?= $Lang->get("PARTENAIRE_REMOVING_ERROR") ?>' +
                        '</div>'
                    );

            })
            .fail(function() {
                $('#error_msg').html('' +
                    '<div class="alert alert-error">' +
                    '<?= $Lang->get("PARTENAIRE_REMOVING_ERROR") ?>' +
                    '</div>'
                );
            })
            .always(function() {});
    }
};
PARTENAIRE.addPartenaire = function() {
    $('#partenaire_form #action').val("add");
    $('#partenaire_modal').modal("show");
}
PARTENAIRE.submitForm = function(event) {
    event.preventDefault();
    event.stopPropagation();

    var inputs = {
        action: $('#partenaire_form #action').val(),
        id: $('#partenaire_form #id').val(),
        channel: $('#partenaire_form #channel').val(),
        pseudo: $('#partenaire_form #pseudo').val(),
        type: $('#partenaire_form #type').val(),
        desc: $('#partenaire_form #desc').val()
    };
    inputs["data[_Token][key]"] = '<?= $csrfToken ?>';
    $.ajax({
            method: "POST",
            url: "<?= $this->Html->url(array('controller' => 'partenaire', 'action' => 'ajax_save_partenaire')) ?>",
            data: inputs
        })
        .done(function(data) {
            console.log(data);
            if (typeof data == "object") {
                console.log(data);
                $('#error_msg').html('' +
                    '<div class="alert alert-success">' +
                    '<?= $Lang->get("PARTENAIRE_SUCCESSFULY_EDITED") ?>' +
                    '</div>'
                );
                if (data.action == "add")
                    $("#partenaire_list tbody").append(
                        "<tr id=\"partenaire-" + data.id + "\">" +
                        "<th id=\"partenaire-" + data.id + "-id\">" + data.id + "</th>" +
                        "<td id=\"partenaire-" + data.id + "-channel\">" + data.channel + "</td>" +
                        "<td id=\"partenaire-" + data.id + "-pseudo\">" + data.pseudo + "</td>" +
                        "<td id=\"partenaire-" + data.id + "-type\">" + data.type + "</td>" +
                        "<td id=\"partenaire-" + data.id + "-desc\">" + data.desc + "</td>" +
                        "<td>" +
                        "<a href=\"#\" onclick=\"PARTENAIRE.editPartenaire(" + data.id + ");\" class=\"btn btn-info\"><?= $Lang->get('EDIT') ?></a>" +
                        "<a href=\"#\" onclick=\"PARTENAIRE.removePartenaire(" + data.id + ");\" class=\"btn btn-danger\"><?= $Lang->get('DELETE') ?></a>" +
                        "</td>" +
                        "</tr>"
                    );
                else {
                    $('#partenaire-' + data.id + "-id").text(data.id);
                    $('#partenaire-' + data.id + "-channel").text(data.channel);
                    $('#partenaire-' + data.id + "-pseudo").text(data.pseudo);
                    $('#partenaire-' + data.id + "-type").text(data.type);
                    $('#partenaire-' + data.id + "-desc").text(data.desc);
                }
                $('#partenaire_modal').modal("hide");
            } else if (data == 0)
                $('#modal_alert_msg').html('' +
                    '<div class="alert alert-error">' +
                    '<?= $Lang->get("PARTENAIRE_ERROR") ?>' +
                    '</div>'
                );

        })
        .fail(function() {
            $('#modal_alert_msg').html('' +
                '<div class="alert alert-error">' +
                '<?= $Lang->get("PARTENAIRE_ERROR") ?>' +
                '</div>'
            );
        })
        .always(function() {});
};

$('#partenaire_form').submit(PARTENAIRE.submitForm);
$('#partenaire_modal').on('hide.bs.modal', function(event) {
    $("#partenaire_form :input").each(function() {
        var input = $(this);
        input.val("");
    });
});
</script>
