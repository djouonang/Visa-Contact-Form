<?php
if( !headers_sent() && '' == session_id() ) { session_start(); }

   $min_number = 1;
	$max_number = 15;

	$random_number1 = mt_rand($min_number, $max_number);
	$random_number2 = mt_rand($min_number, $max_number);
          
          echo '<br />'.'<br />'.$random_number1 . ' + ' . $random_number2 . ' = ';
          
        ?>
  <input name="captchaResult2" id="captchaResult2" type="text" size="2" />

		<input name="firstNumber" id="firstNumber2" type="hidden" value="<?php echo $random_number1; ?>" />
		<input name="secondNumber" id="secondNumber2" type="hidden" value="<?php echo $random_number2; ?>" /><br />