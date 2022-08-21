<?php
class FileUploadController extends AppController {
	
	public function index() {
		$this->set('title', __('File Upload Answer'));

		$file_uploads = $this->FileUpload->find('all');
		$this->set(compact('file_uploads'));
	}
	public function submit()
	{
		$file= $this->request->data;

		if($file){
			
			$data = array(
				'file_uploads' => array(
				'name' => $file["FileUpload"]["file"],
				'email'=> 'leon@mail.com',
				'valid'=> 1,
				'created'=>'',
				'modified'=>'',
			));
			
			// prepare the model for adding a new entry
			$this->FileUpload->create();
			
			// save the data
			$this->FileUpload->save($data);


			$this->setFlash('File Upload Done.');
		}else{
			$this->setFlash('File Upload Failed.');
		}
		$this->Redirect("index");
	}
}