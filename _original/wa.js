// weeralarm hipster js file
// precies, ik kan er geen fuck van.

var noAlarmSublines = [
  "Nog niet tenminste",
  "Kwestie van tijd",
  "Effe wachten nog",
  "Kan nooit lang duren dit" 
  ];

  var codeYellowSublines = [
  "Geen paniek, 't is maar geel",
  "Geel is ook een beetje zonnig, toch?",
  "Geel? Ik noem het liever de kleur van bier",
  "Geel is ´t nieuwe groen"
  ];
  var codeOrangeSublines = [
  "Oranje boven...",
  "We houden van Oranje, maar dit wat minder",
  "Tijd om naar Brazilië te verkassen",
  "Toch even wat stormlijntjes om die oude beuk..."
  ];

    var codeRedSublines = [
  "Zie de hond waait door de bomen...",
  "Vandaag is rood...",
  "Vrouwen en kinderen eerst!",
  "Zelfs het luchtalarm hoor je niet meer"
  ];

Array.prototype.randomElement = function () {
    return this[Math.floor(Math.random() * this.length)]
}
  function RndText() {
    if ( $( "#container" ).is( ".none" ) ) {
    document.getElementById('subline').innerHTML=noAlarmSublines.randomElement();
   $("#warning").hide();
    }
    if ( $( "#container" ).is( ".code-geel" ) ) {
    document.getElementById('subline').innerHTML=codeYellowSublines.randomElement();
  $("#warning").show();
  $("span.code").text("GEEL");
    }
    if ( $( "#container" ).is( ".code-oranje" ) ) {
    document.getElementById('subline').innerHTML=codeOrangeSublines.randomElement();
    $("#warning").show();
  $("span.code").text("ORANJE");
    }
    if ( $( "#container" ).is( ".code-rood" ) ) {
    document.getElementById('subline').innerHTML=codeRedSublines.randomElement();
      $("#warning").show();
  $("span.code").text("ROOD");
    }
  }
    function yesOrNo() {
  if ( $( "#container" ).is( ".none" ) ) {
    document.getElementById("tagline").innerHTML="NEE";
    }else{
    document.getElementById("tagline").innerHTML="JA";
    }
  }
  onload = function() { RndText(); yesOrNo(); }
