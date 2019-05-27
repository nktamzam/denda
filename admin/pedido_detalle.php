<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    include "./php/conexion.php";
    ?>



                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Produktua</th>
                                                <th>Kantitatea</th>
                                                <th>Egoera</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$result = $dbConn->query("SELECT *, produktuak_lang.izena as izena FROM eskariak_produktuak INNER JOIN produktuak_lang ON eskariak_produktuak.id_produktoa = produktuak_lang.id_produktoa WHERE produktuak_lang.hizkuntza='eu' AND eskariak_produktuak.id_eskaria=$id;");
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        ?>
                                            <tr>
                                                <td><?=$row['izena']?></td>
                                                <td><?=$row['kantitatea']?></td>
                                                <td><span class="status--process">Bidalita</span></td>
                                            </tr>
<?}?>

                                        </tbody>
                                    </table>
                                </div>
<?}?>