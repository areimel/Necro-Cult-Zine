<?php
App::uses('BlogController', 'Controller');
class BlogController extends AppController {

	public $uses = array("AppFormSubmission","AppCmsEntry","AppCmsLayout","AppCmsRevision","AppCmsSection","AppBlogPost","AppBlogCategory");


	/*
		Staging & Product Environment Vars
		status = [YES/NO] = Used for media library
		field = Used to pull correct body from CMS
	*/

		public $_published=array(
			'status'=>'YES',
			'field'=>'published_body'
		);


	public function beforeFilter()
	{

		## Logic

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

				if(!empty($_GET['jkId'])) {
					$cookie_name = "jkid";
					$cookie_value = $_GET['jkId'];
					setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
					$_SESSION['jkId']=$_GET['jkId'];
				}

		## Page

			$cms_sections=$this->AppCmsSection->query('
				SELECT
					AppCmsSection.name, AppCmsSection.type, AppCmsSection.schema, AppCmsSection.'.$this->_published['field'].'
				FROM
					app_cms_sections AppCmsSection
				WHERE
					AppCmsSection.app_cms_entry_id=38
				AND
					AppCmsSection.status="ON"
				ORDER BY
					AppCmsSection.sort_weight ASC
			');
			$this->set('cms_header_footer', $this->formatCmsResults($cms_sections));

			$cms_sections=$this->AppCmsSection->query('
				SELECT
					AppCmsSection.name, AppCmsSection.type, AppCmsSection.schema, AppCmsSection.'.$this->_published['field'].'
				FROM
					app_cms_sections AppCmsSection
				WHERE
					AppCmsSection.app_cms_entry_id=40
				AND
					AppCmsSection.status="ON"
				ORDER BY
					AppCmsSection.sort_weight ASC
			');
			$this->set('cms_modal', $this->formatCmsResults($cms_sections));
	}


	/***************************************************

	Index

	***************************************************/
	function index($blog_category=NULL)
	{

		## Initialize

			$page_model="AppBlogPost";
			$_GET['page']=(!empty($_GET['page'])?$_GET['page']:0);
			$_GET['ajax']=(!empty($_GET['ajax'])?$_GET['ajax']:0);
			$offset=2;
			$conditions="";

		## Form

		## Logic

			//conditions

				if(!empty($blog_category)) {
					$conditions='
						AND
							AppBlogPost.id IN (
								SELECT
									app_blog_post_id
								FROM
									app_blog_post_categories,
									app_blog_categories
								WHERE
									app_blog_categories.name="'.addslashes(str_replace('-',' ',urldecode($blog_category))).'"
								AND
									app_blog_categories.id=app_blog_post_categories.app_blog_category_id
							)
					';
				} else if(!empty($_GET['search'])) {
					$conditions='
						AND
							(
									AppBlogPost.title like "%'.addslashes($_GET['search']).'%"
								OR
									AppBlogPost.body like "%'.addslashes($_GET['search']).'%"
							)
					';
				}

			//results
			$results=$this->$page_model->query('
				SELECT
					AppBlogPost.*,
					(
						SELECT
							GROUP_CONCAT(app_blog_categories.name)
						FROM
							app_blog_categories,
							app_blog_post_categories
						WHERE
							app_blog_categories.id=app_blog_post_categories.app_blog_category_id
						AND
							app_blog_post_categories.app_blog_post_id=AppBlogPost.id
					) as "categories"
				FROM
					app_blog_posts AppBlogPost
				WHERE
					AppBlogPost.status="ON"
				AND
					AppBlogPost.post_date<=CURDATE()
					'.$conditions.'
				ORDER BY
					AppBlogPost.post_date DESC
				LIMIT
					'.($_GET['page']*$offset).','.$offset.'
			');


			//results_total
			$results_total=$this->$page_model->query('
				SELECT
					count(AppBlogPost.id) as "total"
				FROM
					app_blog_posts AppBlogPost
				WHERE
					AppBlogPost.status="ON"
					'.$conditions.'
				AND
					AppBlogPost.post_date<=CURDATE()
			');

		## Page

			if(!empty($_GET['ajax'])) {
				$this->layout="ajax";
			}

			$this->set('blog_category', $blog_category);
			$this->set('blog_categories', $this->AppBlogCategory->find("list", array("order"=>"AppBlogCategory.name ASC")));
			$this->set('results_total', $results_total);
			$this->set('results', $results);
	}


	/***************************************************

	Post

	***************************************************/
	function post($slug=NULL)
	{

		## Initialize

			$page_model="AppBlogPost";

		## Form

		## Logic

			//verify

				if(empty($slug)) {
					$this->redirect("/blog");
				}

				$temp=explode("-",$slug);
				$id=end($temp);

				if(!ctype_digit($id)) {
					$this->redirect("/blog");
				}


			//results

				$result=$this->$page_model->query('
					SELECT
						AppBlogPost.*,
						(
							SELECT
								GROUP_CONCAT(app_blog_categories.name)
							FROM
								app_blog_categories,
								app_blog_post_categories
							WHERE
								app_blog_categories.id=app_blog_post_categories.app_blog_category_id
							AND
								app_blog_post_categories.app_blog_post_id=AppBlogPost.id
						) as "categories"
					FROM
						app_blog_posts AppBlogPost
					WHERE
						AppBlogPost.status="ON"
					AND
						AppBlogPost.post_date<=CURDATE()
					AND
						AppBlogPost.id='.addslashes($id).'
				');

		## Page

			$this->set('blog_categories', $this->AppBlogCategory->find("list", array("order"=>"AppBlogCategory.name ASC")));
			$this->set('result', $result);
	}

}?>
