<!DOCTYPE html> <!--Training module for map in Conta System -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Conta map</title>
</head>
<body>


            





    <link rel="stylesheet" href="style.css"/>
    <!--<link rel="stylesheet" href="leafletpack/leaflet.css" />-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
    integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
    crossorigin=""/>
    <div id="map"></div>
    <!--<script src="leafletpack/leaflet.js"></script>-->
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
    integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
    crossorigin=""></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    </br>
    <div name="data">

        Small description:</br>
        <textarea rows="4" cols="50" id="description"></textarea></br>


        <input type="submit" value="Send Report" id="bntSaveReport"></br>
        


    </div>

    <dir id="result"></div>
    <script>
                //var reports = {};
 

                carregarMapa();


            
                var coordenada = {"latitude" : -8.0553,  "longituede" : -34.9457, "elevacao" : 15}
                
                var map = L.map('map').setView([coordenada.latitude, coordenada.longituede], coordenada.elevacao);
            
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
            
                //L.marker([-8.0522404, -34.9286096]).addTo(map)
                //.bindPopup("Ponto marcado pela coordenada.<br> "+reports[0].lat+", "+reports[0].lng)
                //.openPopup();


                var popup = L.popup();

                var latCadastro = "";
                var lngCadastro = "";
                
                function onMapClick(e) {
                    popup
                        .setLatLng(e.latlng)
                        //.setContent("Region selected." + e.latlng.toString())
                        .setContent("Region selected.")
                        .openOn(map);

                        latCadastro = e.latlng.lat;
                        lngCadastro = e.latlng.lng;
                        
                }
                map.on('click', onMapClick);
                $("#bntSaveReport").click(function(){
                    var description = $("#description").val();
                    //console.log(description);
                    //var valor = $("#dado").val();
                    $.ajax({
                    url: "Report_controller.php",
                    type: "POST",
                    data: "campo1="+latCadastro+"&campo2="+lngCadastro+"&campo3="+description,
                    dataType: "html"
                
                    }).done(function(resposta) {
                        //console.log(resposta);
                        //$("#result").text(resposta);
                        //reports = JSON.parse(resposta);
                        carregarMapa();
                    }).fail(function(jqXHR, textStatus ) {
                        console.log("Request failed: " + textStatus);
                        
                    }).always(function() {
                        console.log("Request Ok!");
                    });
                });


                    function carregarMapa(){
                        $.get( "GetReport_controller.php" , function( data ) {
                        //$( "#result" ).html( data );
                            reports = JSON.parse(data);
                            
                            for(var k in reports) {

                                L.marker([reports[k].lat, reports[k].lng]).addTo(map)
                                //.bindPopup("<b>Description:     </b>"+reports[k].description+"</br> "+reports[k].lat+", "+reports[k].lng)
                                .bindPopup("<b>Description:     </b></br>"+reports[k].description)
                                .openPopup();        

                                //console.log(k, reports[k]);          
            
                            }


                        });
                    }
                    
            
    </script>



    

    
    
    
</body>
</html>