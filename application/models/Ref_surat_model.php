<?php

class Ref_surat_model extends CI_Model{

	public function get_all(){
		$query = $this->db->get('ref_surat');
		return $query->result();
	}

	public function get_all_j($jenis){
		$this->db->where('jenis_surat',$jenis);
		$this->db->or_where('jenis_surat','umum');
		$query = $this->db->get('ref_surat');
		return $query->result();
	}

	public function get_page($mulai,$hal,$filter=''){
		// $this->db->offsett(0,6);
		if($filter!=''){
			foreach($filter as $key => $value){
				$this->db->like($key,$value);
			}
		}else{
			$this->db->limit($hal,$mulai);
		}
		$query = $this->db->get('ref_surat');
		return $query->result();
	}

	public function get_page_internal($mulai,$hal,$filter=''){
		// $this->db->offsett(0,6);
		if($filter!=''){
			foreach($filter as $key => $value){
				$this->db->like($key,$value);
			}
		}else{
			$this->db->limit($hal,$mulai);
		}
		$this->db->where('jenis_surat','internal');
		$this->db->or_where('jenis_surat','umum');
		$query = $this->db->get('ref_surat');
		return $query->result();
	}

	public function get_page_eksternal($mulai,$hal,$filter=''){
		// $this->db->offsett(0,6);
		if($filter!=''){
			foreach($filter as $key => $value){
				$this->db->like($key,$value);
			}
		}else{
			$this->db->limit($hal,$mulai);
		}
		$this->db->where('jenis_surat','eksternal');
		$this->db->or_where('jenis_surat','umum');
		$query = $this->db->get('ref_surat');
		return $query->result();
	}




	public function get_by_id($id_ref_surat){
		$this->db->where('id_ref_surat',$id_ref_surat);
		$query = $this->db->get('ref_surat');
		return $query->row();
	}
	public function insert($data){
		$this->load->dbforge();
		$input = $data;
		unset($input['json_form']);
		$this->db->insert('ref_surat',$input);
		$id_ref_surat = $this->db->insert_id();
		$json_data = json_decode($data['json_form']);
		$sort = 1;
		foreach($json_data as $t){

			$tablee = $t->name;
			if ($this->db->field_exists($tablee, 'surat_keluar')){
				$rand = rand(1,99);
				$t_name = $tablee.$rand;
			}else{
				$t_name = $tablee;
				if ($t->type!=='header'){
					$this->db->query("ALTER TABLE surat_keluar ADD `$tablee` BLOB NULL DEFAULT NULL;");
				}
			}

			$table = '';
			$value = '';
			$label = '';
			if(isset($t->lookup)){
				$lookup = $t->lookup;
				if($lookup=='database'){
					if(isset($t->t_value)&&isset($t->table)&&isset($t->t_label)){
						$table = $t->table;
						$value = $t->t_value;
						$label = $t->t_label;
					}else{
						$table = '';
						$value = '';
						$label = '';
					}
				}
			}

			if(isset($t->placeholder)){
				$placeholder = $t->placeholder;
			}else{
				$placeholder = '';
			}

			if(isset($t->subtype)){
				$subtype = $t->subtype;
			}else{
				$subtype = '';
			}

			if(isset($t->className)){
				$class = $t->className;
			}else{
				$class = 'form-control';
			}

			$reference_value = '';
			$re_table = '';
			$re_value = '';
			$re_event = '';

			if(isset($t->autofill)){
				$autofill = $t->autofill;
				if($autofill=='aktif'){
					if(isset($t->reference_value)&&isset($t->re_table)&&isset($t->re_value)&&isset($t->re_event)){
						$reference_value = $t->reference_value;
						$re_table = $t->re_table;
						$re_value = $t->re_value;
						$re_event = $t->re_event;
					}else{
						$reference_value = '';
						$re_table = '';
						$re_value = '';
						$re_event = '';
					}
				}
			}

			$this->db->insert('ref_formulir_field',array('id_ref_surat'=>$id_ref_surat,'sort'=>$sort,'field_name'=>$tablee,'field_label'=>$t->label,'input_type'=>$t->type,'r_value'=>$value,'r_label'=>$label,'r_table'=>$table,'field_placeholder'=>$placeholder,'field_subtype'=>$subtype,'field_class'=>$class,'re_r_value'=>$reference_value,'re_table'=>$re_table,'re_value'=>$re_value,'re_event'=>$re_event));

			$id_field = $this->db->insert_id();
			if(isset($t->lookup)){
				$lookup = $t->lookup;
				if($lookup=='costumize'){
					if($t->type=='checkbox-group'||$t->type=='select'||$t->type=='radio-group'){
						foreach($t->values as $v){
							$this->db->insert('ref_formulir_option',array('id_field'=>$id_field,'id_ref_surat'=>$id_ref_surat,'option_label'=>$v->label,'option_value'=>$v->value));
						}
					}
				}
			}
			$sort++;
		}
	}
	public function update($data,$id_ref_surat){

		$this->load->dbforge();
		$update = $data;
		unset($update['json_form']);
		$this->db->update('ref_surat',$update,array('id_ref_surat'=>$id_ref_surat));
		$json_data = json_decode($data['json_form']);

		$this->db->where('id_ref_surat',$id_ref_surat);
		$delete1 = $this->db->delete('ref_formulir_field');
		$this->db->where('id_ref_surat',$id_ref_surat);
		$delete1 = $this->db->delete('ref_formulir_option');

		$sort = 1;
		foreach($json_data as $t){

			$tablee = $t->name;
			if ($this->db->field_exists($tablee, 'surat_keluar')){
				$rand = rand(1,99);
				$t_name = $tablee.$rand;
			}else{
				$t_name = $tablee;
				if ($t->type!=='header'){
					$this->db->query("ALTER TABLE surat_keluar ADD `$tablee` BLOB NULL DEFAULT NULL;");
				}
			}

			$table = '';
			$value = '';
			$label = '';
			if(isset($t->lookup)){
				$lookup = $t->lookup;
				if($lookup=='database'){
					if(isset($t->t_value)&&isset($t->table)&&isset($t->t_label)){
						$table = $t->table;
						$value = $t->t_value;
						$label = $t->t_label;
					}else{
						$table = '';
						$value = '';
						$label = '';
					}
				}
			}

			if(isset($t->placeholder)){
				$placeholder = $t->placeholder;
			}else{
				$placeholder = '';
			}

			if(isset($t->subtype)){
				$subtype = $t->subtype;
			}else{
				$subtype = '';
			}

			if(isset($t->className)){
				$class = $t->className;
			}else{
				$class = 'form-control';
			}

			$reference_value = '';
			$re_table = '';
			$re_value = '';
			$re_event = '';

			if(isset($t->autofill)){
				$autofill = $t->autofill;
				if($autofill=='aktif'){
					if(isset($t->reference_value)&&isset($t->re_table)&&isset($t->re_value)&&isset($t->re_event)){
						$reference_value = $t->reference_value;
						$re_table = $t->re_table;
						$re_value = $t->re_value;
						$re_event = $t->re_event;
					}else{
						$reference_value = '';
						$re_table = '';
						$re_value = '';
						$re_event = '';
					}
				}
			}

			$this->db->insert('ref_formulir_field',array('id_ref_surat'=>$id_ref_surat,'sort'=>$sort,'field_name'=>$tablee,'field_label'=>$t->label,'input_type'=>$t->type,'r_value'=>$value,'r_label'=>$label,'r_table'=>$table,'field_placeholder'=>$placeholder,'field_subtype'=>$subtype,'field_class'=>$class,'re_r_value'=>$reference_value,'re_table'=>$re_table,'re_value'=>$re_value,'re_event'=>$re_event));
			$id_field = $this->db->insert_id();
			if(isset($t->lookup)){
				$lookup = $t->lookup;
				if($lookup=='costumize'){
					if($t->type=='checkbox-group'||$t->type=='select'||$t->type=='radio-group'){
						foreach($t->values as $v){
							$this->db->insert('ref_formulir_option',array('id_field'=>$id_field,'id_ref_surat'=>$id_ref_surat,'option_label'=>$v->label,'option_value'=>$v->value));
						}
					}
				}
			}
			$sort++;
		}
	}
	public function delete($id_ref_surat){
		$this->db->delete('ref_surat',array('id_ref_surat'=>$id_ref_surat));
		$field = $this->db->get_where('ref_formulir_field',array('id_ref_surat'=>$id_ref_surat))->result();
		foreach($field as $f){
			$field_name = $f->field_name;
			if ($this->db->field_exists($field_name, 'surat_keluar')){
				$this->db->query("ALTER TABLE surat_keluar DROP COLUMN `$field_name`;");
			}
		}
		$this->db->delete('ref_formulir_field',array('id_ref_surat'=>$id_ref_surat));
		$this->db->delete('ref_formulir_option',array('id_ref_surat'=>$id_ref_surat));
	}


	public function get_field($id){
		$this->db->where('id_ref_surat', $id);
		$query = $this->db->get('ref_formulir_field');
		return $query->result();
	}

	public function get_field_with_event($id){
		$this->db->group_by('re_r_value');
		$this->db->group_by('re_event');
		$this->db->where('id_ref_surat', $id);
		$this->db->where('re_r_value is not null');
		$query = $this->db->get('ref_formulir_field');
		$q = $query->result();
		foreach($q as $n => $qq){
			if(empty($qq->re_r_value)){
				unset($q[$n]);
			}
		}
		foreach($q as $n => $qq){
			$this->db->where('field_name',$qq->re_r_value);
			$this->db->where('id_ref_surat', $id);
			$x = $this->db->get('ref_formulir_field')->row();
			$q[$n]->reference_field = $x->r_value;
		}
		return $q;
	}

	public function get_field_with_event_detail($id,$r_value,$event){
		$this->db->where('id_ref_surat', $id);
		$this->db->where('re_r_value',$r_value);
		$this->db->where('re_event',$event);
		$query = $this->db->get('ref_formulir_field');
		return $query->result();
	}

	public function get_field_all(){
		$this->db->where('input_type !=','header');
		$query = $this->db->get('ref_formulir_field');
		return $query->result();
	}

	public function get_field_single($id_field){
		$this->db->where('id_field', $id_field);
		$query = $this->db->get('ref_formulir_field');
		return $query->row();
	}


	public function get_option($id,$tabel=NULL){
		if(!empty($tabel)){
			$query = $this->db->get($tabel);
		}else{
			$this->db->where('id_field', $id);
			$query = $this->db->get('ref_formulir_option');
		}
		return $query->result();
	}

	public function get_total_surat(){
		$query = $this->db->get('ref_surat');
		return $query->num_rows();
	}

	public function get_total_internal(){
		$this->db->where('jenis_surat','internal');
		$query = $this->db->get('ref_surat');
		return $query->num_rows();

	}

	public function get_total_eksternal(){
		$this->db->where('jenis_surat','eksternal');
		$query = $this->db->get('ref_surat');
		return $query->num_rows();
	}
}
