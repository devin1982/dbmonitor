<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
class Mailer {
 
    var $mail;
 
    public function __construct()
    {
        require_once('mailer/class.smtp.php');
        require_once('mailer/class.phpmailer.php');
        // the true param means it will throw exceptions on errors, which we need to catch
        $this->mail = new PHPMailer(true);
 
        $this->mail->IsSMTP(); // telling the class to use SMTP
        $this->mail->IsHTML(true);
        $this->mail->Encoding = "base64"; 
        $this->mail->CharSet = "utf-8";                  // 一定要設定 CharSet 才能正確處理中文
        $this->mail->SMTPDebug  = 0;                     // enables SMTP debug information
        $this->mail->SMTPAuth   = true;                  // enable SMTP authentication
                   // sets the prefix to the servier
        $this->mail->Host       = "smtp.exmail.qq.com";      // sets GMAIL as the SMTP server
        $this->mail->Port       = 25;                   // set the SMTP port for the GMAIL server
        $this->mail->Username   = "ruoyu.lu@tuanche.com";// GMAIL username
        $this->mail->Password   = "devin1982";       // GMAIL password
        $this->mail->AddReplyTo('ruoyu.lu@tuanche.com', 'ruoyu.lu');
        $this->mail->SetFrom('ruoyu.lu@tuanche.com', 'ruoyu.lu');
    }
 
    public function sendmail($tolist, $subject, $body){
        try{
            $this->mail->ClearAddresses();            
            foreach($tolist as $sendto){
            $this->mail->AddAddress($sendto);
            }
 
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;
 
            $this->mail->Send();
            //    echo "Message Sent OK</p>\n";
 
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
            return 0;
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
            return 0;
        }
         return 1;
    }
    
}
 
/* End of file mailer.php */
 
