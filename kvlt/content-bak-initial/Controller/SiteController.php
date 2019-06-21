<?php
App::uses('AppController', 'Controller');
class SiteController extends AppController {

	public $uses = array();


	public function beforeFilter() {

		//Start Session
			CakeSession::start();
			App::uses('CakeEmail','Network/Email');

			if(empty($_SESSION['session_datetime'])) {
				$_SESSION['session_datetime']=session_id().time();
			}

		//Set URL params
			// 86400 = 1 day

				if(!empty($_GET['utm_source'])) {
					setcookie("utm_source", $_GET['utm_source'], time() + (86400 * 30), "/");
					$_SESSION['utm_source']=$_GET['utm_source'];
				}

				if(!empty($_GET['utm_medium'])) {
					setcookie("utm_medium", $_GET['utm_medium'], time() + (86400 * 30), "/");
					$_SESSION['utm_medium']=$_GET['utm_medium'];
				}

				if(!empty($_GET['utm_campaign'])) {
					setcookie("utm_campaign", $_GET['utm_campaign'], time() + (86400 * 30), "/");
					$_SESSION['utm_campaign']=$_GET['utm_campaign'];
				}

				if(!empty($_GET['utm_term'])) {
					setcookie("utm_term", $_GET['utm_term'], time() + (86400 * 30), "/");
					$_SESSION['utm_term']=$_GET['utm_term'];
				}

				if(!empty($_GET['utm_content'])) {
					setcookie("utm_content", $_GET['utm_content'], time() + (86400 * 30), "/");
					$_SESSION['utm_content']=$_GET['utm_content'];
				}

				if(empty($_SESSION['utm_source']) && empty($_COOKIE['utm_source'])) {
					if(!empty($_SERVER['HTTP_REFERER'])) {
						$parse = parse_url($_SERVER['HTTP_REFERER']);
						setcookie("utm_source", $parse["host"], time() + (86400 * 30), "/");
						$_SESSION['utm_source']=$parse["host"];

						if(empty($_SESSION['utm_medium']) && empty($_COOKIE['utm_medium'])) {
							setcookie("utm_medium", "referral", time() + (86400 * 30), "/");
							$_SESSION['utm_medium']='referral';
						}

					} else {
						setcookie("utm_source", "direct", time() + (86400 * 30), "/");
						$_SESSION['utm_source']='direct';
					}


				}

			// Form Capture
			if(!empty($this->data)) {
				if(empty($this->data['address'])) {
					if((strtotime("now")-$this->data['pagetime'])>=3) {

						// UTMs

							if(!empty($_COOKIE['utm_source'])) {
								$this->request->data['utm_source']=$_COOKIE['utm_source'];
							} else if(!empty($_SESSION['utm_source'])) {
								$this->request->data['utm_source']=$_SESSION['utm_source'];
							} else {
								$this->request->data['utm_source']='';
							}

							if(!empty($_COOKIE['utm_medium'])) {
								$this->request->data['utm_medium']=$_COOKIE['utm_medium'];
							} else if(!empty($_SESSION['utm_medium'])) {
								$this->request->data['utm_medium']=$_SESSION['utm_medium'];
							} else {
								$this->request->data['utm_medium']='';
							}

							if(!empty($_COOKIE['utm_campaign'])) {
								$this->request->data['utm_campaign']=$_COOKIE['utm_campaign'];
							} else if(!empty($_SESSION['utm_campaign'])) {
								$this->request->data['utm_campaign']=$_SESSION['utm_campaign'];
							} else {
								$this->request->data['utm_campaign']='';
							}

							if(!empty($_COOKIE['utm_term'])) {
								$this->request->data['utm_term']=$_COOKIE['utm_term'];
							} else if(!empty($_SESSION['utm_term'])) {
								$this->request->data['utm_term']=$_SESSION['utm_term'];
							} else {
								$this->request->data['utm_term']='';
							}

							if(!empty($_COOKIE['utm_content'])) {
								$this->request->data['utm_content']=$_COOKIE['utm_content'];
							} else if(!empty($_SESSION['utm_content'])) {
								$this->request->data['utm_content']=$_SESSION['utm_content'];
							} else {
								$this->request->data['utm_content']='';
							}


							//Save Database
								$temp="";
								$temp.="****>~Email:~<****".$this->data['email']."****^~";
								$temp.="****>~First Name:~<****".$this->data['f_name']."****^~";
								$temp.="****>~Last Name:~<****".$this->data['l_name']."****^~";
								$temp.="****>~Phone Number:~<****".$this->data['phone']."****^~";
								$temp.="****>~Zip:~<****".$this->data['zip']."****^~";
								$temp.="****>~UTM Source:~<****".$this->data['utm_source']."****^~";
								$temp.="****>~UTM Medium:~<****".$this->data['utm_medium']."****^~";
								$temp.="****>~UTM Campaign:~<****".$this->data['utm_campaign']."****^~";
								$temp.="****>~UTM Content:~<****".$this->data['utm_content']."****^~";
								$temp.="****>~UTM Keyword:~<****".$this->data['utm_term']."****^~";


								$this->request->data['ip_address']=$_SERVER['REMOTE_ADDR'];
								$this->request->data['form']=$this->data['form'];
								$this->request->data['app_company_property_id']=00;

								$this->request->data['submission']=$temp;
								$this->AppFormSubmission->save($this->data);

								//Send Email
									$Email = new CakeEmail('mailgun');
									$Email->viewVars(array('data' => $this->data));
									$Email->emailFormat('html');
									$Email->to('name@domain.com');
									//$Email->returnPath('name@domain.com');
									//$Email->replyTo('name@domain.com');
									$Email->subject("Form");
									$Email->template('default');
									$Email->send();

					}
				}
			}



	}


	/***************************************************

	Index

	***************************************************/

	function index()
	{

		## Permissions
		# Typically applicable on client portals where there are permissions

		## Initialize
		# Define vars in controller action.

		## Logic

			

		## Form
		# Work on all incoming form submissions.

		## Logic
		# House general business logic and any incoming $_GET params condition checks.

		## Page

			$this->set('meta_title', '');
			$this->set('meta_description', '');

	}


	/***************************************************

	Page

	***************************************************/

	function page($pretty_url=NULL)
	{

		## Logic

			//Check valid page

				if(empty($pretty_url)) {
					$this->redirect("/");
				}


			//CMS Entry

				$cms_entry=$this->AppCmsEntry->query('
					SELECT
						AppCmsLayout.name,
						AppCmsTemplate.name,
						AppCmsEntry.`id`,AppCmsEntry.`meta_title`, AppCmsEntry.`meta_description`, AppCmsEntry.`meta_keywords`,AppCmsEntry.schema
					FROM
						app_cms_entries AppCmsEntry,
						app_cms_layouts AppCmsLayout,
						app_cms_templates AppCmsTemplate
					WHERE
						AppCmsEntry.app_cms_layout_id=AppCmsLayout.`id`
					AND
						AppCmsEntry.app_cms_template_id=AppCmsTemplate.`id`
					AND
						AppCmsEntry.status="ON"
					AND
						AppCmsEntry.app_company_property_id = '.$this->_company_property_id.'
					AND
						AppCmsEntry.pretty_url="'.addslashes($pretty_url).'"
				');

				if(empty($cms_entry)) {
					$this->redirect("/");
				}

			//Cms Layout

				$cms_layout=strtolower(str_replace(" ","_",$cms_entry[0]['AppCmsLayout']['name']));

			//Cms Template

				$cms_template=strtolower(str_replace(" ","_",$cms_entry[0]['AppCmsTemplate']['name']));

			//Cms Sections

				$cms_sections=$this->AppCmsSection->query('
					SELECT
						AppCmsSection.id, AppCmsSection.name, AppCmsSection.type, AppCmsSection.schema, AppCmsSection.'.$this->_published['field'].'
					FROM
						app_cms_sections AppCmsSection
					WHERE
						AppCmsSection.app_cms_entry_id='.$cms_entry[0]['AppCmsEntry']['id'].'
					AND
						AppCmsSection.status="ON"
					ORDER BY
						AppCmsSection.sort_weight ASC
				');


				$this->set('cms_sections', $this->formatCmsResults($cms_sections));

			## Page

				$this->set('pretty_url', $pretty_url);
				$this->set('page',trim('/', $pretty_url));
				$this->set('meta_title', $cms_entry[0]['AppCmsEntry']['meta_title']);
				$this->set('meta_description', $cms_entry[0]['AppCmsEntry']['meta_description']);

				$this->render($cms_template);
	}

}
?>
