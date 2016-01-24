<?php

	class SiteController extends Controller {
		var $breadcrumbs = array('เช่ายืม' => array('/'));

		/**
		 * Declares class-based actions.
		 */
		public function actions() {
			return array(
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha' => array(
					'class'     => 'CCaptchaAction',
					'backColor' => 0xFFFFFF,
				),
				// page action renders "static" pages stored under 'protected/views/site/pages'
				// They can be accessed via: index.php?r=site/page&view=FileName
				'page'    => array(
					'class' => 'CViewAction',
				),
			);
		}

		public function actionIndex() {
			$this->breadcrumbs = array();
			// borrowed books list
			$model = Borrow::model()->findAll();
			$this->render(
				'index',
				array(
					'model' => $model,
				)
			);
		}

		public function actionAdmin($id = null) {
			/**
			 * @var $model           Borrow
			 */
			$model = new Borrow();
			if ($id) {
				$model = Borrow::model()->findByPk($id);
			}
			$condition['profile'] = null;
			$condition['book'] = null;
			// if profile borrows 3 books, out.
			$profile_criteria            = new CDbCriteria();
			$profile_criteria->select    = 'profile_id';
			$profile_criteria->condition = 'return_date IS NULL';
			$profile_criteria->group     = 'profile_id';
			$profile_criteria->having    = 'COUNT(profile_id) = 3';
			$exceed                      = Borrow::model()->findAll($profile_criteria);
			$exclude                     = array();
			foreach ($exceed as $profile) {
				$exclude[] = $profile->profile_id;
			}
			if($exclude) {
				$condition['profile'] = 'id not in (' . implode(',', $exclude) . ')';
			}
			$profiles = Profile::model()->findAll($condition['profile']);
			// if book is not returned, cannot borrow
			$book_criteria               = new CDbCriteria();
			$book_criteria->select = 'book_id';
			$book_criteria->condition = 'return_date IS NULL';
			$unavailable_books = Borrow::model()->findAll($book_criteria);
			$exclude = array();
			foreach($unavailable_books as $book) {
				$exclude[] = $book->book_id;
			}
			if($exclude) {
				$condition['book'] = 'id not in (' . implode(',', $exclude) . ')';
			}
			$books  = Book::model()->findAll($condition['book']);
			$alerts = array();
			if ($_POST) {
				$tmp                   = $_POST;
				$borrow                = $tmp['Borrow'];
				$saveType              = $tmp['save'];
				$model->attributes     = $borrow;
				$model->check_out_date = date('Y-m-d');
				$model->due_date       = date('Y-m-d', strtotime('+7 day'));
				$isNew                 = false;
				if (!$model->id) {
					$isNew = true;
				}
				if ($model->save()) {
					$alerts['success']['Borrow'] = 'บันทึกข้อมูลการยืมหนังสือเรียบร้อยแล้ว';
				} else {
					$alerts['danger']['Borrow'] = $model->errors;
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
			}
			$this->render(
				'admin',
				array(
					'model'    => $model,
					'profiles' => $profiles,
					'books'    => $books,
					'alerts'   => $alerts,
				)
			);
		}

		public function actionReturn($id) {
			/**
			 * @var $model    Borrow
			 */
			$model              = Borrow::model()->findByPk($id);
			$model->return_date = date('Y-m-d');
			$model->save();
			if (strtotime($model->return_date) > strtotime($model->due_date)) {
				echo 'bad';
			} else {
				echo 'good';
			}
		}

		/**
		 * This is the action to handle external exceptions.
		 */
		public function actionError() {
			if ($error = Yii::app()->errorHandler->error) {
				if (Yii::app()->request->isAjaxRequest)
					echo $error['message'];
				else
					$this->render('error', $error);
			}
		}

		/**
		 * Displays the contact page
		 */
		public function actionContact() {
			$model = new ContactForm;
			if (isset($_POST['ContactForm'])) {
				$model->attributes = $_POST['ContactForm'];
				if ($model->validate()) {
					$name    = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
					$subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
					$headers = "From: $name <{$model->email}>\r\n" .
						"Reply-To: {$model->email}\r\n" .
						"MIME-Version: 1.0\r\n" .
						"Content-Type: text/plain; charset=UTF-8";

					mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
					Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
					$this->refresh();
				}
			}
			$this->render('contact', array('model' => $model));
		}

		/**
		 * Displays the login page
		 */
		public function actionLogin() {
			$model = new LoginForm;

			// if it is ajax validation request
			if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}

			// collect user input data
			if (isset($_POST['LoginForm'])) {
				$model->attributes = $_POST['LoginForm'];
				// validate user input and redirect to the previous page if valid
				if ($model->validate() && $model->login())
					$this->redirect(Yii::app()->user->returnUrl);
			}
			// display the login form
			$this->render('login', array('model' => $model));
		}

		/**
		 * Logs out the current user and redirect to homepage.
		 */
		public function actionLogout() {
			Yii::app()->user->logout();
			$this->redirect(Yii::app()->homeUrl);
		}
	}