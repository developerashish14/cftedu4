<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
	
if(!function_exists('ECHS_user_verification'))
{
    function ECHS_user_verification($code)
    {
        $msg = '
        <html>
            <head></head>
            <body>
                <div style="background: #efefef; padding: 0 15%;">
                    <div style="background: #fff; padding: 5px 3%;">
                        <div>
                        <div style="display: inline;text-align:center;">
                            <h3 style="margin: 10px 0;font-size: 35px;">ECHS</h3>
                        </div>
                        </div>
                        <hr style="height: 10px;background-color: black;border: none;">
                        <div>
                            <h3 style="text-align: center;">Beneficiary Verification</h3>
                            <p>Dear Sir/Madam,</p>
                            <p>we identified you are trying to log in on the ECHS complaint website please confirm your login with the below OTP</p>
                            <p style="text-align:center;font-size:32px;"><b>'.$code.'</b></p>
                            <br>
                            <br>
                            <p style="margin: 2px 0;">ECHS Delhi</p>
                            <p><BR></p>
                        </div>
                    </div>
                    
                    <div style="text-align: center; padding: 3%; font-family: monospace;">
                        <p style="font-size: 10px; margin: 0px;">© '.date('Y').' ECHS. All right reserved. Developed by PCTIL.</p>
                        <p style="font-size: 10px; margin: 0px;">PLEASE DO NOT PRINT THIS EMAIL TO SAVE ENVVIRONMENT</p>
                    </div>
                </div>
            </body>
        </html>
            
        ';
        
        return $msg;
    }
}

?>