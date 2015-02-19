<?php

class SV_SpamPruneConfig_Listener
{
    const AddonNameSpace = 'SV_SpamPruneConfig';

    public static function load_class($class, array &$extend)
    {
        switch($class)
        {
            case 'XenForo_Model_SpamPrevention':
                $extend[] = self::AddonNameSpace.'_'.$class;
                break;
        }
    }
}