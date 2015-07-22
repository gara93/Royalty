<? Php
    función  renderizar ( $ vista , $ Datos ) {
        si ( ! is_array ( $ Datos )) {
            http_response_code ( 404 );
            die ( " Error de renderizador: Datos No Es Arreglo de la ONU " );
        }
        // Unión de los Dos Arreglos
        mundial  $ global_context ;
        $ Datos  =  array_merge ( $ global_context , $ Datos );
        $ ViewsPath  =  " views / " ;
        $ FileTemplate  =  $ vista . " .view.tpl " ;
        $ LayoutFile  =  " layout.view.tpl " ;
        $ HtmlContent  =  " " ;
        si ( file_exists ( $ viewsPath . $ LayoutFile )) {
            $ HtmlContent  =  file_get_contents ( $ viewsPath . $ LayoutFile );
            si ( file_exists ( $ viewsPath . $ fileTemplate )) {
                $ Tmphtml  =  file_get_contents ( $ viewsPath . $ fileTemplate );
                $ HtmlContent  =  str_replace ( " {{{page_content}}} " ,
                            $ Tmphtml ,
                            $ HtmlContent );
                // Limpiar Saltos de Pagina
                $ HtmlContent  =  str_replace ( " \ n " , " " , $ htmlContent );
                $ HtmlContent  =  str_replace ( " \ r " , " " , $ htmlContent );
                $ HtmlContent  =  str_replace ( " \ t " , " " , $ htmlContent );
                $ HtmlContent  =  str_replace ( "   " , " " , $ htmlContent );
                // Obtiene ONU Arreglo separando lo Distintos Tipos de nodos
                $ Template_code  = parseTemplate ( $ htmlContent );
                $ HtmlResult  = renderTemplate ( $ template_code , $ Datos );
                echo  $ htmlResult ;
            }
        }
    }
    función  renderTemplate ( $ template_block , $ context ) {
        $ RenderedHTML  =  " " ;
        $ ForeachIsOpen  =  false ;
        $ IfIsOpen  =  false ;
        $ IfCondition  =  false ;
        $ InnerBlock  =  array ();
        $ CurrentContext  =  " " ;
        foreach ( $ template_block  como  $ node ) {
            // Buscando si Es Un Cierre de foreach
            si ( strpos ( $ nodo , " {{endfor $ CurrentContext }} " ) ! ==  false ) {
                si ( $ foreachIsOpen ) {
                    $ ForeachIsOpen  =  false ;
                    foreach ( $ context [ $ CurrentContext ] como  $ forcontext ) {
                        $ RenderedHTML  =. renderTemplate ( $ innerBlock , $ forcontext );
                    }
                    $ InnerBlock  =  array ();
                    $ CurrentContext  =  " " ;
                    continuar ;
                }
            }
            // Buscando si es ONU Cierre de si
            si ( strpos ( $ nodo , " {{endif $ CurrentContext }} " ) ! ==  false ) {
                si ( $ ifIsOpen ) {
                    $ IfIsOpen  =  false ;
                    $ RenderedHTML  =. ( $ ifCondition ) renderTemplate (? $ innerBlock , $ context ): " " ;
                    $ CurrentContext  =  " " ;
                    $ InnerBlock  =  array ();
                    $ IfCondition  = false ;
                    continuar ;
                }
            }
            si ( $ foreachIsOpen  ||  $ ifIsOpen ) {
                $ InnerBlock [] =  $ nodo ;
                continuar ;
            }
            // Buscando si Es Una apertura de foreach
            si ( strpos ( $ nodo , " {{foreach " ) ! ==  false ) {
                si ( ! $ foreachIsOpen ) {
                    $ ForeachIsOpen  =  verdadero ;
                    $ CurrentContext  =  recortar ( str_replace ( " }} " , " " , str_replace ( " {{foreach " , " " , $ nodo )));
                    continuar ;
                }
            }
            // Buscando es si la ONU si
            si ( strpos ( $ nodo , " {{if " )   ! ==  false ) {
                si ( ! $ ifIsOpen ) {
                    $ IfIsOpen  =  verdadero ;
                    $ CurrentContext  =  recortar ( str_replace ( " }} " , " " , str_replace ( " {{if " , " " , $ nodo )));
                    si ( isset ( $ context [ $ CurrentContext ])) {
                        $ IfCondition  = ( $ context [ $ CurrentContext ]) &&  verdadera ;
                    }
                    continuar ;
                }
            }
            // Remplazando las variables de del nodo
            $ NodeReplace  =  preg_split ( "/ ( \ {\ { \ w * \} \} ) / " , $ nodo , - 1 , PREG_SPLIT_DELIM_CAPTURE  |  PREG_SPLIT_NO_EMPTY );
            foreach ( $ nodeReplace  como  $ item ) {
                si ( strpos ( $ item , " {{ " )   ! ==  false ) {
                    $ Indice  =  recortar ( str_replace ( " }} " , " " , str_replace ( " {{ " , " " , $ item )));
                    $ Item  =  isset ( $ context [ $ índice ])? $ context [ índice $ ]: " " ;
                }
                $ RenderedHTML  =.  $ item ;
            }
        }
        retorno  $ renderedHTML ;
    }
    función  parseTemplate ( $ htmlTemplate ) {
        $ Regexp_array  =  array ( ' foreach '    =>  ' (\ {\ {foreach \ w * \} \}) ' ,
                               ' endfor '     =>  ' (\ {\ {endfor \ w * \} \}) ' ,
                               ' si '         =>  ' (\ {\ {if \ w * \} \}) ' ,
                               ' if_close '   =>  ' (\ {\ {endif \ w * \} \}) ' );
        $ Tag_regexp  =  " / "  .  unirse ( " | " , $ regexp_array ) .  " / " ;
        // Dividir el código con la expresión regular etiquetas
        $template_code  =  preg_split ( $tag_regexp , $htmlTemplate , - 1 , PREG_SPLIT_DELIM_CAPTURE  |  PREG_SPLIT_NO_EMPTY );
        devolver  $ template_code ;
    }
? >
