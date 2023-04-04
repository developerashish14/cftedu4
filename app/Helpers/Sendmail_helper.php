<?php
if ( ! function_exists('send_mail'))
{
	function send_mail($config, $to, $subject, $mail_body, $attach = '')
	{
		if(@fopen("https://www.pctiltd.com","r"))
		{
			$email = \Config\Services::email();
			$email->setTo($to);
			if($config->cc != ""){ $email->setCC($config->cc); }
			if($config->bcc != ""){ $email->setBCC($config->bcc); }
			if($attach != ""){ $email->attach($attach); }
			$email->setSubject($subject);
			$email->setMessage($mail_body);
			if($email->send())
			{
				return $arr = array('success'=>true);
			}
			else
			{
				return $arr = array('success'=>false,'message'=>$email->printDebugger());
			}
		}
		else
		{
			return $arr = array('success'=>false,'message'=>"Please check your intrenet connection.");
		}
	}
}
?>