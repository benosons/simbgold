<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Simbg_lib
{

	function __construct()
	{
		//Get the CodeIgniter super object
		$this->ci =& get_Instance();
		$this->ci->load->library('session');
		$this->ci->load->database();
	}

	function sendEmail($email,$subject,$text)
	{
		$this->ci->load->library('PHPMailerAutoload');
		$mail = new PHPMailer();
        $mail->SMTPDebug = false;
		$mail->protocol = 'mail';
		$mail->charset = 'iso-8859-1';
		$mail->wordwrap = TRUE;
        $mail->Debugoutput = 'html';
		$mail->isSMTP();
        $mail->Host = gethostbyname('ssl://smtp.gmail.com');
        $mail->Port = '465';
        $mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
        $mail->Username = 'simbg@pu.go.id';
        $mail->Password = 'SIMBG2020!!';
		$mail->setFrom('simbg@pu.go.id', 'CS SIMBG');
        $mail->addAddress($email);
		$mail->Subject = $subject;
		$mail->Body = $text;
		$mail->isHTML(true);
        $mail->send();
	}

	function sendEmailWithAttachment($file,$nama_file,$email,$subject,$text)
	{
		$this->ci->load->library('PHPMailerAutoload');
		$mail = new PHPMailer();
        $mail->SMTPDebug = false;
		$mail->protocol = 'mail';
		$mail->charset = 'iso-8859-1';
		$mail->wordwrap = TRUE;
        $mail->Debugoutput = 'html';
		$mail->isSMTP();
        $mail->Host = gethostbyname('ssl://smtp.gmail.com');
        $mail->Port = '465';
        $mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
        $mail->Username = 'simbgcs.reset@gmail.com';
        $mail->Password = '@shinigami07';
		$mail->setFrom('simbgcs.reset@gmail.com', 'CS SIMBG');
		$mail->AddAttachment( $file,$nama_file);
		$mail->addAddress($email);
		$mail->Subject = $subject;
		$mail->Body = $text;
		$mail->isHTML(true);

		$mail->send();
	}

	function sendEmailWithAttachmentAndCopyCarbon($file,$nama_file,$email,$subject,$text,$queryAddCopyCarbon)
	{
		$this->ci->load->library('PHPMailerAutoload');

		$mail = new PHPMailer();
        $mail->SMTPDebug = false;
		$mail->protocol = 'mail';
		$mail->charset = 'iso-8859-1';
		$mail->wordwrap = TRUE;
        $mail->Debugoutput = 'html';

		$mail->isSMTP();
        $mail->Host = gethostbyname('ssl://smtp.gmail.com');
        $mail->Port = '465';
        $mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
        $mail->Username = 'simbgcs@gmail.com';
        $mail->Password = 'cssimbg88';
		$mail->setFrom('cssimbg.stanbakpupr@gmail.com', 'CS SIMBG');

		$mail->AddAttachment( $file,$nama_file);
		foreach ($queryAddCopyCarbon as $row)
		{
			$mail->AddCC($row->email, $row->nama_personal);
		}

		$mail->addAddress($email);
		$mail->Subject = $subject;
		$mail->Body = $text;
		$mail->isHTML(true);

		$mail->send();
	}


	function getNamaPermohonan($jml_lantai_bg,$luas_bg,$id_jenis_permohonan,$id_fungsi_bg,$id_klasifikasi_bg,$id_dok_tek)
	{
		$id = "";
		$kompleksitas = "";
		//set Kompleksitas
		if($id_fungsi_bg == '5')
		{
			$kompleksitas = '3';
		}else{
			if($luas_bg <= 500)
			{
				$kompleksitas = '1';
			}else if(($luas_bg > 500 || $jml_lantai_bg > 2)){
				$kompleksitas = '2';
			}
		}
		//end set Kompleksitas
		$this->ci->load->model('mpengajuan','mpp');

		$query = $this->ci->mpp->getNamaPermohonan_list('a.*',$kompleksitas,$id_klasifikasi_bg,$id_jenis_permohonan,$id_dok_tek);
		if ($query->num_rows() == 1)
		{
			$data 	= $query->row_array();
			$id		= $data['id'];
		}

		return $id;
	}

	function check_session_login()
	{
		$session_login 	= $this->ci->session->userdata('loc_login');
		if ($session_login==TRUE)
		{
			$menu = $this->ci->uri->segment(1);
			$role_id = $this->ci->session->userdata('loc_role_id');
			$query_menu = $this->ci->db->get_where('tm_menu',['url' => $menu])->row_array();
			$menu_id = $query_menu['id'];
			$user_access = $this->ci->db->get_where('tm_role_menu',[
				'role_id' => $role_id,
				'menu_id' => $menu_id
				]);
			if ($user_access->num_rows() < 1) {
						redirect('Front');
					}
		} else {
			redirect('Front');
		}
	}

	function check_session_login2()
	{
		$session_login 	= $this->ci->session->userdata('loc_login');
		if ($session_login==TRUE)
		{
			$url = $this->ci->uri->segment(1);
			if ($this->ci->uri->segment(2))  $url .= '/'.$this->ci->uri->segment(2);
			//if ($this->ci->uri->segment(3))  $url = $this->ci->uri->segment(2).'/'.$this->ci->uri->segment(3);
			$cek_db_menu = $this->ci->mmenu->getDataMenu('url',$this->ci->session->userdata('loc_role_id'),$url)->row_array();
			//$url2 = count($cek_db_menu['url']);
			//menu_id = role_id (hanya segment 1, tm_role_menu)
			if (count($cek_db_menu['url']) == 0) {
						//$url2 = $this->ci->uri->segment(1).'/'.$this->ci->session->userdata('recent_c');
						//$cek_db_menu2 = $this->ci->mmenu->getDataMenu('url',$this->ci->session->userdata('loc_role_id'),$url2)->row_array();
						//if (count($cek_db_menu2['url']) == 0) {
							//redirect('Front');
							//echo $url2;
						//}
						redirect('Front');
						//echo "<script type='text/javascript'>alert('$url');</script>";
					}
		} else {
			redirect('Front');
		}

	}

	public function getCSRFToken()
	{
		return $this->ci->security->get_csrf_hash();
	}

}
