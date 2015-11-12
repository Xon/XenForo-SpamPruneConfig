<?php

class SV_SpamPruneConfig_Listener
{
    const AddonNameSpace = 'SV_SpamPruneConfig_';

    public static function load_class($class, array &$extend)
    {
        $extend[] = self::AddonNameSpace.$class;
    }
}