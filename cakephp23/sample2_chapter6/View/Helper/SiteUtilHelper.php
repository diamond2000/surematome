<?php
/**
 * SiteUtilHelper
 */
App::uses('AppHelper', 'View/Helper');

class SiteUtilHelper extends AppHelper {

    /**
     * 使うヘルパーがあれば書きます
     */
    public $helpers = array('Html');

    /**
     * レイアウトの出力の前に実行される
     */
    public function beforeLayout(){
        // 処理をここに書きます
    }

    /**
     * ビューへの出力が始まる前に実行
     */
    public function beforeRender(){
        // 処理をここに書きます
    }

    /**
     * レイアウトの出力の後に実行される
     */
    public function afterLayout(){
        // 処理をここに書きます
    }

    /**
     * ビューへの出力が始まる後に実行
     */
    public function afterRender(){
        // 処理をここに書きます
    }
    
    /**
     * hello worldを出力
     * @return <>
     */
    public function helloWorld() {
        $result = $this->Html->div('hello', 'helloWorld');
        return $result;
    }

    /**
     * 空な場合は$defaultを返す
     *
     * @param <type> $array
     * @param <type> $key
     * @param <type> $default
     * @return <type>
     */
    public function ifEmptySetDefault($array, $key = null, $default = '', $h = true) {
        $output = (!empty($array[$key])) ? $array[$key] : $default;
        if($h) {
            $output = h($output);
        }
        return $output;
    }

}
