<?php

// include_once APPPATH . '/libraries/pdf.php';

defined('BASEPATH') or exit('No direct script access allowed');
class Traffic extends MY_Controller
{
	private $sqlResultLimit = 20;

	function __construct()
	{
		parent::__construct();
		$this->load->helper(['url', 'typography', 'global', 'file']);



		if (!$this->session->has_userdata('logged_in')) {
			redirect('/auth');
		}

		if ($this->session->has_userdata('secret_code') && !$this->session->has_userdata('googleCode')) {
			redirect('/autentifikacia');
		}

		$this->load->model('traffic_model');
	}

	/*
	 * Traffic disruptions list
	 *
	 * @return void
	 */

	public function index()
	{

		if (!$this->auth_model->canDo('traffic')) {
			$this->session->set_flashdata('error', 'Na túto akciu nemáte oprávenie.');
			redirect('/admin');
		}

		$all_paragraphs = $this->traffic_model->getParagraphs();
		$traffic_disruptions = $this->traffic_model->getTrafficDisruptions();




		foreach ($traffic_disruptions as $key => $traffic_disruption) {
			$traffic_disruptions[$key]['paragraphs_id'] = $this->traffic_model->getTrafficDisruptionsParagraphsIds($traffic_disruption['id']);
		}

		foreach ($traffic_disruptions as $key => $traffic_disruption) {
			$data = (array_map('array_shift', $traffic_disruption['paragraphs_id']));

			foreach ($all_paragraphs as $paragraph) {

				if (in_array($paragraph['id'], $data)) {
					$selected_paragraphss[] = $paragraph['paragraph'];
					$traffic_disruptions[$key]['paragraphs'] = $selected_paragraphss;
				}
			}
			unset($traffic_disruptions[$key]['paragraphs_id']);
		}



		$this->data['traffic_disruptions'] 	= 	$traffic_disruptions;
		$this->data['paragraphs'] 	= 			$all_paragraphs;

		$this->load->view('admin/admin_header', $this->data);
		$this->load->view('admin/traffic/show', $this->data);
	}



	/*
	 * Create disruption 
	 *
	 * @return void
	 */


	public function create()
	{
		$this->data['pageHeaderTitle'] 	= 'Doprava';

		$this->data['paragraphs'] 	=  $this->traffic_model->getParagraphs();

		if ($post = $this->input->post()) {


			$post['date'] = date('Y-m-d H:i:s', strtotime($post['date'] . ' ' . $post['time']));
			$post['created_by'] = $this->session->userdata('id');

			$disruption_data = $post;

			unset($disruption_data['paragraphs'], $disruption_data['time']);

			$traffic_disruption_id = $this->traffic_model->insertTrafficDisruption($disruption_data);


			$insert_paragraphs = [];

			if (isset($post['paragraphs'])) {
				foreach ($post['paragraphs'] as $paragraph_id) {
					$insert_paragraphs[] = array(
						'legal_paragraph_id' => $paragraph_id,
						'traffic_discruption_id' => $traffic_disruption_id
					);
				}
			}
			if (!empty($insert_paragraphs)) {
				$this->traffic_model->inserTraffiscDrisruptionsParagraphs($insert_paragraphs);
			}

			redirect('admin/traffic/edit/' . $traffic_disruption_id);
		}


		$this->load->view('admin/admin_header', $this->data);

		$this->load->view('admin/traffic/step', $this->data);
	}




	public function pdf($slug)
	{
		
		if ($traffic_disruption = $this->traffic_model->getTrafficDisruption($slug)) {
			
			$all_paragraphs = $this->traffic_model->getParagraphs();

			$traffic_disruption['paragraphs_id'] = $this->traffic_model->getTrafficDisruptionsParagraphsIds($traffic_disruption['id']);
			$data = (array_map('array_shift', $traffic_disruption['paragraphs_id']));
			foreach ($all_paragraphs as $paragraph) {
				
				if (in_array($paragraph['id'], $data)) {
					$selected_paragraphss[] = $paragraph['paragraph'];
					$traffic_disruption['paragraphs'] = $selected_paragraphss;
				}
			}
			
			unset($traffic_disruption['paragraphs_id']);

			$this->data['pageHeaderTitle'] 	= 'Dopustili ste sa';
			$this->data['paragraphs'] 	=  $this->traffic_model->getParagraphs();
			$this->data['traffic_disruption'] 	= 	$traffic_disruption;
			ini_set('memory_limit', '128M'); // boost the memory limit if it's low ;)
			$this->load->library('pdf');
			$this->load->library('pdf');
			$pdf = $this->pdf->load();
			// write the HTML into the PDF
			$html = $this->load->view('admin/traffic/traffic_final_pdf', $this->data, true);
			$pdf->WriteHTML($html);
			$output = 'itemreport' . date('Y_m_d_H_i_s') . '_.pdf';
			$pdf->Output("$output", 'I');
			
		
		} else {
			$this->session->set_flashdata('error', 'Priestupok neexistuje alebo bol vymazaný.');
			redirect('/admin/traffic');
		}
	}

	public function show_pdf()
	{

		if ($post = $this->input->post()) {

			$post['date'] = date('Y-m-d H:i:s', strtotime($post['date'] . ' ' . $post['time']));
			$post['created_by'] = $this->session->userdata('id');

			$traffic_disruption = $post;

			$all_paragraphs = $this->traffic_model->getParagraphs();
			foreach ($all_paragraphs as $paragraph) {

				if (in_array($paragraph['id'], $post['paragraphs'])) {
					$selected_paragraphss[] = $paragraph['paragraph'];
					$traffic_disruption['paragraphs'] = $selected_paragraphss;
				}
			}

			unset($traffic_disruption['paragraphs_id']);

			$this->data['pageHeaderTitle'] 	= 'Dopustili ste sa';
			$this->data['paragraphs'] 	=  $this->traffic_model->getParagraphs();
			$this->data['traffic_disruption'] 	= 	$traffic_disruption;
			ini_set('memory_limit', '128M'); // boost the memory limit if it's low ;)
			$this->load->library('pdf');
			$this->load->library('pdf');
			$pdf = $this->pdf->load();
			// write the HTML into the PDF
			$html = $this->load->view('admin/traffic/preview_pdf', $this->data, true);
			$pdf->WriteHTML($html);
			$output = 'itemreport' . date('Y_m_d_H_i_s') . '_.pdf';
			$pdf->Output("$output", 'I');
		} else {
			$this->session->set_flashdata('error', 'Priestupok neexistuje alebo bol vymazaný.');
			redirect('/admin/traffic');
		}
	}


	/*
	 * Edit form
	 *
	 * @
	 *
	 * @return void
	 */
	public function edit($slug)
	{

		


		$traffic_disruptions_ids = array_map("array_shift", $this->traffic_model->getTrafficDisruptionsParagraphsIds($slug));

		foreach ($traffic_disruptions_ids as $id) {

			$selected_paragraphs[] = $this->traffic_model->getLegalParagraphs($id);
		}

		if (isset($selected_paragraphs) && !empty($selected_paragraphs)) {

			$selected_paragraphs_ids = array_map("array_shift", $selected_paragraphs);
		} else {
			$selected_paragraphs_ids = 0;
		}

		$traffic_disruption = $this->traffic_model->getTrafficDisruption($slug);



		$this->data['pageHeaderTitle'] 	= 'Edit';
		$this->data['paragraphs'] 	=  $this->traffic_model->getParagraphs();
		$this->data['selected_paragraphs_ids'] 	=  $selected_paragraphs_ids;
		$this->data['traffic_disruption'] 	=  $traffic_disruption;


		if ($post = $this->input->post()) {

			$id = $traffic_disruption['id'];
			$vrn = $traffic_disruption['vrn'];

			$images = [
				'car_image',
				'front_image',
				'document_image',

			];

			foreach ($images as $image_name_key) {
				if (isset($_FILES[$image_name_key]['name']) && !empty($_FILES[$image_name_key]['name'])) {
					$post[$image_name_key . '_delete'] = '1';
				}

				if (isset($post[$image_name_key . '_delete']) && !empty($post[$image_name_key . '_delete']) == 1) {
					$this->traffic_model->updateTrafficDiscruptionImage($id, $image_name_key, $traffic_disruption[$image_name_key]);

					if (file_exists('uploads/traffic/' . $vrn . '/' . $id . '/' . $traffic_disruption[$image_name_key]) && !empty($traffic_disruption[$image_name_key])) {
						unlink('uploads/traffic/' . $vrn . '/' . $id . '/' . $traffic_disruption[$image_name_key]);
					}
				}
			}

			unset($post['car_image_delete'], $post['front_image_delete'], $post['document_image_delete']);


			//Upload photo 
			$disruption_image_data = $this->upload($vrn, $id, $images);
			$this->traffic_model->insertTrafficDristributionImage($slug, $disruption_image_data);

			//Update traffic disruptions
			$post['date'] = date('Y-m-d H:i:s', strtotime($post['date'] . ' ' . $post['time']));
			$post['created_by'] = $this->session->userdata('id');

			$disruption_data = $post;

			unset($disruption_data['paragraphs'], $disruption_data['time']);

			$traffic_disruption_id = $this->traffic_model->updateTrafficDisruption($slug, $disruption_data);

			$insert_paragraphs = [];

			if (isset($post['paragraphs'])) {
				foreach ($post['paragraphs'] as $paragraph_id) {
					$insert_paragraphs[] = array(
						'legal_paragraph_id' => $paragraph_id,
						'traffic_discruption_id' => $traffic_disruption_id
					);
				}
			}
			$this->traffic_model->deleteParagraphs($traffic_disruption['id']);

			if (!empty($insert_paragraphs)) {
				$this->traffic_model->inserTraffiscDrisruptionsParagraphs($insert_paragraphs);
			}

			

			// redirect('/admin/traffic');
			// redirect('admin/traffic/pdf/' . $traffic_disruption['id']);
		}



		$this->load->view('admin/admin_header', $this->data);

		$this->load->view('admin/traffic/form', $this->data);
	}

	public function upload($vrn, $id, $images)
	{

		$response = [];

		$this->upload_dir = './uploads/traffic/' . $vrn . '/' . $id . '/';

		foreach ($images as $image_name_key) {
			if (isset($_FILES[$image_name_key]['name']) && !empty($_FILES[$image_name_key]['name'])) {


				$temp_name  = $_FILES[$image_name_key]['name'];
				$extension  = strtolower(substr(strrchr($temp_name, '.'), 1));
				$image_name = $this->generateToken(30);
				if (!file_exists($this->upload_dir)) {
					mkdir($this->upload_dir, 0775, true);
				}
				$image = $image_name . '.' . $extension;

				$saveToDir = './uploads/traffic/' . $vrn . '/' . $id . '/';
				$imagePath = $_FILES[$image_name_key]['tmp_name'];
				$imageName = $image;
				$data = $this->traffic_model->resizeImages($imagePath, 10000, $saveToDir, $imageName, 1000);

				$response[$image_name_key] = $image;
			}
		}



		return $response;
	}





	private function generateToken($length = 10)
	{

		$characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString     = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}



	/*
	 * Delete 
	 *
	 * @param
	 * 
	 * @return void
	 */
	public function delete()
	{

		if (!$post = $this->input->post()) {
			$this->session->set_flashdata('error', 'Vyskytla sa chyba. Skúste to prosím znovu.');
		} else {

			if (file_exists('uploads/traffic/' . $post['vrn'] . '/' . $post['id'])) {
				array_map('unlink', glob('uploads/traffic/' . $post['vrn'] . '/' . $post['id'] . '/*.*'));
				rmdir('uploads/traffic/' . $post['vrn'] . '/' . $post['id']);
				rmdir('uploads/traffic/' . $post['vrn']);
			}

			// exit;
			$this->traffic_model->deleteParagraphs($post['id']);
			$this->traffic_model->deleteDisruption($post['id']);


			$this->session->set_flashdata('success', 'Priestupok bol odstránený!');
		}

		redirect('admin/traffic');
	}
}
