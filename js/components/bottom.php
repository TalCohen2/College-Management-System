<?php
if(!empty($this->js)) {
    for ($i=0;$i<count($this->js);$i++) {
        echo "<script src=\"/College-Managment-System/js/{$this->js[$i]}\"></script>";
    }
}
?>
</body>
</html>