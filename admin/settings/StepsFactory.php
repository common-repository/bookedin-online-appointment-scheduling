<?php

include_once('LoginStep.php');
include_once('ButtonStep.php');
include_once('SelectionStep.php');
include_once('WidgetStep.php');

class StepsFactory {
    public static function create($step_name, $plugin_name) {
        $step = ucwords($step_name) . "Step";

        if(class_exists($step)) {
            return new $step($plugin_name);
        } else {
            throw new Exception("Step {$step} doesn't exist");
        }
    }
}