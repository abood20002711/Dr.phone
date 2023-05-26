<?php

    // get the page title
    function GetTitle(){
        global $PageTilte;
        if(isset($PageTilte)){
            echo $PageTilte;
        }
        else{
            echo "default";
        }
    }
?>