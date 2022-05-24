<?php
/**
 * Daniel module for Craft CMS 3.x
 *
 * x
 *
 * @link      www.x.com
 * @copyright Copyright (c) 2022 Daniel
 */

namespace modules\danielmodule\services;

use modules\danielmodule\DanielModule;

use Craft;
use craft\base\Component;

/**
 * Event Service
 *
 * All of your module’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other modules can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Daniel
 * @package   DanielModule
 * @since     1
 */
class Event extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin/module file, call it like this:
     *
     *     DanielModule::$instance->event->exampleService()
     *
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';

        return $result;
    }
}
