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

  echo 'code: ' . $code . "\n";
?>
