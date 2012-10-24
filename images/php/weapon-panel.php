<?php
header ('Content-type: image/png'); // PNG will be the best format for this kind of use.

imagepng($dest);
imagedestroy($dest);
?>