<?
session_start();
if ($_SESSION["usuario"] !== "admin" || $_SESSION["pass"] !== "admin") {
    header('Location: ./index.php');
}
include "./php/idiomas.php";
include "./php/conexion.php";
include './includes/head.php';?>


                        <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">Produktuak</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--md">
                                            <select class="js-select2" name="property">
                                                <option selected="selected">All Properties</option>
                                                <option value="">Option 1</option>
                                                <option value="">Option 2</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--sm">
                                            <select class="js-select2" name="time">
                                                <option selected="selected">Today</option>
                                                <option value="">3 Days</option>
                                                <option value="">1 Week</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <button class="au-btn-filter">
                                            <i class="zmdi zmdi-filter-list"></i>filters</button>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <a href="./produktua.php"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>Produktu berria</button></a>
                                        <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                                            <select class="js-select2" name="type">
                                                <option selected="selected">Export</option>
                                                <option value="">Option 1</option>
                                                <option value="">Option 2</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </th>
                                                <th>id</th>
                                                <th>izena</th>
                                                <th>kategoria</th>
                                                <th>kantitatea</th>
                                                <th>salneurria</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php
$result = $dbConn->query("SELECT *, produktuak.id as id, produktuak_lang.izena as izena FROM `produktuak` inner JOIN produktuak_lang on produktuak.id = produktuak_lang.id_produktoa WHERE hizkuntza = '$lang' ORDER BY kantitatea ASC;");
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    ?>
                                            <tr class="tr-shadow">
                                                <td>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td><?=$row['id']?></td>
                                                <td><?=$row['izena']?></td>
                                                <td><?=$categoria[$row['kategoria']]?></td>
                                                <td>
                                                    <span style="color:<?php
if ($row['kantitatea'] < 20) {echo "red";} else if ($row['kantitatea'] < 50) {echo "orange";} else {echo "black";}
    ?>"><?=$row['kantitatea']?></span>
                                                </td>
                                                <td><?=$row['salneurria']?>€</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <a href="./produktua.php?aldatu=<?=$row['id']?>" >
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        </a>
                                                        <a href="./produktua.php?ezabatu=<?=$row['id']?>" >
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>

                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
<?}?>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>
                        </div>
                    </div>









                    <div class="row m-t-30">
                            <div class="col-md-12">
                            <h3 class="title-5 m-b-35">Eskariak</h3>
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Ikusi</th>
                                                <th>Eskaria</th>
                                                <th>Bezeroa</th>
                                                <th>Salneurria</th>
                                                <th>Data</th>
                                                <th>Ordianketa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
$result = $dbConn->query("SELECT salneurria, data, eskariak.id, bezeroak.izena AS izena FROM eskariak INNER JOIN bezeroak ON eskariak.id_bezeroa = bezeroak.id ORDER BY eskariak.id DESC LIMIT 10;");
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    ?>
                                            <tr>
                                                <td><button type="button" onclick="consulta(<?=$row['id']?>)" class="btn btn-success btn-sm"><i class="fa fa-search"></i></button></td>
                                                <td><?=$row['id']?></td>
                                                <td><?=$row['izena']?></td>
                                                <td><?=$row['salneurria']?></td>
                                                <td><?=$row['data']?></td>
                                                <td><span class="status--process">Ordainduta</span>
                                                </td>
                                            </tr>
<?}?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>


<!-- The Modal -->
<div class="modal" id="Modal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="mediumModalLabel">Detalles del pedido</h5>
							<button onclick="document.getElementById('Modal').style.display='none';" type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body" id="detalle">

						</div>
						<div class="modal-footer">
							<button onclick="document.getElementById('Modal').style.display='none';" type="button" class="btn btn-danger" data-dismiss="modal">itxi</button>

						</div>
					</div>
				</div>
			</div>

<script>
function consulta(id) {
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              var resp = this.responseText;
              console.log (resp);
                document.getElementById("detalle").innerHTML=resp;
                document.getElementById("Modal").style.display="block";

            }
        };
        xhttp.open("GET","./pedido_detalle.php?id="+id,true);
        xhttp.send();

};
</script>

        <?include "./includes/footer.php"?>