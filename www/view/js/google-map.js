
var google;

/**
 * Not used right now, it used to show the location of the IES Estació on the contact page
 * 
 * @deprecated
 */
function init() {
    var ontinyent = {lat: 38.8102874, lng: -0.6043017};
    

    //replace this variable with the json you generate in the google maps api wizard tool
    //Styles Start
    var styles = [ { "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "color": "#444444" } ] }, { "featureType": "landscape", "elementType": "all", "stylers": [ { "color": "#f2f2f2" } ] }, { "featureType": "poi", "elementType": "all", "stylers": [ { "visibility": "on" } ] }, { "featureType": "poi", "elementType": "geometry.fill", "stylers": [ { "saturation": "-100" }, { "lightness": "57" } ] }, { "featureType": "poi", "elementType": "geometry.stroke", "stylers": [ { "lightness": "1" } ] }, { "featureType": "poi", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road", "elementType": "all", "stylers": [ { "saturation": -100 }, { "lightness": 45 } ] }, { "featureType": "road.highway", "elementType": "all", "stylers": [ { "visibility": "simplified" } ] }, { "featureType": "road.arterial", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "transit", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "transit.station.bus", "elementType": "all", "stylers": [ { "visibility": "on" } ] }, { "featureType": "transit.station.bus", "elementType": "labels.text.fill", "stylers": [ { "saturation": "0" }, { "lightness": "0" }, { "gamma": "1.00" }, { "weight": "1" } ] }, { "featureType": "transit.station.bus", "elementType": "labels.icon", "stylers": [ { "saturation": "-100" }, { "weight": "1" }, { "lightness": "0" } ] }, { "featureType": "transit.station.rail", "elementType": "all", "stylers": [ { "visibility": "on" } ] }, { "featureType": "transit.station.rail", "elementType": "labels.text.fill", "stylers": [ { "gamma": "1" }, { "lightness": "40" } ] }, { "featureType": "transit.station.rail", "elementType": "labels.icon", "stylers": [ { "saturation": "-100" }, { "lightness": "30" } ] }, { "featureType": "water", "elementType": "all", "stylers": [ { "color": "#d2d2d2" }, { "visibility": "on" } ] } ];

    //Styles End
   //Create a styled map using the above styles
   var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"}); 

   var mapProp = { 
      center: ontinyent,//set the centre of the map. In my case it is the same as the position of the map pin.
      zoom:14,
      mapTypeId:google.maps.MapTypeId.ROADMAP
   };

   var map=new google.maps.Map(document.getElementById("map"),mapProp);

   //Set the map to use the styled map
   map.mapTypes.set('map_style', styledMap);
   map.setMapTypeId('map_style');
   var contentString = '<div id="google-popup">'+
            '<p>IES l\'Estació Ontinyent</p>'+
            '</div>';

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

   //Create a marker pin to add to the map
   var marker;
   marker = new google.maps.Marker({
      position:  ontinyent,//set the position of the pin
      map: map,
      animation:google.maps.Animation.DROP
   });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });


}
google.maps.event.addDomListener(window, 'load', init);