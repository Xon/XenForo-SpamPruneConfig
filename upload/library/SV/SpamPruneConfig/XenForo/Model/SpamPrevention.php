<?php
class SV_SpamPruneConfig_XenForo_Model_SpamPrevention extends XFCP_SV_SpamPruneConfig_XenForo_Model_SpamPrevention
{
    public function cleanupSpamTriggerLog($cutOff = null)
    {
        if ($cutOff === null)
        {
            $cutOff = XenForo_Application::get('options')->SV_SpamPruneConfig_Prune_Default * 86400;
        }

        if ($cutOff > 0)
        {
            $this->_getDb()->query("delete from xf_spam_trigger_log where content_type <> 'user' and log_date < ? ", array(XenForo_Application::$time - $cutOff));
        }
        $cutOff = XenForo_Application::get('options')->SV_SpamPruneConfig_Prune_User_Rejected;
        if ($cutOff > 0)
        {
            $this->_getDb()->query("delete from xf_spam_trigger_log where content_type = ? and result = ? and log_date < ? ", array('user', self::RESULT_DENIED, XenForo_Application::$time - $cutOff * 86400));
        }
        $cutOff = XenForo_Application::get('options')->SV_SpamPruneConfig_Prune_User_Moderated ;
        if ($cutOff > 0)
        {
            $this->_getDb()->query("delete from xf_spam_trigger_log where content_type = ? and result = ? and log_date < ? ", array('user', self::RESULT_MODERATED, XenForo_Application::$time - $cutOff * 86400));
        }
        $cutOff = XenForo_Application::get('options')->SV_SpamPruneConfig_Prune_User_Allowed ;
        if ($cutOff > 0)
        {
            $this->_getDb()->query("delete from xf_spam_trigger_log where content_type = ? and result = ? and log_date < ? ", array('user', self::RESULT_ALLOWED, XenForo_Application::$time - $cutOff * 86400));
        }
    }
}