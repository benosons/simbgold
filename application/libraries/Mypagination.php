<?php  if ( ! defined('BASEPATH' )) exit('No direct script access allowed' );
/**
* Class untuk paging
*/
Class Mypagination
{
	function __construct()
	{
		$this->SP =& get_instance();
		$this->SP->load->library('pagination' );
	}
	
	function getPagination($total, $per_page, $url, $uri_segment)
	{
		$config['base_url' ] = base_url().index_page() .$url;
		$config['full_tag_open' ] = '<div class=paging>' ;
		$config['full_tag_close' ] = '</div>' ;
		$config['cur_tag_open' ] = '<span class=pag_link_cur>' ;
		$config['cur_tag_close' ] = '</span>' ;
		$config['num_tag_open' ] = '<span class=pag_link>' ;
		$config['num_tag_close' ] = '</span>' ;
		$config['uri_segment' ] = $uri_segment;
		$config['next_link' ] = 'next �' ;
		$config['prev_link' ] = '� prev' ;
		$config['first_link'] = '�� first';
		$config['last_link'] = 'last ��';
		$config['num_links' ] = 3;
		$config['total_rows' ] = $total;
		$config['per_page' ] = $per_page;
		$this->SP->pagination->initialize($config);
		$data['link' ]=$this->SP->pagination->create_links();
		// echo $this->SP->pagination->create_links();
		$data['url' ]=$config;
		// echo print_r ($config);
		return $data;
 }
}

?>