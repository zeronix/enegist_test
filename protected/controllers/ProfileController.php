<?php

	/**
	 * @var $this        Controller
	 */
	class ProfileController extends Controller {
		var $breadcrumbs = array('ลูกค้า' => array('profile/'));

		public function actionIndex() {
			$this->breadcrumbs = array();
			$model             = Profile::model()->findAll();
			$this->render(
				'index',
				array(
					'model' => $model,
				)
			);
		}

		public function actionAdmin($id = null) {
			/**
			 * @var $model           Profile
			 * @var $oAddress        Address
			 */
			$model    = new Profile();
			$oAddress = new Address();
			$home     = new Address();
			$work     = new Address();
			if ($id) {
				$model = Profile::model()->findByPk($id);
			}
			$alerts = array();
			if ($_POST) {
				$tmp               = $_POST;
				$profile           = $tmp['Profile'];
				$address           = $tmp['Address'];
				$saveType          = $tmp['save'];
				$model->attributes = $profile;
				$isNew             = false;
				if (!$model->id) {
					$isNew = true;
				}
				if ($model->save()) {
					$alerts['success']['Profile'] = 'บันทึกข้อมูลลูกค้าเรียบร้อยแล้ว';
					$profile_id                   = $model->id;
					if ($model->addresses) {
						$addresses = $model->addresses;
						foreach ($addresses as $row) {
							switch ($row->address_type_id) {
								case 1:
									$home = $row;
									break;
								case 2:
									$work = $row;
									break;
							}
						}
					} else {
						// home address
						$home->profile_id      = $profile_id;
						$home->address_type_id = 1;
						// work address
						$work->profile_id      = $profile_id;
						$work->address_type_id = 2;
					}
					// loop for addresses
					foreach ($address as $attribute => $address_type) {
						foreach ($address_type as $address_type_id => $data) {
							// insert '-' to empty row for quick data validation
							switch ($address_type_id) {
								case 1:
									if (trim($data) !== '') {
										$home->$attribute = $data;
									} else {
										$home->$attribute = '-';
									}
									break;
								case 2:
									if (trim($data) !== '') {
										$work->$attribute = $data;
									} else {
										$work->$attribute = '-';
									}
									break;
							}
						}
					}
					if ($home->save()) {
						$alerts['success']['Home'] = 'บันทึกที่อยู่เรียบร้อยแล้ว';
					} else {
						$alerts['danger']['Home'] = $model->errors;
					}
					if ($work->save()) {
						$alerts['success']['Work'] = 'บันทึกที่อยู่ที่ทำงานเรียบร้อยแล้ว';
					} else {
						$alerts['danger']['Work'] = $model->errors;
					}
					if (!isset($alerts['danger'])) {
						if ($saveType === 'SaveAndNew') {
							$this->redirect($this->createUrl('admin'));
						} else {
							if ($isNew) {
								$this->redirect($this->createUrl('admin', array('id' => $model->id)));
							}
						}
					}
				} else {
					$alerts['danger']['Profile'] = $model->errors;
				}
			}
			$this->render(
				'admin',
				array(
					'model'   => $model,
					'address' => $oAddress,
					'alerts'  => $alerts,
				)
			);
		}

		public function actionExport() {
			/**
			 * @var $model Profile[]
			 */
			$cProfile = Profile::model();
			$model    = $cProfile->findAll();

			$arrProfiles = array();
			foreach ($model as $index => $profile) {
				// user object
				$arrProfiles[$index]['first_name']               = $profile->first_name;
				$arrProfiles[$index]['last_name']                = $profile->last_name;
				// home address object
				$arrProfiles[$index]['home_address']['address1'] = $profile->addresses[0]->address1;
				$arrProfiles[$index]['home_address']['address2'] = $profile->addresses[0]->address2;
				$arrProfiles[$index]['home_address']['city']     = $profile->addresses[0]->city;
				$arrProfiles[$index]['home_address']['country']  = $profile->addresses[0]->country;
				$arrProfiles[$index]['home_address']['zip_code'] = $profile->addresses[0]->zip_code;
				// work address object
				$arrProfiles[$index]['work_address']['address1'] = $profile->addresses[1]->address1;
				$arrProfiles[$index]['work_address']['address2'] = $profile->addresses[1]->address2;
				$arrProfiles[$index]['work_address']['city']     = $profile->addresses[1]->city;
				$arrProfiles[$index]['work_address']['country']  = $profile->addresses[1]->country;
				$arrProfiles[$index]['work_address']['zip_code'] = $profile->addresses[1]->zip_code;
				// borrowed books
				$arrBooks = array();
				foreach($profile->borrows as $row => $borrow) {
					$arrBooks[$row]['title'] = $borrow->book->title;
					$arrBooks[$row]['author'] = $borrow->book->author;
				}
				$arrProfiles[$index]['books'] = $arrBooks;
			}
			$json = json_encode($arrProfiles);

			echo $json;
		}
	}