 <!--Footer-->
 <footer class="page-footer text-center font-small mt-4 wow fadeIn">

<!-- Social icons -->
<div class="pb-4">
  <a href="#" target="_blank">
    <i class="fab fa-facebook-f mr-3"></i>
  </a>

  <a href="https://twitter.com/MDBootstrap" target="_blank">
    <i class="fab fa-twitter mr-3"></i>
  </a>

  <a href="#" target="_blank">
    <i class="fab fa-youtube mr-3"></i>
  </a>

  <a href="#" target="_blank">
    <i class="fab fa-google-plus-g mr-3"></i>
  </a>

  <a href="#" target="_blank">
    <i class="fab fa-dribbble mr-3"></i>
  </a>

  <a href="#" target="_blank">
    <i class="fab fa-pinterest mr-3"></i>
  </a>

  <a href="#" target="_blank">
    <i class="fab fa-github mr-3"></i>
  </a>

  <a href="#" target="_blank">
    <i class="fab fa-codepen mr-3"></i>
  </a>
</div>
<!-- Social icons -->

<!--Copyright-->
<div class="footer-copyright py-3">
  © 2019 Copyright:
  <a href="https://aeg.eus" target="_blank"> aeg.eus </a>
</div>
<!--/.Copyright-->

</footer>
<!--/.Footer-->

<!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>

<script>
console.log (<?=json_encode($_SESSION);?>);

function add(id,salneurria) {
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              var resp = this.responseText;
              resp = JSON.parse(resp);
                console.log (resp);
                document.getElementById("kant").innerHTML=resp.total
                document.getElementById("kant2").innerHTML=resp.total;
                document.getElementById("kant_"+id).innerHTML=resp.cart[id];
                document.getElementById("saln_"+id).innerHTML=resp.sal[id]+"€";
                document.getElementById("salneurritotala").innerHTML=resp.salneurria+"€";
            }
        };
        xhttp.open("GET","./saskia_kudeatu.php?add="+id+"&salneurria="+salneurria,true);
        xhttp.send();

};

function remove(id,salneurria) {
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              var resp = this.responseText;
              resp = JSON.parse(resp);
              console.log (resp);
                document.getElementById("kant").innerHTML=resp.total;
                document.getElementById("kant2").innerHTML=resp.total;
                document.getElementById("saln_"+id).innerHTML=resp.sal[id]+"€";
                document.getElementById("salneurritotala").innerHTML=resp.salneurria+"€";

                if (resp.cart[id] === undefined) {
                  document.getElementById("li_"+id).style.display="none";
                  } else {
                  document.getElementById("kant_"+id).innerHTML=resp.cart[id];
                  }
            }
        };
        xhttp.open("GET","./saskia_kudeatu.php?remove="+id+"&salneurria="+salneurria,true);
        xhttp.send();

};

function limpiar() {
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("faktura").style.display="none";
              document.getElementById("kant").innerHTML="0";
              document.getElementById("kant2").innerHTML="0";
            }
        };
        xhttp.open("GET","./saskia_kudeatu.php?clear=true",true);
        xhttp.send();

}

</script>
