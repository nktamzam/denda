<?session_start();
if ($_SESSION["usuario"] !== "admin" || $_SESSION["pass"] !== "admin") {
    header('Location: ./index.php');
}
include "./php/idiomas.php";
include "./php/conexion.php";

// hasiera.php ezabatzeko eman diote $_GET["ezabatu"]
if (isset($_GET["ezabatu"])) {
    $id = $_GET["ezabatu"];
    try {
        $sql = $dbConn->prepare("DELETE FROM produktuak where id=$id; DELETE FROM produktuak_lang where id_produktoa=$id");
        $sql->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $conn = null;
    header('Location: ./hasiera.php');
}

// hasiera.php aldatzeko eman diote $_GET["aldatu"]
if (isset($_GET["aldatu"])) {
    $id = $_GET["aldatu"];
    try {
        $result = $dbConn->query("SELECT *  FROM `produktuak` WHERE id=$id;");
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $kategoria = $row['kategoria'];
            $salneurria = $row['salneurria'];
            $kantitatea = $row['kantitatea'];
        }

        $result2 = $dbConn->query("SELECT * FROM `produktuak_lang` WHERE id_produktoa=$id AND hizkuntza='eu';");
        while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
            $izena_eu = $row['izena'];
            $deskribapena_eu = $row['deskribapena'];
        }

        $result3 = $dbConn->query("SELECT * FROM `produktuak_lang` WHERE id_produktoa=$id AND hizkuntza='es';");
        while ($row = $result3->fetch(PDO::FETCH_ASSOC)) {
            $izena_es = $row['izena'];
            $deskribapena_es = $row['deskribapena'];
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $conn = null;
}

// produktoa.php formulario bidali dute $_POST["aldatu"]
if (isset($_POST["aldatu"])) {
    echo "aladtu behar da kontxo";
    try {

        $izena_eu = test_input($_POST["izena_eu"]);
        $izena_es = test_input($_POST["izena_es"]);
        $deskribapena_eu = test_input($_POST["deskribapena_eu"]);
        $deskribapena_es = test_input($_POST["deskribapena_es"]);
        $kategoria = test_input($_POST["kategoria"]);
        $salneurria = test_input($_POST["salneurria"]);
        $kantitatea = test_input($_POST["kantitatea"]);

        $sql = $dbConn->prepare("UPDATE produktuak SET salneucrria = :salneurria, kantitatea = :kantitatea, kategoria = :kategoria WHERE id=$id");

        $sql->bindParam(':salneurria', $salneurria);
        $sql->bindParam(':kantitatea', $kantitatea);
        $sql->bindParam(':kategoria', $kategoria);

        $sql->execute();

        // $sql = $dbConn->prepare("UPDATE produktuak_lang SET izena = :izena_eu, deskribapena = :deskribapena_eu  WHERE id_produktoa=$id AND hizkuntza='eu';
        // UPDATE produktuak_lang SET izena = :izena_es, deskribapena = :deskribapena_es  WHERE id_produktoa=$id AND hizkuntza='es'");

        // $sql->bindParam(':izena_eu', $izena_eu);
        // $sql->bindParam(':izena_es', $izena_es);
        // $sql->bindParam(':deskribapena_eu', $deskribapena_eu);
        // $sql->bindParam(':deskribapena_es', $deskribapena_es);

        //$sql->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $conn = null;
    header('Location: ./hasiera.php');
}

if (isset($_POST["izena_eu"]) && !isset($_POST["aldatu"])) {
    try {

        $izena_eu = test_input($_POST["izena_eu"]);
        $izena_es = test_input($_POST["izena_es"]);
        $deskribapena_eu = test_input($_POST["deskribapena_eu"]);
        $deskribapena_es = test_input($_POST["deskribapena_es"]);
        $kategoria = test_input($_POST["kategoria"]);
        $salneurria = test_input($_POST["salneurria"]);
        $kantitatea = test_input($_POST["kantitatea"]);

        $sql = $dbConn->prepare("INSERT INTO produktuak (salneurria, kantitatea, kategoria)
VALUES (:salneurria, :kantitatea, :kategoria)");

        $sql->bindParam(':salneurria', $salneurria);
        $sql->bindParam(':kantitatea', $kantitatea);
        $sql->bindParam(':kategoria', $kategoria);

        $sql->execute();

        $last_id = $dbConn->lastInsertId();

        $sql = $dbConn->prepare("INSERT INTO produktuak_lang (id_produktoa, hizkuntza, izena, deskribapena)
    VALUES (:id, 'eu', :izena_eu, :deskribapena_eu); INSERT INTO produktuak_lang (id_produktoa, hizkuntza, izena, deskribapena)
    VALUES (:id, 'es', :izena_es, :deskribapena_es)");

        $sql->bindParam(':id', $last_id);
        $sql->bindParam(':izena_eu', $izena_eu);
        $sql->bindParam(':izena_es', $izena_es);
        $sql->bindParam(':deskribapena_eu', $deskribapena_eu);
        $sql->bindParam(':deskribapena_es', $deskribapena_es);

        $sql->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $conn = null;
    header('Location: ./hasiera.php');

}
include './includes/head.php';
?>
<div class="card">
                                    <div class="card-header">
                                        <strong>Produktu</strong> Berria
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="./produktua.php" method="post" class="form-horizontal">
                                        <?if (isset($_GET["aldatu"])) {?>
                                        <input type="Hidden" name="aldatu" value="bai">
                                        <?}?>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="izena_e" class=" form-control-label">Izena</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" value="<?=$izena_eu?>" id="izena_eu" name="izena_eu" placeholder="Produktuaren izena" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="izena_es" class=" form-control-label">Nombre</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" value="<?=$izena_es?>" id="izena_es" name="izena_es" placeholder="Nombre del producto" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="salneurria" class=" form-control-label">Salneurria</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" value="<?=$salneurria?>" id="salneurria" name="salneurria" placeholder="Nombre del producto" class="form-control">
                                                </div>
                                            </div>

                                    <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="deskribapena_eu" class=" form-control-label">Deskribapena</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea name="deskribapena_eu" id="deskribapena_eu" rows="9" placeholder="Deskribapena euskeraz" class="form-control"><?=$deskribapena_eu?></textarea>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="deskribapena_es" class=" form-control-label">Descripción</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea name="deskribapena_es" id="deskribapena_es" rows="9" placeholder="Descripción castellano" class="form-control"><?=$deskribapena_es?></textarea>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="kategoria" class=" form-control-label">Kategoria</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="kategoria" id="kategoria" class="form-control">
                                                    <?php foreach ($categoria as $idkat => $kat) {?>
                                                        <option value="<?=$idkat?>"  <?if ($idkat == $kategoria) {echo "selected";}?>><?=$kat?></option>
                                                    <?}?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="argazkia" class=" form-control-label">Argazkia</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="file" id="argazkia" name="argazkia" class="form-control-file">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="kantitatea" class=" form-control-label">Kantitatea</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="number" value="<?=$kantitatea?>"  id="kantitatea" name="kantitatea" placeholder="0" class="form-control">
                                                </div>
                                            </div>

                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Reset
                                        </button>
                                    </div>
                                    </form>
                                </div>
                                <?include "./includes/footer.php"?>