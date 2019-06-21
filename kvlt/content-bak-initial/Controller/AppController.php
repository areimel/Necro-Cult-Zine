<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {


    /***************************************************

	FUNCTION
	formatCmsResults

	***************************************************/

	function formatCmsResults($cms_sections=NULL, $return_type="ASSOCIATIVE")
	{

		## Logic

			//Initialize

				$arr=array();

			//Format

				if(!empty($cms_sections)) {
					if($return_type=='ASSOCIATIVE') {
						for($i=0; $i<count($cms_sections); $i++) {
							if($cms_sections[$i]['AppCmsSection']['type']=="MEDIASLIDE") {
								$arr['slides'][$cms_sections[$i]['AppCmsSection']['name']]=$this->AppMediaSlide->find(
									"all",
									array(
										"conditions"=>array(
											'
													AppMediaSlide.app_media_slide_group_id='.$cms_sections[$i]['AppCmsSection']['published_body'].'
												AND
													AppMediaSlide.published="'.$this->_published['status'].'"
											'
										),
										"order"=>"AppMediaSlide.position asc"
									)
								);
							} else {
								$arr['entries'][trim($cms_sections[$i]['AppCmsSection']['name'])] = $cms_sections[$i]['AppCmsSection'][$this->_published['field']];
							}
						}
					} else if($return_type=='INDEXED') {

						for($i=0; $i<count($cms_sections); $i++) {
							if($cms_sections[$i]['AppCmsSection']['type']=="MEDIASLIDE") {

								$arr['slides'][$i]=$this->AppMediaSlide->find(
									"all",
									array(
										"conditions"=>array(
											'
													AppMediaSlide.app_media_slide_group_id='.$cms_sections[$i]['AppCmsSection'][$this->_published['field']].'
												AND
													AppMediaSlide.published="'.$this->_published['status'].'"
											'
										),
										"order"=>"AppMediaSlide.position asc"
									)
								);
							} else {
								$arr['entries'][$i] = $cms_sections[$i]['AppCmsSection'][$this->_published['field']];
							}
						}
					}
				}

				return $arr;

	}

}
