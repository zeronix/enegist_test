<?php

	/**
	 * @var $this    Controller
	 */
	class BookController extends Controller {
		var $breadcrumbs = array('หนังสือ' => array('book/'));

		public function actionIndex() {
			$this->breadcrumbs = array();
			$model             = Book::model()->findAll();
			$this->render(
				'index',
				array(
					'model' => $model,
				)
			);
		}

		public function actionAdmin($id = null) {
			/**
			 * @var $model           Book
			 */
			$model = new Book();
			if ($id) {
				$model = Book::model()->findByPk($id);
			}
			$alerts = array();
			if ($_POST) {
				$tmp               = $_POST;
				$book              = $tmp['Book'];
				$saveType          = $tmp['save'];
				$model->attributes = $book;
				$isNew             = false;
				if (!$model->id) {
					$isNew = true;
				}
				if ($model->save()) {
					$alerts['success']['Book'] = 'บันทึกข้อมูลหนังสือเรียบร้อยแล้ว';
				} else {
					$alerts['danger']['Book'] = $model->errors;
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
					'model'  => $model,
					'alerts' => $alerts,
				)
			);
		}
	}