<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model
{
	public $post_id;
	public $title;
	public $title_slug;
	public $content;
	public $date;
	public $time;
	public $picture;
	public $hits;
	public $author;
	public $post_status;
	public $category_id;
	public $category_name;
	public $search;
	public $search_c;
	public $full_name;
	public $category_slug;
	public $edited_at;

	public $external;

	public function __construct()
	{
		parent::__construct();
		$this->db_tahu = $this->load->database('tahu', TRUE);
	}

	public function getTotalByAuthor($user_id)
	{
		$this->db_tahu->where('author',$user_id);
		$query = $this->db_tahu->get('post');
		return $query->num_rows();
	}
	public function get_for_page($limit,$offset)
	{

		$this->db_tahu->join('category','category.category_id = post.category_id','left');
		$this->db_tahu->join('user','user.user_id = post.author','left');
		if ($this->search!=""){
			$this->db_tahu->group_start();
			$this->db_tahu->like('title',$this->search);
			$this->db_tahu->or_like('content',$this->search);
			$this->db_tahu->group_end();
		}
		if ($this->author!="") $this->db_tahu->where('author',$this->author);
		if ($this->post_status!="") $this->db_tahu->where('post_status',$this->post_status);
		if ($this->external!="") $this->db_tahu->where('category.category_id > 0');
		if ($this->search_c!="") $this->db_tahu->where('category.category_id',$this->search_c);
		
		if ($this->category_slug!="") $this->db_tahu->where('category.category_slug',$this->category_slug);
		$this->db_tahu->order_by('date','DESC');
		$this->db_tahu->order_by('time','DESC');
		$this->db_tahu->limit($limit,$offset);
		$query = $this->db_tahu->get('post');
		return $query->result();
	}
	public function check_availability($old_title_slug,$title_slug){
		if ($old_title_slug==$title_slug){
			return true;
		}
		else{
			$this->db_tahu->where('title_slug',$title_slug);
			$query = $this->db_tahu->get('post');
			if ($query->num_rows() == 0){
				return true;
			}
			else{
				return false;
			}
		}
	}

	public function get_by_slug($slug){
		$this->db_tahu->where('title_slug', $slug);
		return $this->db_tahu->get('post')->result();
	}

	public function get_by_id(){
		$this->db_tahu->where('post_id', $this->post_id);
		return $this->db_tahu->get('post')->row();
	}

	public function get_all($limit = null, $where = null){
		$this->db_tahu->where('post_status', 'Publish');
		$this->db_tahu->order_by('publish_date', 'DESC');
		$this->db_tahu->order_by('publish_time', 'DESC');
		if (!empty($where)) {
			$this->db_tahu->where($where);
		}
		if (!empty($limit)) {
			$this->db_tahu->limit($limit);
			if ($limit == 1) {
				$q = $this->db_tahu->get('post')->row();
			}else{
				$q = $this->db_tahu->get('post')->result();
			}
		}else{
			$q = $this->db_tahu->get('post')->result();
		}
		return $q;
	}


	public function get_where_total($where = array()){
		$this->db_tahu->order_by('publish_date', 'DESC');
		$this->db_tahu->order_by('publish_time', 'DESC');
		if (!empty($where)) {
			// print_r($where);die;
			$this->db_tahu->where($where);
		}
		return $this->db_tahu->get('post')->num_rows();
	}

	public function insert()
	{
		$this->db_tahu->set('category_id',$this->category_id);
		$this->db_tahu->set('title',$this->title);
		$this->db_tahu->set('title_slug',$this->title_slug);
		$this->db_tahu->set('content',$this->content);
		$this->db_tahu->set('date',$this->date);
		$this->db_tahu->set('time',$this->time);
		$this->db_tahu->set('picture',$this->picture);
		$this->db_tahu->set('author',$this->author);
		$this->db_tahu->set('id_skpd',$this->session->userdata('id_skpd'));
		$this->db_tahu->set('post_status',$this->post_status);
		return $this->db_tahu->insert('post');
	}

	public function insert_percobaan()
	{
		$this->db_tahu->set('category_id',$this->category_id);
		$this->db_tahu->set('title',$this->title);
		$this->db_tahu->set('title_slug',$this->title_slug);
		$this->db_tahu->set('content',$this->content);
		$this->db_tahu->set('date',$this->date);
		$this->db_tahu->set('time',$this->time);
		$this->db_tahu->set('picture',$this->picture);
		$this->db_tahu->set('author',$this->author);
		$this->db_tahu->set('id_skpd',$this->session->userdata('id_skpd'));
		$this->db_tahu->set('post_status',$this->post_status);
		return $this->db_tahu->insert('post_percobaan');
	}
	public function update()
	{
		$this->db_tahu->where('post_id',$this->post_id);
		$this->db_tahu->set('category_id',$this->category_id);
		$this->db_tahu->set('title',$this->title);
		$this->db_tahu->set('title_slug',$this->title_slug);
		$this->db_tahu->set('content',$this->content);
		$this->db_tahu->set('edited_at',$this->edited_at);
		if ($this->picture!="") $this->db_tahu->set('picture',$this->picture);
		$this->db_tahu->set('title',$this->title);
		$this->db_tahu->set('author',$this->author);
		$this->db_tahu->update('post');
	}
	public function getTags($tags){
		$tags = str_replace('<li class="select2-search-choice">', '', $tags);
		$tags = str_replace('<div>', '', $tags);
		$tags = str_replace('</div>', ';', $tags);
		$tags = str_replace('<a href="#" onclick="return false;" class="select2-search-choice-close" tabindex="-1"></a>', '', $tags);
		$tags = str_replace('</li>', '', $tags);
		$tags = str_replace('<li class="select2-search-field">', '', $tags);
		$tags = str_replace('<input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" id="s2id_autogen2" style="width: 34px;">', '', $tags);
		$tags = str_replace('<input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input select2-focused" id="s2id_autogen2" style="width: 34px;">','',$tags);
		$tags = str_replace('  ', '', $tags);
		return $tags;
	}
	public function setTags($tags)
	{
		$tag="";
		if ($tags!=""){
			$exp = explode(";", $tags);
			for ($x=0; $x < (count($exp) - 1) ; $x++)
			{
				$tag .= "<li class='select2-search-choice'>";
				$tag .= "<div>";
				$tag .= $exp[$x];
				$tag .= "</div>";
				$tag .= "<a href='#' onclick='return false;' class='select2-search-choice-close' tabindex='-1'></a>";
				$tag .= "</li>";
			}
		}
		return $tag;
	}
	public function getDate($date)
	{
		
		$s = explode(",", $date);
		$newDate = $s[1];
		$s2 = explode(" ", $newDate);
		$day = $s2[1];
		$month = $s2[2];
		$year = $s2[3];
		$months = array(
			'January' => '1',
			'February' => '2',
			'March' => '3',
			'April' => '4',
			'May' => '5',
			'June' => '6',
			'July' => '7',
			'August' => '8',
			'September' => '9',
			'October' => '10',
			'November' => '11',
			'December' => '12',
		);
		$numMonth = $months[$month];
		return $year."-".$numMonth."-".$day;
	}
	public function set_by_id()
	{
		$this->db_tahu->where('post_id',$this->post_id);
		$this->db_tahu->join('category','category.category_id = post.category_id','left');
		$this->db_tahu->join('user','user.user_id = post.author','left');
		$query = $this->db_tahu->get('post');
		foreach ($query->result() as $row) {
			$this->category_id 		= $row->category_id;
			$this->category_name	= $row->category_name;
			$this->title 			= $row->title;
			$this->title_slug 		= $row->title_slug;
			$this->content 			= $row->content;
			$this->date 			= $row->date;
			$this->time 			= $row->time;
			$this->picture 			= $row->picture;
			$this->hits 			= $row->hits;
			$this->author 			= $row->author;
			$this->full_name		= $row->full_name;
			$this->post_status 		= $row->post_status;
		}
	}
	public function delete()
	{
		$this->db_tahu->where('post_id',$this->post_id);
		$this->db_tahu->delete('post');
	}
	public function get_total_row()
	{

		$this->db_tahu->join('category','category.category_id = post.category_id','left');
		$this->db_tahu->join('user','user.user_id = post.author','left');
		if ($this->search!=""){
			$this->db_tahu->group_start();
			$this->db_tahu->like('title',$this->search);
			$this->db_tahu->or_like('content',$this->search);
			$this->db_tahu->group_end();
		}
		if ($this->author!="") $this->db_tahu->where('author',$this->author);
		if ($this->post_status!="") $this->db_tahu->where('post_status',$this->post_status);
		if ($this->external!="") $this->db_tahu->where('category.category_id > 0');
		if ($this->search_c!="") $this->db_tahu->where('category.category_id',$this->search_c);
		
		if ($this->category_slug!="") $this->db_tahu->where('category.category_slug',$this->category_slug);
		
		if ($this->post_status!="") $this->db_tahu->where('post_status',$this->post_status);
		$query = $this->db_tahu->get('post');
		return $query->num_rows();
	}
	public function get_popular()
	{
		$this->db_tahu->where('category.category_id > 0');
		$this->db_tahu->where("hits > 0 AND post_status='Publish' ");
		$this->db_tahu->join('category','category.category_id = post.category_id','left');
		$this->db_tahu->join('user','user.user_id = post.author','left');
		$this->db_tahu->order_by('hits','DESC');
		$this->db_tahu->limit('3');
		$query = $this->db_tahu->get('post');
		return $query->result();
	}

	public function get_random_cat()
	{
		if ($this->category_slug!="") $this->db_tahu->where('category.category_slug',$this->category_slug);
		$this->db_tahu->where("hits > 0 AND post_status='Publish' ");
		$this->db_tahu->join('category','category.category_id = post.category_id','left');
		$this->db_tahu->join('user','user.user_id = post.author','left');
		$this->db_tahu->order_by('post_id','DESC');
		$this->db_tahu->limit(2);
		$query = $this->db_tahu->get('post');
		return $query->result();
	}

	public function set_by_slug()
	{
		$this->db_tahu->where('title_slug',$this->title_slug);
		$this->db_tahu->join('category','category.category_id = post.category_id','left');
		$this->db_tahu->join('user','user.user_id = post.author','left');
		$query = $this->db_tahu->get('post');
		if ($query->num_rows() == 0) redirect(base_url('berita'));
		foreach ($query->result() as $row) {
			$this->category_id 		= $row->category_id;
			$this->category_name	= $row->category_name;
			$this->title 			= $row->title;
			$this->title_slug 		= $row->title_slug;
			$this->content 			= $row->content;
			$this->date 			= $row->date;
			$this->time 			= $row->time;
			$this->picture 			= $row->picture;
			$this->hits 			= $row->hits;
			$this->author 			= $row->author;
			$this->full_name		= $row->full_name;
			$this->post_status 		= $row->post_status;
			$this->category_slug	= $row->category_slug;
		}
	}

	public function update_status(){
		$this->db_tahu->where('post_id', $this->post_id);
		$this->db_tahu->set('post_status', $this->post_status);
		$this->db_tahu->set('publish_date', date('Y-m-d'));
		$this->db_tahu->set('publish_time', date('H:i:s'));
		return $this->db_tahu->update('post');
	}

	public function update_hits()
	{
		$hits = $this->hits + 1;
		$this->db_tahu->where('title_slug',$this->title_slug);
		$this->db_tahu->set('hits',$hits);
		$this->db_tahu->update('post');
	}

	public function get_total_by_category()
	{
		$this->db_tahu->select("category.category_id, category.category_name, post.category_id , count(post.category_id) as category_count");
		$this->db_tahu->join('category', 'category.category_id = post.category_id');
		$this->db_tahu->group_by("post.category_id");
		return $this->db_tahu->get('post')->result();
	}
}