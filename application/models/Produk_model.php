<?php defined('BASEPATH') OR exit('No direct script acces allowed');

class Produk_model extends CI_Model
{
	private $_table = "produk";

	public $id_produk;
	public $nama;
	public $harga;
	public $gambar = "default.jpg";
	public $deskripsi;

	public function rules()
	{
		return [
			['field' => 'nama',
			'label' => 'Nama',
			'rules' => 'required'],

			['field' => 'harga',
			'label' => 'Harga',
			'rules' => 'numeric'],

			['field' => 'deskripsi',
			'label' => 'Deskripsi',
			'rules' => 'required'],
		];
	}

	//menampilkan DB
	public function getAll()
	{
		return $this->db->get($this->_table)->result();
	}
	//READ = menampilkan data berdasarkan ID
	public function getById($id)
	{
		return $this->db->get_where($this->_table, ["id_produk" => $id])->row();
		//SELECT * FROM produk WHERE id_produk=$id;
	}
	//CREAT = mengisikan data
	public function save()
	{
		$post = $this->input->post();
		$this->id_produk = uniqid();
		$this->nama = $post["nama"];
		$this->harga = $post["harga"];
		$this->deskripsi = $post["deskripsi"];

		$this->db->insert($this->_table, $this);
	}
	//UPDATE = edit data
	public function update()
	{
		$post = $this->input->post();
		$this->id_produk = $post["id"];
		$this->nama = $post["nama"];
		$this->harga = $post["harga"];

		if (!empty($_FILES["gambar"]["name"])){
			$this->gambar=$this->_uploadImage();
		}else{
			$this->gambar=$post["old_image"];
		}
		$this->deskripsi = $post["deskripsi"];

		$this->db->update($this->_table, $this, array('id_produk'=>$post['id']));
	}
	//DELETE = menghapus data
	public function delete($id)
	{
		return $this->db->delete($this->_table, array("id_produk" => $id));
	}

private function _uploadImage()
{
	$config['upload_path']			='./upload/produk';
	$config['allowed_types']		='gif|jpg|png';
	$config['file_name']			=$this->id_produk;
	$config['overwrite']			=true;
	$config['max_size']				=1024;

	$this->load->library('upload', $config);

	if ($this->upload->do_upload('gambar')) {
		return $this->upload->data("file_name");
	}

	return "apel.png";
}
}

?>