(function() {
  var data = {
    green: {
      label: 'groen',
      sublines: [
        'Nog niet tenminste',
        'Kwestie van tijd',
        'Effe wachten nog',
        'Kan nooit lang duren dit'
      ]
    },
    yellow: {
      label: 'geel',
      sublines: [
        'Geen paniek, \'t is maar geel',
        'Geel is ook een beetje zonnig, toch?',
        'Geel? Ik noem het liever de kleur van bier',
        'Geel is ´t nieuwe groen'
      ]
    },
    orange: {
      label: 'oranje',
      sublines: [
        'Oranje boven...',
        'We houden van Oranje, maar dit wat minder',
        'Tijd om naar Brazilië te verkassen',
        'Toch even wat stormlijntjes om die oude beuk...'
      ]
    },
    red: {
      label: 'rood',
      sublines: [
        'Zie de hond waait door de bomen...',
        'Vandaag is rood...',
        'Vrouwen en kinderen eerst!',
        'Zelfs het luchtalarm hoor je niet meer'
      ]
    }
  };

  Array.prototype.randomElement = function() {
    return this[Math.floor(Math.random() * this.length)];
  }

  window.onload = function() {
    var code = document.getElementById('container').getAttribute('data-code');
    var showWarning = code !== 'green';

    document.getElementById('subline').innerHTML = data[code].sublines.randomElement();
    document.getElementById('tagline').innerHTML = showWarning ? 'JA' : 'NEE';
    document.getElementById('code').innerHTML = data[code].label;

    if(showWarning) {
      document.getElementById('warning').style.display = 'block';
    }
  }
}());
