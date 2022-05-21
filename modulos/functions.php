<?php 

function showEror($msg) {
    $etiquet = '<div class="alert alert-error fade in center">
                    <button class="close" type="button" data-dismiss="alert">
                        x
                    </button>
                    ' . $msg . '
                </div>';
    return $etiquet;
}


?>