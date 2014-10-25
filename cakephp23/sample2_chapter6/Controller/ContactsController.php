<?php
class ContactsController extends AppController {

	public $uses = array('Contact');
	
	/**
	 * beforeRenderコールバック
	 */
	public function beforeRender() {
		
		$this->set('sexList', $this->Contact->MtrSex->find('list'));
		$this->set('ageList', $this->Contact->MtrAge->find('list'));
		$this->set('favoliteList', $this->Contact->MtrFavolite->find('list'));
		
	}
	
	/**
	 * 問い合わせリスト
	 */
	public function index() {
		
		$contactData = $this->paginate();
		
		$this->set(compact('contactData'));
	}
	
	/**
	 * お問い合わせ詳細
	 */
	public function view($id) {
		
		//お問い合わせを捜して見つかったら表示
		//
		$contactData = $this->Contact->findById($id);
		if(empty($contactData)) {
			$this->Session->setFlash('お問い合わせが見つかりませんでした');
			$this->redirect(array('action'=> 'index'));
		}
		
		$this->set(compact('contactData'));
	}
	
	/**
	 * お問い合わせ編集
	 */
	public function edit($id) {
		
		//フォーム入力があった場合には保存処理。そうでない場合は初期値の準備
		//
		if($this->request->is('post') || $this->request->is('put')) {
			
			if($this->Contact->save($this->request->data)) {
				$this->Session->setFlash('問い合わせを保存しました');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('入力に間違いがあります');
			}
		} else {
			$this->request->data = $this->Contact->findById($id);
			if(empty($this->request->data)) {
				$this->Session->setFlash('お問い合わせが見つかりませんでした');
				$this->redirect(array('action'=> 'index'));
			}
		}
	}
	
	/**
	 * お問い合わせ削除
	 */
	public function delete($id) {
		
		//フォーム入力があった場合に削除処理。そうでない場合は初期値の準備
		//
		if($this->request->is('post') || $this->request->is('put')) {
			
			//削除実行。削除できない場合はエラー
			//
			if ($this->Contact->delete($id)) {
				$this->Session->setFlash('お問い合わせを削除しました');
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash('お問い合わせの削除に失敗しました');
			$this->redirect(array('action' => 'index'));
		}
		
		//お問い合わせを捜し、いなかったらエラー
		//
		$this->request->data = $this->Contact->findById($id);
		if (empty($this->request->data)) {
			$this->Session->setFlash('お問い合わせが見つかりませんでした');
			$this->redirect(array('action' => 'index'));
		}
	}
	
}
