<?php
/*
 * LiveStreet CMS
 * Copyright © 2013 OOO "ЛС-СОФТ"
 *
 * ------------------------------------------------------
 *
 * Official site: www.livestreetcms.com
 * Contact e-mail: office@livestreetcms.com
 *
 * GNU General Public License, version 2:
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * ------------------------------------------------------
 *
 * @link http://www.livestreetcms.com
 * @copyright 2013 OOO "ЛС-СОФТ"
 * @author Maxim Mzhelskiy <rus.engine@gmail.com>
 *
 */

/**
 * Позволяет транслировать данные в json
 *
 * @param unknown_type $params
 * @param unknown_type $smarty
 * @return unknown
 */
function smarty_function_json($params, &$smarty)
{
    if (!array_key_exists('var', $params)) {
        trigger_error("json: missing 'var' parameter", E_USER_WARNING);
        return;
    }

    if (class_exists('Entity')
        && $params['var'] instanceof Entity
    ) {
        $aMethods = null;
        if (!empty($params['methods'])) {
            $aMethods = is_array($params['methods'])
                ? $params['methods']
                : explode(',', $params['methods']);
        }
        $var = func_convert_entity_to_array($params['var'], $aMethods);
    } else {
        $var = $params['var'];
    }

    $_contents = json_encode($var);

    if (!empty($params['assign'])) {
        $smarty->assign($params['assign'], $_contents);
    } else {
        return $_contents;
    }
}