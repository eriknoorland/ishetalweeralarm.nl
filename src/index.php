<?php

  /*
  <div class="wrapper--alert">
    <div class="alert alert--green"> || yellow || orange || red
      <div class="alert__heading">Code groen</div>
      <div class="alert__body">
          <a class="alert__description" href="/nederland-nu/weer/waarschuwingen">
             Er zijn geen waarschuwingen
          </a>
      </div>
    </div>
  </div>
  */

  $data = array(
    'green' => array(
      'label' => 'groen',
      'sublines' => array(
        'Nog niet tenminste',
        'Kwestie van tijd',
        'Effe wachten nog',
        'Kan nooit lang duren dit',
        'Yay!'
      )
    ),
    'yellow' => array(
      'label' => 'geel',
      'sublines' => array(
        'Geen paniek, \'t is maar geel',
        'Geel is ook een beetje zonnig, toch?',
        'Geel? Ik noem het liever de kleur van bier',
        'Geel is ´t nieuwe groen'
      )
    ),
    'orange' => array(
      'label' => 'oranje',
      'sublines' => array(
        'Oranje boven...',
        'We houden van Oranje, maar dit wat minder',
        'Tijd om naar Brazilië te verkassen',
        'Toch even wat stormlijntjes om die oude beuk...'
      )
    ),
    'red' => array(
      'label' => 'rood',
      'sublines' => array(
        'Zie de hond waait door de bomen...',
        'Vandaag is rood...',
        'Vrouwen en kinderen eerst!',
        'Zelfs het luchtalarm hoor je niet meer'
      )
    )
  );

  libxml_use_internal_errors(true);

  $page = file_get_contents('http://www.knmi.nl');
  $document = new DOMDocument();
  $document->loadHTML($page);
  $alertWrapper = '';

  // find the above HTML to be able to extract the code colour
  foreach($document->getElementsByTagName('div') as $node) {
    if($node->getAttribute('class') === 'wrapper--alert') {
      $i = $node->firstChild;
      $alertWrapper = $document->saveHtml($node);
      break;
    }
  }

  // set the default code to green
  // so we don't start a panic when
  // the following code doesn't work
  // properly
  $code = 'green';

  // extract the code modifier class
  // which contains the colour code
  $codePrefix = 'alert--';
  $regex = '/' . $codePrefix . '[^"]*/';
  $matches = array();
  preg_match($regex, $alertWrapper, $matches);

  // extract the code colour
  if(count($matches) !== 0) {
    $code = str_replace($codePrefix, '', $matches[0]);
  }

  $showWarning = $code !== 'green';
  $label = $data[$code]['label'];
  $subline = $data[$code]['sublines'][rand(0, count($data[$code]['sublines']) -1)];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Is het al weeralarm?</title>

    <meta property="og:title" content="Is het al weeralarm?" />
    <meta property="og:site_name" content="ishetalweeralarm" />
    <meta property="og:description" content="Paniek op de wegen! Water in de sloten! Onweer, hagel en ander gezeik: Is het alweer alarm?" />

    <link rel="shortcut icon" type="image/png" href="favicon.ico" />

    <style>
      body {
        font-family: sans-serif;
        text-align: center;
      }

      a {
        color: currentColor;
      }

      .code-green { background-color: #98bf6e; }
      .code-yellow { background-color: #fbec5d; }
      .code-orange { background-color: #f87531; }
      .code-red { background-color: #cd3333; }

      .inyourface {
        position: absolute;
        top: 50%;
        right: 0;
        left: 0;
        margin: 0 auto;
        width: 300px;
        transform: translateY(-50%);
      }

      .subline {
        margin: 0;
      }

      .tagline {
        margin: 0;
        font-weight: bold;
        font-size: 100px;
        color: white;
      }

      .warning {
        display: none;
        font-size: 11px;
      }

      .warning.is-visible {
        display: block;
      }

      .socialWrapper {
        height: 70px;
      }

      .fb-like {
        display: block;
        margin: 20px auto 0;
        text-align: center;
      }

      .twitter-share-button {
        display: block;
        margin: 10px auto 0;
      }
    </style>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-51466866-1', 'ishetalweeralarm.nl');
      ga('send', 'pageview');
    </script>
  </head>

  <body class="code-<?php echo $code; ?>" data-code="<?php echo $code; ?>">
    <div id="fb-root"></div>

    <script>
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

    <div class="inyourface">
      <p class="tagline">
        <?php echo $showWarning ? 'JA' : 'NEE'; ?>
      </p>

      <p class="subline">
        <?php echo $subline; ?>
      </p>

      <p class="warning <?php echo $showWarning ? 'is-visible' : '' ?>">
        Code <?php echo $label; ?> in (delen van) 't land:
        <a href="http://www.knmi.nl" target="_blank">
          KNMI
        </a>
      </p>

      <div class="fb-like" data-href="http://www.ishetalweeralarm.nl" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>

      <a href="https://twitter.com/share" class="twitter-share-button" data-via="Mday_" data-hashtags="weeralarm"></a>
      <script>
        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
      </script>
    </div>
  </body>
</html>
