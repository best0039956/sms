<?php
/**
 * @filesource modules/index/models/checker.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Index\Checker;

use Kotchasan\Language;

/**
 * ตรวจสอบข้อมูลสมาชิกด้วย Ajax
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Model extends \Kotchasan\Model
{
    /**
     * ฟังก์ชั่นตรวจสอบความถูกต้องของ username และตรวจสอบ username ซ้ำ
     */
    public function username()
    {
        // referer
        if (self::$request->isReferer()) {
            try {
                // ค่าที่ส่งมา
                $id = self::$request->post('id')->toInt();
                $value = self::$request->post('value')->url();
                // ตรวจสอบ username ซ้ำ
                $search = $this->db()->first($this->getTableName('user'), array('username', $value));
                if ($search && ($id == 0 || $id != $search->id)) {
                    echo Language::replace('This :name already exist', array(':name' => Language::get('Username')));
                }
            } catch (\Kotchasan\InputItemException $e) {
                echo Language::replace('Invalid :name', array(':name' => Language::get('Username')));
            }
        }
    }
}
