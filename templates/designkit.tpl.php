
body {
      background-color: <?php print $background ?>;
    }

header {
      background: <?php print $header ?>;
}

main {
      background: <?php print $content ?>;
}

nav {
      background: <?php print $navigation ?>;
}

footer {
      background: <?php print $footer ?>;
}

.sidebar {
      background: <?php print $sidebars?>;
}

#page-title {
  background: <?php print designkit_colorshift($background, '#000000', .1) ?>;
  color: <?php print (designkit_colorhsl($background, 'l') > .5) ? '#fff' : '#000' ?>;
}
