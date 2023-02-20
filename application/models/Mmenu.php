<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mmenu extends CI_Model
{


	public function getMenu($menu = '')
	{
		$this->db->select('a.menu_id,b.name_menu,b.url,b.icon,b.parentid');
		$this->db->where('b.parentid', 0);
		$this->db->where('b.menu_aktif', '1');
		(($menu != '') ? $this->db->where_in('a.role_id', $menu) : $this->db->where('menu_aktif', '1'));
		$this->db->join('tm_menu b', 'a.menu_id = b.id');
		$this->db->order_by('b.urut', 'asc');
		$this->db->order_by('b.id', 'asc');
		$query = $this->db->get('tm_role_menu a');
		if ($query->num_rows() > 0) :
			foreach ($query->result() as $row) :

				$url	= $row->url != '#' ? site_url($row->url) : '#';
				$child	= $this->getMenuChild($row->menu_id, $menu);
				$showchild	= ($child != '') ? '#' . $row->menu_id : $url;
				$dd	= ($child != '') ? 'data-toggle="dropdown"' : '';
				echo '<li class="menu-dropdown classic-menu-dropdown " >';
				echo '<a data-hover="megamenu-dropdown" href="' . $showchild . '" data-close-others="true" ' . $dd . ' >';
				// echo '<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="' . $showchild . '">';
				// echo '<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:">';
				echo '<i class="' . $row->icon . '"></i><span class="title"> ' . $row->name_menu;
				echo '</span><spa class="arrow "></spa>
				</a>';
				echo $this->getMenuChild($row->menu_id, $menu);
				echo '</li>';
			endforeach;
		endif;
	}


	function getMenuChild($parent, $menu = '')
	{
		$this->db->select('a.menu_id,b.name_menu,b.url,b.icon,b.parentid');
		$this->db->where('b.parentid', $parent);
		$this->db->where_in('a.role_id', $menu);
		$this->db->where('menu_aktif', '1');
		$this->db->join('tm_menu b', 'a.menu_id = b.id');
		$this->db->order_by('b.urut', 'asc');
		$this->db->order_by('a.id', 'asc');
		$query = $this->db->get('tm_role_menu a');
		$html	= '';
		if ($query->num_rows() > 0) :
			$html	.= '<ul class="dropdown-menu pull-left">';
			foreach ($query->result() as $row) :
				$html	.= '<li class="dropdown-submenu">';
				$url	= $row->url != '#' ? base_url() . $row->url : '#';
				$html	.= '<a href="' . $url . '"> <i class="' . $row->icon . '"></i> ' . $row->name_menu . '</a>';
				$html	.= '</li>';
			endforeach;
			$html	.= '</ul>';
		endif;
		return $html;
	}


	public function ListMenu($role_id_session, $element = '', $role_id_form = '', $class = 'menu-list', $disable = '')
	{
		$input		= '';
		$var	= '';
		$this->db->select('menu_id');
		$this->db->where('role_id', $role_id_form);
		$query_menu_selected	= $this->db->get('tm_role_menu');

		$this->db->select('a.id,a.name_menu,a.url,a.icon,a.parentid');
		$this->db->where('a.parentid', 0);
		$this->db->where('a.menu_aktif', '1');
		$this->db->order_by('a.urut', 'asc');
		$query_menu	= $this->db->get('tm_menu a');

		if ($query_menu->num_rows() > 0) :
			$var .= '<ul class="' . $class . '">';
			foreach ($query_menu->result() as $row) :
				if ($element == 'checkbox') {
					$setVal 	= '';
					foreach ($query_menu_selected->result() as $key) :
						$menu_id = $key->menu_id;
						if ($row->id == $menu_id) {
							$setVal = 'checked="checked"';
						}
					endforeach;
					$set	= $disable != '' ? 'disabled="disabled"' : '';
					$input	= '<input type="checkbox" ' . $setVal . ' name="menu[]" value="' . $row->id . '" ' . $set . '>';
				}
				$var .= '<li class="' . $class . '">' . $input . '<span class="text-menulist">' . $row->name_menu . '</span>';
				$var .= $this->ListMenuParent($row->id, $role_id_session, $element, $role_id_form, $class, $set);
				$var .= '</li>';
			endforeach;
			$var .= '</ul>';
		endif;
		return $var;
	}

	public function ListMenuParent($parent, $role_id_session, $element = '', $role_id_form = '', $class = '', $set)
	{
		$input		= '';
		$var	= '';
		$this->db->select('menu_id');
		$this->db->where('role_id', $role_id_session);
		$query_menu_selected	= $this->db->get('tm_role_menu');

		$this->db->select('a.id,a.name_menu,a.url,a.icon,a.parentid');
		$this->db->where('a.parentid', $parent);
		$this->db->where('a.menu_aktif', '1');
		$this->db->order_by('a.urut', 'asc');
		$query_menu	= $this->db->get('tm_menu a');
		if ($query_menu->num_rows() > 0) :
			$var .= '<ul>';
			foreach ($query_menu->result() as $row) :
				if ($element == 'checkbox') {
					$setVal 	= '';
					foreach ($query_menu_selected->result() as $key) :
						if ($row->id == $key->menu_id) {
							$setVal = 'checked="checked"';
						}
					endforeach;
					$input	= '<input type="checkbox" ' . $setVal . ' name="menu[]" value="' . $row->id . '" ' . $set . '>';
				}
				$var .= '<li>' . $input . '<span class="text-menulist">' . $row->name_menu . '</span>';
				$var .= $this->ListMenuParent($row->id, $role_id_session, $element, $role_id_form, $class, $set);
				$var .= '</li>';
			endforeach;
			$var .= '</ul>';
		endif;
		return $var;
	}

	public function getDataMenu($select = 'url', $id_role, $url)
	{
		$this->db->select($select, FALSE);
		$this->db->join('tm_role_menu b', 'a.id = b.menu_id', 'LEFT');
		$this->db->where('b.role_id', $id_role);
		$this->db->where('a.url', $url);
		//$this->db->where('a.url','setting/profile_user');
		return $this->db->get('tm_menu a');
	}

	//SELECT * from tm_menu a LEFT JOIN tm_role_menu b ON a.id = b.menu_id

}
