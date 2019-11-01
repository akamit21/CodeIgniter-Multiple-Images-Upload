<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Gallery_mdl
 */

class Gallery_mdl extends Base_Model
{
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}

	/**
	 * Insert a new row into the table. $data should be an associative array
	 * of data to be inserted. Returns newly created ID.
	 * @param  array $data [form input data]
	 * @return boolean
	 */
	public function insert($data)
	{
		if ($data != null) {
			$this->db->insert('gallery', $data);
			if($this->db->affected_rows() != 1) {
				error_log('Error, Unable to insert data in table.');
				return false;
			}
			$response = array(
				'status' => true,
				'id' => $this->db->insert_id()
			);
			return $response;
		} else {
			error_log('Error, Undefined variabled: $data');
			return false;
		}
	}

	/**
	 * Insert images for plant gallery.
	 * @param  array $names [image name]
	 * @param  array $id    [plant id]
	 * @return array
	 */
	public function insert_plant_gallery($names, $id)
	{
		if ($names != null && $id != null) {
			foreach ($names as $name) {
				$data = array(
					'fk_plant_id' => $id,
					'img_name' => $name
				);
				$this->db->insert('plant_gallery', $data);
			}
			$response = array(
				'status' => true,
				'id' => $id
			);
			return $response;

		} else {
			error_log('Error, Undefined variabled: $id');
			return false;
		}
	}

	/**
	 * Get images of plant gallery.
	 * @param  int $id [plant id]
	 * @return array
	 */
	public function get_plant_gallery($id)
	{
		if ($id != null) {
			return $this->db->get_where('plant_gallery', array('fk_plant_id' => $id))->result();
		} else {
			error_log('Error, Undefined variabled: $id');
			return false;
		}
	}

	/**
	 * Delete images of plant gallery.
	 * @param  string $name [image name]
	 * @param  int    $id   [plant id]
	 * @return boolean
	 */
	public function delete_gallery_image($name, $id)
	{
		if ($name != null && $id != null) {
			$this->db->where(array('fk_plant_id' => $id, 'img_name' => $name));
			$this->db->delete('plant_gallery');
			if($this->db->affected_rows() == 1) {
				if(file_exists('assets/img/plants/' . $id . '/gallery/' . $name)) {
					unlink('assets/img/plants/' . $id . '/gallery/' . $name);
				}
				return true;
			}
			return false;
		} else {
			error_log('Error, Undefined variabled: $name');
			return false;
		}
	}

	/**
	 * Return the next auto increment of the table. Only tested on MySQL.
	 */
	public function get_next_id()
	{
		return (int) $this->db->select('AUTO_INCREMENT')
			->from('information_schema.TABLES')
			->where('TABLE_NAME', 'gallery')
			->where('TABLE_SCHEMA', $this->db->database)->get()->row()->AUTO_INCREMENT;
	}
}

/* End of file Plant.php */
/* Location: ./application/modules/plants/models/Plant.php */
