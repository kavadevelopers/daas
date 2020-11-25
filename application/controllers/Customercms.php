<?php
class Customercms extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function terms()
	{
		$data['_title']		= "Customer App - Terms and Conditions";
		$data['content']	= $this->db->get_where('pages',['id' => '1'])->row_array()['content'];
		$this->load->theme('cms/customer/terms',$data);
	}

	public function terms_save()
	{
		$data = [
			'content' => $this->input->post('content')
		];
		$this->db->where('id','1')->update('pages',$data);

		$this->session->set_flashdata('msg', 'Page Updated');
		redirect(base_url('customercms/terms'));
	}

	public function privacy()
	{
		$data['_title']		= "Customer App - Privacy Policy";
		$data['content']	= $this->db->get_where('pages',['id' => '2'])->row_array()['content'];
		$this->load->theme('cms/customer/privacy',$data);
	}

	public function privacy_save()
	{
		$data = [
			'content' => $this->input->post('content')
		];
		$this->db->where('id','2')->update('pages',$data);

		$this->session->set_flashdata('msg', 'Page Updated');
		redirect(base_url('customercms/privacy'));
	}

	public function about()
	{
		$data['_title']		= "Customer App - About App";
		$data['content']	= $this->db->get_where('pages',['id' => '3'])->row_array()['content'];
		$this->load->theme('cms/customer/about',$data);
	}

	public function about_save()
	{
		$data = [
			'content' => $this->input->post('content')
		];
		$this->db->where('id','3')->update('pages',$data);

		$this->session->set_flashdata('msg', 'Page Updated');
		redirect(base_url('customercms/about'));
	}

	public function how()
	{
		$data['_title']		= "Customer App - How Does it Works ?";
		$data['content']	= $this->db->get_where('pages',['id' => '4'])->row_array()['content'];
		$this->load->theme('cms/customer/how',$data);
	}

	public function how_save()
	{
		$data = [
			'content' => $this->input->post('content')
		];
		$this->db->where('id','4')->update('pages',$data);

		$this->session->set_flashdata('msg', 'Page Updated');
		redirect(base_url('customercms/how'));
	}

	public function faq()
	{
		$data['_title']		= "Customer App - FAQ's";
		$data['list']	= $this->db->get_where('faq_customer')->result_array();
		$data['_e']		= "0";
		$this->load->theme('cms/customer/faq',$data);
	}

	public function save_faq()
	{
		$data = [
			'que'	=> $this->input->post('que'),
			'ans'	=> $this->input->post('ans'),
		];
		$this->db->insert('faq_customer',$data);

		$this->session->set_flashdata('msg', 'FAQ Added');
		redirect(base_url('customercms/faq'));
	}

	public function edit_faq($id)
	{
		$data['_title']		= "Customer App - FAQ's";
		$data['list']	= $this->db->get_where('faq_customer')->result_array();
		$data['faq']	= $this->db->get_where('faq_customer',['id' => $id])->row_array();
		$data['_e']		= "1";
		$this->load->theme('cms/customer/faq',$data);
	}

	public function update_faq()
	{
		$data = [
			'que'	=> $this->input->post('que'),
			'ans'	=> $this->input->post('ans'),
		];
		$this->db->where('id',$this->input->post('id'))->update('faq_customer',$data);

		$this->session->set_flashdata('msg', 'FAQ Updated');
		redirect(base_url('customercms/faq'));
	}

	public function delete_faq($id)
	{
		$this->db->where('id',$id)->delete('faq_customer');
		$this->session->set_flashdata('msg', 'FAQ Deleted');
		redirect(base_url('customercms/faq'));
	}
}
?>