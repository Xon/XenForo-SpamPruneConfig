<?php
class SV_SpamPruneConfig_XenForo_Model_SpamPrevention extends XFCP_SV_SpamPruneConfig_XenForo_Model_SpamPrevention
{
    public function cleanupSpamTriggerLog($cutOff = null)
    {
        if ($cutOff === null)
        {
            $cutOff = XenForo_Application::get('options')->SV_SpamPruneConfig_SpamTrigger_PruneDays * 86400;
        }
        if ($cutOff > 0)
        {
            $this->_getDb()->query("delete from xf_spam_trigger_log where content_type <> 'user' and log_date < ? ", array($cutOff));
        }
        
        $cutOff = XenForo_Application::get('options')->SV_SpamPruneConfig_SpamTrigger_User_Rejected_PruneDays ;
        if ($cutOff > 0)
        {
            $this->_getDb()->query("delete from xf_spam_trigger_log where content_type = ? and result = ? and log_date < ? ", array('user', self::RESULT_DENIED, $cutOff * 86400));
        }
        $cutOff = XenForo_Application::get('options')->SV_SpamPruneConfig_SpamTrigger_User_Moderated_PruneDays ;
        if ($cutOff > 0)
        {
            $this->_getDb()->query("delete from xf_spam_trigger_log where content_type = ? and result = ? and log_date < ? ", array('user', self::RESULT_MODERATED, $cutOff * 86400));
        }
        $cutOff = XenForo_Application::get('options')->SV_SpamPruneConfig_SpamTrigger_User_Allowed_PruneDays ;
        if ($cutOff > 0)
        {
            $this->_getDb()->query("delete from xf_spam_trigger_log where content_type = ? and result = ? and log_date < ? ", array('user', self::RESULT_ALLOWED, $cutOff * 86400));
        }
    }
/*
    public function cleanupContentSpamCheck($cutOff = null)
    {
        if ($cutOff === null)
        {
            $cutOff = XenForo_Application::get('options')->SV_SpamPruneConfig_ContentSpamCheckPruneDays * 86400;
        }

        $this->_getDb()->delete('xf_content_spam_cache', 'insert_date < ' . intval($cutOff));
    }
*/
}