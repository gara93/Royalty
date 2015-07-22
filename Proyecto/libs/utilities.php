<? Php
    $ Global_context  =  array ();
    función  addToContext ( $ key , $ value ) {
        mundial  $ global_context ;
        $ Global_context [ $ key ] =  $ valor ;
    }
    función  redirectWithMessage ( $ mensaje , $ url = " index.php " ) {
      echo  " <script> alert (' $ mensaje '); window.location =' $ url '; </ script> " ;
      die ();
    }
    función  redirectToUrl ( $ url ) {
      header ( " Location: $ url " );
      die ();
    }
    funcionar  mergeArrayTo ( y $ origen , y $ destino ) {
      si ( is_array ( $ origen ) &&  is_array ( $ destino )) {
        foreach ( $ origen  como  $ okey  =>  $ oValue ) {
          si ( isset ( $ destino [ $ okey ])) {
            $ Destino [ $ okey ] =  $ oValue ;
          }
        }
      }
    }
? >
