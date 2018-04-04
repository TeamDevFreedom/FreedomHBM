<?php
require_once 'auth.php';
require_once '../db.php';

$vecteurs = array();
try {
    $query = $db->prepare("select v.*, p.nom, a.base_1 as a_base_1, a.base_2 as a_base_2, a.base_3 as a_base_3, a.base_4 as a_base_4 "
            . " from vecteur v "
            . " inner join patients p on v.rfid = p.rfid "
            . " inner join adn a on a.rfid = v.rfid "
            . " order by id desc");
    $query->execute(array());
    while ($ligne = $query->fetch(PDO::FETCH_OBJ)) {
        $vecteur = array();
        $vecteur['description_ok'] = $ligne->description_ok;
        $vecteur['description_nok'] = $ligne->description_nok;
        $vecteur['patient'] = $ligne->nom;
        $vecteur['validable'] = false;
        $vecteur['devalidable'] = false;
        $vecteur['id'] = $ligne->id;
        $vecteur['vecteur'] = '[ ' . $ligne->base_1 . ' ' . $ligne->base_2 . ' ' . $ligne->base_3 . ' ' . $ligne->base_4 . ' ]';
        $vecteur['adn'] = '[ ' . $ligne->a_base_1 . ' ' . $ligne->a_base_2 . ' ' . $ligne->a_base_3 . ' ' . $ligne->a_base_4 . ' ]';
        if ($ligne->statut == "ADMINISTRE") {
            $vecteur['statut'] = "Administré";
        } else if ($ligne->statut == "CREE") {
            $vecteur['statut'] = "En création";
            $vecteur['validable'] = true;
        } else if ($ligne->statut == "VALIDE") {
            $vecteur['devalidable'] = true;
            $vecteur['statut'] = "Validé";
        } else {
            $vecteur['devalidable'] = false;
            $vecteur['validable'] = false;
            $vecteur['statut'] = "Périmé";
        }
        array_push($vecteurs, $vecteur);
    }
    $query->closeCursor();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>HBM</title>
        <link rel="stylesheet" type="text/css" href="admin.css">
        <script src="/js/jquery.js"></script>
        <script src="/js/navigation.js"></script>
    </head>
    <body>
        <script>
            var validerVecteurCallback = function (json) {
                var parsed = JSON.parse(json);
                if (parsed.status === AJAX_SUCCESS) {
                    navigate('index.php');
                } else {
                    alert(parsed.message);
                }
            };

            var validerHandler = function (event) {
                var id = event.target.id;
                var description_ok = $('#text_area_ok_' + id).val();
                var description_nok = $('#text_area_nok_' + id).val();
                var input = {id: event.target.id, description_ok: description_ok, description_nok: description_nok};
                $.post('valider_vecteur.php', input, validerVecteurCallback);
            };

            var devaliderHandler = function (event) {
                var input = {id: event.target.id};
                $.post('devalider_vecteur.php', input, validerVecteurCallback);
            };

            var documentReadyHandler = function () {
                $('.devalider').click(devaliderHandler);
                $('.valider').click(validerHandler);
            };
            $(document).ready(documentReadyHandler);
        </script>
        <table>
            <tr>
                <th>Patient</th>
                <th>ADN</th>
                <th>Vecteur</th>
                <th>Statut</th>
                <th>Description OK</th>
                <th>Description NOK</th>
                <th></th>
            </tr>
            <?php foreach ($vecteurs as $vecteur) { ?>
                <tr>
                    <td><?php echo $vecteur['patient'] ?></td>
                    <td><?php echo $vecteur['adn'] ?></td>
                    <td><?php echo $vecteur['vecteur'] ?></td>
                    <td><?php echo $vecteur['statut'] ?></td>
                    <?php if ($vecteur['validable']) { ?>
                        <td><textarea id="text_area_ok_<?php echo $vecteur['id']; ?>"></textarea></td>
                    <?php } else { ?>
                        <td><?php echo $vecteur['description_ok'] ?></td>
                    <?php } ?>
                    <?php if ($vecteur['validable']) { ?>
                        <td><textarea id="text_area_nok_<?php echo $vecteur['id']; ?>"></textarea></td>
                    <?php } else { ?>
                        <td><?php echo $vecteur['description_nok'] ?></td>
                    <?php } ?>
                    <?php if ($vecteur['validable']) { ?>
                        <td><input class="valider" type=button value="Valider" id="<?php echo $vecteur['id']; ?>"/></td>
                    <?php } else if ($vecteur['devalidable']) { ?>
                        <td><input class="devalider" type=button value="Dévalider" id="<?php echo $vecteur['id']; ?>"/></td>
                        <?php } else { ?>
                        <td></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>