/**
 * Validar CNH
 * @param string $cnh
 * @return boolean
 */
function validarCnh( $cnh ) {
    $ret = false;

    if ( is_string( $cnh ) ) {
    
    	if (( strlen( $cnh = preg_replace( '/[^\d]/' , '' , $cnh ) ) <> 11 )){
    		$cnh = str_pad($cnh, 11, "0", STR_PAD_LEFT);
    	}
    	
        if ( ( str_repeat( $cnh{ 1 } , 11 ) != $cnh ) ) {
            $dsc = 0;

            for ( $i = 0 , $j = 9 , $v = 0 ; $i < 9 ; ++$i , --$j )
                    $v += (int) $cnh{ $i } * $j;

            if ( ( $vl1 = $v % 11 ) >= 10 ) {
                    $vl1 = 0;
                    $dsc = 2;
            }

            for ( $i = 0 , $j = 1 , $v = 0 ; $i < 9 ; ++$i , ++$j )
                    $v += (int) $cnh{ $i } * $j;

            $vl2 = ( $x = ( $v % 11 ) ) >= 10 ? 0 : $x - $dsc;
            $ret = sprintf( '%d%d' , $vl1 , $vl2 ) == substr( $cnh , -2 );
        }
    }

    return $ret;
}
