<script type="text/javascript">
  function  initMap(){

    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat:-33.0193998,lng:-71.5583707},
      zoom: 14,
      styles: [{
          "featureType": "administrative",
          "elementType": "all", "stylers": [
              {
                  "saturation": "-100"
              }
          ]
      },
          {
              "featureType": "administrative.province",
              "elementType": "all", "stylers": [
                  {
                      "visibility": "off"
                  }
              ]
          },
          {
              "featureType": "landscape",
              "elementType": "all", "stylers": [
                  {
                      "saturation": -100
                  },
                  {
                      "lightness": 65
                  },
                  {
                      "visibility": "on"
                  }
              ]
          },
          {
              "featureType": "poi",
              "elementType": "all", "stylers": [
                  {
                      "saturation": -100
                  },
                  {
                      "lightness": "50"
                  },
                  {
                      "visibility": "simplified"
                  }
              ]
          },
          {
              "featureType": "road",
              "elementType": "all", "stylers": [
                  {
                      "saturation": "-100"
                  }
              ]
          },
          {
              "featureType": "road.highway",
              "elementType": "all", "stylers": [
                  {
                      "visibility": "simplified"
                  }
              ]
          },
          {"featureType": "road.arterial","elementType": "all",
              "stylers": [
                  {
                      "lightness": "30"
                  }
              ]
          },
          {
              "featureType": "road.local",
              "elementType": "all", "stylers": [
                  {
                      "lightness": "40"
                  }
              ]
          },
          {
              "featureType": "transit",
              "elementType": "all",
              "stylers": [
                  {
                      "saturation": -100
                  },
                  {
                      "visibility": "simplified"
                  }
              ]
          },
          {
              "featureType": "water",
              "elementType": "all", "stylers": [
                  {
                      "color": "#6b6a6a"
                  }
              ]
          },
          {
              "featureType": "water",
              "elementType": "geometry", "stylers": [
                  {
                      "hue": "#ffff00"
                  },
                  {
                      "lightness": -25
                  },
                  {
                      "saturation": -97
                  }
              ]
          },
          {
              "featureType": "water",
              "elementType": "labels", "stylers": [
                  {
                      "lightness": -25
                  },
                  {
                      "saturation": -100
                  }
              ]
          }]
    });





    addMarker({lat:-33.0193998,lng:-71.5583707});
    addMarker({lat:-33.0079354,lng:-71.5498058});
    addMarker({lat:-33.01283803875065,lng:-71.5493255853653});
    //Add marker
    function addMarker(coords){
      var marker = new google.maps.Marker({
        position:coords,
        map:map,
        icon:'img/markerfika.png'
    });

  }
}
</script>
