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
	public $full_name;
	public $category_slug;

	public $external;

	public function getTotalByAuthor($user_id)
	{
		$this->db->where('author',$user_id);
		$query = $this->db->get('post');
		return $query->num_rows();
	}
	public function get_for_page($limit,$offset)
	{

		$this->db->join('category','category.category_id = post.category_id','left');
		$this->db->join('user','user.user_id = post.author','left');
		if ($this->search!=""){
			$this->db->where(" title like '%$this->search%' OR content like '%$this->search%'  ");
		}
		if ($this->author!="") $this->db->where('author',$this->author);
		if ($this->post_status!="") $this->db->where('post_status',$this->post_status);
		if ($this->external!="") $this->db->where('category.category_id > 0');
		
		if ($this->category_slug!="") $this->db->where('category.category_slug',$this->category_slug);
		$this->db->order_by('date','DESC');
		$this->db->limit($limit,$offset);
		$query = $this->db->get('post');
		return $query->result();
	}
	public function check_availability($old_title_slug,$title_slug){
		if ($old_title_slug==$title_slug){
			return true;
		}
		else{
			$this->db->where('title_slug',$title_slug);
			$query = $this->db->get('post');
			if ($query->num_rows() == 0){
				return true;
			}
			else{
				return false;
			}
		}
	}
	public function insert()
	{
		$this->db->set('category_id',$this->category_id);
		$this->db->set('title',$this->title);
		$this->db->set('title_slug',$this->title_slug);
		$this->db->set('content',$this->content);
		$this->db->set('date',$this->date);
		$this->db->set('time',$this->time);
		$this->db->set('picture',$this->picture);
		$this->db->set('title',$this->title);
		$this->db->set('author',$this->author);
		$this->db->set('post_status',$this->post_status);
		$this->db->insert('post');
	}
	public function update()
	{
		$this->db->where('post_id',$this->post_id);
		$this->db->set('category_id',$this->category_id);
		$this->db->set('title',$this->title);
		$this->db->set('title_slug',$this->title_slug);
		$this->db->set('content',$this->content);
		$this->db->set('date',$this->date);
		$this->db->set('time',$this->time);
		if ($this->picture!="") $this->db->set('picture',$this->picture);
		$this->db->set('title',$this->title);
		$this->db->set('author',$this->author);
		$this->db->set('post_status',$this->post_status);
		$this->db->update('post');
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
		$this->db->where('post_id',$this->post_id);
		$this->db->join('category','category.category_id = post.category_id','left');
		$this->db->join('user','user.user_id = post.author','left');
		$query = $this->db->get('post');
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
		$this->db->where('post_id',$this->post_id);
		$this->db->delete('post');
	}
	public function get_total_row()
	{

		$this->db->join('category','category.category_id = post.category_id','left');
		$this->db->join('user','user.user_id = post.author','left');
		if ($this->search!=""){
			$this->db->where(" title like '%$this->search%' OR content like '%$this->search%'  ");
		}
		if ($this->author!="") $this->db->where('author',$this->author);
		if ($this->post_status!="") $this->db->where('post_status',$this->post_status);
		if ($this->external!="") $this->db->where('category.category_id > 0');
		
		if ($this->category_slug!="") $this->db->where('category.category_slug',$this->category_slug);
		
		if ($this->post_status!="") $this->db->where('post_status',$this->post_status);
		$query = $this->db->get('post');
		return $query->num_rows();
	}
	public function get_popular()
	{
		$this->db->where('category.category_id > 0');
		$this->db->where("hits > 0 AND post_status='Publish' ");
		$this->db->join('category','category.category_id = post.category_id','left');
		$this->db->join('user','user.user_id = post.author','left');
		$this->db->order_by('hits','DESC');
		$query = $this->db->get('post');
		return $query->result();
	}

	public function get_random_cat()
	{
		if ($this->category_slug!="") $this->db->where('category.category_slug',$this->category_slug);
		$this->db->where("hits > 0 AND post_status='Publish' ");
		$this->db->join('category','category.category_id = post.category_id','left');
		$this->db->join('user','user.user_id = post.author','left');
		$this->db->order_by('post_id','DESC');
		$this->db->limit(2);
		$query = $this->db->get('post');
		return $query->result();
	}

	public function set_by_slug()
	{
		$this->db->where('title_slug',$this->title_slug);
		$this->db->join('category','category.category_id = post.category_id','left');
		$this->db->join('user','user.user_id = post.author','left');
		$query = $this->db->get('post');
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
	public function update_hits()
	{
		$hits = $this->hits + 1;
		$this->db->where('title_slug',$this->title_slug);
		$this->db->set('hits',$hits);
		$this->db->update('post');
	}
}