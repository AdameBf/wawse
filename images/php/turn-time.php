<?php
header ('Content-type: image/png'); // PNG will be the best format for this kind of use.

$source = imagecreatefrompng('../png/turn-time.png'); // The image I'll include the number on.

imagepng($image);
?>