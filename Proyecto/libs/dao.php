<? Php
   // Objeto de acceso a datos
   require_once ( " libs / parameters.php " );
   // ------------------------
   $ Conexion  =  nueva  mysqli ( $ servidor , $ usuario , $ pswd ,
                          $ Database , $ puerto );
   si ( $ conexion -> connect_errno ) {
        // Die ();
        morir ( $ conexion -> connect_error );
   }
   función  obtenerRegistros ( $ sqlstr , y $ conexion  =  nula ) {
        si ( ! $ conexion ) mundial  $ conexion ;
        $ Resultado  =  $ conexion -> query ( $ sqlstr );
        $ ResultArray  =  array ();
        foreach ( $ resultado  como  $ registro ) {
            $ ResultArray [] =  $ registro ;
        }
        retorno  $ resultArray ;
   }
   funcionar  obtenerUnRegistro ( $ sqlstr , y $ conexion  =  nula ) {
        si ( ! $ conexion ) mundial  $ conexion ;
        $ Resultado  =  $ conexion -> query ( $ sqlstr );
        $ ResultArray  =  array ();
        $ ResultArray  =  $ resultado -> FETCH_ASSOC ();
        retorno  $ resultArray ;
   }
   función  ejecutarNonQuery ( $ sqlstr , y $ conexion  =  nula ) {
        si ( ! $ conexion ) mundial  $ conexion ;
        $ Resultado  =  $ conexion -> query ( $ sqlstr );
        retorno  $ conexion -> affected_rows ;
   }
   función  valstr ( $ cadena , y $ conexion  =  nula ) {
      si ( ! $ conexion ) mundial  $ conexion ;
      retorno  $ conexion -> escape_string ( $ cadena );
   }
   función  getLastInserId ( y $ conexion  =  nula ) {
     mundial  $ conexion ;
     retorno  $ conexion -> insert_id ;
   }
? >
